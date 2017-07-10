<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class AccessComponent extends Component {

    public $components = ['Acl.Acl', 'Auth', 'Flash'];

    public function initialize(array $config) {
        parent::initialize($config);
        $this->Connection = ConnectionManager::get('default');
    }

    public function get_aro_keys($model = 'Groups', $foreign_key = null) {
        if ($foreign_key == null)
            $results = $this->Connection->execute("select a.id, a.foreign_key from aros a where a.parent_id is null and a.model = :model", ["model" => $model])->fetchAll('obj');
        else
            $results = $this->Connection->execute("select a.id, a.foreign_key from aros a where a.model = :model and foreign_key = :foreign_key", ["model" => $model, "foreign_key" => $foreign_key])->fetchAll('obj');
        $aro_keys = [];
        foreach ($results as $row) {
            $aro_keys[$row->foreign_key] = $row->id;
        }
        return $aro_keys;
    }

    public function get_permission_cols() {
        return $this->Connection->execute("select column_name from information_schema.columns where table_name='aros_acos' and column_name like '\_%' and table_schema = :table_schema", ['table_schema' => $this->Connection->config()['database']])->fetchAll('assoc');
    }

    public function get_access_map($aro_id) {
        $access_map = [];
        $permission_columns = $this->get_permission_cols();
        $aros_acos = $this->Connection->execute("select a.* from aros_acos a where a.aro_id = :aro_id ", ["aro_id" => $aro_id])->fetchAll('assoc');
        foreach ($aros_acos as $aro_aco) {
            foreach ($permission_columns as $column) {
                $access_map[$column['column_name']][$aro_aco['aco_id']] = $aro_aco[$column['column_name']];
            }
        }
        return $access_map;
    }

    public function read_access_map($permission, $aco_id, $access_map) {
        if (isset($access_map[$permission][$aco_id])) {
            return $access_map[$permission][$aco_id];
        } else {
            return 0;
        }
    }

}
