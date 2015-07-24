<?php

$Module = array( 'name' => 'Gestione Importatori',
                 'variable_params' => true );

$ViewList = array();


$ViewList['indice'] = array(
    'functions' => array( 'indice' ),
    'script' => 'indice.php',
    'default_navigation_part' => 'ociniguinavigationpart'
    );


$ViewList['importer'] = array(
    'functions' => array( 'importer' ),
    'script' => 'importer.php',
    'default_navigation_part' => 'ociniguinavigationpart'
    );

$ViewList['cleantoken'] = array(
    'functions' => array( 'importer' ),
    'script' => 'cleantoken.php',
    'default_navigation_part' => 'ociniguinavigationpart'
    );    


$ViewList['runimporter'] = array(
    'functions' => array( 'runimporter' ),
    'script' => 'runimporter.php',
    'default_navigation_part' => 'ociniguinavigationpart'
    );


$ViewList['logs'] = array(
    'script' => 'logs.php',
    'functions' => array( 'log' ),
    'default_navigation_part' => 'ociniguinavigationpart'
);

$stateLimitations = eZContentObjectStateGroup::limitations();
$FunctionList = array();
$FunctionList['indice'] = array();
$FunctionList['importer'] = array();
$FunctionList['runimporter'] = array();
$FunctionList['log'] = array();

?>
