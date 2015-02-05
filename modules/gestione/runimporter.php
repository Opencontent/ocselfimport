<?php
$Module = $Params['Module'];

$handler = $Params['Parameters'];

if ( eZINI::instance( 'selfimport.ini' )->hasVariable( 'Settings', 'Siteaccess' ) )
{
    $siteaccess = eZINI::instance( 'selfimport.ini' )->variable( 'Settings', 'Siteaccess' );
}
else
{
    $current = eZSiteAccess::current();
    $siteaccess = $current['name'];
}
$runcronjob = 'enabled'; //eZINI::instance( 'selfimport.ini' )->variable( 'Settings', 'Runcronjob' );
$availableSourceHandlers = (array) eZINI::instance( 'selfimport.ini' )->variable( 'AvailableSourceHandlers', 'Handler' );

$manager = ProcessManager::instance();
$manager->cleanOutputFile();
$manager->cleanErrorFile();

//if( $handler == 'runcronjob' && $runcronjob == 'enabled' )
//{        
//    //$manager->addScript( "runcronjobs.php", "-s" . $siteaccess . " sqliimport_run" );
//    
//}
//elseif ( array_key_exists( $handler, $availableSourceHandlers ) )
//{
//    $part = '--debug --source-handlers="' . $handler .'" -s' . $siteaccess;
//    $manager->addScript( "extension/sqliimport/bin/php/sqlidoimport.php", $part );
//    $manager->addScript( "runcronjobs.php", "-s" . $siteaccess . " sqliimport_cleanup" );
//}

$manager->addScript( "runcronjobs.php", "-s" . $siteaccess . " sqliimport_run" );

$manager->execAll();

eZExecution::cleanExit();

?>
