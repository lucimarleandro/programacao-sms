<?php
App::uses('AppController', 'Controller');
/**
 * ObjetivosEspecificos Controller
 *
 * @property ObjetivoEspecifico $ObjetivoEspecifico
 */
class ObjetivosEspecificosController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('ObjetivoEspecifico', 'Modulo');
    
/**
 * 
 * @param type $objetivoGeralId
 */
    public function index($objetivoGeralId = null) {
        
        if($objetivoGeralId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'ObjetivoGeral.id'=>$objetivoGeralId
        );
        $dados = $this->ObjetivoEspecifico->ObjetivoGeral->find('first', $opcoes);
        
        $this->Modulo->recursive = -1;
        $modulo = $this->Modulo->find('first', array('conditions'=>array('Modulo.id'=>$dados['Area']['modulo_id'])));
        $dados = $modulo + $dados;

        $this->set(compact('dados'));
    }
    
}
?>
