<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 *
 * @method \App\Model\Entity\Dashboard[] paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->set('title', 'Admin panel');
    }

}
