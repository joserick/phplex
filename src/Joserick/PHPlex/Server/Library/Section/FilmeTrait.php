<?php

namespace Joserick\Plex\Server\Library\Section;

/**
 * Plex Server Library Filme Trait
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
 * Trait groups diferents functionalities for Plex library movie section and 
 * Plex library show section.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <joserick.92@gmail.com> José Erick Carreón
 * @copyright (c) 2019 José Erick Carreón
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
Trait Plex_Server_Library_Section_FilmeTrait
{
	/**
	 * Returns a list of content ratings for the section. We use makeCall
	 * directly here because we want to return just the raw array of content
	 * ratings and not do any post processing on it.
	 *
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Server_Library::buildUrl()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_FilmeTrait::ENDPOINT_CATEGORY_CONTENT_RATING
	 *
	 * @return array An array of content ratings with their names and keys.
	 */
	public function getContentRatings()
	{
		return $this->makeCall(
			$this->buildUrl(
				$this->buildEndpoint(self::ENDPOINT_CATEGORY_CONTENT_RATING)
			)
		);
	}
	
	private function __call($name, $arguments)
    {
    	$type = ucfirst($this->type).'s';
        if (method_exists($this, $name.$type)){
        	return call_user_func_array([$this, $name.$type], $arguments);
        }
        if (strlen($name)>3) {
        	$method = substr_replace($name, $type, 3, 0);
	        if (method_exists($this, $method)){
        		return call_user_func_array([$this, $method], $arguments);
	        }
        }
       trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
    }
}