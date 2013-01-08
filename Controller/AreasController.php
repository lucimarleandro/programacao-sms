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
        $this->Area->recursive = -1;
        $this->Modulo->recursive = -1;
        
        if($moduloId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'Area.modulo_id'=>$moduloId
        );        
        $opcoes['order'] = array(
            'Area.nome ASC'
        );
        $opcoes['fields'] = array(
            'Area.id', 'Area.nome'
        );

        $areas = $this->Area->find('list', $opcoes);        
        $modulo = $this->Area->Modulo->find('first', array('conditions'=>array('Modulo.id'=>$moduloId)));
        
        $dados = $modulo + array('Area'=>$areas);
        
        $this->set(compact('dados'));
    }
    
}
?>
