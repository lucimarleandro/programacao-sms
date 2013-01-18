<div class="navorcamento">
    <div style="float: right">
        <div class="legenda" style="border-left: 1px solid #ccc"><i class="icon-search icon-3x"></i></div>
        <div class="form-busca-itens" style="padding: 1px 8px; line-height: 1.7em; float: left">
            Procurar por:<br />
            <input type="text" size="30" />
            <button><i class="icon-search"></i> Procurar</button>
        </div>
    </div>
    
    <div class="legenda"><i class="icon-filter icon-3x"></i></div>
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
            <th>Unidade</th>
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
                        <?php echo $item['Item']['metrica_id']; ?>
                    </td>
                    <td class="centralizado nowrap">
                        <?php echo $item['Orcamento']['qtde']; ?>
                    </td>
                    <td class="centralizado nowrap">R$ <?php echo $s_valor; ?></td>
                    <td class="centralizado nowrap">R$ <?php echo $s_total; ?></td>
                    <td class="acoes nowrap centralizado">
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
            <th>Qtde</th>
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
                $i_valor = $item['Procedimento']['valor'];
                $i_qtde = $item['Orcamento']['qtde'];
                $s_total = ($i_valor * $i_qtde);
                $escalaU = ($i_valor < 0.01 && $i_valor > 0) ? 4 : 2;
                $escalaT = ($s_total < 0.01 && $s_total > 0) ? 4 : 2;
                $s_valor = number_format($i_valor, $escalaU, ',', '.');
                $s_total = number_format($s_total, $escalaT, ',', '.');
                $s_tipo = ($item['Procedimento']['tipo'] == 'A') ? "AMBULATORIAL" : "HOSPITALAR";
                ?>
                <tr>
                    <td class="centralizado"><?php echo $item['Procedimento']['codigo']; ?></td>
                    <td><?php echo $item['Procedimento']['nome']; ?></td>
                    <td class="centralizado"><?php echo $s_tipo; ?></td>
                    <td class="centralizado nowrap">
                        <?php echo $i_qtde; ?>
                    </td>
                    <td class="txt-direita nowrap">R$ <?php echo $s_valor; ?></td>
                    <td class="txt-direita nowrap">R$ <?php echo $s_total; ?></td>
                    <td class="acoes nowrap centralizado">
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
