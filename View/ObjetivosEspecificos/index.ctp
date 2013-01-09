<table cellspacing="0" class="font-normal pad-medio">
    <?php if (count($dados['ObjetivoEspecifico']) > 0) : ?>
        <caption>Selecione um objetivo específico para continuar</caption>
        <tbody>
            <?php foreach ($dados['ObjetivoEspecifico'] as $id => $objetivo) : ?>
                <tr>
                    <td>
                        <?php
                        $url = array('controller' => 'acoes', 'action' => 'index', $id);
                        echo $this->Html->link($objetivo, $url);
                        ?>
                    </td>
                    <td style="width: 10%" class="centralizado">
                        <?php
                        // Quando for zero, não aparecerá na lista
                        if (isset($contaAcoes[$id])) {
                            $num = $contaAcoes[$id];
                            $texto = ($num > 1) ? "{$num} ações" : "1 ação";
                            echo $this->Html->link($texto, $url);
                        } else
                            echo "&nbsp;";
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