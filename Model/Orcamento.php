<?php
App::uses('AppModel', 'Model');
/**
 * Orcamento Model
 *
 * @property Acao $Acao
 * @property Item $Item
 * @property Procedimento $Procedimento
 */
class Orcamento extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Acao' => array(
			'className' => 'Acao',
			'foreignKey' => 'acao_id'
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
                        'conditions' => array('Orcamento.tipo' => 'I')
		),
                'Procedimento' => array(
                    'foreignKey' => 'item_id',
                    'conditions' => array('Orcamento.tipo' => 'P')
                )
	);

        /**
         * Calcula o valor total do orçamento de uma ação ou grupo de ações.
         * @param integer|array $acaoId
         * @return double
         */
        public function totalPorAcao($acaoId) {
            $procs = $this->find('first', array(
                'fields' => array('SUM(Procedimento.valor * Orcamento.qtde) AS soma'),
                'joins' => array(
                    array(
                        'table' => 'procedimentos',
                        'alias' => 'Procedimento',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Procedimento.codigo = Orcamento.item_id',
                            'Orcamento.tipo' => ORCAMENTO_PROCEDIMENTOS
                        )
                    )
                ),
                'conditions' => array('Orcamento.acao_id' => $acaoId),
                'recursive' => -1
            ));
            $itens = $this->find('first', array(
                'fields' => array('SUM(Item.valor * Orcamento.qtde) AS soma'),
                'joins' => array(
                    array(
                        'table' => 'itens',
                        'alias' => 'Item',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Item.id = Orcamento.item_id',
                            'Orcamento.tipo' => ORCAMENTO_ITENSGERAIS
                        )
                    )
                ),
                'conditions' => array('Orcamento.acao_id' => $acaoId),
                'recursive' => -1
            ));
            return (double) doubleval($procs[0]['soma'] + $itens[0]['soma']);
        }
}
