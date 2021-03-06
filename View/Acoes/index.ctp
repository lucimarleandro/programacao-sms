<div class="form-inline form-acao-novo painel">
    <?php
    echo $this->Form->create('Acao', array(
        'url' => array('controller' => 'acoes', 'action' => 'adicionar'),
        'inputDefaults' => array('div' => false)
    ));
    echo $this->Form->hidden('objetivo_especifico_id', array('value' => $dados['ObjetivoEspecifico']['id']));
    ?>
    <div class="input" style="width: 42%">
        <?php
        echo $this->Form->input('descricao', array(
            'type' => 'text',
            'label' => 'Descrição da ação'
        ));
        ?>
    </div>
    <div class="input" style="width: 42%">
        <?php
        echo $this->Form->input('meta_programada', array(
            'type' => 'text',
            'label' => 'Meta Programada'
        ));
        ?>
    </div>
    <div class="input" style="width: 15%">
        <?php echo $this->Form->label(false, '&nbsp;'); ?>
        <?php echo $this->Form->button('<i class="icon-plus"></i> Adicionar ação', array('type' => 'submit')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<table cellspacing="0" class="font-normal">
    <thead>
        <tr>
            <th>Descrição da Ação</th>
            <th>Meta Programada</th>
            <th style="width: 15%">Orçamento</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($dados['Acao']) > 0) : ?>
            <?php foreach ($dados['Acao'] as $acao) : ?>
                <tr>
                    <td><?php echo $acao['descricao']; ?></td>
                    <td><?php echo $acao['meta_programada']; ?></td>
                    <td class="acoes centralizado">
                        <?php
                        echo $this->Html->link(
                            '<span style="font-weight: bold">$</span> abrir orçamento',
                            array(
                                'controller' => 'orcamentos',
                                'action' => 'index',
                                'acao' => $acao['id']),
                            array('escape' => false)
                        );

                        $orc = $this->requestAction(array('controller' => 'orcamentos', 'action' => 'somaOrcamento', $acao['id']));
                        if ($orc > 0) {
                            ?>
                            <span class="small block">[R$ <?php echo number_format($orc, 2, ',', '.'); ?>]</span>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <th colspan="3">
                Não há ação cadastrada neste objetivo específico. Utilize o
                formulário para adicionar uma.
            </th>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
