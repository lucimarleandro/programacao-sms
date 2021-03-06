<?php
App::uses('AppController', 'Controller');
/**
 * Modulos Controller
 *
 * @property Modulo $Modulo
 */
class ModulosController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('Modulo');
    
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
        
        $dados = array('Modulo'=>$this->Modulo->find('list', $opcoes));

        $this->set(compact('dados'));
    }
}
?>
