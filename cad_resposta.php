<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/avaliado.class.php";
require "classes/disciplina.class.php";
require "classes/iniciativa.class.php";
require "classes/produtividade.class.php";
require "classes/responsabilidade.class.php";
require "classes/assiduidade.class.php";

$assiduidade       = new Assiduidade($pdo);
$disciplina        = new Disciplina($pdo);
$iniciativa        = new Iniciativa($pdo);
$produtividade     = new Produtividade($pdo);
$responsabilidade  = new Responsabilidade($pdo);
$avaliado          = new Avaliado($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])) {


if (isset($_POST['assiduidade_q1']) && !empty($_POST['assiduidade_q1'])) {
	$id_gestor        = $_SESSION['Login'];
	$id_avaliado      = $_GET['id'];
	$assiduidade_q1   = $_POST['assiduidade_q1'];
	$assiduidade_obs1 = $_POST['assiduidade_obs1'];
	$assiduidade_q2   = $_POST['assiduidade_q2'];
	$assiduidade_obs2 = $_POST['assiduidade_obs2'];
    
    $assiduidade->inserirAssiduidade($id_gestor, $id_avaliado, $assiduidade_q1, $assiduidade_obs1, $assiduidade_q2, $assiduidade_obs2);
    //$avaliado->updateStatus($id_avaliado);
}


if (isset($_POST['disciplina_q1']) && !empty($_POST['disciplina_q1'])) {
	$id_gestor        = $_SESSION['Login'];
	$id_avaliado      = $_GET['id'];
	$disciplina_q1    = $_POST['disciplina_q1'];
	$disciplina_obs1  = $_POST['disciplina_obs1'];
	$disciplina_q2    = $_POST['disciplina_q2'];
	$disciplina_obs2  = $_POST['disciplina_obs2'];

    $disciplina->inserirDisciplina($id_avaliado, $id_gestor, $disciplina_q1, $disciplina_obs1, $disciplina_q2, $disciplina_obs2);
    //$avaliado->updateStatus($id_avaliado);
    header("Location: index.php");

}

if (isset($_POST['iniciativa_q1']) && !empty($_POST['iniciativa_q1'])) {
	$id_gestor        = $_SESSION['Login'];
	$id_avaliado      = $_GET['id'];
	$iniciativa_q1    = $_POST['iniciativa_q1'];
	$iniciativa_obs1  = $_POST['iniciativa_obs1'];
	$iniciativa_q2    = $_POST['iniciativa_q2'];
	$iniciativa_obs2  = $_POST['iniciativa_obs2'];

    $iniciativa->inserirIniciativa($id_avaliado, $id_gestor, $iniciativa_q1, $iniciativa_obs1, $iniciativa_q2, $iniciativa_obs2);
    //$avaliado->updateStatus($id_avaliado);
    header("Location: index.php");

}

if (isset($_POST['produtividade_q1']) && !empty($_POST['produtividade_q1'])) {
	$id_gestor        = $_SESSION['Login'];
	$id_avaliado      = $_GET['id'];
	$produtividade_q1    = $_POST['produtividade_q1'];
	$produtividade_obs1  = $_POST['produtividade_obs1'];
	$produtividade_q2    = $_POST['produtividade_q2'];
	$produtividade_obs2  = $_POST['produtividade_obs2'];

    $produtividade->inserirProdutividade($id_avaliado, $id_gestor, $produtividade_q1, $produtividade_obs1, $produtividade_q2, $produtividade_obs2);
    //$avaliado->updateStatus($id_avaliado);
    header("Location: index.php");

}

if (isset($_POST['responsabilidade_q1']) && !empty($_POST['responsabilidade_q1'])) {
	$id_gestor        = $_SESSION['Login'];
	$id_avaliado      = $_GET['id'];
	$responsabilidade_q1    = $_POST['responsabilidade_q1'];
	$responsabilidade_obs1  = $_POST['responsabilidade_obs1'];
	$responsabilidade_q2    = $_POST['responsabilidade_q2'];
	$responsabilidade_obs2  = $_POST['responsabilidade_obs2'];

    $responsabilidade->inserirResponsabilidade($id_avaliado, $id_gestor, $responsabilidade_q1, $responsabilidade_obs1, $responsabilidade_q2, $responsabilidade_obs2);
    $avaliado->updateStatus($id_avaliado);
    header("Location: index.php");

}
?>

<form action="" method="POST" role="form">
	<hr>
    <h4>Assiduidade</h4>
	<div class="form-group">
		<label for=""><b>II/A- ASSIDUIDADE: Considere como assiduidade a regularidade do colaborador ao local de trabalho,ausentando apenas por motivos justos e com anuência dos superiores:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="assiduidade_q1" value="10.0" required>
				10.0 – É sempre pontual no cumprimento dos horários de entrada e saída das escalas normais e extraordinárias.
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="7.5">
				7.5 - Quando faltou,teve justificativa compatível,procurando avisar a chefia antecipadamente, evitando o comprometimento do trabalho.
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="5.0">
				5.0 – As vezes atrasa nos horários de entrada e de saída das escalas normais, apesar de não comprometer o trabalho. 
			</label>
			<label>
				<input type="radio" name="assiduidade_q1" value="2.5">
				2.5 - Falta constantemente, atrasa com frequência sem dar justificativas, comprometendo o planejamento da equipe .
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="assiduidade_obs1"></textarea>
    </div>
	<div class="form-group">
		<label for=""><b>II/B- ASSIDUIDADE: Considere como assiduidade, a participação do colaborador em cursos de aprimoramento promovidos pela Prefeitura:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="assiduidade_q2" value="10.0" required>
				10.0 – Participa,  recomenda, pede ou sugere cursos para melhorar seus conhecimentos na área.
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="7.5">
				7.5 - Participa sempre de cursos de aperfeiçoamento, reuniões de orientação.
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="5.0">
				5.0 – Participa as vezes de algumas reuniões ou cursos de orientação profissional. 
			</label>
			<label>
				<input type="radio" name="assiduidade_q2" value="2.5">
				2.5 - Não demonstra interesse em participar de cursos de aperfeiçoamento ou reuniões que objetivam transmitir novos conhecimentos técnicos.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="assiduidade_obs2"></textarea>
    </div>
	<hr>

	<hr>
    <h4>Disciplina</h4>
	<div class="form-group">
		<label for=""><b>III-/A- DISCIPLINA: Ética na conduta profissional e responsabilidade na realização das atividades laborais:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="disciplina_q1" value="10.0" required>
				10.0 – Cumpre efetivamente as normas e ordens disciplinares. Dispensa supervisão para executar uma ordem recebida.Quando considera uma ordem inadequada apresenta sugestões,embora sempre acate para não prejudicar o serviço.
			</label>
			<label>
				<input type="radio" name="disciplina_q1" value="7.5">
				7.5 - Sempre  responsável no cumprimento de suas tarefas, seguindo os princípios e  normais  gerais.
			</label>
			<label>
				<input type="radio" name="disciplina_q1" value="5.0">
				5.0 – Aceita as normas e ordens disciplinares no que diz respeito à hierarquia.Precisa ser lembrado de que o serviço público tem suas particularidadese limitações legais. 
			</label>
			<label>
				<input type="radio" name="disciplina_q1" value="2.5">
				2.5 - Falta de ética e profissionalismo,não respeita as leis, decretos e regulamentos.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="disciplina_obs1"></textarea>
    </div>
	<div class="form-group">
		<label for=""><b>III-/B- DISCIPLINA: Cordialidade no atendimento ao público, seriedade igualitária com seus pares e  superiores:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="disciplina_q2" value="10.0" required>
				10.0 – Demonstra facilidade de estabelecer relações, nunca cria problemas. É extremamente hábil e respeitos  tratar no manejo com pessoas. Assimila ensinamentos e faz transferência de aprendizagem. Sabe receber e dar feedback.
			</label>
			<label>
				<input type="radio" name="disciplina_q2" value="7.5">
				7.5 - Mantém bom relacionamento interpessoal com respeito, cordialidade e seriedade no atendimento ao público. Demonstra zelo pelo trabalho.
			</label>
			<label>
				<input type="radio" name="disciplina_q2" value="5.0">
				5.0 – Ajusta- se às situações ambientais. Sabe receber e acatar críticas e aceitar mudanças. Coopera e participa efetivamente dos trabalhos em equipe, revelando consciência de grupo. 
			</label>
			<label>
				<input type="radio" name="disciplina_q2" value="2.5">
				2.5 - A execução de suas tarefas é prejudicada, por não saber tratar as pessoas adequadamente necessita de orientação para aprimorar-se nesse aspecto.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="disciplina_obs2"></textarea>
    </div>
	<hr>

	<hr>
    <h4>Capacidade de Iniciativa</h4>
	<div class="form-group">
		<label for=""><b>IV/A- CAPACIDADE DE INICIATIVA: Considerar a capacidade de compreensão do trabalho e a visão crítica dos seus pontos mais importantes, como também, capacidade de organização e de decisão:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="iniciativa_q1" value="10.0" required>
				10.0 – Apresenta capacidade de agregar valor e contribuir para o desenvolvimento da área,no que se refere à otimização de recursos, implantação e disseminação de novas metodologias e procedimentos.
			</label>
			<label>
				<input type="radio" name="iniciativa_q1" value="7.5">
				7.5 - Percebe as situações rotineiras de trabalho, sem que lhe seja preciso cobranças constantes. Aplica as soluções que lhe são apresentadas, utilizando com eficácia tais recursos, inclusive em atividades mais complexas.
			</label>
			<label>
				<input type="radio" name="iniciativa_q1" value="5.0">
				5.0 – Necessita de orientação e  apoio em geral e de algumas  diretivas específicas .Recorre, por vezes, a esclarecimentos complementares do responsável. Revela iniciativa com resultados poucos visíveis. 
			</label>
			<label>
				<input type="radio" name="iniciativa_q1" value="2.5">
				2.5 - Falta-lhe criatividade para inovar em sua rotina de trabalho. Não tem iniciativa para quando necessário. Necessita de orientação pormenorizada.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="iniciativa_obs1"></textarea>
    </div>
	<div class="form-group">
		<label for=""><b>IV/B-CAPACIDADE DE INICIATIVA:Considere  o   relacionamento,disponibilidade e boa vontade para com a equipe,e postura  com os seus superiores:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="iniciativa_q2" value="10.0" required>
				10.0 – Demonstra  interesse  e  a predisposição  em colaborar  com  seus  colegas  e  superiores  na  execução  do  trabalho diário e no desenvolvimento de projetos, aumentando o grau  de coesão.Coopera e dialoga com  hierarquia.Exibe  facilidade, correção e eficiência nas  relações com as entidades  exteriores.
			</label>
			<label>
				<input type="radio" name="iniciativa_q2" value="7.5">
				7.5 - Sente-se à vontade para participar de tarefas que envolvam outras pessoas,prestando auxílio sempre que possível. Acata com presteza as ordens de sua chefia imediata e observa os níveis hierárquicos nas relações funcionais.
			</label>
			<label>
				<input type="radio" name="iniciativa_q2" value="5.0">
				5.0 – Gera por vezes conflitos, não contribuindo para o bom ambiente de trabalho.Revela dificuldades em se integrar em equipe.Aceita com relutância as legítimas diretivas hierárquicas. 
			</label>
			<label>
				<input type="radio" name="iniciativa_q2" value="2.5">
				2.5 - Não possui habilidade de relacionar-se, o que já lhe ocasionou problemas com a equipe.Entende como pessoais as críticas que lhe são feitas no trabalho.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="iniciativa_obs2"></textarea>
    </div>
	<hr>

	<hr>
    <h4>Produtividade</h4>
	<div class="form-group">
		<label for=""><b>V/A - PRODUTIVIDADE: Atenção aos interesses organizacionais- metas e objetivos,dedicado em resolver problemas, exerce suas atividades no prazo e capricho:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="produtividade_q1" value="10.0" required>
				10.0 – Realiza o trabalho com planejamento e organização,buscando eficiência na utilização dos recursos disponíveis, executando as atividades com precisão,apresentando incidência mínima de erros e ausência de retrabalhos.
			</label>
			<label>
				<input type="radio" name="produtividade_q1" value="7.5">
				7.5 - Apresenta  habilidade em administrar os prazos e solicitações com  resultados satisfatórios, buscando priorizar aquelas de maior importância, independente do volume de trabalho.
			</label>
			<label>
				<input type="radio" name="produtividade_q1" value="5.0">
				5.0 – Razoável dedicação e disponibilidade. Aceita com naturalidade tarefas que  não se incluem na rotina habitual, ou que resultem de sobrecargas de trabalho decorrentes de variações sazonais ou de ponta Adaptação satisfatória a novas tarefas, embora hesite perante situações menos frequentes. 
			</label>
			<label>
				<input type="radio" name="produtividade_q1" value="2.5">
				2.5 - Não exerce suas funções com zelo e capricho, não atende aos interesses da organização.Raramente executa suas atvidades laborais dentro dos prazos estabelecidos, prejudicando o seu andamento e o da equipe.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="produtividade_obs1"></textarea>
    </div>
	<div class="form-group">
		<label for=""><b>V/B - PRODUTIVIDADE:  Ganho e/ou manutenção dos níveis de qualidade, sem o acréscimo de mão-de-obra ou aumento dos recursos necessários:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="produtividade_q2" value="10.0" required>
				10.0 –É altamente produtivo,apresentando uma excelente capacidade para execução e conclusão do trabalho. Observa as prioridades e utiliza toda sua capacidade e recursos materiais disponíveis. Aplica  métodos, técnicas e procedimentos adequados aos objetivos do trabalho.
			</label>
			<label>
				<input type="radio" name="produtividade_q2" value="7.5">
				7.5 - Empenha-se para melhorar a atividade a ser executada, contornando as dificuldades que lhe são impostas no dia a dia. Cumpre os prazos estabelecidos, mantendo o nível de qualidade exigida.
			</label>
			<label>
				<input type="radio" name="produtividade_q2" value="5.0">
				5.0 – O nível de atenção que dispensa à execução de seu trabalho é suficiente para levar um resultado de boa qualidade dentro dos padrões exigidos. 
			</label>
			<label>
				<input type="radio" name="produtividade_q2" value="2.5">
				2.5 - Não sabe lidar com o aumento inesperado do volume de trabalho.Eventualmente apresenta erros, sendo necessário orientações para corrigi-los.A qualidade das suas atividades laborais está muito abaixo do nível desejado para o cargo.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="produtividade_obs2"></textarea>
    </div>
	<hr>

	<hr>
    <h4>Responsabilidade</h4>
	<div class="form-group">
		<label for=""><b>VI/A- RESPONSABILIDADE: Considerar a disposição e o esforço pessoal em aperfeiçoar-se profissionalmente e intelectualmente afim de preparar-se para assumir novas funções e responsabilidades:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="responsabilidade_q1" value="10.0" required>
				10.0 – Compromete-se   com seu trabalho, sendo  ético e atento ao que faz.Preocupa-se com o bom andamento das suas atividades laborais além de demonstrar interesse por assuntos que possam ajuda-lo a progredir e a assumir maiores responsabilidades.
			</label>
			<label>
				<input type="radio" name="responsabilidade_q1" value="7.5">
				7.5 - Empenha-se para fazer  as  atividades solicitadas inerentes a sua função. Conhece e obedece a legislação.Zela pelo patrimônio da Instituição e evita desperdícios, além de buscar autodesenvolvimento para seu crescimento profissional.
			</label>
			<label>
				<input type="radio" name="responsabilidade_q1" value="5.0">
				5.0 – Coopera com sua equipe de trabalho, concluindo suas tarefas evitando sobrecarga de serviço. É cuidadoso em relação aos bens da instituição, conservando em condições de uso os materiais e equipamentos.Demonstra pouco interesse em aperfeiçoar-se profissionalmente. 
			</label>
			<label>
				<input type="radio" name="responsabilidade_q1" value="2.5">
				2.5 - NEvita comprometer-se ou assumir responsabilidades. Não zela pelo patrimônio e não demonstra conduta compatível com perfil  profissional. Não assume compromissos e obrigações de trabalho que promovam crescimento profissional.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="responsabilidade_obs1"></textarea>
    </div>
	<div class="form-group">
		<label for=""><b>VI/B- RESPONSABILIDADE: Considerar a responsabilidade do avaliado em analisar os resultados decorrentes de suas decisões na área em que atua:</b></label>
		<div class="radio">
			<label>
				<input type="radio" name="responsabilidade_q2" value="10.0" required>
				10.0 – Chama a responsabilidade para si. Busca solucionar os casos que surgem no trabalho. Não só aplica as soluções que lhe são apresentadas, como busca alternativas a fim de cumprir suas obrigações da melhor maneira possível, afim de obter os resultados esperados ela Instituição.
			</label>
			<label>
				<input type="radio" name="responsabilidade_q2" value="7.5">
				7.5 - Tem  uma postura profissional participativa e colaboradora, manifestada através dos resultados concretos obtidos, necessários ao cumprimento da missão da Instituição.
			</label>
			<label>
				<input type="radio" name="responsabilidade_q2" value="5.0">
				5.0 – Ajusta -se às situações ambientais. Sabe receber e acatar críticas e aceitar mudanças/inovações para alcançar os resultados esperados pela Instituição. 
			</label>
			<label>
				<input type="radio" name="responsabilidade_q2" value="2.5">
				2.5 - Tem dificuldade em assumir erros e falta-lhe compromisso em atingir o resultado das tarefas que lhe são atribuídas.Não disponibiliza todo o potencial em prol dos objetivos e metas da Instituição.Tem pouca colaboração, suporte, dedicação e empenho.
			</label>
		</div>
	</div>
	<div class="form-group">
            <label><b>Observações</b></label>
            <textarea class="form-control" rows="3" name="responsabilidade_obs2"></textarea>
    </div>
	<hr>

	<button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php 
}else{
	header("Location: index.php");
} 
?>