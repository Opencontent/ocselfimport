
<?php
$Module = $Params['Module'];
$tpl = eZTemplate::factory();

$handler = $Params['Parameters'];
$tpl->setVariable( 'handler', $handler[0] );

$tpl = eZTemplate::factory();
$Result = array();
$Result['content'] = $tpl->fetch( 'design:gestione/importer.tpl' );
$Result['path'] = array( array( 'text' => 'Gestione' ,
                                'url' => 'gestione/indice' ),
                         array( 'url' => false,
                                'text' => 'Avvia importer' ) );

?>