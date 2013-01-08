<?php if(empty($dados['ObjetivoEspecifico'])) {?>
	<h3><?php echo __('Não há Objetivos Específicos');?>
<?php } else {
        
    foreach($dados['ObjetivoEspecifico'] as $valor): 
        echo $this->Html->link($valor['nome'], array('controller'=>'acoes', 'action'=>'index', $valor['id']));
        echo '<br>';
    endforeach;
}
?>       
