<?php 

/**
 * Classe de Controle de Banco de Dados.
 */
Class DB {

	/**
	 * Endereço do servidor MySQL.
	 */
	protected $host = 'localhost';
	/**
	 * Nome do banco de dados.
	 */
	protected $db = 'test_akna';
	/**
	 * Nome do usuário do banco de dados.
	 */
	protected $user = 'test_akna';
	/**
	 * Senha do usuário do banco de dados.
	 */
	protected $pass = 'test_akna';
	/**
	 * Nome da tabela de dados.
	 */
	protected $table = 'lista_compras';
	
	/**
	 * Método que faz a conexão com o banco de dados.
	 * @return [object] Retorna a conexão realizada.
	 */
	protected function conn() 
	{
		try {
		    return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		    return null;
		}
	}

	/**
	 * Método que faz um select dos dados.
	 * @return [$array] Retorna um array com os dados do select.
	 */
	public function select() 
	{
		$query = $this->conn()->query("SELECT * FROM $this->table");
		return $query->fetchAll();
	}

	/**
	 * Método faz um insert dos dados.
	 * @param  [array] Dados a serem inseridos.
	 */
	public function insert($array) 
	{
		$statement = $this->conn()->prepare("INSERT INTO $this->table (mes, categoria, produto, quantidade) VALUES (?, ?, ?, ?)");
		$statement->execute($array);
	}
}