<?php
class Admin
{

	private $produtosTable = 'produtos';
	private $pedidosTable = 'pedidosvendas';
	private $categoriasTable = 'categorias';
	private $adminTable = 'admin';
	private $con;


	public function __construct($db)
	{
		$this->con = $db;
	}

	public function login()
	{
		if ($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM " . $this->adminTable . " 
				WHERE email = ? AND password = ?";
			$stmt = $this->con->prepare($sqlQuery);
			// $password = md5($this->password);
			$stmt->bind_param("ss", $this->email, $this->password);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if ($result->num_rows > 0) {
				$user = $result->fetch_assoc();

				$_SESSION["id"] = $user['id'];
				$_SESSION["nome"] = $user['nome'];
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	public function loggedIn()
	{
		if (!empty($_SESSION["id"])) {
			return 1;
		} else {
			return 0;
		}
	}

	/*<input type="file" class="logo-financeiro" id="<?php echo $campo9 ?>" name="imagem" id="<?php echo $campo9 ?>" onChange="carregarImg();">
	
	
	function carregarImg() {
    var target = document.getElementById('target');
    var file = document.querySelector("input[type=file]").files[0];
    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);
        //console.log(resultado[1]);
        if(resultado[1] === 'pdf'){
            $('#target').attr('src', "../img/pdf.png");
            return;
        }

        if(resultado[1] === 'rar'){
            $('#target').attr('src', "../img/rar.png");
            return;
        }

        if(resultado[1] === 'zip'){
            $('#target').attr('src', "../img/rar.png");
            return;
        }

        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }*/

	public function insertProduto()
	{
		if ($this->item_name) {
			$stmt = $this->con->prepare("
			INSERT INTO " . $this->produtosTable . "(`name`, `id_categoria`, `price`, `description`, `images`,
			`status`)
			VALUES(?,?,?,?,?,?)");
			$this->item_name = htmlspecialchars(strip_tags($this->item_name));
			$this->item_idcategory = htmlspecialchars(strip_tags($this->item_idcategory));
			$this->item_price = htmlspecialchars(strip_tags($this->item_price));
			$this->item_description = htmlspecialchars(strip_tags($this->item_description));
			$this->item_image = htmlspecialchars(strip_tags($this->item_image));
			$this->item_status = htmlspecialchars(strip_tags($this->item_status));
			$stmt->bind_param(
				"sidssi",
				$this->item_name,
				$this->item_idcategory,
				$this->item_price,
				$this->item_description,
				$this->item_image,
				$this->item_status
			);
			if ($stmt->execute()) {
				return true;
			}
		}
	}

	public function updateProduto($id)
	{
		if ($this->item_name) {

			$this->item_name = htmlspecialchars(strip_tags($this->item_name));
			$this->item_idcategory = htmlspecialchars(strip_tags($this->item_idcategory));
			$this->item_price = htmlspecialchars(strip_tags($this->item_price));
			$this->item_description = htmlspecialchars(strip_tags($this->item_description));
			$this->item_image = htmlspecialchars(strip_tags($this->item_image));
			$this->item_status = htmlspecialchars(strip_tags($this->item_status));
			$stmt = $this->con->prepare("
			UPDATE ".$this->produtosTable ." SET `name`='$this->item_name', `id_categoria`='$this->item_idcategory', `price`='$this->item_price', `description`='$this->item_description', `images`='$this->item_image',
			`status`='$this->item_status' WHERE id = ".$id." ");
			$stmt->execute();
		}
		return $stmt;
	}
	
	public function allProdutos(){		
		$stmt = $this->con->prepare("SELECT id, name, id_categoria, price, description, images, status FROM ".$this->produtosTable. " order by id_categoria desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function allCategorias(){		
		$stmt = $this->con->prepare("SELECT id, nome,status FROM ".$this->categoriasTable. " order by id asc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function allPedidos(){		
		$stmt = $this->con->prepare("SELECT id, item_id, name, price, quantity, cliente_nome, status, order_date, observacao, order_id, num_mesa FROM ".$this->pedidosTable. " order by id desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function buscarProduto($id){		
		$stmt = $this->con->prepare("SELECT * FROM ".$this->produtosTable. " WHERE id = ".$id);				
		$stmt->execute();			
		$result = $stmt->get_result();	
		return $result->fetch_assoc();	
	}

	public function buscarCategoria($id){		
		$stmt = $this->con->prepare("SELECT * FROM ".$this->categoriasTable. " WHERE id = ".$id);				
		$stmt->execute();			
		$result = $stmt->get_result();	
		return $result->fetch_assoc();	
	}

	public function insertCategoria()
	{
		if ($this->item_catName) {
			$stmt = $this->con->prepare("
			INSERT INTO " . $this->categoriasTable . "(`nome`, `status`)
			VALUES(?,?)");
			$this->item_catName = htmlspecialchars(strip_tags($this->item_catName));
			$this->item_catStatus = htmlspecialchars(strip_tags($this->item_catStatus));
			$stmt->bind_param("si", $this->item_catName, $this->item_catStatus);
			if ($stmt->execute()) {
				return true;
			}
		}
	}

	public function deleteCategoria($id)
	{
		$stmt = $this->con->prepare("
			DELETE FROM " . $this->categoriasTable . " WHERE id = " . $id);
		if ($stmt->execute()) {
			return true;
		}
	}

	public function deleteProduto($id)
	{
		$stmt = $this->con->prepare("
			DELETE FROM " . $this->produtosTable . " WHERE id = " . $id);
		if ($stmt->execute()) {
			return true;
		}
	}
}
