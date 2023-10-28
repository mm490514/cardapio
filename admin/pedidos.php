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

        <style>
            .text-danger {
                color: red; 
            }
        </style>
		

		<table class="table table-hover text-center">
			<thead class="table-dark">
				<tr>
					<th scope="col">Número Pedido</th>
                    <th scope="col">Data</th>
                    <th scope="col">Número da Mesa</th>
					<th scope="col">Nome Cliente</th>					
					<th scope="col">Nome item</th>
                    <th scope="col">Quantidade</th>	                   
                    <th scope="col">Observação</th>
                    <th scope="col">Status</th> 
                </tr>
			</thead>
			<tbody>
				<?php
					$items = $admin->allPedidos();

					while($item = $items->fetch_assoc()){
                        if ($item['status'] == 0) {                            
                            $textClass = 'text-danger';
                        } else {  
                            $textClass = ''; 
                        }
						?>
						 <tr class="<?php echo $rowClass; ?>">
                            <td><?php echo $item['order_id']?></td>
                            <td><?php echo $item['order_date']?></td>
                            <td><?php echo $item['num_mesa']?></td>
                            <td><?php echo $item['cliente_nome']?></td>
                            <td><?php echo $item['name']?></td>
                            <td><?php echo $item['quantity']?></td>
                            <td><?php echo $item['observacao']?></td>
                            <?php if ($item['status'] == 0){
                                $status = "PREPARANDO";
                            } else if ($item['status'] == 1){
                                $status = "ENTREGUE";
                            } else if ($item['status'] == 2){
                                $status = "FINALIZADO";
                            } else if ($item['status'] == 3){
                                $status = "CANCELADO";
                            }?>
                            <td class="<?php echo $textClass; ?>"><?php echo $status?></td>                       
                        </tr>
						<?php
					}
				?>

			</tbody>
		</table>
	</div>
	

</body>

</html>