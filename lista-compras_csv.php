<?php

include_once 'model/ListaCompras.php';

$lista_compras = new ListaCompras('lista-de-compras.php');

$lista_compras->toCSV();