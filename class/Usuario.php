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

						$this->setData($result[0]);
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

						$this->setData($result[0]);

					}else {
						throw new Exception("Login e/ou senha inválidos.");
						
					}

				}

				public function setData($data){

						$this->setIdUsuario($data['idusuario']);
						$this->setDesLogin($data['deslogin']);
						$this->setDesSenha($data['dessenha']);
						$this->setDtCadastro(new DateTime($data['dtcadastro']));

				}

				public function insert(){

					$sql = new Sql();

				$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array (
 					'LOGIN'=>$this->getDesLogin(),
 					'PASSWORD'=>$this->getDesSenha()
				));

				if (count($result) > 0) {
					$this->setData($result[0]);
				}


				}

				public function update($login, $password){

					$this->setDesLogin($login);
					$this->setDesSenha($password);

					$sql = new Sql();

					$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD, WHERE idusuario = :ID", array(
						':LOGIN'=>$this->getDesLogin(),
						':PASSWORD'=>$this->getDesSenha(),
						':ID'=>$this->getIdUsuario()
				));
				}
}


 ?>