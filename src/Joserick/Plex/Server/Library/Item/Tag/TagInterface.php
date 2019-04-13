<?php

namespace Joserick\Plex\Server\Library\Item\Tag;

/**
 * Plex Library Item Tag
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <joserick.92@gmail.com> Jose Erick Carreon
 * @copyright (c) 2019 Jose Erick Carreon
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
 * Interface that represents the tag info a Plex Server Library Item.
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <joserick.92@gmail.com> Jose Erick Carreon
 * @copyright (c) 2019 Jose Erick Carreon
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
interface Plex_Server_Library_Item_TagInterface
{
	/**
	 * Returns the ID of the tag info.
	 *
	 * @return integer The ID of the tag info.
	 */
	public function getId();
	
	/**
	 * Sets the ID of the tag info.
	 *
	 * @param integer $id The ID of the tag info.
	 *
	 * @return void
	 */
	public function setId($id);

	/**
	 * Returns the filter of the tag info.
	 *
	 * @return integer The filter of the tag info.
	 */
	public function getFilter();
	
	/**
	 * Sets the filter of the tag info.
	 *
	 * @param integer $filter The filter of the tag info.
	 *
	 * @return void
	 */
	public function setFilter($filter);

	/**
	 * Returns the data tag of the tag info.
	 *
	 * @return integer The tag of the tag info.
	 */
	public function getTag();
	
	/**
	 * Sets the tag data of the tag info.
	 *
	 * @param integer $tag The tag of the tag info.
	 *
	 * @return void
	 */
	public function setTag($tag);
}
