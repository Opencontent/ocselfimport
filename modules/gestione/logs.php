<?php
$Module = $Params['Module'];

$tpl = eZTemplate::factory();
$manager = ProcessManager::instance();

$tpl->setVariable( 'output', file_get_contents($manager->getOutputFile()) );
$tpl->setVariable( 'errors', file_get_contents($manager->getErrorFile()) );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:gestione/logs.tpl' );
$Result['left_menu'] = 'design:selfimport/parts/leftmenu.tpl';
$Result['path'] = array( array( 'text' => 'Gestione' ,
                                'url' => 'gestione/indice' ),
                         array( 'url' => false,
                                'text' => 'Log aggiornamento' ) );



?>
