<div class="form-login">
    <p>
        Bem-vindo(a). Você está acessando o sistema de apoio à <em>Programação
        Anual de Gestão da Secretaria de Saúde do Município de João Pessoa</em>.
        Esse sistema foi desenvolvido com o objetivo de tornar mais simples e
        rápidas as atividades de orçamentação de ações e acompanhamento da
        execução de metas. Para acessar o sistema, você precisa se identificar
        informando no campo abaixo a sua matrícula de servidor.
    </p>
    <?php
    echo $this->Form->create('Usuario', array('inputDefaults' => array('label' => false, 'div' => false)));
    echo $this->Form->input('matricula', array('label' => 'Qual é a sua matrícula?'));
    echo $this->Form->end('Continuar');
    ?>
</div>