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
            $this->redirect('/');
        }
        
        $modulo = $this->Modulo->findById($moduloId);
        if(empty($modulo)) {
            $this->Session->setFLash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
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

        $areas = array('Area'=>$this->Area->find('list', $opcoes));        
        $dados = $modulo + $areas;
        
        $this->set(compact('dados'));
    }
    
}
?>
