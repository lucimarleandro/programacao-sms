<?php
App::uses('AppModel', 'Model');
/**
 * Acao Model
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
    
/**
 *
 * @var type 
 */
    public $validate = array(
        'descricao'=>array(
            'rule'=>'notEmpty',
            'message'=>'O campo não pode ficar vazio'
        ),
        'meta_programada'=>array(
            'rule'=>'notEmpty',
            'message'=>'O campo não pode ficar vazio'
        )
    );

}
