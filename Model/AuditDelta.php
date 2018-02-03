<?php
App::uses('AuditLogAppModel', 'AuditLog.Model');

/**
 * AuditDelta Model
 *
 * @property Audit $Audit
 */
class AuditDelta extends AuditLogAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'audit_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'property_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Audit' => array(
			'className' => 'Audit',
			'foreignKey' => 'audit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $order = array('Audit.created DESC');
        
        public $limit = 50;
}
