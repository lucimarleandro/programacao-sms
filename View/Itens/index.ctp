<h1><i class="icon-asterisk"></i> Banco de Itens Gerais</h1>
<p>&nbsp;</p>
<table cellspacing="0" class="gradeada">
    <?php if (!isset($dados['Item']) || count($dados['Item']) == 0) : ?>
        <thead>
            <tr>
                <th style="width: 30%"></th>
                <th style="width: 40%">
                    <i class="icon-remove-sign icon-4x"></i><br /><br />
                    Não é possível realizar a tarefa de orçamentação
                    porque o banco de itens não está acessível no momento ou
                    nenhum item foi registrado nele.
                </th>
                <th style="width: 30%"></th>
            </tr>
        </thead>
    <?php else : ?>
        <?php
        // armazenamento em cache de dados que se repetem
        $acao_id = $dados['Acao']['id'];
        $formInit = $this->Form->create('Orcamento', array(
            'id' => false,
            'inputDefaults' => array('div' => false, 'label' => 'false', 'error' => false),
            'method' => 'post',
            'url' => array('controller' => 'orcamentos', 'action' => 'add')
        ));
        $formAcaoInput = $this->Form->hidden('Orcamento.acao_id', array('value' => $acao_id));
        $formEnd = $this->Form->end();
        $indisp = '<span class="small"><em>&lt;não disponível&gt;</em></span>';
        $btn_atualiza = $this->Form->button("<i class='icon-refresh'></i>", array(
            'type' => 'submit',
            'class' => 'minpadding',
            'title' => 'Atualizar quantidade'
        ));
        $btn_adiciona = $this->Form->button("<i class='icon-plus'></i>", array(
            'type' => 'submit',
            'class' => 'minpadding',
            'title' => 'Adicionar ao orçamento'
        ));
        ?>
        <thead>
            <tr>
                <th style="min-width: 15%">Nome</th>
                <th style="min-width: 35%">Descrição</th>
                <th>Marca</th>
                <th>Unidade de Medida</th>
                <th>Quantidade</th>
                <th style="min-width: 5%">Valor Unitátio</th>
                <th style="min-width: 5%">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados['Item'] as $item) : ?>
                <?php
                $i_id = $item['Item']['id'];
                $i_nome = $item['Item']['nome'];
                $i_marca = $item['Item']['marca'];
                $i_descr = $item['Item']['descricao'];
                $i_metrica = $item['Item']['metrica_id'];
                $i_fonte = isset($item['Fonte']['nome']) ? $item['Fonte']['nome'] : false;
                $o_qtde = isset($item['Orcamento']['qtde']) ? doubleval($item['Orcamento']['qtde']) : 0;
                $i_valor = $item['Item']['valor'];
                $s_total = ($i_valor * $o_qtde);
                $escalaU = ($i_valor > 0 && $i_valor < 0.01) ? 4 : 2;
                $escalaT = ($s_total > 0 && $s_total < 0.01) ? 4 : 2;
                $s_valor = number_format($i_valor, $escalaU, ',', '.');
                $s_total = number_format($s_total, $escalaT, ',', '.');
                ?>
                <tr>
                    <td><?php echo isset($i_nome) ? $i_nome : $indisp; ?></td>
                    <td>
                        <?php
                        echo $i_descr;
                        if ($i_fonte)
                            echo "<span class='block small' style='margin-top: 10px'><em>(Fonte: {$i_fonte})</em></span>";
                        ?>
                    </td>
                    <td class="centralizado"><?php echo isset($i_marca) ? $i_marca : $indisp; ?></td>
                    <td class="centralizado"><?php echo isset($i_metrica) ? $i_metrica : $indisp; ?></td>
                    <td class="centralizado nowrap">
                        <?php
                        echo $formInit;
                        echo $this->Form->text('Orcamento.qtde', array(
                            'value' => $o_qtde,
                            'style' => 'width: 30px; text-align: center',
                            'class' => 'minpadding',
                            'autocomplete' => 'off'
                        ));
                        echo ($o_qtde > 0) ? $btn_atualiza : $btn_adiciona;
                        echo $formAcaoInput;
                        echo $this->Form->hidden('Orcamento.item_id', array('value' => $i_id));
                        echo $this->Form->hidden('Orcamento.tipo', array('value' => ORCAMENTO_ITENSGERAIS));
                        echo $formEnd;
                        ?>
                    </td>
                    <td class="nowrap txt-direita">R$ <?php echo $s_valor; ?></td>
                    <td class="nowrap txt-direita">R$ <?php echo $s_total; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php endif; ?>
</table>
