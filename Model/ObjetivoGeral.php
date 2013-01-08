<?php
App::uses('AppModel', 'Model');
/**
 * ObjetivoGeral Model
 *
 */
class ObjetivoGeral extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'objetivos_gerais';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Area'=> array(
			'foreignKey' => 'area_id',			
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ObjetivoEspecifico'=> array(
			'foreignKey' => 'objetivo_geral_id',
			'dependent' => false,
		)
	);

}
