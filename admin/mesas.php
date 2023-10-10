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
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
			<button type="button" class="btn-close" data-bs-dismiss="alert"
			aria-lable="Close"></button></div>';
    }

    ?>











    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3" style="border: none;">
                    <div class="card mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Mesa 1</h5>        
                            <h6 class="card-subtitle mb-2 text-body-secondary">Matheus</h6>                                              
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Quantidade</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td>X Tudão</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="#" class="btn btn-primary">P</a>
                                                <a href="#" class="btn btn-success">E</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Coca-Cola Lata 250ml</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="#" class="btn btn-primary">P</a>
                                                <a href="#" class="btn btn-success">E</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="#" class="btn btn-primary">Pronto</a>
                            <a href="#" class="btn btn-success">Entregue</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="card mb-3" style="border: none;">
                    <div class="card mb-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Mesa 2</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Martin</h6> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Quantidade</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2</td>
                                        <td>X Tudão</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="#" class="btn btn-primary">P</a>
                                                <a href="#" class="btn btn-success disabled">E</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Coca-Cola Lata 250ml</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="#" class="btn btn-primary disabled">P</a>
                                                <a href="#" class="btn btn-success">E</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="#" class="btn btn-primary">Pronto</a>
                            <a href="#" class="btn btn-success">Entregue</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Adicione mais col-md-4 para mais cards lado a lado -->
        </div>
    </div>
    </body>

    </html>