<?php
switch ($tipo_proc) {
    case PROC_AMBULATORIAL:
        $icone = 'ambulance';
        $texto = 'Banco de Procedimentos Ambulatoriais';
        break;
    case PROC_HOSPITALAR:
        $icone = 'hospital';
        $texto = 'Banco de Procedimentos Hospitalares';
        break;
    default:
        $icone = 'asterisk';
        $texto = 'Banco de Procedimentos Gerais';
        break;
}
?>
<h1><i class="icon-<?php echo $icone; ?>"></i>&nbsp;<?php echo $texto; ?></h1>

<table cellspacing="0" class="gradeada">
    <?php if (!isset($dados['Procedimento']) || count($dados['Procedimento']) == 0) : ?>
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
            'url' => array('controller' => 'orcamentos', 'action' => 'add')));
        $formAcaoInput = $this->Form->hidden('Orcamento.acao_id', array('value' => $acao_id));
        $formEnd = $this->Form->end();
        $indisp = '<span class="small"><em>&lt;não disponível&gt;</em></span>';
        $btn_atualiza = $this->Form->button("<i class='icon-refresh'></i>", array(
            'type' => 'submit',
            'class' => 'minpadding',
            'title' => 'Atualizar quantidade'));
        $btn_adiciona = $this->Form->button("<i class='icon-plus'></i>", array(
            'type' => 'submit',
            'class' => 'minpadding',
            'title' => 'Adicionar ao orçamento'));
        ?>
        <thead>
            <tr>
                <th style="min-width: 7%">Código</th>
                <th style="min-width: 50%">Procedimento</th>
                <th>Fonte</th>
                <th>Quantidade</th>
                <th>Frequência</th>
                <th style="min-width: 5%">Valor Unitátio</th>
                <th style="min-width: 5%">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados['Procedimento'] as $item) : ?>
                <?php
                $i_id = $item['Procedimento']['codigo'];
                $i_nome = $item['Procedimento']['nome'];
                $i_valor = number_format($item['Procedimento']['valor'], 2, ',', '.');
                $i_fonte = isset($item['Fonte']['nome']) ? $item['Fonte']['nome'] : $indisp;
                $o_qtde = isset($item['Orcamento']['qtde']) ? doubleval($item['Orcamento']['qtde']) : 0;
                $s_total = number_format($item['Procedimento']['valor'] * $o_qtde, 2, ',', '.');
                ?>
                <tr>
                    <td class="centralizado"><?php echo $i_id; ?></td>
                    <td><?php echo $i_nome; ?></td>
                    <td class="centralizado"><?php echo $i_fonte; ?></td>
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
                        echo $this->Form->hidden('Orcamento.tipo', array('value' => ORCAMENTO_PROCEDIMENTOS));
                        echo $formEnd;
                        ?>
                    </td>
                    <td class="centralizado">--</td>
                    <td class="nowrap centralizado">R$ <?php echo $i_valor; ?></td>
                    <td class="nowrap centralizado">R$ <?php echo $s_total; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php endif; ?>
</table>
