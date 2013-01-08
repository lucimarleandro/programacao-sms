<table>
    <thead>
        <tr>
            <td>Nome</td>
            <td>Descrição</td>
            <td>Marca</td>
            <td>Unidade de medida</td>
            <td>Valor</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $valor): ?>
            <tr>
                <td><?php echo $valor['Item']['nome']; ?></td>
                <td><?php echo $valor['Item']['descricao']; ?></td>
                <td><?php echo $valor['Item']['marca']; ?></td>
                <td><?php echo $valor['Metrica']['nome_extenso']; ?></td>
                <td><?php echo $valor['Item']['valor']; ?></td>
            </tr>    
        <?php endforeach; ?>
    </tbody>
</table>