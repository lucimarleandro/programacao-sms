<div class="navorcamento">
    <div class="legenda">
        <i class="icon-plus icon-2x"></i><br />
        Adicionar itens:
    </div>
    <?php
    echo $this->Html->link('<i class="icon-asterisk icon-2x"></i> ITENS GERAIS', array(
        'controller' => 'itens',
        'action' => 'index',
        $dados['Acao']['id']), array('escape' => false));
    echo $this->Html->link('<i class="icon-hospital icon-2x"></i> PROCEDIMENTOS HOSPITALARES', array(
        'controller' => 'procedimentos',
        'action' => 'hospitalares',
        'acao' => $dados['Acao']['id']), array('escape' => false));
    echo $this->Html->link('<i class="icon-ambulance icon-2x"></i> PROCEDIMENTOS AMBULATORIAIS', array(
        'controller' => 'procedimentos',
        'action' => 'ambulatoriais',
        'acao' => $dados['Acao']['id']), array('escape' => false));
    ?>
</div>

<table cellspacing="0" class="bordered">
    <caption>Itens Gerais</caption>
    <thead>
        <tr>
            <th style="min-width: 20%">Nome</th>
            <th style="min-width: 50%">Descrição</th>
            <th>Qtde</th>
            <th>Valor Unitário</th>
            <th>Valor Total</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($orcamento['Itens']) > 0) : ?>
            <?php
            $rm_url = array('controller' => 'orcamentos', 'action' => 'removeItem');
            $rm_msg = 'Tem certeza que deseja remover esse item do orçamento da ação selecionada?';
            $rm_texto = '<i class="icon-remove"></i> remover';
            $sp_off = '<span class="small">&lt;não disponível&gt;</span>';
            foreach ($orcamento['Itens'] as $item) {
                $o_id = $item['Orcamento']['id'];
                $s_valor = number_format($item['Item']['valor'], 2, ',', '.');
                $s_total = number_format($item['Item']['valor'] * $item['Orcamento']['qtde'], 2, ',', '.');
                $s_nome = isset($item['Item']['nome']) ? $item['Item']['nome'] : $sp_off;
                ?>
                <tr>
                    <td><?php echo $s_nome; ?></td>
                    <td><?php echo $item['Item']['descricao']; ?></td>
                    <td class="centralizado nowrap">
                        <?php
                        echo $item['Orcamento']['qtde'], ' ';
                        echo mb_strtolower($item['Item']['metrica_id'], 'utf-8');
                        ?>
                    </td>
                    <td class="centralizado nowrap">R$ <?php echo $s_valor; ?></td>
                    <td class="centralizado nowrap">R$ <?php echo $s_total; ?></td>
                    <td class="acoes nowrap">
                        <?php
                        $opts = array('data' => array('orcamentoId' => $o_id), 'escape' => false);
                        echo $this->Form->postLink($rm_texto, $rm_url, $opts, $rm_msg);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        <?php else : ?>
            <tr>
                <th colspan="9">Não há itens gerais orçados nesta ação.</th>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<p>&nbsp;</p>

<!-- PROCEDIMENTOS -->
<table cellspacing="0" class="bordered">
    <caption>Procedimentos</caption>
    <thead>
        <tr>
            <th style="min-width: 10%">Código</th>
            <th style="min-width: 50%">Procedimento</th>
            <th>Tipo</th>
            <th>Qtde / Frequência</th>
            <th>Valor Unitário</th>
            <th>Valor Total</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($orcamento['Procedimentos']) > 0) : ?>
            <?php
            $rm_url = array('controller' => 'orcamentos', 'action' => 'removeItem');
            $rm_msg = 'Tem certeza que deseja remover esse item do orçamento da ação selecionada?';
            $rm_texto = '<i class="icon-remove"></i> remover';
            $sp_off = '<span class="small">&lt;não disponível&gt;</span>';
            foreach ($orcamento['Procedimentos'] as $item) {
                $o_id = $item['Orcamento']['id'];
                $s_valor = number_format($item['Procedimento']['valor'], 2, ',', '.');
                $s_total = number_format($item['Procedimento']['valor'] * $item['Orcamento']['qtde'], 2, ',', '.');
                $s_tipo = ($item['Procedimento']['tipo'] == 'A') ? "AMBULATORIAL" : "HOSPITALAR";
                ?>
                <tr>
                    <td class="centralizado"><?php echo $item['Procedimento']['codigo']; ?></td>
                    <td><?php echo $item['Procedimento']['nome']; ?></td>
                    <td><?php echo $s_tipo; ?></td>
                    <td class="centralizado nowrap">
                        <?php echo $item['Orcamento']['qtde'], ' '; ?>
                        <span class="block">freq</span>
                    </td>
                    <td class="centralizado nowrap">R$ <?php echo $s_valor; ?></td>
                    <td class="centralizado nowrap">R$ <?php echo $s_total; ?></td>
                    <td class="acoes nowrap">
                        <?php
                        $opts = array('data' => array('orcamentoId' => $o_id), 'escape' => false);
                        echo $this->Form->postLink($rm_texto, $rm_url, $opts, $rm_msg);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        <?php else : ?>
            <tr>
                <th colspan="9">Não há procedimento orçados nesta ação.</th>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
