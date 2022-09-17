<?php
/**
* Methods associated with caching recordsets using the apcu server
*
* This file is part of the ADOdb package.
*
* @copyright 2020 Mark Newnham
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace ADOdb\addins\cache\plugins\apcu;

final class ADOCacheMethods extends \ADOdb\addins\cache\ADOCacheMethods
{
		
	/*
	* Service flag. Do not modify value
	*/
	public string $service = 'apcu';
	
	public string $serviceName = 'APCu';
	
	/**
	* Constructor
	*
	* @param obj $connection   A Valid ADOdb Connection
	* @param obj $cacheDefinitions An ADOdbCacheDefinitions Class
	*
	* @return obj 
	*/	
	final public function __construct(object $connection, object $cacheDefinitions)
	{
		$this->setDefaultEnvironment($connection,$cacheDefinitions);
		
		/*
		* Startup the client connection
		*/
		$this->connect();
		
	}
	
	/**
	* Connect to one of the available 
	* 
	* @return bool
	*/
	final protected function connect() : bool 
	{
		/*
		*	do we have memcache or memcached?
		*/
		$apcu = function_exists('apcu_enabled') && apcu_enabled();
		
		$this->writeLoggingPair(
			$apcu,
			'Loaded the APCu Libary',
			'The APCu PHP extension was not found or is disabled'
			);
					
		/*
		* Global flag
		*/
		$this->_connected = true;
			
		/*
		* The memcache connection object
		*/
		$this->cacheLibrary = new \stdClass;
		
		return true;
	}
	
	/**
	* Flushes all entries from apcu cache
	*
	* @return void
	*/
	final public function flushall() : void
	{
				
		if (!$this->checkConnectionStatus())
			return;

		$success = apcu_clear_cache();
;
		$this->logFlushAllEvent($success);
		
	}
	
	/**
	* Flush an individual query from the apcu cache
	*
	* @param string $filename The md5 of the query
	* @param bool $debug ignored because because of global
	* @param object $additional options unused
	*
	* @return void
	*/
	final public function flushcache(
		string $filename,
		bool $debug=false,
		object $options=null ) : void {	
					
		if (!$this->checkConnectionStatus())
			return;

		$success = apcu_delete($filename);

		$this->logFlushCacheEvent($filename,$success);
		
	}
	
	/**
	* Tries to return a recordset from the cache
	*
	* @param string $filename the md5 code of the request
	* @param string $err      The error string by reference
	* @param int $secs2cache
	* @param string $arrayClass
	* @param object $options
	*
	* @return recordset
	*/
	final public function readcache(
				string $filename,
				string &$err,
				int $secs2cache,
				string $arrayClass,
				?object $options=null) :?object{
				
		if (!$this->checkConnectionStatus())
			return null;

/*
		* Standardize the parameters
		*/
		$options = $this->unpackCacheObject($options,$secs2cache);
		
		$rs = apcu_fetch($filename,$success);
		
		list ($rs, $err) = $this->unpackCachedRecordset($filename, $rs,$options->ttl);
		
		return $rs;
	}		
	
	/**
	* Builds a cached data set
	*
	* @param string $filename
	* @param string $contents
	* @param bool   $debug     Ignored
	* @param int    $secs2cache
	* @param obj    $options
	*
	* @return bool
	*/
	final public function writecache(
			string $filename, 
			string $contents, 
			bool $debug = false,
			int $secs2cache,
			?object $options=null) : bool {
		
		if (!$this->checkConnectionStatus())
			return false;

		/*
		* Standardize the parameters
		*/
		$options = $this->unpackCacheObject($options,$secs2cache);
		
		/*
		* Windows connection module, allows compression
		*/
		$success = apcu_add ( $filename , $contents ,$options->ttl );
		
		return $this->logWriteCacheEvent($filename,$options->ttl,$success);

	}
	
	/**
	* Returns an array of info about the cache
	*
	* @return array
	*/
	final public function cacheInfo() : array
	{
		if (!$this->checkConnectionStatus())
			return array();

		return apcu_cache_info();
	}	
}
