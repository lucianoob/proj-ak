<?php
/**
 * Classe pde Funções Auxiliares
 */
Class Aux {
	/**
	 * Array com os nomes dos meses e suas variações.
	 */ 
	protected static $months = [
		["jan", "janeiro"],
		["fev", "fevereiro"],
		["mar", "março", "marco"],
		["abr", "abril"],
		["mai", "maio"],
		["jun", "junho"],
		["jul", "julho"],
		["ago", "agosto"],
		["set", "setembro"],
		["out", "outubro"],
		["nov", "novembro"],
		["dez", "dezembro"]
	];

	/**
	 * Array com as palavras incorretas e suas correções.
	 */ 
	protected static $words_fix = [
		"Papel Hignico" => "Papel higiênico",
		"Brocolis" => "Brócolis",
		"Chocolate ao leit" => "Chocolate ao leite",
		"Sabao em po" => "Sabão em pó",
		"Escova de dente" => "Escova de dentes",
		"Enxaguante bocal" => "Enxaguante bucal",
		"Geléria de morango" => "Geléia de morango",
	];

	/**
	 * Método para corrigir as palavras do array (case e Ajuste da palavra).
	 * @param  [array] Um array com os dados.
	 * @return [array] Retorna o array corrigido.
	 */
	static function fixWords(&$array)
	{
		foreach ($array as $month => $categories) {
			foreach($categories as $category => $spends) {
				foreach($spends as $spend => $value) {
					unset($spends[$spend]);
					if(array_key_exists($spend, self::$words_fix)) {
						$spend = self::$words_fix[$spend];				
					}
					$spends[ucfirst($spend)] = $value;
				}
				unset($categories[$category]);
				$category = ucwords(str_replace("_", " ", $category));
				$categories[$category] = $spends;
			}
			$array[$month] = $categories;
		}
	}

	/**
	 * Método para remover os conteúdos vazios do array.
	 * @param  [array] Um array com os dados.
	 * @return [array] Retorna o array corrigido.
	 */
	static function trimEmpty(&$array)
	{
		foreach ($array as $month => $categories) {
			foreach($categories as $category => $spends) {
				if(empty($spends)){
					unset($categories[$category]);
				}
			}
			if(empty($categories)){
				unset($array[$month]);
			}
		}
	}

	/**
	 * Método para ordenar o array conforme uma ordem pré-definida (mês, categoria, produto e valor).
	 * @param  [array] Um array com os dados.
	 * @return [array] Retorna o array corrigido.
	 */
	static function setOrder(&$array) 
	{
		foreach ($array as $month => $categories) {
			foreach($categories as $category => $spends) {
				arsort($spends);
				$categories[$category] = $spends;
			}
			arsort($categories);
			$array[$month] = $categories;
		}
	}
	
	/**
	 * Método para corrigir os meses do array.
	 * @param  [array] Um array com os dados.
	 * @return [array] Retorna o array corrigido.
	 */
	static function fixMonths(&$array) 
	{
		uksort($array, "self::monthOrder");

		foreach ($array as $month => $value) {
			unset($array[$month]);
			$array[self::monthName($month)] = $value;
		}
	}

	/**
	 * Método que compara meses devolvendo a ordem correta.
	 * @param  [string] Primeiro valor de comparação.
	 * @param  [string] Segundo valor de comparação.
	 * @return [string] Retorna a comparação.
	 */
	protected function monthOrder($a, $b) {
		$a = self::monthToNumber($a);
		$b = self::monthToNumber($b);
		return $a > $b;
	}

	/**
	 * Método que corrigi o nome de um mês.
	 * @param  [string] Mês a ser pesquisado.
	 * @return [string] Retorna o mês corrigido. 
	 */
	protected function monthName($string)
	{
		foreach(self::$months as $num => $month) {
			if(in_array(strtolower($string), $month)) {
				return ucfirst($month[1]);
				break;
			}
		}
		return -1;
	}

	/**
	 * Método para localizar o número de um mês em português.
	 * @param  [string] Mês a ser pesquisado.
	 * @return [int] Retorna o número do mês ou -1 para um mês não localizado.
	 */
	protected function monthToNumber($string)
	{
		foreach(self::$months as $num => $month) {
			if(in_array(strtolower($string), $month)) {
				return $num;
				break;
			}
		}
		return -1;
	}
}