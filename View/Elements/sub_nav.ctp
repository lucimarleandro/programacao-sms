<?php
/**
 * Uma ação está selecionada quando o usuário está realizando o
 * orçamento da mesma. Na página de orçamentos, a trilha de navegação
 * não é exibida como nas páginas anteriores. Ao invés disso, é exibido
 * um link para retornar à página de listagem das ações (do mesmo
 * objetivo específico) e o valor do orçamento para a ação atual.
 */
if (!isset($dados['Acao']['descricao'])) :

    // Exibe a trilha apenas se ao menos um destes dados existe.
    if (isset($dados['Modulo']['nome'])
            || isset($dados['Area']['nome'])
            || isset($dados['ObjetivoGeral']['nome'])
            || isset($dados['ObjetivoEspecifico']['nome'])) :
        ?>
        <div class="navmenu painel">
            <div class="trilha esquerda">
                <?php
                if (isset($dados['Modulo']['nome'])) {
                    $url = array('controller' => 'areas', 'action' => 'index', $dados['Modulo']['id']);
                    $nome = $dados['Modulo']['nome'];
                    $altmod = array('controller' => 'modulos', 'action' => 'index');
                    ?>
                    <div style="padding-left: 5px">
                        <i class="icon-caret-right"></i>&nbsp;
                        Módulo: <?php echo $this->Html->link($nome, $url); ?>
                        <span class="small">(<?php echo $this->Html->link('trocar módulo', $altmod); ?>)</span>
                    </div>
                    <?php
                }

                if (isset($dados['Area']['nome'])) {
                    $url = array('controller' => 'objetivos_gerais', 'action' => 'index', $dados['Area']['id']);
                    $nome = $dados['Area']['nome'];
                    ?>
                    <div style="padding-left: 15px">
                        <i class="icon-caret-right"></i>&nbsp;
                        Área: <?php echo $this->Html->link($nome, $url) ?>
                    </div>
                    <?php
                }

                if (isset($dados['ObjetivoGeral']['nome'])) {
                    $url = array('controller' => 'objetivos_especificos', 'action' => 'index', $dados['ObjetivoGeral']['id']);
                    $nome = $dados['ObjetivoGeral']['nome'];
                    ?>
                    <div style="padding-left: 25px">
                        <i class="icon-caret-right"></i>&nbsp;
                        Objetivo Geral: <?php echo $this->Html->link($nome, $url); ?>
                    </div>
                    <?php
                }

                if (isset($dados['ObjetivoEspecifico']['nome'])) {
                    $url = array('controller' => 'acoes', 'action' => 'index', $dados['ObjetivoEspecifico']['id']);
                    $nome = $dados['ObjetivoEspecifico']['nome'];
                    ?>
                    <div style="padding-left: 35px">
                        <i class="icon-caret-right"></i>&nbsp;
                        Objetivo Específico: <?php echo $this->Html->link($nome, $url); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    endif; // trilha
else :
    // A ação foi identificada
    $orcamentoLink = array('controller' => 'orcamentos', 'action' => 'index', 'acao' => $dados['Acao']['id']);
    ?>
    <div class="navmenu painel">
        <div class="trilha esquerda" style="width: 70%">
            <div style="padding-left: 5px">
                <i class="icon-reply"></i>
                <?php echo $this->Html->link('retornar ao objetivo específico desta ação', array(
                    'controller' => 'acoes',
                    'action' => 'index',
                    $dados['Acao']['objetivo_especifico_id']
                )); ?>
            </div>
            <div class="clear">&nbsp;</div>
            <div style="padding-left: 5px">
                Você está realizando o orçamento da ação:
            </div>
            <div style="padding-left: 15px; margin-top: 5px;">
                <i class="icon-caret-right"></i>&nbsp;
                <strong><?php echo mb_strtoupper($dados['Acao']['descricao'], 'utf-8'); ?></strong>
                <small>(<?php echo $this->Html->link('ver orçamento', $orcamentoLink, array('style' => 'white-space: nowrap')); ?>)</small>
            </div>
        </div>
        <div class="direita orcamento" style="width: 20%">
            <div class="cifrao">R$</div>
            <div class="wrapper">
                <div class="legenda">
                    <?php echo $this->Html->link('orçamento desta ação', $orcamentoLink); ?>
                </div>
                <div class="valor">
                    <?php
                    $soma = $this->requestAction(array('controller' => 'orcamentos', 'action' => 'somaOrcamento', $dados['Acao']['id']));
                    echo number_format($soma, 2, ',', '.');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif; // ação
?>