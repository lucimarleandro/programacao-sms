<table>
    <thead>
        <tr>
            <td>Nome</td>
            <td>Descrição</td>
            <td>Marca</td>
            <td>Unidade de medida</td>
            <td>Valor</td>
            <td>Quantidade</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $valor): ?>
            <tr>
                <td><?php echo $valor['Item']['nome']; ?></td>
                <td><?php echo $valor['Item']['descricao']; ?></td>
                <td><?php echo $valor['Item']['marca']; ?></td>
                <td><?php echo $valor['Metrica']['id']; ?></td>
                <td><?php echo $valor['Item']['valor']; ?></td>
                <td>
                    <?php 
                    echo $this->Form->create('Orcamento', array('url'=>array('controller'=>'orcamentos', 'action'=>'add')));
                        echo $this->Form->input('qtde', array('type'=>'text', 'label'=>false, 'value'=>$valor['Orcamento']['qtde'] == null ? 0 : $valor['Orcamento']['qtde'])); 
                        echo $this->Form->input('acao_id', array('type'=>'hidden', 'value'=>$acaoId));
                        echo $this->Form->input('item_id', array('type'=>'hidden', 'value'=>$valor['Item']['id']));
                    echo $this->Form->end('Atualizar');
                    ?>
                </td>
            </tr>    
        <?php endforeach; ?>
    </tbody>
</table>
