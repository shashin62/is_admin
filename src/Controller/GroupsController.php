<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 *
 * @method \App\Model\Entity\Group[] paginate($object = null, array $settings = [])
 */
class GroupsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Common');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->disableCache();

            $result = $this->Connection->execute("select group_id, count(id) as cnt from users group by group_id")->fetchAll('assoc');
            $extra = [];
            foreach ($result as $value) {
                $extra['users_cnt'][$value['group_id']] = $value['cnt'];
            }
            
            $columns = array(
                array('db' => 'id', 'dt' => 0),
                array('db' => 'name',
                    'dt' => 1,
                    'formatter' => function($d, $row, $extra) {
                        return h($d);
                    }),
                array('db' => 'description',
                    'dt' => 2,
                    'formatter' => function($d, $row, $extra) {
                        return strlen($d) > 50 ? substr(h($d), 0, 50) . '...' : h($d);
                    }),
                array(
                    'db' => 'status',
                    'dt' => 3),
                array('db' => 'id',
                    'dt' => 4,
                    'formatter' => function($d, $row, $extra) {
                        return isset($extra['users_cnt'][$d]) == true ? $extra['users_cnt'][$d] : 0;
                    }),
                array('db' => 'modified', 'dt' => 5),
                array('db' => 'created', 'dt' => 6),
                array('db' => 'id', 'dt' => 7)
            );

            $columns_with_alias = array(
                array('db' => 'a.id', 'dt' => 0),
                array('db' => 'a.name', 'dt' => 1),
                array('db' => 'a.description', 'dt' => 2),
                array('db' => 'b.name as status', 'dt' => 3),
                array('db' => 'a.id', 'dt' => 4),
                array('db' => 'a.modified', 'dt' => 5),
                array('db' => 'a.created', 'dt' => 6),
                array('db' => 'a.id', 'dt' => 7)
            );

            // We do not show the Super User group to end-users ever, thus id!=1
            echo $this->Datatables->complex($this->request->data, 'groups a inner join status_masters b on a.status = b.flag', 'a.id', $columns, $columns_with_alias, 'a.id !=1', null, $extra);
            // #141759151
            exit;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $group = $this->Groups->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $aro = $this->Acl->Aro->newEntity();
                $aro = $this->Acl->Aro->patchEntity($aro, array(
                    'model' => 'Groups',
                    'foreign_key' => $group->id,
                    'parent_id' => null,
                    'alias' => $group->name
                ));
                if ($this->Acl->Aro->save($aro)) {
                    $this->Flash->success(__('The group has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Group->delete($group);
                    $this->Flash->error(__('The group could not be saved. Please, try again.'));
                }
            }
            if ($group->errors()) {
                $this->Flash->error(__($this->Common->toastErrorMessages($group->errors())), ['escape' => false]);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
