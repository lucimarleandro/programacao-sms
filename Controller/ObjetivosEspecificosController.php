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
    public $uses = array('ObjetivoEspecifico', 'ObjetivoGeral', 'Area', 'Modulo');
    
/**
 * 
 * @param type $objetivoGeralId
 */
    public function index($objetivoGeralId = null) {
        
        $this->ObjetivoEspecifico->recursive = -1;
        $this->ObjetivoGeral->recursive = -1;
        $this->Area->recursive = -1;
        $this->Modulo->recursive = -1;
        
        if($objetivoGeralId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'ObjetivoEspecifico.objetivo_geral_id'=>$objetivoGeralId
        );
        $opcoes['order'] = array(
            'ObjetivoEspecifico.nome ASC'
        );
        $opcoes['fields'] = array(
            'ObjetivoEspecifico.id', 'ObjetivoEspecifico.nome'
        );
        
        $objetivosEspecificos = array('ObjetivoEspecifico'=>$this->ObjetivoEspecifico->find('list', $opcoes));
        $objetivoGeral = $this->ObjetivoGeral->find('first', array('conditions'=>array('ObjetivoGeral.id'=>$objetivoGeralId)));
        $area = $this->Area->find('first', array('conditions'=>array('Area.id'=>$objetivoGeral['ObjetivoGeral']['area_id'])));
        $modulo = $this->Modulo->find('first', array('conditions'=>array('Modulo.id'=>$area['Area']['modulo_id'])));
        
        $dados = $modulo + $area + $objetivoGeral + $objetivosEspecificos;
        
        $this->set(compact('dados'));
    }
    
}
?>
