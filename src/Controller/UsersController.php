<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->set('title', 'Add User');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $aro = $this->Acl->Aro->newEntity();
                $aro = $this->Acl->Aro->patchEntity($aro, array(
                    'model' => 'Users',
                    'foreign_key' => $user->id,
                    'parent_id' => $this->Access->get_aro_keys()[$user->group_id],
                    'alias' => $user->email
                ));

                if ($this->Acl->Aro->save($aro)) {

                    
                    
                    //Send email to user 
                    $emailTemplateTable = TableRegistry::get('email_templates');
                    $email_data = $emailTemplateTable->find('all')->where(['unique_name' => 'USER_FROM_ADMIN'])->toArray();

                    $email_content = $this->Common->modifyEmailContent($email_data[0]['content'], $user->id);

                    $temp['email'] = $this->request->data('email');
                    $temp['subject'] = $email_data[0]['name'];

                    if (stripos($email_content, "WEBSITE_LINK") !== false) {
                        $replace_with = $this->Common->getSettings('front', 'WEBSITE_LINK');
                        $email_content = str_ireplace("{{WEBSITE_LINK}}", $replace_with, $email_content);
                    }

                    if (stripos($email_content, "PASSWORD") !== false) {
                        $replace_with = $autoPassword;
                        $email_content = str_ireplace("{{PASSWORD}}", $replace_with, $email_content);
                    }

                    $temp['message'] = $email_content;
                    $response = $this->Common->sendMail($temp);


                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Users->delete($user);
                    $this->Flash->error(__('The user aro could not be saved. Please, try again.'));
                }





                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
