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
        <h3>Editar produto</h3>
        <!-- <p class="text-muted">Complete the form</p> -->
    </div>
</div>


<?php
$item = $admin->buscarProduto($_GET['id']);
?>

<div class="container d-flex justify-content-center">
<form action="" method="post" style="width: 50vw; min-width: 300px;" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <label class="form-label" for="">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $item['name'] ?>" required>
                <label for="" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $item['price'] ?>" step="any" required>
            </div>

            <div class="col">
            <label class="form-label" for="">Categoria</label>
            <select type="text" name="categoria" class="form-select" id="categoria" required>
                <option value="">Selecione</option>
                <?php
                $result = $categoria->categoriasList();
                while ($item2 = $result->fetch_assoc()) {
                    $selected = ($item2['id'] == $item['id_categoria']) ? 'selected' : '';
                    ?>
                    <option value="<?php echo $item2['id'] ?>" <?php echo $selected ?>><?php echo $item2['nome'] ?></option>
                <?php }; ?>
            </select>          
            <label class="form-label" for="">Imagem</label>
            <input type="file" name="image" id="image" class="form-control" multiple />
            <input type="hidden" name="image_salva" value="<?php echo $item['images']; ?>">         
        </div>


        </div>

        <div class="">
            <label class="form-label" for="">Descrição</label>
            <input type="text" class="form-control" name="desc" value="<?php echo $item['description'] ?>">
        </div>

        <div class="mb-3">

            <label class="form-label" for="">Status</label>
            <select type="text" name="status" class="form-select" id="categoria" required>
                <option value="0" <?php if ($item['status'] == 0) echo 'selected' ?>>Inativo</option>
                <option value="1" <?php if ($item['status'] == 1) echo 'selected' ?>>Ativo</option>
            </select>
        </div>



        <div>
            <button type="submit" class="btn btn-success" name="submit">
                Atualizar</button>
            <a href="produtos.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
<!-- Modal de confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Produto Atualizado com sucesso!</h5> 
        <i class="bi bi-check-lg" style="font-size: 2rem;"></i>                   
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmUpdate">Ok</button>        
      </div>
    </div>
  </div>
</div>
<?php

$hash = md5(implode($_POST));

if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash) {
    echo '<div class="container justify-content-center mt-5"><div class="alert alert-warning alert-dismissible fade show" role="alert">Produto já foi cadastrado!
    <button type="button" class="btn-close" data-bs-dismiss="alert"
    aria-lable="Close"></button></div></div>';
} else {
    if (isset($_POST['nome'])) {        
        $admin->item_name = $_POST['nome'];
        $admin->item_idcategory = $_POST['categoria'];
        $admin->item_price = $_POST['preco'];
        $admin->item_description = $_POST['desc'];         
       
      
       if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
    
            $targetDir = "D:\\xampp\htdocs\cardapio\images\\";
            $targetFile = $targetDir . basename($imageName);
    
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                // Se o upload da imagem for bem-sucedido, continue com o restante do código
                $admin->item_image = $_FILES['image']['name'];
                $admin->item_status = 1;
                $admin->updateProduto($_GET['id']);
                echo '<script>
                $(document).ready(function() {
                    $("#confirmModal").modal("show");
                    $("#confirmUpdate").on("click", function() {
                        $("#confirmModal").modal(\'hide\'); 
                        window.location.href = \'produtos.php\';                          
                    });
                });
              </script>';
                $_SESSION['hash'] = $hash;
                // header("Location: index.php?msg=Novo produto criado com sucesso!");
            } else {
                echo "Desculpe, ocorreu um erro ao mover o arquivo de imagem.";
            }
        }  else if (isset($_POST['image_salva'])) {            
            $admin->item_status = 1;
            $admin->item_image = $_POST['image_salva']; 
            $admin->updateProduto($_GET['id']);
            echo '<script>
            $(document).ready(function() {
                $("#confirmModal").modal("show");
                $("#confirmUpdate").on("click", function() {
                    $("#confirmModal").modal(\'hide\');     
                    window.location.href = \'produtos.php\';                     
                });
            });
            </script>';
            $_SESSION['hash'] = $hash;
        }       
        else {
            echo "Desculpe, ocorreu um erro ao encontrar o arquivo.";
             
        }
    }
}
?>