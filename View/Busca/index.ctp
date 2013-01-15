<?php

echo $this->Form->create('Busca', array(
    'url' => array(
        'controller' => 'busca',
        'action' => 'busca'
    ),
    'type' => 'get'
));
echo $this->Form->input('q', array(
    'label' => 'Que item você deseja encontrar?',
));
echo $this->Form->input('t', array(
    'label' => 'Tipo de item',
    'empty' => '(selecione um tipo)',
    'options' => isset($opcoes) ? $opcoes : array()
));
echo $this->Form->submit('Buscar');
echo $this->Form->end();
?>