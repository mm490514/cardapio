<?php
include_once 'config/Database.php';
include_once 'class/Pedido.php';

$database = new Database();
$db = $database->getConexao();
$order = new Pedido($db);

include('inc/header.php');
?>


<title>Cardapio</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>

<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php
			if (isset($_POST['enviar']) && !empty($_GET['order'])) {
				
				
				
				if (isset($_POST['obs'])) {
					$obs = $_POST['obs'];
				}else{
					$obs = '';
				}

			

				

				$nome = $_POST['nome'];
				$mesa = $_SESSION['num_mesa'];
				$status = 0;
				$total = 0;
				$orderDate = date('Y-m-d');				

				
				
				if (isset($_SESSION["cart"])) {
					$cont = 0;

					
					
					foreach ($_SESSION["cart"] as $keys => $values) {

					
						
						$nomeItem[] = $values["item_name"];
						$preco[] = $values["item_price"];
						$qtd[] = $values["item_quantity"];

						$order->item_id = $values["item_id"];
						$order->item_name = $values["item_name"];						
						$order->item_price = $values["item_price"];
						$order->quantity = $values["item_quantity"];
						$order->cliente_nome = $nome;
						$order->num_mesa = $mesa;
						$order->status = $status;						
						if (isset($values["observacao"])) {
							$order->cliente_observacao = $values["observacao"];
						} else {							
							$order->cliente_observacao = '';							
						}
						$order->order_date = $orderDate;
						$order->order_id = $_GET['order'];
						$cont++;
						$order->insert();
						
						
						
					}
			
				}
				?>
				<br>
				<html>
					
					
				<div class="container">
					<div class="jumbotron">
						<h1 style="font-weight: bold; margin-top: 15px; font-size: 25px;" class="text-left"><span class="glyphicon glyphicon-ok-circle"></span> Pedido Confirmado.</h1>
					</div>
				</div>								
				<h2 style="color: gray; margin-top: 15px; font-size: 20px;" class="text-left"><?php echo $nome; ?> seu pedido foi confirmado e já está sendo preparado. Obrigado!</h2>												
				<h2 style="color: gray; margin-top: 15px; font-size: 20px;" class="text-left">Você pode acompanhar seu pedido por aqui.</h2>				
				<div class="d-grid gap-2 d-md-block" style="text-align: center; margin-top: 30px;">
					<a href="order.php">
						<button class="btn btn-danger" type="button" style="color: white; width: 300px; height: 50px;"><p style="margin: 0; padding: 0;">Acompanhar pedido</p></button>
					</a>
				</div>
				

			<table border="0" style="border-collapse: collapse; margin-top: 30px;">
			<tr>
				<th>Item</th>
				<th>Preço</th>
				<th>Quantidade</th>
				<th>Obs</th>
			</tr>
				<?php

				if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
					// Inicialize os arrays
					$nomeItem = array();
					$preco = array();
					$qtd = array();
					$obs = array();

					// Supondo que $_SESSION["cart"] seja um array associativo
					foreach ($_SESSION["cart"] as $keys => $values) {
						// Preencha os arrays com os valores do $_SESSION["cart"]
						$nomeItem[] = $values["item_name"];
						$preco[] = $values["item_price"];
						$qtd[] = $values["item_quantity"];							
						if (isset($values["observacao"])) {
							$obs[] = $values["observacao"];		
						} else {
							$obs[] = "";
						}			

						$subtotal = $values["item_price"] * $values["item_quantity"];
						$total += $subtotal;

					
					}

					// Exiba os valores dos arrays em uma tabela
					for ($i = 0; $i < count($nomeItem); $i++) {
						echo "<tr>";
						echo "<td>" . $nomeItem[$i] . "</td>";
						echo "<td>R$ " . number_format($preco[$i], 2) . "</td>"; // Formate o preço como moeda
						echo "<td>" . $qtd[$i] . "</td>";
						echo "<td>" . $obs[$i] . "</td>";
						echo "</tr>";
					}
					
					  // Adicione a linha de total
					  echo "<tr style='border-top: 2px solid darkgray;'>";
					  echo "<td colspan='2'><strong>Total:</strong></td>";
					  echo "<td><strong>R$ " . number_format($total, 2) . "</strong></td>";
					  echo "</tr>";
				} else {
					// Se a sessão "cart" estiver vazia, exiba uma mensagem de que não há itens no carrinho.
					echo "<tr><td colspan='3'>Não há itens no carrinho.</td></tr>";
				}
				?>
			</table>
		

			<?php } unset($_SESSION["cart"]); ?>
		</div>
	</div>
	<?php include('inc/footer.php'); ?>