<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AcoMasters Model
 *
 * @property \App\Model\Table\AcoMastersTable|\Cake\ORM\Association\BelongsTo $ParentAcoMasters
 * @property \App\Model\Table\AcoMastersTable|\Cake\ORM\Association\HasMany $ChildAcoMasters
 *
 * @method \App\Model\Entity\AcoMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\AcoMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AcoMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AcoMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AcoMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AcoMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AcoMaster findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AcoMastersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('aco_masters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {

        $validator
                ->requirePresence('aco_title', 'create')
                ->notEmpty('aco_title');

        $validator
                ->integer('sort_order')
                ->requirePresence('sort_order', 'create')
                ->notEmpty('sort_order');

        $validator
                ->integer('parent_id')
                ->requirePresence('parent_id', 'create')
                ->notEmpty('parent_id');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->integer('type')
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        return $validator;
    }
}
