<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Auth Controller
 *
 *
 * @method \App\Model\Entity\Auth[] paginate($object = null, array $settings = [])
 */
class AuthController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['login', 'logout', 'forgot']);
    }

    public function login() {
        $this->set('title', 'Login');
        $this->viewBuilder()->layout('public');
        if ($this->request->is('post')) {

            //#141207253
            $message = 'Invalid username or password, try again';
            if (trim($this->request->data['email']) == '' && trim($this->request->data['password']) == '') {
                $message = 'Please enter username and password';
            } else if (trim($this->request->data['email']) == '') {
                $message = 'Please enter username';
            } else if (trim($this->request->data['password']) == '') {
                $message = 'Please enter password';
            }
            $user = $this->Auth->identify();
            if ($user) {
                // #141390803
                if ($user["is_admin_panel"] == 1) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $message = 'You are not authorized.';
                }
            }
            $this->Flash->error(__($message));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function forgot($email = null, $token = null) {
        $this->viewBuilder()->layout('public');
        $this->set('title', 'Forgot password');
        $this->set('email', $email);
        $this->set('token', $token);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->find('all')->where(['email' => $this->request->data['email']])->first();

            if ($user) {
                if ($user->is_admin_panel == 1) {
                    if ($this->request->data['token'] == null || $this->request->data['token'] == "") {
                        $this->request->data['action'] = 'forgot';
                        $newToken = $this->Common->generatePassword(50);
                        $this->request->data['forgot_token'] = $newToken;

                        $user = $this->Users->patchEntity($user, $this->request->data, ['validate' => false]);
                        if ($this->Users->save($user)) {
                            $email_data = $this->EmailTemplates->find('all')->where(['unique_name' => 'reset_password'])->toArray();
                            $email_content = $this->Common->modifyEmailContent($email_data[0]['content'], $user->id);
                            //$email_content = str_replace("{{LINK}}", Configure::read('App.fullBaseUrl') . '/admin/forgot/' . urlencode($user->email) . '/' . $newToken, $email_content);
                            $email_content = str_replace("{{LINK}}", 'http://192.168.15.108/linkcxo-web/admin/forgot/' . urlencode($user->email) . '/' . $newToken, $email_content);
                            $temp['email'] = $this->request->data('email');
                            $temp['subject'] = $email_data[0]['name'];
                            $temp['message'] = $email_content;
                            $this->Common->sendMail($temp);
                            $this->Flash->success(__('The request has been saved. You should recieve a mail shortly.'));
                            return $this->redirect(['action' => 'login']);
                        } else {
                            $this->Flash->error(__('The request could not be saved. Please, try again.'));
                        }
                    } else {
                        if ($user->forgot_token == $this->request->data['token']) {
                            $user = $this->Users->patchEntity($user, $this->request->data, ['validate' => false]);
                            if ($this->Users->save($user)) {
                                if ($this->Connection->update('users', ['forgot_token' => ''], ['id' => $user->id])) {
                                    $this->Flash->success(__('Password reset successfully.'));
                                    return $this->redirect(['action' => 'login']);
                                } else {
                                    $this->Flash->error(__('Error processing your request. Please, try again.'));
                                }
                            } else {
                                $this->Flash->error(__('Error processing your request. Please, try again.'));
                            }
                        } else {
                            $this->Flash->error(__('Error processing your request. Please, try again.'));
                        }
                    }
                } else {
                    // #141390803
                    $this->Flash->error(__('You are not authorized.'));
                }
            } else {
                //#141207905
                if (trim($this->request->data['email']) == '') {
                    $this->Flash->error(__('Please enter email address.'));
                } else {
                    $this->Flash->error(__('The email id is not registered with LinkCXO'));
                }
            }
        }
    }

}
