<?php if(empty($dados)) {?>
	<h3><?php echo __('Não há Módulos');?>
<?php } else {
        
    foreach($dados as $valor): 
        echo $this->Html->link($valor['Modulo']['nome'], array('controller'=>'areas', 'action'=>'index', $valor['Modulo']['id']));
        echo '<br>';
    endforeach;
}
?>       
