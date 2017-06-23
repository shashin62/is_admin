<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\GroupsTable|\Cake\ORM\Association\BelongsTo $Groups
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
    }

    public function findAuth(Query $query, array $options) {
        $query->select(['id', 'username', 'password', 'firstname', 'lastname', 'group_id', 'is_admin_panel', 'status'])->where(['Users.status' => 1]);
        return $query;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->email('email')
                ->requirePresence('email', 'create')
                ->notEmpty('email')
                ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->allowEmpty('address');

        $validator
                ->requirePresence('password', 'create')
                ->notEmpty('password');

        $validator
                ->allowEmpty('firstname');

        $validator
                ->allowEmpty('formername');

        $validator
                ->allowEmpty('lastname');

        $validator
                ->allowEmpty('headline');

        $validator
                ->integer('industry')
                ->requirePresence('industry', 'create')
                ->notEmpty('industry');

        $validator
                ->allowEmpty('summary');

        $validator
                ->allowEmpty('photo');

        $validator
                ->integer('is_deleted')
                ->requirePresence('is_deleted', 'create')
                ->notEmpty('is_deleted');

        $validator
                ->integer('is_admin_panel')
                ->requirePresence('is_admin_panel', 'create')
                ->notEmpty('is_admin_panel');

        $validator
                ->allowEmpty('forgot_token');

        $validator
                ->allowEmpty('access_token');

        $validator
                ->dateTime('last_login')
                ->requirePresence('last_login', 'create')
                ->notEmpty('last_login');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));

        return $rules;
    }

}
