<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UsuariosController extends AppController {
    
/**
 * 
 */
    public function beforeRender() {        
        $this->Auth->allow(array('login', 'logout'));
    }


    /**
 * 
 */
    public function login() {
       if ($this->request->is('POST')) {           
           if(($usuario = $this->autenticaUsuario())) {
               $this->Auth->login($usuario['Usuario']);
               $this->redirect($this->Auth->redirect());
           }else {
                $this->Session->setFlash(__('Sua matrícula não foi encontrada.'), 'flash-erro');
           }           
        }
    }
    
/**
 * 
 */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
/**
 * 
 */
    private function autenticaUsuario() {
        $opcoes['conditions'] = array(
            'Usuario.matricula'=>$this->request->data['Usuario']['matricula']
        );        
        $usuario = $this->Usuario->find('first', $opcoes);
        
        if(!empty($usuario)) {            
            $modelVisita = ClassRegistry::init('Visita');
            $modelVisita->useTable = 'visitas';
            
            $registro['Visita']['matricula_id'] = $usuario['Usuario']['matricula'];
            $registro['Visita']['hora'] = date('Y-m-d H:i:s');
            
            $modelVisita->create();
            if(!$modelVisita->save($registro)) {
                return false;
            }
            
            return $usuario;
        }
        
        return false;
    }
}
?>
