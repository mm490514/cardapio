<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

include('inc/header.php');
$mesa = $_SESSION['num_mesa'];
$sqlPedidos = "SELECT * FROM pedidosvendas WHERE num_mesa = ? and status <> '2'";
$stmt = $db->prepare($sqlPedidos);
$stmt->bind_param("i", $mesa);
$stmt->execute();
$resultP = $stmt->get_result();
$qtd = $resultP->num_rows;

?>
<title>Cardapio</title>
<?php include('inc/container.php'); ?>
<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php include('top_menu.php'); ?>
		</div>
		<div class='row'>	
			<?php
            if ($resultP->num_rows > 0) {
            ?>		
				<h3>Seus Pedidos:</h3>
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>							
							<th width="4%">Pedido</th>
							<th width="30%" style="text-align: center;">Item</th>
							<th width="8%" style="text-align: center;">Qtd</th>							
							<th width="20%" style="text-align: center;">Obs</th>
							<th width="20%" style="text-align: center;">Status</th>							
						</tr>
					</thead>					
					<?php
						while ($row = $resultP->fetch_assoc()) {
							if ($row['status'] == 0) {                            
								$textClass = 'text-primary';
							} else if ($row['status'] == 1) {                            
								$textClass = 'text-success';
							} else if ($row['status'] == 3) {                            
								$textClass = 'text-danger';
							}else {  
								$textClass = ''; 
							}
							$pedido = $row['order_id'];
							$item = $row['name'];
							$quantidade = $row['quantity'];
							$obs = $row['observacao'];
							$status = $row['status'];
						?>
						<tr>
							<td style="vertical-align: middle;"><?php echo $pedido; ?></td>
							<td style="vertical-align: middle; text-align: center;"><?php echo $item; ?></td>
							<td style="vertical-align: middle; text-align: center;"><?php echo $quantidade; ?></td>
							<td style="vertical-align: middle; text-align: center;"><?php echo $obs; ?></td>
							<?php if ($row['status'] == 0){
                                $status = "PREPARANDO";
                            } else if ($row['status'] == 1){
                                $status = "ENTREGUE";
                            } else if ($row['status'] == 2){
                                $status = "FINALIZADO";
                            } else if ($row['status'] == 3){
                                $status = "CANCELADO";
                            }?>
                            <td style="vertical-align: middle; text-align: center;" class="<?php echo $textClass; ?>"><?php echo $status?></td>   
						</tr>
						<?php
						}
						?>
										
				</table>	
				<?php
            } else {
            ?>
			<div class="container">
                <div class="jumbotron">
                    <h3>Você ainda não tem pedidos. Escolha seus <a href="index.php">produtos!</a></h3>
                </div>
            </div>
            <?php
            }
            ?>					
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>