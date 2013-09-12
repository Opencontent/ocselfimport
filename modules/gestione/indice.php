<?php

$Module = $Params['Module'];
$ini = eZINI::instance( 'selfimport.ini' );
$tpl = eZTemplate::factory();

if ( isset( $Params['UserParameters'] ) )
{
    $UserParameters = $Params['UserParameters'];
}
else
{
    $UserParameters = array();
}

$handlers = $ini->variable( 'AvailableSourceHandlers', 'Handler' );
$tpl->setVariable( 'handlers', $handlers );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:gestione/indice.tpl' );
$Result['path'] = array( array( 'text' => 'Gestione' ,
                                'url' => 'gestione/i' ) );

?>
