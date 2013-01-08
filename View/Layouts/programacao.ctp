<?php
/**
 * Carrega as configurações da aplicação, definidas no bootstrap.
 */
$cfg = Configure::read('Aplicacao');
$cfg['nome'] = isset($cfg['nome']) ? $cfg['nome'] : 'Aplicação CDI - SMSJP';
$title = empty($title_for_layout) ? $cfg['nome'] : "{$title_for_layout} :: {$cfg['nome']}";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <?php
        // Tags Meta
        echo $this->Html->charset(), PHP_EOL;

        // Processa diretivas META na configuração da aplicação.
        if (isset($cfg['meta'])) {
            foreach ($cfg['meta'] as $key => $value)
                if (is_array($value))
                    echo $this->Html->meta($value), PHP_EOL;
                else
                    echo $this->Html->meta($key, $value), PHP_EOL;
        }

        echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')), PHP_EOL;
        ?>
        <title><?php echo $title; ?></title>
        <?php
        // Folhas de Estilo CSS
        echo $this->Html->css(array('motiro2', 'font-awesome', 'programacao')), PHP_EOL;
        echo $this->fetch('css'), PHP_EOL; // folhas de estilo adicionadas no runtime.
        ?>
        <!--[if IE 7]><?php echo $this->Html->css('font-awesome-ie7'); ?><![endif]-->
    </head>
    <body>
        <div id="cabecalho" class="barratopo">
            <div class="aplicacao esquerda">
                <?php echo $this->Html->image('programacao-branco-36a.png'); ?>
            </div>
        </div>
        <div class="clear"></div>

        <!-- Área Central -->
        <div id="principal" class="conteudo">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <div class="clear"></div>

        <!-- Rodapé -->
        <div id="rodape" class="rodape">
            <div class="esquerda">
                NÚCLEO DE DESENVOLVIMENTO DE APLICATIVOS<br />
                COORDENAÇÃO DE DESENVOLVIMENTO INSTITUCIONAL<br />
                SECRETARIA MUNICIPAL DE SAÚDE DE JOÃO PESSOA
            </div>
            <div class="direita">
                <img src="/img/cdilogo64.png" alt="CDI/SMSJP" />
                <img src="/img/smsjplogo64a.png" alt="SMS/PMJP" />
            </div>
        </div>
        <div class="clear"></div>

        <div class="carregando">
            Processando sua requisição...
            <br />
            <?php echo $this->Html->image('carregando.gif'); ?>
        </div>

        <?php if (Configure::read('debug') == 2) echo $this->element('sql_dump'); ?>
    </body>
</html>
