<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 */
class Item extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'itens';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo= array(
		'Metrica' => array(
			'foreignKey' => 'metrica_id',			
		)
	);

}
