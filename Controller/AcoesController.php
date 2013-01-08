<?php

/**
 * 
 */
class AcoesController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Acao');
    
/**
 * 
 * @param type $objetivoEspecificoId
 */
    public function index($objetivoEspecificoId = null) {
        
        if($objetivoEspecificoId == null) {
            $this->Session->setflash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $opcoes['conditions'] = array(
            'ObjetivoEspecifico.id'=>$objetivoEspecificoId
        );
        
        $dados = $this->Acao->ObjetivoEspecifico->find('first', $opcoes);
        
        $this->Acao->ObjetivoEspecifico->ObjetivoGeral->Area->recursive = 0;
        $area_modulo = $this->Acao->ObjetivoEspecifico->ObjetivoGeral->Area->find('first', array('conditions'=>array('Area.id'=>$dados['ObjetivoGeral']['area_id'])));
      
        $dados['Area'] = $area_modulo['Area'];
        $dados['Modulo'] = $area_modulo['Modulo'];

        $this->set(compact('dados'));        
    }
    
/**
 * 
 */
    public function adicionar() {
        $this->autoRender = false;
        if($this->request->is('POST')) {
            $this->Acao->create();
            if($this->Acao->save($this->request->data)) {
                $this->Session->setFlash(__('Cadastrado com sucesso'), 'flash_sucesso');
            }else {
                $this->Session->setFLash(__('Não foi possível cadastrar'), 'flash_erro');
            }
            
            $this->redirect(array('controller'=>'acoes', 'action'=>'index', $this->request->data['Acao']['objetivo_especifico_id']));
        }
    }
    
}
?>

