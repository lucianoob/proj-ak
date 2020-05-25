
CREATE TABLE `lista_compras` (
  `id` int(11) NOT NULL,
  `mes` varchar(120) NOT NULL,
  `categoria` varchar(120) NOT NULL,
  `produto` varchar(120) NOT NULL,
  `quantidade` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lista_compras`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lista_compras`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;