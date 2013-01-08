<table cellspacing="0" class="font-normal pad-medio">
    <?php if (count($dados) > 0) : ?>
        <caption>Selecione um objetivo geral para continuar</caption>
        <tbody>
            <?php foreach ($dados['ObjetivoGeral'] as $id => $objetivo) : ?>
                <tr>
                    <td>
                        <?php
                        echo $this->Html->link($objetivo, array(
                            'controller' => 'objetivos_especificos',
                            'action' => 'index',
                            $id
                        ));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php else : ?>
        <tr>
            <th>Não é possível prosseguir porquê não há objetivos gerais inseridos nesta área.</th>
        </tr>
    <?php endif; ?>
</table>