<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Area', 'Modulo');
    
/**
 * 
 * @param type $modulo_id
 */
    public function index($moduloId = null) {
        
        if($moduloId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'Modulo.id'=>$moduloId
        );

        $dados = $this->Area->Modulo->find('first', $opcoes);

        $this->set(compact('dados'));
    }
    
}
?>
