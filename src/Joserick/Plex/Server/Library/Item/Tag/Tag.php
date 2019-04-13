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
 * Class that represents the tag info a Plex Server Library Item.
 * 
 * @category php-plex
 * @package Plex_Server_Library
 * @subpackage Plex_Server_Library_Item
 * @author <joserick.92@gmail.com> Jose Erick Carreon
 * @copyright (c) 2019 Jose Erick Carreon
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Item_Tag
	implements Plex_Server_Library_Item_TagInterface
{
	/**
	 * ID of the tag info.
	 * @var integer
	 */
	private $id;
	
	/**
	 * Filter of the tag info.
	 * @var string
	 */
	private $filter;
	
	/**
	 * Tag data of the tag info.
	 * @var string
	 */
	private $tag;
		
	/**
	 * Sets an array of tag info to their corresponding class members.
	 * 
	 * @param array $rawTag An array of the raw tag info returned from the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_Item_Tag::setId()
	 * @uses Plex_Server_Library_Item_Tag::setFilter()
	 * @uses Plex_Server_Library_Item_Tag::setTag()
	 *
	 * @return void
	 */
	public function __construct($rawTag)
	{
		if (isset($rawTag['id'])) {
			$this->setId($rawTag['id']);
		}
		if (isset($rawTag['filter'])) {
			$this->setFilter($rawTag['filter']);
		}
		if (isset($rawTag['tag'])) {
			$this->setTag($rawTag['tag']);
		}
	}
	
	/**
	 * Returns the ID of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$id
	 *
	 * @return integer The ID of the tag info.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Sets the ID of the tag info.
	 *
	 * @param integer $id The ID of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$id
	 *
	 * @return void
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * Returns the filter of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$filter
	 *
	 * @return integer The filter of the tag info.
	 */
	public function getFilter()
	{
		return $this->filter;
	}
	
	/**
	 * Sets the filter of the tag info.
	 *
	 * @param integer $filter The filter of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$filter
	 *
	 * @return void
	 */
	public function setFilter($filter)
	{
		$this->filter = $filter;
	}

	/**
	 * Returns the tag data of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$tag
	 *
	 * @return integer The tag of the tag info.
	 */
	public function getTag()
	{
		return $this->tag;
	}
	
	/**
	 * Sets the tag data of the tag info.
	 *
	 * @param integer $tag The tag of the tag info.
	 *
	 * @uses Plex_Server_Library_Item_Tag::$tag
	 *
	 * @return void
	 */
	public function setTag($tag)
	{
		$this->tag = $tag;
	}
}
