<?php
App::uses('AppController', 'Controller');
/**
 * ObjetivosGerais Controller
 *
 * @property ObjetivoGeral $ObjetivoGeral
 * @property Orcamento $Orcamento
 * @property Acao $Acao
 *  
 */
class ObjetivosGeraisController extends AppController {
    
/**
 *
 * @var type 
 */
    public $uses = array('ObjetivoGeral', 'Orcamento', 'Acao', 'Area', 'Modulo');
    
/**
 * 
 * @param type $areaId
 */
    public function index($areaId = null) {
        
        $this->ObjetivoGeral->recursive = -1;
        $this->Area->recursive = -1;
        $this->Modulo->recursive = -1;
        
        if($areaId == null) {
            $this->Session->setFlash(__('Requisição inválida'), 'flash_erro');
            $this->redirect(array('controller'=>'modulos', 'action'=>'index'));
        }
        
        $area = $this->Area->findById($areaId);        
        if(empty($area)) {
            $this->Session->setFlash(__('Não foi possível processar a requisição. Tente novamente.'), 'flash_erro');
            $this->redirect('/');
        }
        
        $opcoes['conditions'] = array(
            'ObjetivoGeral.area_id'=>$areaId
        );
        $opcoes['order'] = array(
            'ObjetivoGeral.nome ASC'
        );
        $opcoes['fields'] = array(
            'ObjetivoGeral.id', 'ObjetivoGeral.nome'
        );
        
        $objetivosGerais = array('ObjetivoGeral'=>$this->ObjetivoGeral->find('list', $opcoes));
        $modulo = $this->Modulo->findById($area['Area']['modulo_id']);        
        $dados = $modulo + $area + $objetivosGerais;
        
        /**
         * Soma orçamento ações
         */
        $ids = array_keys($objetivosGerais['ObjetivoGeral']);
        $somaAcoes = array();
        foreach ($ids as $geral_id) {
            $acoes = $this->Acao->find('list', array(
                'fields' => 'Acao.id',
                'joins' =>array(
                    array(
                        'table' => 'objetivos_especificos',
                        'alias' => 'ObjetivoEspecifico',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ObjetivoEspecifico.id = Acao.objetivo_especifico_id'
                        )
                    ),
                    array(
                        'table' => 'objetivos_gerais',
                        'alias' => 'ObjetivoGeral',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ObjetivoGeral.id = ObjetivoEspecifico.objetivo_geral_id'
                        ) 
                    )
                ),
                'conditions' => array('ObjetivoGeral.id' => $geral_id)
            ));
            $acoes_ids = array_keys($acoes);

            $somaAcoes[$geral_id] = $this->Orcamento->totalPorAcao($acoes_ids);
        }
        
        $this->set(compact('dados', 'somaAcoes'));
    }
    
}
?>