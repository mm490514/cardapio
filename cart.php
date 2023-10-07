<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

if (isset($_SESSION["cart"])) {
	if (isset($_GET["action"])) {
		if ($_GET["action"] == "add") {
			foreach ($_SESSION["cart"] as $keys => $values) {
				if ($values["food_id"] == $_GET["id"]) {				
					$_SESSION["cart"][$keys]["item_quantity"]++;					
					echo '<script>window.location="cart.php"</script>';
				}
			}
		}
	}
}

if (isset($_POST["add"])) {
	if (isset($_SESSION["cart"])) {
		$item_array_id = array_column($_SESSION["cart"], "food_id");
		if (!in_array($_GET["id"], $item_array_id)) {
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'food_id' => $_GET["id"],
				'item_name' => $_POST["item_name"],
				'item_price' => $_POST["item_price"],
				'item_id' => $_POST["item_id"],
				'item_quantity' => 1,
				'item_image' => $_POST["item_image"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="cart.php"</script>';
			
		} else {
			echo '<script>window.location="cart.php"</script>';
		}
		
	} else {
		$item_array = array(
			'food_id' => $_GET["id"],
			'item_name' => $_POST["item_name"],
			'item_price' => $_POST["item_price"],
			'item_id' => $_POST["item_id"],
			'item_quantity' => 1,
			'item_image' => $_POST["item_image"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
	
} 



if (isset($_GET["action"])) {
	if ($_GET["action"] == "delete") {
		foreach ($_SESSION["cart"] as $keys => $values) {
			if ($values["food_id"] == $_GET["id"]) {				
				unset($_SESSION["cart"][$keys]);
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}



if (isset($_GET["action"])) {
	if ($_GET["action"] == "sub") {
		foreach ($_SESSION["cart"] as $keys => $values) {
			if ($values["food_id"] == $_GET["id"]) {
				$_SESSION["cart"][$keys]["item_quantity"]--;				
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

if (isset($_GET["action"])) {
	if ($_GET["action"] == "empty") {
		foreach ($_SESSION["cart"] as $keys => $values) {
			unset($_SESSION["cart"]);
			echo '<script>window.location="cart.php"</script>';
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
			if (!empty($_SESSION["cart"])) {
			?>
				<h3>Seu Carrinho:</h3>
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>							
							<th width="4%"></th>
							<th width="20%" style="text-align: center;">Nome</th>
							<th width="8%" style="text-align: center;">Qtd</th>							
							<th width="4%" style="text-align: center;">Subtotal</th>
							<th width="20%" style="text-align: center;">Obs</th>
							<th width="5%"></th>
						</tr>
					</thead>
					<?php
					$total = 0;
					foreach ($_SESSION["cart"] as $keys => $values) {
						//var_dump($_SESSION["cart"]);exit;
					?>
						<tr>							
							<td style="vertical-align: middle;"><img src="images/<?php echo $values["item_image"]; ?>" alt="Descrição da imagem" width="50" height="50"></td>							
							<td style="vertical-align: middle; text-align: center;"><?php echo $values["item_name"]; ?></td>
							<td style="vertical-align: middle; text-align: center;">
							<a href="cart.php?action=sub&id=<?php echo $values["food_id"]; ?>"><i class="fas fa-minus-circle text-black"></i></a>							
							<span id="quantity-<?php echo $values["food_id"]; ?>"><?php echo $values["item_quantity"]; ?></span>
							<a href="cart.php?action=add&id=<?php echo $values["food_id"]; ?>"><i class="fas fa-plus-circle text-black"></i></a>							
							</td>									
							<td style="vertical-align: middle; text-align: center;">R$ <?php echo $values["item_price"] * $values["item_quantity"]; ?></td>
							<td style="vertical-align: middle; text-align: center;">
								<?php if (isset($values["customization"])): ?>
									<span id="customization-<?php echo $values["food_id"]; ?>"><?php echo $values["customization"]; ?></span>
									<a href="#" onclick="editCustomization(<?php echo $values["food_id"]; ?>);"><i class="fas fa-edit text-primary"></i></a>
								<?php else: ?>
									<span id="customization-<?php echo $values["food_id"]; ?>"></span>
									<a href="#" onclick="editCustomization(<?php echo $values["food_id"]; ?>);"><i class="fas fa-edit text-primary"></i></a>
								<?php endif; ?>
							</td>
							<td style="vertical-align: middle; text-align: center;"><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><i class="fas fa-times-circle text-danger"></i></a></td>
						</tr>
					<?php
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
					}
					?>
					<tr>
						<td style="vertical-align: middle;" colspan="3" align="right">Total:</td>
						<td align="right"><strong>R$ <?php echo number_format($total, 2); ?></strong></td>
						
					</tr>
				</table>
				<?php
				echo '<div><a href="cart.php?action=empty"><button class="btn btn-danger"><span class="bi bi-trash-fill"></span> Limpar Carrinho</button></a>&nbsp;<a href="index.php"><button class="btn btn-warning">Adicionar mais itens</button></a>&nbsp;<a href="checkout.php"><button class="btn btn-success float-end"><span class="bi bi-arrow-right"></span> Confirmar</button></a></div>';
				?>
			<?php
			} elseif (empty($_SESSION["cart"])) {
			?>
				<div class="container">
					<div class="jumbotron">
						<h3>Seu carrinho está vazio. Escolha seus <a href="index.php">produtos!</a></h3>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>

<script>

    function editCustomization(foodId) {
        var customizationSpan = document.getElementById("customization-" + foodId);
        var customizationValue = customizationSpan.innerHTML;
        var newCustomization = prompt("Editar personalização:", customizationValue);

        if (newCustomization !== null) {
        // Atualizar o valor exibido no <span>
        customizationSpan.innerHTML = newCustomization;

        // Atualizar o valor em $_SESSION["cart"]
        // Para fazer isso, você precisa enviar o novo valor para o servidor (por exemplo, usando AJAX) e lá atualizar $_SESSION["cart"]
        
        // Exemplo de como você pode atualizar $_SESSION["cart"] via AJAX usando jQuery
        $.ajax({
            type: "POST", // ou "GET" dependendo do seu backend
            url: "atualizar_cart.php", // URL do script no servidor que atualizará $_SESSION["cart"]
            data: {
                foodId: foodId,
                customization: newCustomization
            },
            success: function(response) {               
            },
            error: function(xhr, status, error) {
                // Lidar com erros de requisição AJAX aqui, se necessário
            }
        });
    }
    }

</script>