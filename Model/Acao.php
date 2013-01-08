<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 */
class Acao extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'acoes';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ObjetivoEspecifico'=> array(
			'foreignKey' => 'objetivo_especifico_id',			
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Orcamento'=> array(
			'foreignKey' => 'acao_id',
			'dependent' => false,
		)
	);

}
