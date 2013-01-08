<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 */
class Area extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'areas';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Modulo' => array(
			'foreignKey' => 'modulo_id',			
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ObjetivoGeral' => array(
			'foreignKey' => 'area_id',
			'dependent' => false,
		)
	);

}
