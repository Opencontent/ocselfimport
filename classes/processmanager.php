<?php

class ProcessManager
{
	
	/**
	 * Private Constructor 
	 * @param string $scriptRoot
	 * @param string $executable
	 * @param integer $sleep
	 * @param integer $maxExecutionTime
	 * @return ProcessManager or false
	 */
	private function __construct( $scriptRoot, $executable, $sleep, $maxExecutionTime, $outputFile, $errorFile )
    {
		$this->root = $scriptRoot;
		$this->executable = $executable;
		$this->sleepTime = $sleep;
		$this->maxExecutionTime = $maxExecutionTime;
		$this->outputFile = $outputFile;
		$this->errorFile = $errorFile;
	}
	
	/**
	 * Instantiate a new Process Manager 
	 * Use configuration file to modify settings
	 * @return ProcessManager ProcessManager
	 */
	public static function instance()
    {
		$ini = eZINI::instance( 'process.ini' );
		
		$scriptRoot = eZSYS::rootDir() . eZSys::fileSeparator(); // $_SERVER['DOCUMENT_ROOT'];
		$executable = $ini->variable( 'ProcessSettings','PhpCliPath' );
		$sleep = $ini->variable( 'ProcessSettings','SleepTime' );
		$maxExecutionTime = $ini->variable( 'ProcessSettings','MaxExecutionTime' );
		$outputFile = $ini->variable( 'ProcessSettings','OutputFile' );
		$errorFile = $ini->variable( 'ProcessSettings','ErrorFile' );
		
		$pm = new ProcessManager( $scriptRoot, $executable, $sleep, $maxExecutionTime, $outputFile, $errorFile );
		return $pm;
	}
	 
	/**
	 * Add a script
	 * @param string $script Path of the script
	 * @param int $maxExecutionTime Max execution time of the process
	 */
	public function addScript( $scriptBase = 'runcronjobs.php', $scriptPart, $maxExecutionTime = null )
    {
		$ini = eZINI::instance( 'process.ini' );
        $forbidden = $ini->variable( 'Forbidden', 'Parts' );
        if ( in_array( $scriptPart, $forbidden ) )
        {
            throw new Exception( "Script forbidden" );
        }
        if( !$maxExecutionTime )
        {
			$maxExecutionTime = $this->maxExecutionTime;
		}
		$this->scripts[] = array( "script_name" => $scriptBase . ' ' . $scriptPart,
                                  "max_execution_time" => $maxExecutionTime );
	}
	 
	/**
	 * Execute all added scripts
	 */
	public function execAll()
    {
		foreach( $this->scripts as $script )
        {
			$this->running[] = new Process( $this->executable, $this->root, $script["script_name"], $script["max_execution_time"], $this->outputFile, $this->errorFile );
			$this->processesRunning++;
			sleep( $this->sleepTime );
		}
	}
	
	/**
	 * Get running scripts
	 * @return array Running process
	 */
	public function getRunning()
    {
		return $this->running;
	}
	
	/**
	 * Get output file
	 * @return string Output file
	 */
	public function getOutputFile()
    {
		return $this->outputFile;
	}
	
	/**
	 * Get error file
	 * @return string Error file
	 */
	public function getErrorFile()
    {
		return $this->errorFile;
	}
	
	/**
	 * Set the ouput file
	 * @param string $file Output file
	 */
	public function setOutputFile( $file )
    {
		$this->outputFile = $file;
	}
	
	/**
	 * Set the error file
	 * @param string $file Error file
	 */
	public function setErrorFile( $file )
    {
		$this->errorFile = $file;
	}
	
	/**
	 * Clear the output file
	 */
	public function cleanOutputFile()
    {
		file_put_contents( $this->outputFile, '' );
	}
	
	/**
	* Clear the error file
	*/
	public function cleanErrorFile()
    {
		file_put_contents( $this->errorFile, '' );
	}
	
	
	private $executable;
	private $root;
	private $scripts = array();
	private $processesRunning = 0;
	private $processes;
	private $running = array();
	private $sleepTime;
	private $maxExecutionTime;
	private $outputFile;
	private $errorFile;
}
?>