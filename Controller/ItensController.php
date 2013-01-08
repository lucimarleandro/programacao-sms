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
    public $uses = array('Item');
    
/**
 * 
 */
    public function index($acaoId = null) {
        $this->Item->recursive = -1;
        
        if($acaoId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
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
            array(
                'table'=>'metricas',
                'alias'=>'Metrica',
                'type'=>'INNER',
                'conditions'=>array(
                    'Item.metrica_id = Metrica.id'
                )
            )
        );
        $opcoes['order'] = array(
            'Item.nome'=>'ASC'
        );
        $opcoes['fields'] = array(
            'Item.*', 'Orcamento.qtde', 'Metrica.id'
        );
        
        $dados = $this->Item->find('all', $opcoes);

        $this->set(compact('dados', 'acaoId'));
    }
}
?>
