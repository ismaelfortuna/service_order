<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Ordem;
use \App\Db\Pagination;

//BUSCA
$busca = filter_input(INPUT_GET,"busca", FILTER_SANITIZE_STRING);

//FILTRO DE STATUS
$filtroStatus = filter_input(INPUT_GET,"filtroStatus", FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

//CONDIÇÕES SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%',$busca).'%"' : null,
    strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
];

//REMOVE POSIÇÕES VAZIAS
$condicoes = array_filter($condicoes);

//CLÁUSULA WHERE
$where = implode(' AND ',$condicoes);

//QUANTIDADE TOTAL DE ORDENS
$quantidadeOrdens = Ordem::getQuantidadeOrdens($where);

//PAGINAÇÃO
$obPagination = new Pagination($quantidadeOrdens, $_GET['pagina'] ?? 1, 5);

//OBTÉM AS ORDENS
$ordens = Ordem::getOrdens($where,null,$obPagination->getLimit());

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';