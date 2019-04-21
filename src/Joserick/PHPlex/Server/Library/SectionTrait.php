<?php 

namespace Joserick\PHPlex\Server\Library\Section;

/**
 * Plex Server Library Section Trait
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <joserick.92@gmail.com> José Erick Carreón
 * @copyright (c) 2019 José Erick Carreón
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 *
 * This file is part of php-plex.
 * 
 * php-plex is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-plex is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Trait groups diferents functionalities for Plex library section.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <joserick.92@gmail.com> José Erick Carreón
 * @copyright (c) 2019 José Erick Carreón
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
Trait Plex_Server_Library_SectionTrait
{
	/**
	 * Simplify the name of the functions for your call.
	 * 
	 * @param  string $name Name of the function not found.
	 * @param  array $arguments Function argument list not found.
	 * @return mixed
	 */
	private function __call($name, $arguments)
	{
		if (isset($this->type)) {
			$type = ucfirst($this->type);
			if (method_exists($this, $name.$type.'s')){
				return call_user_func_array([$this, $name.$type.'s'], $arguments);
			}
			if (strlen($name)>3) {
				$method = substr_replace($name, $type, 3, 0).'s';
				if (method_exists($this, $method)){
					return call_user_func_array([$this, $method], $arguments);
				}
			}
			if ($name == 'get') {
				if (method_exists($this, $name.$type)){
					return call_user_func_array([$this, $name.$type], $arguments);
				}
			}
		}
		trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
	}
}
