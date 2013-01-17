<?php

/**
 *
 * @author Jonathan Souza <rds_ralison@yahoo.com.br>
 */
class ManualController extends AppController {

    public $uses = false;

    public function index() {
        if ($this->Session->check('Usuario.primeiroAcesso')) {
            $this->Session->delete('Usuario.primeiroAcesso');
            $this->set('primeiroAcesso', true);
        }
    }

}
