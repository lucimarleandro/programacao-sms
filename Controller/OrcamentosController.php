<?php
App::uses('AppController', 'Controller');
/**
 * Orcamentos Controller
 *
 * @property Orcamento $Orcamento
 */
class OrcamentosController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Orcamento');
    
/**
 * 
 */
    public function add() {
        $this->autoRender = false;
        $this->Orcamento->create();
        $this->Orcamento->recursive = -1;
              
        $opcoes['conditions'] = array(
            'Orcamento.item_id'=>$this->request->data['Orcamento']['item_id'],
            'Orcamento.acao_id'=>$this->request->data['Orcamento']['acao_id']
        );
        $opcoes['fields'] = array(
            'Orcamento.id'
        );
        $orcamento = $this->Orcamento->find('first', $opcoes);
               
        if(!empty($orcamento)) {
            $this->Orcamento->id = $orcamento['Orcamento']['id'];
        }        
        if($this->Orcamento->save($this->request->data)) {
            $this->Session->SetFlash(__('Adicionado com sucesso'), 'flash_sucesso');
        }else {
            $this->Session->setFlash(__('Erro ao adicionar'), 'flah_erro');
        }
        
        $this->redirect(array('controller'=>'itens', 'action'=>'index', $this->request->data['Orcamento']['acao_id']));
    }
    
/**
 * 
 * @param type $acaoId
 */
    public function somaOrcamento($acaoId) {
        $this->autoRender = false;        
        $this->Orcamento->recursive = -1;
        
        $opcoes['joins'] = array(
            array(
                'table'=>'itens',
                'alias'=>'Item',
                'type'=>'INNER',
                'conditions'=>array(
                    'Orcamento.item_id = Item.id',
                    'Orcamento.acao_id'=>$acaoId
                )
            )
        );
        $opcoes['conditions'] = array(
            'Orcamento.acao_id'=>$acaoId
        );
        $opcoes['fields'] = array(
            'sum(Orcamento.qtde * Item.valor) AS soma'
        );
        
        $soma = $this->Orcamento->find('first', $opcoes);

        return doubleval($soma[0]['soma']);
    }

}
