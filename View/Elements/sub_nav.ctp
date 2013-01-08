<div class="navmenu painel">
    <div class="trilha esquerda" style="width: 70%">
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
            $url = array('controller' => 'objetivos_especificos', 'action' => 'index', $dados['ObjetivoEspecifico']['id']);
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