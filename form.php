<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

$mesa = $_SESSION['num_mesa'];
?>

<div class="col">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <div style="display: flex;">
            <div>


                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Número da Mesa</span>
                    <input style="text-align: center; font-weight: bold;"  class="form-control w-80" type="text" name="mesa" id="mesa" value="<?= $_SESSION['num_mesa'] ?>" required="true" disabled/>
                </div>

                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                    <input style="text-align: center;" class="form-control w-80" type="text" name="nome" id="nome" value="" required="true" />
                </div>


            <div style="margin-left: 80px;">
                </div>
                <h4 class="mt-3" >Detalhes do pedido</h4>
                <p class="mb-1" id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) {
                $obsText = !empty($obs[$i]) ? " - " . $obs[$i] : ""; // Adiciona o hífen se $obs[$i] não estiver vazio
                echo " <br> " . $qtd[$i] . " " . $itens[$i] .  " - R$ "  . $precos[$i]  * $qtd[$i] . $obsText;
                } ?> </p>

                <p class="mb-1" id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal; ?></p>
                <div class="input-group">
                </div>
                <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-outline-success mt-3">Confirmar Pedido</button></a></p>
        </div>
    </form>
</div>