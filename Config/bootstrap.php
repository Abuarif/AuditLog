<?php

$stmodels = Configure::read('AuditLog.models');
if (!empty($stmodels)){
    $models = split(",", $stmodels);
    foreach ($models as $m) {
        Croogo::hookBehavior(trim($m), 'AuditLog.Auditable');
    }
}
        
CroogoNav::add('auditlog', array(
        'icon' => array('tasks', 'large'),
	'title' => __('Audit'),
	'url' => array(
		'admin' => true,
		'plugin' => 'audit_log',
		'controller' => 'audit_deltas',
		'action' => 'index',
	)));


CroogoNav::add('settings.children.auditlog', array(
		'title' => __('Audit Log'),
		'url' => array(
			'admin' => true,
			'plugin' => 'settings',
			'controller' => 'settings',
			'action' => 'prefix',
			'AuditLog',
		),
	));