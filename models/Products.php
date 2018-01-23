<?php
class  Products extends Model {

	public function getProducts($search = null) {
		$array = array();

		if (!empty($search)) {
			$sql = "SELECT * FROM products WHERE cod = :cod OR name LIKE :name";	
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":cod", $search);
			$sql->bindValue(":name", '%'.$search.'%');
			$sql->execute(); 
		} else {
			$sql = "SELECT * FROM products";
			$sql = $this->db->query($sql);
		}

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function addProduct($cod, $name, $price, $quantity, $min_quantity) {
		$sql = "INSERT INTO products SET cod = :cod, name = :name, price = :price, quantity = :quantity, min_quantity = :min_quantity";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":cod", $cod);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":quantity", $quantity);
		$sql->bindValue(":min_quantity", $min_quantity);
		$sql->execute();
	}

	public function editProduct($cod, $name, $price, $quantity, $min_quantity, $id) {
		$sql = "UPDATE products SET cod = :cod, name = :name, price = :price, quantity = :quantity, min_quantity = :min_quantity WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":cod", $cod);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":price", $price);
		$sql->bindValue(":quantity", $quantity);
		$sql->bindValue(":min_quantity", $min_quantity);
		$sql->bindValue(":id", $id); 
		$sql->execute();
	}

	public function getProduct($id) {
		$array = array();

		$sql = "SELECT * FROM products WHERE id = :id ";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(); 
		}

		return $array;
	}

	public function getLowQuantityProdutcs() {
		$array = array();

		$sql = "SELECT * FROM products WHERE quantity < min_quantity";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
} 