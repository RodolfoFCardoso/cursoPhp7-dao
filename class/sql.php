<?php 


class Sql extends PDO {

	private $conn;

	//Criarndo metodo para realizar a conexão com o bando de dados.
	public function __construct(){
		$this->conn = new PDO("mysql:host=localhost; dbname=dbphp7","root","");

	}
	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($key, $value);
		}

	}

	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);

	}
	//Executar um comando no banco.
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;

	}
		//faz um retorno do que o query fez.
		public function select($rawQuery, $params = array()):array{

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
}

 ?>