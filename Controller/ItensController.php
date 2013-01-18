<?php
App::uses('AppController', 'Controller');
/**
 * Itens Controller
 *
 * @property Item $Item
 */
class ItensController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Item', 'Acao');
    
/**
 * 
 */
    public function index($acaoId = null) {
        $this->Item->recursive = -1;
        $this->Acao->recursive = -1;
        
        if($acaoId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $acao = $this->Acao->findById($acaoId);        
        if(empty($acao)) {
            $this->Session->setFLash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
        }
        
        $opcoes['joins'] = array(
            array(
                'table'=>'orcamentos',
                'alias'=>'Orcamento',
                'type'=>'LEFT',
                'conditions'=>array(
                    'Orcamento.item_id = Item.id',
                    'Orcamento.acao_id'=>$acaoId
                )
            ),
            // Junta com os dados da fonte.
            array(
                'table' => 'itens_fontes',
                'alias' => 'Fonte',
                'type' => 'LEFT',
                'conditions' => array('Fonte.id = Item.fonte_id')
            )
        );
        $opcoes['order'] = array(
            'Item.nome'=>'ASC'
        );
        $opcoes['fields'] = array(
            'Item.*', 'Orcamento.qtde', 'Fonte.nome'
        );
        $opcoes['limit'] = 300;
        $itens = array('Item'=>$this->Item->find('all', $opcoes));
        $dados = $acao + $itens;
        
        $this->set(compact('dados'));
    }
}
?>
