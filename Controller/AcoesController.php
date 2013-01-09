<?php
App::uses('AppController', 'Controller');
/**
 * Acoes Controller
 *
 * @property Acao $Acao
 */
class AcoesController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Acao', 'ObjetivoEspecifico', 'Area');
    
/**
 * 
 * @param type $objetivoEspecificoId
 */
    public function index($objetivoEspecificoId = null) {        
        $this->Area->recursive = 0;
        
        if($objetivoEspecificoId == null) {
            $this->Session->setflash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $objetivoEspecifico = $this->ObjetivoEspecifico->findById($objetivoEspecificoId);
        if(empty($objetivoEspecifico)) {
            $this->Session->setFLash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
        }
        
        $area_modulo = $this->Area->findById($objetivoEspecifico['ObjetivoGeral']['area_id']);      
        $dados = $area_modulo + $objetivoEspecifico;

        $this->set(compact('dados'));        
    }
    
/**
 * 
 */
    public function adicionar() {
        //$this->autoRender = false;
        if($this->request->is('POST')) {
            $this->Acao->create();
            if($this->Acao->save($this->request->data)) {
                $this->Session->setFlash(__('Cadastrado com sucesso'), 'flash_sucesso');
                $this->redirect(array('controller'=>'acoes', 'action'=>'index', $this->request->data['Acao']['objetivo_especifico_id']));
            }else {
                $this->Session->setFLash(__('Não foi possível cadastrar'), 'flash_erro');
                $this->setAction('index', $this->request->data['Acao']['objetivo_especifico_id']);
            }            
        }
    }
    
}
?>

