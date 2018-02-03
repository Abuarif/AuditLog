<?php
App::uses('AppController', 'Controller');
/**
 * AuditDeltas Controller
 *
 * @property AuditDelta $AuditDelta
 */
class AuditDeltasController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AuditDelta->recursive = 0;
		$this->set('auditDeltas', $this->paginate());
	}


/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AuditDelta->id = $id;
		if (!$this->AuditDelta->exists()) {
			throw new NotFoundException(__d('croogo', 'Invalid audit delta'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AuditDelta->delete()) {
			$this->Session->setFlash(__d('croogo', 'Audit delta deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__d('croogo', 'Audit delta was not deleted'), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
}
