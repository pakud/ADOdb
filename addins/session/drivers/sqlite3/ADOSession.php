<?php
/**
* SQLite3 driver configuration for the Sessions package
*
* This file is part of the ADOdb package.
*
* @copyright 2021 Mark Newnham
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace ADOdb\addins\session\drivers\sqlite3;

use \ADOdb\addins\session;

class ADOSession extends \ADOdb\addins\session\ADOSession {
		
	/*
	* large object handling required
	*/
	protected string $largeObject = 'blob';
		
}