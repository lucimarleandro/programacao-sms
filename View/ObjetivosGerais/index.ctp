<?php if(empty($dados['ObjetivoGeral'])) {?>
	<h3><?php echo __('Não há Objetivos Gerais');?>
<?php } else {
    foreach($dados['ObjetivoGeral'] as $valor): 
        echo $this->Html->link($valor['nome'], array('controller'=>'objetivos_especificos', 'action'=>'index', $valor['id']));
        echo '<br>';
    endforeach;
}
?>       
