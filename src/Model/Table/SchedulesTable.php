<?php
namespace App\Model\Table;

use App\Model\Entity\Organisation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organisations Model
 */
class SchedulesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('schedules');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            /*->add('adminId', 'valid', ['rule' => 'numeric'])
            ->requirePresence('adminId', 'create')
            ->notEmpty('adminId')
            ->add('organisationType', 'valid', ['rule' => 'numeric'])
            ->requirePresence('organisationType', 'create')
            ->notEmpty('organisationType')
            ->requirePresence('organisationName', 'create')
            ->notEmpty('organisationName')
            ->requirePresence('organisationAddress', 'create')
            ->notEmpty('organisationAddress')
            ->requirePresence('organisationPhone', 'create')
            ->notEmpty('organisationPhone')
            ->requirePresence('organisationEmail', 'create')
            ->notEmpty('organisationEmail');*/
            //->requirePresence('createdDate', 'create')
           // ->notEmpty('createdDate')
            //->requirePresence('updateddate', 'create')
            //->notEmpty('updateddate');

        return $validator;
    }
}
