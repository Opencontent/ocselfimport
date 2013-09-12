<?php
$Module = $Params['Module'];

$handler = $Params['Parameters'];
$handler = $handler[0];

$siteaccess = eZINI::instance( 'selfimport.ini' )->variable( 'Settings', 'Siteaccess' );
$runcronjob = eZINI::instance( 'selfimport.ini' )->variable( 'Settings', 'Runcronjob' );

$manager = ProcessManager::instance();
$manager->cleanOutputFile();
$manager->cleanErrorFile();

if( $handler == 'runcronjob' && $runcronjob == 'enabled' )
{
    $manager->addScript( "runcronjobs.php", "-s" . $siteaccess . " sqliimport_run" );
}
else
{
    $part = '--source-handlers="' . $handler .'" -s' . $siteaccess;
    $manager->addScript( "extension/sqliimport/bin/php/sqlidoimport.php", $part );	
}

$manager->addScript( "runcronjobs.php", "-s" . $siteaccess . " sqliimport_cleanup" );
$manager->execAll();

eZExecution::cleanExit();

?>
