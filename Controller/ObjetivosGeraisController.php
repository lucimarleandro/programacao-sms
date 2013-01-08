<?php
/**
 * 
 */
class ObjetivosGeraisController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('ObjetivoGeral');
    
/**
 * 
 * @param type $areaId
 */
    public function index($areaId = null) {
        
        if($areaId == null) {
            $this->Session->flash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'Area.id'=>$areaId
        );
        
        $dados = $this->ObjetivoGeral->Area->find('first', $opcoes);
        
        $this->set(compact('dados'));
    }
    
}
?>