<?php

/**
 *
 * @author Jonathan Souza <rds_ralison@yahoo.com.br>
 * @property Fonte $Fonte
 */
class Procedimento extends AppModel {

    public $useTable = 'procedimentos';
    public $primaryKey = 'codigo';
    public $belongsTo = array('Fonte');

}
