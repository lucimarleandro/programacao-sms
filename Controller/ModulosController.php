<?php

class ModulosController extends AppController {
    
/**
 * 
 */
    public function index() {
        $opcoes['order'] = array(
            'Modulo.nome'=>'ASC'
        );
        $opcoes['fields'] = array(
            'Modulo.id', 'Modulo.nome'
        );
        
        $dados = $this->Modulo->find('all', $opcoes);
        
        $this->set(compact('dados'));
    }
}
?>
