<?php
class Pedido {	
   
	private $pedidosTable = 'pedidosvendas';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }
	
	public function insert(){		
		if($this->item_name) {
			$stmt = $this->con->prepare("
			INSERT INTO ".$this->pedidosTable."(`item_id`, `name`, `price`, `quantity`, `cliente_nome`, `num_mesa`,`status`,`observacao`, `order_date`, `order_id`)
			VALUES(?,?,?,?,?,?,?,?,?,?)");		
			$this->item_id = htmlspecialchars(strip_tags($this->item_id));
			$this->item_name = htmlspecialchars(strip_tags($this->item_name));
			$this->quantity = htmlspecialchars(strip_tags($this->quantity));
			$this->item_price = htmlspecialchars(strip_tags($this->item_price));
			$this->cliente_nome = htmlspecialchars(strip_tags($this->cliente_nome));
			$this->num_mesa = htmlspecialchars(strip_tags($this->num_mesa));
			$this->cliente_observacao = htmlspecialchars(strip_tags($this->cliente_observacao));
			$this->order_date = htmlspecialchars(strip_tags($this->order_date));
			$this->order_id = htmlspecialchars(strip_tags($this->order_id));			
			$stmt->bind_param("isdisiissi", $this->item_id, $this->item_name, $this->item_price, $this->quantity, $this->cliente_nome, 
			$this->num_mesa, $this->status, $this->cliente_observacao, $this->order_date, $this->order_id);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
}
?>
