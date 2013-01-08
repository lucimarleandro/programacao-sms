<?php 
echo $this->Form->create('Acao', array('url'=>array('controller'=>'acoes', 'action'=>'adicionar')));
    echo $this->Form->input('objetivo_especifico_id', array('type'=>'hidden', 'value'=>$dados['ObjetivoEspecifico']['id']));
    echo $this->Form->input('descricao', array('label'=>'Descrição da Ação')); 
    echo $this->Form->input('meta_programada', array('label'=>'Meta Programada'));
echo $this->Form->end('Salvar');
?>

<table>
    <thead>
        <tr>
            <th>Descrição da Ação</th>
            <th>Meta Programada</th>
            <th>Orçamento</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados['Acao'] as $valor): ?>
            <tr>
                <td><?php echo $valor['descricao'];?></td>
                <td><?php echo $valor['meta_programada'];?></td>
                <td>
                    <?php 
                    echo $this->Html->link('Orçar', array('controller'=>'itens', 'action'=>'index', $valor['id'])); 
                    echo ' / ';
                    echo $this->requestAction(array('controller'=>'orcamentos', 'action'=>'somaOrcamento', $valor['id']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>    
</table>