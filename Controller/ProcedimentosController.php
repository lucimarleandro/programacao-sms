<?php

/**
 *
 * @author Jonathan Souza <rds_ralison@yahoo.com.br>
 * @property Procedimento $Procedimento
 * @property Acao $Acao
 */
class ProcedimentosController extends AppController {

    public $uses = array('Procedimento', 'Acao');
    
    /**
     * Chama a ação procedimentos especificando a carga apenas dos procedimentos
     * ambulatoriais.
     */
    public function ambulatoriais() {
        $this->setAction('procedimentos', PROC_AMBULATORIAL);
    }
    
    /**
     * Chama a ação procedimentos especificando a carga apenas dos procedimentos
     * hospitalares.
     */
    public function hospitalares() {
        $this->setAction('procedimentos', PROC_HOSPITALAR);
    }

    /**
     * Realiza a consulta na tabela de procedimentos, carregando apenas os
     * itens da tabela que estão de acordo com o tipo especificado como
     * argumento.
     * @param string $tipo
     */
    public function procedimentos($tipo = PROC_AMBULATORIAL) {
        if (!isset($this->request->params['named']['acao'])) {
            $this->Session->setFlash('Não foi possível identificar a ação selecionada.', 'flash_erro');
            $this->redirect($this->referer());
        } else
            $acaoId = $this->request->params['named']['acao'];
        
        $acao = $this->Acao->find('first', array(
            'conditions' => array('Acao.id' => $acaoId),
            'recursive' => -1
        ));
        if (!$acao) {
            $this->Session->setFlash('Não foi possível carregar informações da ação selecionada.', 'flash_erro');
            $this->redirect($this->referer());
        }
        
        $procs = $this->Procedimento->find('all', array(
            'conditions' => array(
                'Procedimento.tipo' => $tipo
            ),
            'order' => 'Procedimento.codigo ASC',
            'joins' => array(
                array(
                    'table' => 'orcamentos',
                    'alias' => 'Orcamento',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Orcamento.acao_id' => $acaoId,
                        'Orcamento.item_id = Procedimento.codigo',
                    )
                )
            ),
            'fields' => '*',
            'recursive' => 0
        ));
        
        $this->set('dados', (array('Procedimento' => $procs) + $acao));
        $this->set('tipo_proc', $tipo);
        $this->render('procedimentos');
    }
}
