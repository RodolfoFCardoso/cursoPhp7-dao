<?php 

class Usuario {

	private $idusuario, $deslogin, $dessenha, $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($value){
		$this->idusuario = $value;
	}

		public function getDesLogin(){
			return $this->deslogin;
		}

		public function setDesLogin($value){
			$this->deslogin = $value;
		}
			public function getDesSenha(){
				return $this->dessenha;
			}

			public function setDesSenha($value){
				$this->dessenha = $value;
			}

				public function getDtCadastro(){
					return $this->dtcadastro;
				}

				public function setDtCadastro($value){
					$this->dtcadastro=$value;
				}
				// Carrega um usuário pelo ID do Banco de dados.
				public function loadById($id){

					$sql = new Sql();

					$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
						":ID"=>$id));

					if (isset ($result[0])) {

						$row = $result[0];

						$this->setIdUsuario($row['idusuario']);
						$this->setDesLogin($row['deslogin']);
						$this->setDesSenha($row['dessenha']);
						$this->setDtCadastro(new DateTime($row['dtcadastro']));
					}
				}

				//Carrega um usuário pela busca
				public static function search($login){

					$sql = new Sql();

					return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
						':SEARCH'=>"%".$login."%"
					));
				}

				// Carrega uma lista de usuários do Banco de Dados.
				public static function getList(){
					$sql = new Sql();

				return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
				}

				public function __toString(){

				return json_encode(array(
					"idusuario"=>$this->getIdUsuario(),
					"deslogin"=>$this->getDesLogin(),
					"dessenha"=>$this->getDesSenha(),
					"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")

				));
				}

				public function login($login, $password){

					$sql = new Sql();

					$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
						":LOGIN"=>$login,
						":PASSWORD"=>$password));

					if (isset ($result[0])) {

						$row = $result[0];

						$this->setIdUsuario($row['idusuario']);
						$this->setDesLogin($row['deslogin']);
						$this->setDesSenha($row['dessenha']);
						$this->setDtCadastro(new DateTime($row['dtcadastro']));
					}else {
						throw new Exception("Login e/ou senha inválidos.");
						
					}

				}
}


 ?>