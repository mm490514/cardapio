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
                    <?php
                    $sqlMesa = "SELECT num_mesa AS total_mesas_ativas FROM pedidosvendas WHERE status <> '2' group by num_mesa";
                    $stmt = $db->prepare($sqlMesa);
                    $stmt->execute();
                    $resultMesa = $stmt->get_result();



                    $mesaPedidos = array(); // Array para armazenar os pedidos de cada mesa

                    while ($row = $resultMesa->fetch_assoc()) {
                        $sqlPedidos = "SELECT * FROM pedidosvendas WHERE num_mesa = ?";
                        $stmt = $db->prepare($sqlPedidos);
                        $stmt->bind_param("s", $row['total_mesas_ativas']);
                        $stmt->execute();
                        $resultP = $stmt->get_result();

                        $mesaPedidos[$row['total_mesas_ativas']] = array(); // Inicializa o array de pedidos para a mesa

                        while ($rowP = $resultP->fetch_assoc()) {
                            // Adiciona os detalhes do pedido à mesa correspondente no array
                            $mesaPedidos[$row['total_mesas_ativas']][] = $rowP;
                        }
                    }

                    // Agora, renderize os cartões com os pedidos agrupados por mesa
                    foreach ($mesaPedidos as $numMesa => $pedidos) {
                        $cardTitle = "Mesa " . $numMesa;
                        // Pode adicionar um subtítulo se desejar

                        echo '
                                <div class="col-md-12">
                                            <div class="card mb-3" style="border: none;">
                                                <div class="card mb-3" style="width: 100%;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">' . $cardTitle . '</h5>
                                                        <!-- Adicione o subtítulo aqui se necessário -->
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="20%">Quantidade</th>
                                                                    <th width="20%">Descrição</th>
                                                                    <th width="40%">Obs</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>';

                                                        foreach ($pedidos as $pedido) {
                                                            if ($pedido['status'] == "0"){
                                                                $textClass = 'text-primary';
                                                                $pedido['status'] = "PREPARANDO";
                                                            } else if ($pedido['status'] == "1"){
                                                                $textClass = 'text-success';
                                                                $pedido['status'] = "ENTREGUE";
                                                            }else if ($pedido['status'] == "3"){
                                                                $textClass = 'text-danger';
                                                                $pedido['status'] = "CANCELADO";
                                                            }
                                                            echo '<tr>
                                                                <td>' . $pedido['quantity'] . '</td>
                                                                <td>' . $pedido['name'] . '</td>
                                                                <td>' . $pedido['observacao'] . '</td>
                                                                <td class = '.$textClass.'><b>' . $pedido['status'] . '</b></td>
                                                                <td></td>                                                               
                                                                <td> <a href="#" class="btn btn-success update-status" data-pedido-id="' . $pedido['id'] . '"><i class="bi bi-check2-circle"></i></a></td>
                                                                <td> <a href="#" class="btn btn-danger cancel-status" data-pedido-id="' . $pedido['id'] . '"><i class="bi bi-x"></i></a></td>

                                                                
                                                            </tr>';
                                                        }

                                                        echo '</tbody>
                                        </table>  
                                        <a href="#" class="btn btn-primary close-table" data-mesa-id="' . $numMesa . '">FECHAR MESA</a>                                
                                        </div>
                                    </div>                                
                            </div>';
                    }


                    ?>
                </div>
            </div>

        </div>
        <!-- Adicione mais col-md-4 para mais cards lado a lado -->
</body>

</html>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Entrega</h5>     
      </div>
      <div class="modal-body">
        <p>O pedido foi entregue ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmUpdate">Sim</button>
        <button type="button" class="btn btn-secondary" id="cancelUpdate">Não</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cancelamento -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancelar Pedido</h5>               
            </div>
            <div class="modal-body">
                Tem certeza de que deseja cancelar este pedido?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelCancel">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Sim, cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Fechamento da Mesa -->
<div class="modal fade" id="closeTableModal" tabindex="-1" role="dialog" aria-labelledby="closeTableModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeTableModalLabel">Fechar Mesa</h5>               
            </div>
            <div class="modal-body">
                Tem certeza de que deseja fechar esta mesa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelCloseTable">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmCloseTable">Sim, fechar mesa</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Função para atualizar o status
    function updateStatus(pedidoID, novoStatus) {
        $.ajax({
            type: "POST",
            url: "atualizar_status_pedido.php",
            data: {
                pedido_id: pedidoID,
                novo_status: novoStatus
            },
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                // Lida com erros, se necessário
            }
        });
    }

    // Botão "Atualizar Status"
    $(".update-status").on("click", function () {
        var pedidoID = $(this).data("pedido-id");
        $("#confirmModal").modal('show');

        $("#confirmUpdate").on("click", function() {
            $("#confirmModal").modal('hide');
            updateStatus(pedidoID, 1); // Altera o status para 1 (ENTREGUE)
        });

        $("#cancelUpdate").on("click", function() {
            $("#confirmModal").modal('hide');
        });
    });

    // Botão "Cancelar"
    $(".cancel-status").on("click", function () {
        var pedidoID = $(this).data("pedido-id");
        $("#cancelModal").modal('show');

        $("#confirmCancel").on("click", function() {
            $("#cancelModal").modal('hide');
            updateStatus(pedidoID, 3); // Altera o status para 3 (CANCELADO)
        });

        $("#cancelCancel").on("click", function() {
            $("#cancelModal").modal('hide');
        });
    });

    // Botão "Fechar Mesa"
    $(".close-table").on("click", function () {
        var mesaID = $(this).data("mesa-id");
        $("#closeTableModal").modal('show');

        $("#confirmCloseTable").on("click", function() {
            $("#closeTableModal").modal('hide');
            // Adicione uma chamada AJAX para fechar a mesa e alterar o status para 2 (FECHADO)
            $.ajax({
                type: "POST",
                url: "fechar_mesa.php", // O arquivo PHP que irá processar o fechamento da mesa
                data: {
                    mesa_id: mesaID,
                    novo_status: 2
                },
                success: function (response) {
                    location.reload();                   
                },
                error: function (error) {
                    // Lida com erros, se necessário
                }
            });
        });

        $("#cancelCloseTable").on("click", function() {
            $("#closeTableModal").modal('hide');
        });
    });
});


</script>


