<?php

$Module = array( 'name' => 'Gestione Importatori',
                 'variable_params' => true );

$ViewList = array();


$ViewList['indice'] = array(
    'functions' => array( 'indice' ),
    'script' => 'indice.php'
    );


$ViewList['importer'] = array(
    'functions' => array( 'importer' ),
    'script' => 'importer.php'
    );


	$ViewList['runimporter'] = array(
    'functions' => array( 'runimporter' ),
    'script' => 'runimporter.php'
    );


$ViewList['logs'] = array(
    'script' => 'logs.php',
    'functions' => array( 'log' ),    
);

$stateLimitations = eZContentObjectStateGroup::limitations();
$FunctionList = array();
$FunctionList['indice'] = array();
$FunctionList['importer'] = array();
$FunctionList['runimporter'] = array();
$FunctionList['log'] = array();

?>
