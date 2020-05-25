# TestAkna - Luciano Borges

Este projeto é referente a um teste usando PHP.

## Pré-Requisitos

Para rodar este projeto deve-se utilizar os seguintes requisitos:
- [Apache2](https://httpd.apache.org/)
- [PHP](https://php.net/)
- [MySQL](https://www.mysql.com/)

## Componentes

Os componentes utilizados neste projeto são:
- php 7.2
- mysql 5.7

## Instalação

Para instalar basta rodar o script install.sh, lembrando que é necessário ter todos os pré-requisitos instalados e configurados.

Este script basicamente irá criar o banco de dados (remove se existe) e inserir a tabela que será utilizada no projeto.

## Execução

- Para executar o primeiro passo proposto no teste basta executar o arquivo 'lista-compras_csv.php', este irá gerar o arquivo 'compra-do-ano.csv'.
- Para executar o segundo passo proposto no teste basta executar o arquivo 'lista-compras_mysql.php', este irá gravar os dados na tabela 'test_akna' (configurada no install.sh).

## Considerações Finais

Seguem abaixo algumas considerações sobre desenvolvimento do projeto:
- O teste poderia facilmente ter sido implementado em Laravel mas por se tratar de algo simples optei por utilizar PHP purto, [veja alguns exemplos meus de Laravel](https://github.com/lucianoob?tab=repositories).
- Foi seguida todas as recomendações de ajustes dos dados (ordem, correção da sintaxe, etc).
- Foram seguidos padrões de projeto e de escrita de código para este ficasse o mais compacto e reutilizável possível.

## Escopo do Teste

A grande escola de ensino fundamental Hogwarts faz o controle das
suas compras de alimentos manualmente. A lista de compras
atualmente Ã© escrita pelo cozinheiro Dobby (manualmente) em um
caderno. ApÃ³s as compras, Dobby reune todo o conteÃºdo do mÃªs (os
papeis) e os envia para a direÃ§Ã£o da escola analisar os gastos mensais
e anuais.

Com o passar do tempo esse mÃ©todo ficou cansativo e caro, tendo em
vista que Ã© muito difÃ­cil vocÃª controlar uma quantidade tÃ£o grande de
informaÃ§Ãµes em um caderno e ainda por cima lembrar de realizar o
envio manualmente para os diretores da escola.

Decidindo mudar esse fluxo e o trabalho manual desnecessÃ¡rio, a
diretora da escola fez a contrataÃ§Ã£o de um programador PHP para
a automatizaÃ§Ã£o desse processo, mas em pequenos passos para
testar a qualidade da mudanÃ§a.

### Passo 1 - Gerar Arquivo CSV
O programador terÃ¡ um arquivo com as listas de alimentos
criadas (**lista-de-compras.php**) com todos os dados
preenchidos que retorna uma estrutura de Array.

Baseado nessa lista, ele criarÃ¡ outro script .php que faz a leitura do
arquivo **lista-de-compras.php**, onde o resultado final serÃ¡ a
geraÃ§Ã£o de um arquivo .csv salvo na pasta com o nome **compras-do-ano.csv**.

O resultado final desse arquivo deve seguir a mesma estrututa do
exemplo abaixo, levando em consideraÃ§Ã£o os dados
contidos na nossa lista de alimentos (**lista-de-compras.php**):

|MÃªs|Categoria|Produto|Quantidade|
|-|-|-|-|
|Janeiro|Alimentos|PÃ£o de forma|10|
|Janeiro|Higiene Pessoal|Creme dental|50|
|Janeiro|Higiene Pessoal|Escova de dente |40|
|Janeiro|Limpeza|Desinfetante|5|
|Fevereiro|Higiene Pessoal|Creme dental|50|
|Fevereiro|Higiene Pessoal|Sabonete lÃ­quido|45|
|MarÃ§o|Alimentos|Ovos|300|

Para a geraÃ§Ã£o desse csv o programador tem que seguir algumas
**regras**, que sÃ£o:

* **O arquivo criado tem que ser ordenador de acordo com a ordem
natural dos meses**:
    * Janeiro
    * Fevereiro
    * MarÃ§o
    * (etc)

* **Respeitando a ordenaÃ§Ã£o dos meses, o programador tem que
salvar os produtos no arquivo ordenados pelas categorias**:
    1. Alimentos
    2. Higiene Pessoal
    3. Limpeza

* **Respeitando as duas ordenaÃ§Ãµes anteriores, o programador tem
que salvar os produtos no arquivo ordenados da maior quantidade para a menor.**

* **O(s) mes(es) com conteÃºdo vazio nÃ£o devem estar presentes no
csv.**

Exemplo de ordenaÃ§Ã£o:

|MÃªs|Categoria|Produto|Quantidade|
|-|-|-|-|
|Janeiro|Alimentos|PÃ£o de forma|10|
|Janeiro|Alimentos|Biscoito |5|
|Janeiro|Higiene|Pessoal Creme dental|50|
|Janeiro|Higiene|Pessoal Escova de dente|40|
|Janeiro|Limpeza|Desinfetante|5|
|Janeiro|Limpeza|Detergente|4|
|Janeiro|Limpeza|SabÃ£o em pÃ³|3|

* **Algumas palavras no Array estÃ£o incorretas, antes de salvar no
arquivo Ã© necessÃ¡rio substitui-las**:

|Trocar de (palavra errada)|Por (palavra correta)|
|-|-|
|Papel Hignico|Papel HigiÃªnico|
|Brocolis|BrÃ³colis|
|Chocolate ao leit|Chocolate ao leite|
|Sabao em po|SabÃ£o em pÃ³|

### Passo 2 - Salvar os dados no BD
Feito o primeiro teste, crie um outro script que consultarÃ¡ os
dados do arquivo lista-de-compras.php e salvarÃ¡ esses
mesmos dados no MySQL.

Crie uma estrutura relacional (nome do banco de dados, nome da(s)
tabela(s), etc) da melhor forma que lhe convÃ©m.

Antes de salvar os dados no MySQL Ã© necessÃ¡rio usar a mesma regra
de substituiÃ§Ã£o de palavras do primeiro teste.
