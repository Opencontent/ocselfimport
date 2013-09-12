<?php
$Module = $Params['Module'];

$handler = $Params['Parameters'];
$handler = $handler[0];

$siteaccess = eZINI::instance( 'selfimport.ini' )->variable( 'Settings', 'Siteaccess' );

$manager = ProcessManager::instance();
$manager->cleanOutputFile();
$manager->cleanErrorFile();
$part = '--source-handlers="' . $handler .'" -s' . $siteaccess;
$manager->addScript( "extension/sqliimport/bin/php/sqlidoimport.php", $part );
$manager->addScript( "runcronjobs.php", "-sbackend sqliimport_cleanup" );
$manager->execAll();

eZExecution::cleanExit();

?>
