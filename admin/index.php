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

$sqlProd = "SELECT COUNT(*) FROM produtos";
$stmt = $db->prepare($sqlProd);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$qtdProd = $row[0];

$sqlMesa = "SELECT COUNT(*) FROM (SELECT DISTINCT num_mesa FROM pedidosvendas WHERE status <> 2) AS subquery";
$stmt = $db->prepare($sqlMesa);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$qtdMesa = $row[0];

$sqlPed = "SELECT COUNT(*) FROM (SELECT DISTINCT order_id FROM pedidosvendas WHERE status = 0) AS subquery";
$stmt = $db->prepare($sqlPed);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$qtdPedidos = $row[0];

$sqlFin = "SELECT COUNT(*) FROM (SELECT DISTINCT order_id FROM pedidosvendas WHERE status = 2 and order_date = CURRENT_DATE) AS subquery";
$stmt = $db->prepare($sqlFin);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$qtdFin = $row[0];


?>

<div class="container-fluid">
	<section id="minimal-statistics">
		<div class="row mb-2">
			<div class="col-12 mt-3 mb-1">
				<h4 class="text-uppercase">Estatísticas do Sistema</h4>

			</div>
		</div>




		<div class="row mb-4">

			<div class="col-xl-3 col-sm-6 col-12" onclick="redirecionarParaProdutos()" > 
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-basket text-primary fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-primary"><?= $qtdProd ?></span></h3>
									<span>Produtos Cadastrados</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6 col-12" onclick="redirecionarParaMesas()"> 
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-clipboard-fill text-warning fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-warning"><?= $qtdMesa ?></span></h3>
									<span>Mesas em Aberto</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-xl-3 col-sm-6 col-12" onclick="redirecionarParaPedidos()"> 
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-pencil-square text-danger	 fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-danger"><?= $qtdPedidos ?></span></h3>
									<span>Pedidos em Preparo</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-xl-3 col-sm-6 col-12" onclick="redirecionarParaPedidos()"> 
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-clipboard2-check-fill text-success fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3><span class="text-success"><?= $qtdFin ?></span></h3>
									<span>Pedidos Finalizados (Hoje)</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<script>
    function redirecionarParaProdutos() {
        window.location.href = 'produtos.php';
    }
	function redirecionarParaMesas() {
        window.location.href = 'mesas.php';
    }
	function redirecionarParaPedidos() {
        window.location.href = 'pedidos.php';
    }
	</script>

	