<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * EmailTemplates Controller
 *
 * @property \App\Model\Table\EmailTemplatesTable $EmailTemplates
 *
 * @method \App\Model\Entity\EmailTemplate[] paginate($object = null, array $settings = [])
 */
class EmailTemplatesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('EmailHashtags');    
        $this->loadComponent('Common');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $emailTemplates = $this->paginate($this->EmailTemplates);

        $this->set(compact('emailTemplates'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $emailTemplate = $this->EmailTemplates->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['unique_name'] = strtolower(str_replace(' ', '_', $this->request->data['name']));
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email template could not be saved. Please, try again.'));
        }

        $tags = $this->EmailHashtags->find('all', [
            'order' => ['EmailHashtags.tag' => 'asc']
        ]);

        $this->set('tags', $tags);
        $this->set(compact('emailTemplate'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email template could not be saved. Please, try again.'));
        }
        $this->set(compact('emailTemplate'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailTemplate = $this->EmailTemplates->get($id);
        if ($this->EmailTemplates->delete($emailTemplate)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
