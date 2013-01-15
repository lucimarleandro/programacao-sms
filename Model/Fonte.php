<?php

/**
 *
 * @author Jonathan Souza <rds_ralison@yahoo.com.br>
 */
class Fonte extends AppModel {

    public $useTable = 'itens_fontes';
    public $hasMany = array('Item', 'Procedimento');

}
