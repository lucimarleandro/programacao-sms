<h1 style="text-align: center">Manual de Utilização</h1>
<div style="margin: 15px auto 0; width: 80%">
    <!-- primeiro acesso -->
    <?php if (isset($primeiroAcesso)) : ?>
        <?php $nome = ucwords(strtolower(preg_replace('/^([^ ]+).*/', '$1', AuthComponent::user('nome')))); ?>
        <h2>Já conhece o sistema?</h2>
        <p>
            Olá <?php echo $nome; ?>, parece que essa é a primeira vez que
            você utiliza esta aplicação. Antes de continuar, é recomendável
            a leitura deste manual de utilização para que você
            possa compreender todo o funcionamento do sistema e fazer o melhor uso dele.
            Este manual também pode ser acessado a qualquer momento clicando no link
            &quot;manual de utilização <i class="icon-question-sign"></i>&quot; que
            se encontra logo abaixo do seu nome
            no canto superior direito das telas do sistema (barrinha azul aqui em cima).
        </p>
        <p style="text-align: center; background-color: #eee; padding: 8px">
            Caso você deseje ler o manual outra hora, basta
            <?php echo $this->Html->link('clicar aqui', '/'); ?> para entrar na aplicação.
        </p>
        <p>&nbsp;</p>
    <?php endif; ?>
    <!-- primeiro acesso -->

    <h2>Sobre a aplicação</h2>
    <p>
        Desenvolvido pela Coordenação de Desenvolvimento Institucional através
        de seu Núcleo de Desenvolvimento de Aplicativos, o sistema de
        Programação Anual de Gestão foi elaborado para ser
        utilizado como uma ferramenta facilitadora da execução das atividades de
        programação e orçamentação da Secretaria Municipal de Saúde de João
        Pessoa. [...]
    </p>
    <p>&nbsp;</p>
    
    <h2>Como funciona</h2>
    <p>
        Este texto está sendo desenvolvido.
    </p>
    
    <p>&nbsp;</p>
    <h3 style="text-align: center">
        <?php echo $this->Html->link('Ir para a aplicação &raquo;', '/', array('escape' => false, 'class'=> 'btn')); ?>
    </h3>
</div>