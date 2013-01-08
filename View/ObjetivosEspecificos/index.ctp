<table cellspacing="0" class="font-normal pad-medio">
    <?php if (count($dados['ObjetivoEspecifico']) > 0) : ?>
        <caption>Selecione um objetivo específico para continuar</caption>
        <tbody>
            <?php foreach ($dados['ObjetivoEspecifico'] as $id => $objetivo) : ?>
                <tr>
                    <td>
                        <?php
                        echo $this->Html->link($objetivo, array(
                            'controller' => 'acoes',
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
                Não é possível prosseguir porquê não há objetivos específicos
                cadastrados para o objetivo geral que você selecionou.
            </th>
        </tr>
    <?php endif; ?>
</table>