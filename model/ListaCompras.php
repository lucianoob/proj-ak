<?php

include_once 'Aux.php';
include_once 'DB.php';

/**
 * Classe de Lista de Compras
 */
Class ListaCompras {

  /**
   * Variável que contém toda o array de dados.
   */
 	protected $list;
  /**
   * Nome do arquivo que será salvo em CSV.
   */
 	protected $csv_file = 'compras-do-ano.csv';
  /**
   * Cabeçalho do arquivo CSV.
   */
 	protected $csv_header = array("Mês","Categoria","Produto","Quantidade");
  /**
   * Separador do arquivo CSV (padrão: ;).
   */
 	protected $csv_glue = ";";
  /**
   * Caractere de fim de linha do arquivo CSV (padrão: \r\n).
   */
 	protected $csv_endline = "\r\n";
  /**
   * Flag se o arquivo será acrescentado ou sobreescrito (padrão: sobreescrito).
   */
 	protected $csv_append = false;

  /**
   * Construtor da classe.
   * @param string Nome do arquivo com os dados.
   */
 	function __construct($file = '') 
 	{
    	if(file_exists($file)) {
    		$this->list = include_once($file);
    		$this->fix();
    	} else {
    		echo "ERRO: o arquivo '$file' não existe!!!";
    	}
   	}

    /**
     * Método para ajustar os dados importados do arquivo de dados.
     */
   	public function fix() 
   	{
   		Aux::fixWords($this->list);
   		Aux::trimEmpty($this->list);
   		Aux::fixMonths($this->list);
   		Aux::setOrder($this->list);
   	}

    /**
     * Método para exibir os dados.
     */
   	public function view() 
   	{
   		print_r($this->list);
   	}

    /**
     * Método para debugar os dados.
     */
   	public function debug() 
   	{
   		var_dump($this->list);
   	}

    /**
     * Método para mudar a configuração da exportação do dados em CSV.
     * @param [string] Nome do arquivo.
     * @param [string] Cabeçalho do arquivo.
     * @param [string] Separador do arquivo.
     * @param [string] Caractere de fim de linha.
     * @param [boolean] Flag se o arquivo será adicionado ou sobreescrito.
     */
   	public function setCSV($file, $header, $glue, $endline, $append)
   	{
   		$this->csv_file = $file;
   		$this->csv_header = $header;
   		$this->csv_glue = $glue;
   		$this->csv_endline = $endline;
   		$this->csv_append = $append;
   	}

    /**
     * Método para comprimir todos os dados em uma array.
     * @return [array] Retorna os dados em uma array linear.
     */
    public function toArray()
    {
      $array = array();
      foreach ($this->list as $month => $categories) {
        foreach($categories as $category => $spends) {
          foreach($spends as $spend => $value) {
            $array[] = array($month, $category, $spend, $value);
          }
        }
      }
      return $array;
    }

    /**
     * Método para exportar os dados em CSV.
     */
   	public function toCSV()
   	{
   		$csv_conteudo = implode($this->csv_glue, $this->csv_header).$this->csv_endline;
   		if($this->csv_append && file_exists($this->csv_file)) {
   			$csv_conteudo = "";
   		}

			foreach($this->toArray() as $row_array) {
				$csv_conteudo .=  implode($this->csv_glue, $row_array).$this->csv_endline;
			}

  		if($this->csv_append) {
  			file_put_contents($this->csv_file, $csv_conteudo, FILE_APPEND);
  		} else {
  			file_put_contents($this->csv_file, $csv_conteudo);
  		}
   	}

    /**
     * Método parra salvar os dados em um banco de dados MySQL.
     */
    public function toMySQL()
    {
      $sql = new DB();
      foreach($this->toArray() as $row_array) {
        $sql->insert($row_array);
      }
    }
}