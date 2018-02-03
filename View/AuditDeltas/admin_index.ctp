<?php
$this->Html->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__('Audit Delta'), $this->here);

$this->viewVars['showActions'] = false;
$this->extend('/Common/admin_index');

?>

<div class="auditDeltas index table">
	<h2><?php echo __('Audit Deltas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Audit.event'); ?></th>
                        <th><?php echo $this->Paginator->sort('Audit.model'); ?></th>
                        <th><?php echo $this->Paginator->sort('Audit.entity_id'); ?></th>
			<th><?php echo $this->Paginator->sort('property_name'); ?></th>
			<th><?php echo $this->Paginator->sort('old_value'); ?></th>
			<th><?php echo $this->Paginator->sort('new_value'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($auditDeltas as $auditDelta): ?>
	<tr>
		<td><?php echo h($auditDelta['Audit']['event']); ?>&nbsp;</td>
                <td><?php echo h($auditDelta['Audit']['model']); ?>&nbsp;</td>
                <td><?php echo h($auditDelta['Audit']['entity_id']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['property_name']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['old_value']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['new_value']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $auditDelta['AuditDelta']['id']), null, __('Are you sure you want to delete # %s?', $auditDelta['AuditDelta']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>
