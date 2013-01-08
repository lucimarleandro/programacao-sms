<table cellspacing="0" class="font-normal pad-plus">
    <?php if (count($dados['Modulo']) > 0) : ?>
        <caption>Selecione um módulo para continuar</caption>
        <tbody>
            <?php foreach ($dados['Modulo'] as $id => $modulo) : ?>
                <tr>
                    <td>
                        <?php
                        echo $this->Html->link($modulo, array(
                            'controller' => 'areas',
                            'action' => 'index',
                            $id
                        ));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php else : ?>
        <tr><th>Não é possível prosseguir porquê não há módulos cadastrados para iniciar a programação.</th></tr>
    <?php endif; ?>
</table>