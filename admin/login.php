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

// if ($admin->loggedIn()) {
//     header("Location: index.php");
// }

include('../inc/header.php');

$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $admin->email = $_POST["email"];
    $admin->password = $_POST["password"];
    if ($admin->login()) {
        header("Location: index.php");
    } else {
        $loginMessage = 'Dados incorretos!';
    }
} else {
    $loginMessage = 'Preencha todos os campos';
}

?>


<title>Painel Admin</title>
<?php include('../inc/container.php'); ?>
<div class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">                                                            
                </div>
                <div class="card shadow-lg">
                <img src="./../images/logo.png" class="img-fluid">		   
                    <?php if ($loginMessage != '') { ?>
                       
                    <?php } ?>


                    <form id="loginform" class="needs-validation" role="form" method="POST" action="">
                        <div class="mb-0 p-4">
                            <input type="text" class="form-control" id="email" name="email" value="<?php if (!empty($_POST["email"])) {
                                                                                                        echo $_POST["email"];
                                                                                                    } ?>" placeholder="Email" style="background:white;" required>
                        </div>
                        <div class="mb-3 p-4">
                            <input type="password" class="form-control" id="password" name="password" value="<?php if (!empty($_POST["password"])) {
                                                                                                                    echo $_POST["password"];
                                                                                                                } ?>" placeholder="Senha" required>
                        </div>

                        <div class="form-group">
                            <div style="text-align: center; margin-bottom: 10px;">
                                <input type="submit" name="login" value="Login" class="btn btn-danger ms-auto">
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>