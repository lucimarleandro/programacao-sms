<?php
App::uses('AppModel', 'Model');
/**
 * Orcamento Model
 *
 * @property Acao $Acao
 * @property Item $Item
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
			'foreignKey' => 'item_id'
		)
	);
}
