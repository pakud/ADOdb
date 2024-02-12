<?php
/**
* Definitions Passed to the ADOCaching Module for the YAC module
*
* This file is part of the ADOdb package.
*
* @copyright 2021 Mark Newnham
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace ADOdb\CachingPlugin\yac;

/**
* Defines the attributes passed to the wincache interface
*/
final class ADOCacheDefinitions extends \ADOdb\CachingPlugin\ADOCacheDefinitions
{
	/*
	* Service flag. Do not modify value
	*/
	public string $serviceName = 'yac';
	
	/*
	* Service Name.
	*/
	public string $serviceDescription = 'YAC';
	
	
}