<?php
App::uses('AppModel', 'Model');
/**
 * Metrica Model
 *
 */
class Metrica extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'metricas';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany= array(
		'Item' => array(
			'foreignKey'=>'metrica_id',			
		)
	);

}
