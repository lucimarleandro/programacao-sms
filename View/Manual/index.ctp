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
        <p class="destaque">
            Caso você deseje ler o manual outra hora, basta
            <?php echo $this->Html->link('clicar aqui', '/'); ?> para entrar na aplicação.
        </p>
        <p>&nbsp;</p>
    <?php endif; ?>
    <!-- primeiro acesso -->

    <h2>Sobre a aplicação</h2>
    <p>
        Desenvolvido pela Coordenação de Desenvolvimento Institucional através
        de seu Núcleo de Desenvolvimento de Software, o sistema de apoio
        Programação Anual de Gestão foi elaborado como uma ferramenta
        facilitadora da execução das atividades de programação e orçamentação da
        Secretaria Municipal de Saúde de João Pessoa.
    </p>
    <p>
        Em seu primeiro estágio, a aplicação possibilita aos usuários organizarem
        as metas e ações a serem executadas durante o ano de 2013 de acordo
        com os eixos e objetivos gerais e específicos previstos no Plano
        Municipal de Saúde.
    </p>
    <p>&nbsp;</p>
    
    <h2>Como funciona</h2>
    <p class="destaque">
        O acesso ao sistema é restrito a servidores ativos da SMSJP. Assim sendo,
        esse acesso está condicionado à informação da sua matrícula de
        servidor.
    </p>
    <p>&nbsp;</p>
    <p>
        O sistema foi estruturado como um assistente que guia o usuário através
        de algumas etapas até a orçamentação das ações e metas cadastradas.
        Essas etapas são apresentadas de forma hierárquica, conforme a lista
        seguinte:
    </p>
    <ul style="list-style-type: none">
        <li style="margin-left: 5px"><i class="icon-caret-right"></i> Módulos</li>
        <li style="margin-left: 15px"><i class="icon-caret-right"></i> Eixos / Áreas</li>
        <li style="margin-left: 25px"><i class="icon-caret-right"></i> Objetivos Gerais</li>
        <li style="margin-left: 35px"><i class="icon-caret-right"></i> Objetivos Específicos</li>
        <li style="margin-left: 45px"><i class="icon-caret-right"></i> Ações e Metas</li>
    </ul>
    
    <h3>Etapa 1: Seleção do módulo</h3>
    <p>
        Ao entrar no sistema, a primeira tela exibida é a tela de
        seleção do Módulo. É preciso selecionar um módulo para continuar. Para
        isso você só precisa clicar sobre o módulo desejado e o sistema o guiará
        automaticamente para a etapa seguinte (conforme a listagem acima).
    </p>
    <p>Até a etapa 4, todas as telas são bem parecidas.</p>
    
    <h3>Etapa 2: Seleção do Eixo/Área</h3>
    <p>Nessa tela são listados todos os eixos cadastrados no módulo selecionado.</p>
    <p>
        Note que a barra cinza no topo da tela já exibe o módulo que você
        selecionou e uma opção para a troca de módulo. A partir desta etapa
    </p>
    <p>
        A partir da etapa de seleção do objetivo geral, o sistema começará a
        exibir um resumo do orçamento para cada objetivo. O valor total orçado
        por objetivo geral é exibido no lado direito de cada linha da lista.
        Ao selecionar um objetivo geral, são exibidos os objetivos específicos
        associados a ele e, da mesma forma, um resumo é exibido no lado direito
        de cada linha. Nesta etapa, porém, além do valor orçado por objetivo
        específico é exibido também o número de ações/metas cadastradas por
        objetivo específico.
    </p>
    
    <h3>Etapas 3 e 4: Objetivos Gerais e Específicos</h3>
    <p>
        A partir desta etapa, o sistema começa a apresentar junto com a lista
        de opções, o valor orçado por objetivo. No objetivo específico, é
        exibido também o número de ações/metas cadastradas para cada objetivo.
    </p>
    
    <p>[...]</p>
    
    <p>&nbsp;</p>
    <h3 style="text-align: center">
        <?php echo $this->Html->link('Entrar no sistema &raquo;', '/', array('escape' => false, 'class'=> 'btn')); ?>
    </h3>
</div>