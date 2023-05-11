<?php
include_once "ConectaMySQLDelta.php";
$pdo = conectSQL();
$transacaoOk = false;
$pdo->beginTransaction();
?>