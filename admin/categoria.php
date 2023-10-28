<?php
include_once '../config/Database.php';
include_once '../class/Produto.php';
include_once '../class/Categoria.php';
include_once '../class/Admin.php';

$database = new Database();
$db = $database->getConexao();
$categoria = new Categoria($db);
$produto = new Produto($db);
$admin = new Admin($db);

if (!$admin->loggedIn()) {
	header("Location: login.php");
}
include('../inc/header.php');
include('./inc/nav.php'); 
?>



<!-- <h1>LOGADO</h1>
<h2>Aqui irei fazer a página do ADM do cardápio</h2>
<a href="addproduto.php">Adicionar um produto</a>
<br>
<a href="addcategoria.php">Adicionar uma categoria</a>
<br>
<a href="desloga.php">Sair</a> -->

	<div class="container mt-4">
		<?php
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'
			<button type="button" class="btn-close" data-bs-dismiss="alert"
			aria-lable="Close"></button></div>';
		}

		?>
		<a href="addcategoria.php" class="btn btn-dark mb-3">Adicionar categoria</a>

		<table class="table table-hover text-center">
			<thead class="table-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nome</th>					
					<th scope="col">Status</th>
					<th scope="col">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$items = $admin->allCategorias();

					while($item = $items->fetch_assoc()){
						?>
						<tr>
							<td><?php echo $item['id']?></td>
							<td><?php echo $item['nome']?></td>														
							<td><?php echo $item['status']?></td>
							<td>
								<a href="editcategoria.php?id=<?php echo $item['id'] ?>" class="link-dark"><i class="bi bi-pencil-fill me-3"></i></a>
								<a href="deletecategoria.php?id=<?php echo $item['id'] ?>" class="link-dark"><i class="bi bi-trash-fill fs-5"></i></a>
							</td>
						</tr>
						<?php
					}
				?>

			</tbody>
		</table>
	</div>
	

</body>

</html>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Categoria deletada com sucesso!</h5> 
        <i class="bi bi-check-lg" style="font-size: 2rem;"></i>                   
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmDelete">Ok</button>        
      </div>
    </div>
  </div>
</div>