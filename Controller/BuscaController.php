<?php

/**
 * Realiza a lógica de busca no banco de dados dos itens para orçamento.
 * 
 * @author Jonathan Souza <rds_ralison@yahoo.com.br>
 */
class BuscaController extends AppController {

    public function index() {
        $opcoes = array(
            'IG' => 'Itens Gerais',
            'PA' => 'Procedimentos Ambulatoriais',
            'PH' => 'Procedimentos Hospitalares'
        );
        $this->set(compact('opcoes'));
    }
    
    public function busca() {
//        if (!isset($q)) {
//            $this->Session->setFlash('A busca não pode ser acessada desta forma', 'flash_aviso');
//            $this->redirect($this->referer());
//        }
    }

}
