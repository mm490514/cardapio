<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

if (isset($_POST["add"])) {
	if (isset($_SESSION["order"])) {
		$item_array_id = array_column($_SESSION["order"], "food_id");
		if (!in_array($_GET["id"], $item_array_id)) {
			$count = count($_SESSION["order"]);
			$item_array = array(
				'item_name' => $_POST["item_name"],
				'item_price' => $_POST["item_price"],
				'item_id' => $_POST["item_id"],
				'item_quantity' => $_POST["quantity"],
                'cliente_nome' => $_POST["cliente_nome"],
                'observacao' => $_POST["observacao"]
			);
			$_SESSION["order"][$count] = $item_array;
			echo '<script>window.location="order.php"</script>';
		} else {
			echo '<script>window.location="order.php"</script>';
		}
	} else {
		$item_array = array(
			    'item_name' => $_POST["item_name"],
				'item_price' => $_POST["item_price"],
				'item_id' => $_POST["item_id"],
				'item_quantity' => $_POST["quantity"],
                'cliente_nome' => $_POST["cliente_nome"],
                'observacao' => $_POST["observacao"]
		);
		$_SESSION["order"][0] = $item_array;
	}
}

if (isset($_GET["action"])) {
	if ($_GET["action"] == "delete") {
		foreach ($_SESSION["order"] as $keys => $values) {
			if ($values["item_id"] == $_GET["id"]) {
				unset($_SESSION["order"][$keys]);
				echo '<script>window.location="order.php"</script>';
			}
		}
	}
}

if (isset($_GET["action"])) {
	if ($_GET["action"] == "empty") {
		foreach ($_SESSION["order"] as $keys => $values) {
			unset($_SESSION["order"]);
			echo '<script>window.location="order.php"</script>';
		}
	}
}

include('inc/header.php');
?>
<title>Projeto</title>
<?php include('inc/container.php'); ?>
<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php include('top_menu.php'); ?>
		</div>
		<div class='row'>
			<?php
			if (!empty($_SESSION["order"])) {
			?>
				<h3>Seu Carrinho:</h3>
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th width="40%">Nome</th>							
							<th width="10%">Qtd</th>
							<th width="20%">Preço Uni.</th>
							<th width="25%">Subtotal</th>
							<th width="5%">Acão</th>
						</tr>
					</thead>
					<?php
					$total = 0;
					foreach ($_SESSION["order"] as $keys => $values) {
					?>
						<tr>
							<td><?php echo $values["cliente_nome"]; ?></td>
                            <td><?php echo $values["item_id"]; ?></td>
                            <td><?php echo $values["observacao"]; ?></td>
                            <td><?php echo $values["item_name"]; ?></td>
							<td><?php echo $values["item_quantity"]?></td>
							<td>R$ <?php echo $values["item_price"]; ?></td>
							<td>R$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
							<td><a href="order.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remover</span></a></td>
						</tr>
					<?php
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total:</td>
						<td align="right"><strong>R$ <?php echo number_format($total, 2); ?></strong></td>
						<td></td>
					</tr>
				</table>
				<?php
				echo '<div><a href="order.php?action=empty"><button class="btn btn-danger"><span class="bi bi-trash-fill"></span> Limpar Carrinho</button></a>&nbsp;<a href="index.php"><button class="btn btn-warning">Adicionar mais itens</button></a>&nbsp;<a href="checkout.php"><button class="btn btn-success float-end"><span class="bi bi-arrow-right"></span> Confirmar</button></a></div>';
				?>
			<?php
			} elseif (empty($_SESSION["order"])) {
			?>
				<div class="container">
					<div class="jumbotron">
						<h3>Sem pedidos faça ja seus <a href="index.php">pedidos!</a></h3>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>