<?php

class ItensController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Item');
    
/**
 * 
 */
    public function index() {

        $opcoes['order'] = array(
            'Item.nome'=>'ASC'
        );
        
        $dados = $this->Item->find('all', $opcoes);
        
        $this->set(compact('dados'));
    }
}
?>
