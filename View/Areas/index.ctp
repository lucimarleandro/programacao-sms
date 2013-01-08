<table cellspacing="0" class="font-normal pad-medio">
    <?php if (count($dados['Area']) > 0) : ?>
        <caption>Selecione uma área para continuar</caption>
        <tbody>
            <?php foreach ($dados['Area'] as $id => $area) : ?>
                <tr>
                    <td>
                        <?php
                        echo $this->Html->link($area, array(
                            'controller' => 'objetivos_gerais',
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
            <th>
                Não é possível prosseguir porquê não há áreas cadastradas dentro
                deste módulo.<br />
                <?php
                echo $this->Html->link('clique para retornar à lista de módulos', array(
                    'controller' => 'modulos',
                    'action' => 'index'
                ));
                ?>
            </th>
        </tr>
<?php endif; ?>
</table>