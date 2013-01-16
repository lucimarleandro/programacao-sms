<?php
App::uses('AppController', 'Controller');
/**
 * ObjetivosGerais Controller
 *
 * @property ObjetivosGerais $ObjetivosGerais
 */
class ObjetivosGeraisController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('ObjetivoGeral', 'Area', 'Modulo');
    
/**
 * 
 * @param type $areaId
 */
    public function index($areaId = null) {
        
        $this->ObjetivoGeral->recursive = -1;
        $this->Area->recursive = -1;
        $this->Modulo->recursive = -1;
        
        if($areaId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $area = $this->Area->findById($areaId);        
        if(empty($area)) {
            $this->Session->setFlash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
        }
        
        $opcoes['conditions'] = array(
            'ObjetivoGeral.area_id'=>$areaId
        );
        $opcoes['order'] = array(
            'ObjetivoGeral.nome ASC'
        );
        $opcoes['fields'] = array(
            'ObjetivoGeral.id', 'ObjetivoGeral.nome'
        );
        
        $objetivosGerais = array('ObjetivoGeral'=>$this->ObjetivoGeral->find('list', $opcoes));
        $modulo = $this->Modulo->findById($area['Area']['modulo_id']);        
        $dados = $modulo + $area + $objetivosGerais;
        
        $this->set(compact('dados'));
    }
    
}
?>