<?php if(empty($dados['Area'])) {?>
	<h3><?php echo __('Não há Áreas');?>
<?php } else {
    foreach($dados['Area'] as $valor): 
        echo $this->Html->link($valor['nome'], array('controller'=>'objetivos_gerais', 'action'=>'index', $valor['id']));
        echo '<br>';
    endforeach;
}
?>   
        
        