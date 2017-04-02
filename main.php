<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'NewArray.php';

$newArray = new NewArray();

session_start();
session_unset();
$_SESSION['array'] = $newArray->generate();
//$_SESSION['array'] = $newArray->getConst();
$_SESSION['rows'] = $newArray->rowCount;
$_SESSION['columns'] = $newArray->columnCount;
$_SESSION['maxItemInfo'] = $newArray->findMaxSimpleDivisorItem();
include 'index.php';
