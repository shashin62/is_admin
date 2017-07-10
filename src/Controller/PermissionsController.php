<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 *
 * @method \App\Model\Entity\Group[] paginate($object = null, array $settings = [])
 */
class PermissionsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Common');
        $this->loadModel('AcoMasters');
        $this->Connection = ConnectionManager::get('default');
    }

    public function beforeFilter(Event $event) {
        $this->access_map_user = $this->Access->get_access_map($this->Auth->user()["aro_user_key"]);
        $this->access_map_group = $this->Access->get_access_map($this->Auth->user()["aro_group_key"]);
        $this->permission_columns = $this->Access->get_permission_cols();
    }

    public function group() {
        if ($this->request->is('post') && $this->request->is('ajax')) {
            // code to generate menu tree 
            // code specifications for fancy tree plugin as found on extra_trees.html, https://github.com/mar10/fancytree/wiki
            $all_menu_items = $this->AcoMasters->find('all', [
                        'order' => ['AcoMasters.parent_id' => 'asc', 'AcoMasters.sort_order' => 'asc']
                    ])
                    ->where(['type' => '0'])
                    ->toArray();

            $all_menu_items_desc = $this->AcoMasters->find('all', [
                        'order' => ['AcoMasters.id' => 'desc']
                    ])
                    ->where(['type' => '0'])
                    ->toArray();

            $distinct_parents = $this->Connection->execute("select count(*) as cnt from (select distinct(parent_id) from " . $this->AcoMasters->table() . ") as a")->fetchAll('assoc');
            $distinct_parents = $distinct_parents[0]['cnt'];

            $i = 0;
            $old_parent_id = '';
            $menu_items = [];
            foreach ($all_menu_items as $value) {
                if ($value['parent_id'] != $old_parent_id) {
                    // Reset the counter for new parent id
                    $i = 0;
                }

                // Assigning key as id of the record
                $menu_items[$value['parent_id']][$i]['key'] = $value['id'];
                // If the record is primary menu item, mark it as folder
                if ($value['parent_id'] == 0) {
                    $menu_items[$value['parent_id']][$i]['folder'] = true;
                }

                // By default, everything is expanded false
                $menu_items[$value['parent_id']][$i]['expanded'] = false;

                // Create a permission data based on access map and adding custom data
                foreach ($this->permission_columns as $column) {
                    $menu_items[$value['parent_id']][$i]['data']['access'][$column['column_name']] = $this->Access->read_access_map($column['column_name'], $value['id'], $this->access_map_user) == 1 || $this->Access->read_access_map($column['column_name'], $value['id'], $this->access_map_user) == 1 ? 'checked' : '';
                }
                $menu_items[$value['parent_id']][$i]['data']['menu_type'] = $value['menu_type'];
                
                // Aco title
                $menu_items[$value['parent_id']][$i]['title'] = $value['aco_title'];
                $old_parent_id = $value['parent_id'];
                $i++;
            }

            $old_menu_items = $menu_items;
            $break_flag = false;
            for ($i = 0; $i < $distinct_parents; $i++) {
                $new_menu_items = $menu_items;
                $last_item_key = 0;
                foreach ($all_menu_items_desc as $value) {
                    $break_flag = false;
                    foreach ($new_menu_items as $key2 => $value2) {
                        if ($key2 == $value['id']) {
                            $new_menu_items[$value['parent_id']][$value['sort_order']]['children'] = $value2;
                            $last_item_key = $key2;
                            $break_flag = true;
                            break;
                        }
                    }
                    if ($break_flag) {
                        unset($new_menu_items[$last_item_key]);
                        break;
                    }
                }
                $menu_items = $new_menu_items;
            }

            echo json_encode($menu_items[0]);
            exit;
        }
    }

}
