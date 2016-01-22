
<?php
$Module = $Params['Module'];
$http = eZHTTPTool::instance();
SQLIImportToken::cleanAll();
$redirectURI = $http->getVariable( 'RedirectURI', $http->sessionVariable( 'LastAccessesURI', '/' ) );
$Module->redirectTo( 'gestione/importer/runcronjob' );

?>