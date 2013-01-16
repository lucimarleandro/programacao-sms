<?php
App::uses('AppController', 'Controller');
/**
 * ObjetivosEspecificos Controller
 *
 * @property ObjetivoEspecifico $ObjetivoEspecifico
 * @property Acao $Acao
 * @property Orcamento $Orcamento
 */
class ObjetivosEspecificosController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('ObjetivoEspecifico', 'ObjetivoGeral', 'Area', 'Modulo', 'Acao', 'Orcamento');
    
/**
 * 
 * @param type $objetivoGeralId
 */
    public function index($objetivoGeralId = null) {
        
        $this->ObjetivoEspecifico->recursive = -1;
        $this->ObjetivoGeral->recursive = -1;
        $this->Area->recursive = -1;
        $this->Modulo->recursive = -1;
        $this->Acao->recursive = -1;
        
        if($objetivoGeralId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $objetivoGeral = $this->ObjetivoGeral->findById($objetivoGeralId);
        if(empty($objetivoGeral)) {
            $this->Session->setFLash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
        }
                
        $opcoes['conditions'] = array(
            'ObjetivoEspecifico.objetivo_geral_id'=>$objetivoGeralId
        );
        $opcoes['order'] = array(
            'ObjetivoEspecifico.nome ASC'
        );
        $opcoes['fields'] = array(
            'ObjetivoEspecifico.id', 'ObjetivoEspecifico.nome'
        );
        
        $objetivosEspecificos = array('ObjetivoEspecifico'=>$this->ObjetivoEspecifico->find('list', $opcoes));
        $area = $this->Area->findById($objetivoGeral['ObjetivoGeral']['area_id']);
        $modulo = $this->Modulo->findById($area['Area']['modulo_id']);
        
         $dados = $modulo + $area + $objetivoGeral + $objetivosEspecificos;
        
        /* Conta a quantidade de ações de cada objetivo específico */
        unset($opcoes);        
        $ids = array_keys($objetivosEspecificos['ObjetivoEspecifico']);
        $opcoes['conditions'] = array(
            'Acao.objetivo_especifico_id'=>$ids    
        );
        $opcoes['fields'] = array(
            'Acao.objetivo_especifico_id AS id', 'count(Acao.objetivo_especifico_id) AS total'
        );
        $opcoes['group'] = array(
            'Acao.objetivo_especifico_id'
        );
        $acoes = $this->Acao->find('all', $opcoes);
        
        $contaAcoes = array();
        foreach($acoes as $acao):
            $contaAcoes[$acao['Acao']['id']] = $acao[0]['total'];
        endforeach;
        /* */
                
        /**
         * Soma orçamento ações
         */
        $somaAcoes = array();
        foreach ($ids as $espec_id) {
            $acoes = $this->Acao->find('list', array(
                'fields' => 'Acao.id',
                'conditions' => array('Acao.objetivo_especifico_id' => $espec_id)
            ));
            $acoes_ids = array_keys($acoes);
            $somaAcoes[$espec_id] = $this->Orcamento->totalPorAcao($acoes_ids);
        }
        
        $this->set(compact('dados', 'contaAcoes', 'somaAcoes'));
    }
    
}
?>
