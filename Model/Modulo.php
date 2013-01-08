<?php
App::uses('AppModel', 'Model');
/**
 * Area Model
 *
 */
class Modulo extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'modulos';


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Area' => array(
			'foreignKey' => 'modulo_id',
			'dependent' => false,
		)
	);

}
