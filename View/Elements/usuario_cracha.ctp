<?php if (($usuario = AuthComponent::user())) : ?>
    <div class="cracha direita">
        <div class="usuario">
            Você está conectado como
            <span class="block"><?php echo mb_strtoupper($usuario['nome'], 'utf-8'); ?></span>
        </div>
        <div class="links">
            <?php echo $this->Html->link('manual de utilização', array(
                'controller' => 'manual',
                'action' => 'index'
            )) ?>
            <i class="icon-question-sign"></i>
            |
            <?php echo $this->Html->link('encerrar sessão', array(
                'controller' => 'usuarios',
                'action' => 'logout'
            )); ?>
        </div>
    </div>
<?php endif; ?>
