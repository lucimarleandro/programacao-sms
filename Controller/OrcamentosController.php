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
        
        $this->redirect($this->referer(true));
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

    /**
     * Carrega os itens (geral e procedimentos) orçados na ação selecionada.
     */
    public function index() {
        $named = $this->request->params['named'];
        $acaoId = isset($named['acao']) ? $named['acao'] : false;
        $acao = is_numeric($acaoId) ? $this->Orcamento->Acao->find('first', array(
            'conditions' => array('Acao.id' => $acaoId),
            'recursive' => -1
        )) : false;
        
        if ($acao == 0) {
            $this->Session->setFlash('Não foi possível processar sua solicitação, tente novamente.');
            $this->redirect($this->request->referer());
        }
        
        // Carrega os itens gerais no orçamento da ação
        $orcamento['Itens'] = $this->Orcamento->find('all', array(
            'conditions' => array(
                'Orcamento.acao_id' => $acaoId,
                'Orcamento.tipo' => ORCAMENTO_ITENSGERAIS
            ),
            'fields' => array(
                'Orcamento.id',
                'Orcamento.qtde',
                'Item.id',
                'Item.valor',
                'Item.nome',
                'Item.descricao',
                'Item.metrica_id'
            )
        ));
        
        // Carrega os procedimentos no orçamento da ação
        $orcamento['Procedimentos'] = $this->Orcamento->find('all', array(
            'conditions' => array(
                'Orcamento.acao_id' => $acaoId,
                'Orcamento.tipo' => ORCAMENTO_PROCEDIMENTOS
            ),
            'fields' => array(
                'Orcamento.id',
                'Orcamento.qtde',
                'Procedimento.valor',
                'Procedimento.nome',
                'Procedimento.codigo',
                'Procedimento.tipo',
            )
        ));
        
        $this->set(compact('orcamento'));
        $this->set('dados', $acao);
    }

    public function removeItem() {
        if ($this->request->is('post')) {
            $oid = isset($this->request->data['orcamentoId']) ? $this->request->data['orcamentoId'] : false;
            if ($oid && is_numeric($oid)) {
                if (!$this->Orcamento->delete($oid))
                    $this->Session->setFlash('Houve uma falha ao remover o item. Tente outra vez.', 'flash_erro');
            }
        }
        $this->redirect($this->referer(true));
    }
}
