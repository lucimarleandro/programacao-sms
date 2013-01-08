<?php
App::uses('AppModel', 'Model');
/**
 * ObjetivoEspecifico Model
 *
 */
class ObjetivoEspecifico extends AppModel {
    
/**
 *
 * @var type 
 */
    public $useTable = 'objetivos_especificos';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ObjetivoGeral'=> array(
			'foreignKey' => 'objetivo_geral_id',			
		)
	);
    
/**
* hasMany associations
*
* @var array
*/
	public $hasMany = array(
		'Acao'=> array(
			'foreignKey' => 'objetivo_especifico_id',
			'dependent' => false,
		)
	);

}
