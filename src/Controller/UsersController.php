<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('EmailTemplates');
        $this->loadModel('Groups');
        $this->loadComponent('Common');
    }

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
            $this->request->data['action'] = 'add';
            $autoPassword = $this->Common->generatePassword(10);
            $this->request->data['password'] = $autoPassword;
            
            // Adding internal user
            $this->request->data['is_admin_panel'] = 1;
            $archiveName = $this->Common->timestampFile($this->request->data('photo')["name"]);
            if (move_uploaded_file($this->request->data('photo')["tmp_name"], WWW_ROOT . Configure::read()['USER_PHOTO_UPLOAD_PATH'] . $archiveName) === false) {
                echo $this->Common->resultJSON("failed", "Internal file upload error. Please try again!");
                exit;
            }

            $this->request->data['photo'] = Configure::read()['USER_PHOTO_UPLOAD_PATH'] . $archiveName;
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

                    // Preparing new user registration email
                    $email_data = $this->EmailTemplates->find('all')->where(['unique_name' => 'new_user_registration'])->toArray();
                    $email_content = $this->Common->replaceEmailHashtags($email_data[0]['content'], $user->id);
                    $email_content = str_replace('#password#', $autoPassword, $email_content);

                    // TODO: Custom CC BCC Templates 
                    $response = $this->Common->sendMail($user->email, $email_data[0]['subject'], $email_content);

                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Users->delete($user);
                    $this->Flash->error(__('The user aro could not be saved. Please, try again.'));
                }
            } else {
                if ($user->errors()) {
                    $this->Flash->error(__($this->Common->toastErrorMessages($user->errors())), ['escape' => false]);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        }

        $groups = $this->Common->combineToSelect($this->Groups->find('all')->where(['id !=' => 1])->toArray(), 'id', 'name');
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
