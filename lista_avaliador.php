<?php
require "inc/cabecalho.php";
require "inc/config.php";
require "classes/gestor.class.php";

$gestor = new Gestor($pdo);

if (isset($_SESSION['Login']) && !empty($_SESSION['Login'])):
	//verifica se o perfil é coordenador
	if ($sql['perfil'] == 'coordenador'):
    $avaliador = $gestor->listarGestorAll();
    ?>
    	<table class="table table-striped table-hover">
    		<thead>
    			<tr>
    				<th>Nome</th>
                    <th>Matricula</th>
    				<th>Perfil</th>
    				<th>Ações</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php foreach ($avaliador as $aval_gestor): ?>
    			<tr>
    				<td><?=utf8_encode($aval_gestor['nome']);?></td>
                    <td><?=$aval_gestor['matricula'];?></td>
    				<td>
                        <?php if($aval_gestor['perfil'] == "coordenador"):?>
                            Membro da Comissão
                        <?php endif ?> 
                        <?php if($aval_gestor['perfil'] == "avaliador"):?>
                            Chefia Imediata (Avaliador)
                        <?php endif ?>                       
                    </td>
    				<td><a class="btn btn-info fas fa-edit" href="edit_gestor_avaliador.php?id_gestor=<?=$aval_gestor['id'];?>">Editar</a></td>
                    <td><a class="btn btn-danger fas fa-trash" href="excluir_gestor.php?id_gestor=<?=$aval_gestor['id'];?>">Excluir</a></td>
                    <td><a class="btn btn-success fas fa-key" href="alterar_senha.php?id_gestor=<?=$aval_gestor['id'];?>">Alterar Senha</a></td>
    			</tr>
    			<?php endforeach; ?>
    		</tbody>
    	</table>
<?php
	endif;
endif;
?>