<?php
App::uses('AppController', 'Controller');
/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
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
            if (($usuario = $this->autenticaUsuario())) {
                $this->Auth->login($usuario['Usuario']);

                // Verifica se é o primeiro acesso do usuário para redirecionar
                // ao manual.
                if ($this->Session->check('Usuario.primeiroAcesso'))
                    $this->redirect(array('controller' => 'manual', 'action' => 'index'));
                else
                    $this->redirect($this->Auth->loginRedirect);
            }else {
                $this->Session->setFlash(__('Sua matrícula não foi encontrada.'), 'flash_erro');
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
 * Realiza a verificação da matrícula informada pelo usuário e retorna os
 * dados do mesmo como um array.
 * @return array|boolean False se a matrícula não for encontrada.
 */
    private function autenticaUsuario() {
        $matricula = preg_replace('/[^0-9]/', '', $this->request->data['Usuario']['matricula']);
        if (!preg_match('/^[0-9]{6}$/', $matricula))
            return false;
        
        $opcoes['conditions'] = array('Usuario.matricula' => $matricula);        
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
            
            // Verifica se é o primeiro acesso do usuário.
            $v = $modelVisita->find('count', array(
                'conditions' => array('Visita.matricula_id' => $matricula)
            ));
            if ($v == 1)
                $this->Session->write('Usuario.primeiroAcesso', true);
            
            return $usuario;
        }
        
        return false;
    }
}
