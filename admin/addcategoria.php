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

<div class="container mt-4">
    <div class="text-center mb-4">
        <h3>Cadastrar Categoria</h3>
        <!-- <p class="text-muted">Complete the form</p> -->
    </div>
</div>

<div class="container d-flex justify-content-center">
    <form action="" method="post" style="width: 50vw; min-width: 300px;">
        <div class="row">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">
                    Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
    </form>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Categoria Cadastrada com sucesso!</h5> 
        <i class="bi bi-check-lg" style="font-size: 2rem;"></i>
                   
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmUpdate">Ok</button>        
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="existeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Categoria já Cadastrada!</h5> 
        <i class="bi bi-check-lg" style="font-size: 2rem;"></i>
                   
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="existeUpdate">Ok</button>        
      </div>
    </div>
  </div>
</div>


<?php
$hash = md5(implode($_POST));

if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash) {   
    echo '<script>
    $(document).ready(function() {
        $("#existeModal").modal("show");
        $("#existeUpdate").on("click", function() {
            $("#existeModal").modal(\'hide\');  
            ' . $modalShown = true . '
            return;                      
        });
    });
  </script>';
} else {
    if (isset($_POST['nome'])) {
        $admin->item_catName = $_POST['nome'];
        $admin->item_catStatus = 1;
        $admin->insertCategoria();
        $_SESSION['hash'] = $hash;
        
        // Adicione um script JavaScript para mostrar o modal após a inserção da categoria
        echo '<script>
                $(document).ready(function() {
                    $("#confirmModal").modal("show");
                    $("#confirmUpdate").on("click", function() {
                        $("#confirmModal").modal(\'hide\');                        
                    });
                });
              </script>';
    }
}
?>