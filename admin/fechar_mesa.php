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

// Receber dados da solicitação AJAX
$mesaID = $_POST['mesa_id'];


$novoStatus = $_POST['novo_status'];

// Executar a consulta de atualização
$stmt = $db->prepare("UPDATE pedidosvendas SET status = ? WHERE num_mesa = ?");

$stmt->bind_param("ii", $novoStatus, $mesaID);

if ($stmt->execute()) {
    echo "Status atualizado com sucesso.";
} else {
    echo "Erro ao atualizar o status: " . $stmt->error;
}


$db->close();
?>
