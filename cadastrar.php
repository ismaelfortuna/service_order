<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar Nova Ordem');

use \App\Entity\Ordem;

$obOrdem= new Ordem;

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obOrdem->titulo    = $_POST['titulo'];
    $obOrdem->descricao = $_POST['descricao'];
    $obOrdem->ativo     = $_POST['ativo'];
    $obOrdem->cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';