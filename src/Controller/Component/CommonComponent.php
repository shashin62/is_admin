<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class CommonComponent extends Component {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->Users = TableRegistry::get('Users');
        $this->Connection = ConnectionManager::get('default');
    }

    public function toastErrorMessages($errors) {
        $error_msg = [];
        foreach ($errors as $errors) {
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    $error_msg[] = $error;
                }
            } else {
                $error_msg[] = $errors;
            }
        }

        if (!empty($error_msg)) {
            return implode("<br>", $error_msg);
        }
    }

    public function combineToSelect($result_set, $id_column, $value_column) {
        $result = [];
        foreach ($result_set as $value) {
            $result[$value[$id_column]] = $value[$value_column];
        }
        return $result;
    }

}
