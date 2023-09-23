<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <div style="display: flex;">
            <div>


                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                    <input class="form-control w-80" type="text" name="nome" id="nome" value="" required="true" />
                </div>


            <div style="margin-left: 80px;">
                </div>
                <h4 class="mt-3" >Detalhes do pedido</h4>
                <p class="mb-1" id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) echo " <br> " . $qtd[$i] . " " . $itens[$i] .  " - R$ "  . $precos[$i]  * $qtd[$i] ?> </p>                              
                <p class="mb-1" id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal; ?></p>
                <div class="input-group">
                <textarea class="form-control" placeholder="Observações"  aria-label="With textarea"></textarea>
                </div>
                <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-outline-success mt-3">Confirmar Pedido</button></a></p>
        </div>
    </form>

    <script src="./api/consultaCep.js"></script>
    <script>
        function verifica(value) {
            var input = document.getElementById("troco");

            if (value == 3) {
                input.disabled = false;
            } else {
                input.disabled = true;
            }
        };
    </script>
</div>