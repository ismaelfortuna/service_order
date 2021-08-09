<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Editar Ordem');

use \App\Entity\Ordem;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA ORDEM
$obOrdem = Ordem::getOrdem($_GET['id']);

//VALIDAÇÃO DA ORDEM
if(!$obOrdem instanceof Ordem){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

    $obOrdem->titulo    = $_POST['titulo'];
    $obOrdem->descricao = $_POST['descricao'];
    $obOrdem->ativo     = $_POST['ativo'];
    $obOrdem->atualizar();

    header('location: index.php?status=success');
    exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';