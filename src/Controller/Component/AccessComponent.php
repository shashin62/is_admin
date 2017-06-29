<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class AccessComponent extends Component {

    public $components = ['Acl.Acl', 'Auth', 'Flash'];

    public function get_aro_keys($model = 'Groups') {
        $results = $this->Connection->execute("select a.id, a.foreign_key from aros a where a.parent_id is null and a.model = :model", ["model" => $model])->fetchAll('obj');
        $aro_keys = [];
        foreach ($results as $row) {
            $aro_keys[$row->foreign_key] = $row->id;
        }
        return $aro_keys;
    }

}
