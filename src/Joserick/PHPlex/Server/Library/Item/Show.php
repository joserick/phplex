<?php

namespace Joserick\PHPlex\Server\Library\Item;

use Joserick\PHPlex\Server\Library\Plex_Server_Library_ItemGrandparentAbstract;

/**
 * Plex Library Show
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
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
 * Represents a Plex show.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Item_Show 
	extends Plex_Server_Library_ItemGrandparentAbstract
{
	/**
	 * Sets an array of attributes, if they exist, to the corresponding class
	 * member.
	 * 
	 * @param array $attribute An array of item attributes as passed back by the
	 * Plex HTTP API.
	 *
	 * @uses Plex_Server_Library_ItemAbstract::setAttributes()
	 *
	 * @return void
	 */
	public function setAttributes($attribute)
	{
		parent::setAttributes($attribute);
	}
	
	/**
	 * Returns an array of all the season objects for the instantiated show.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_ItemAbstract::buildChildrenEndpoint()
	 *
	 * @return Plex_Server_Library_Item_Season[] An array of Plex library season
	 * objects.
	 */
	public function getSeasons()
	{
		return $this->getItems(
			$this->buildChildrenEndpoint()
		);
	}
	
	/**
	 * Returns a single season by index, key, or exact title match.
	 *
 	 * @param integer|string $polymorphicData Either an index, a key, or a title
	 * for an exact title match that will be used to retrieve a single season.
	 * 
	 * @uses Plex_Server_Library_ItemAbstract::getPolymorphicItem()
	 *
	 * @return Plex_Server_Library_Item_Season A single season.
	 */
	public function getSeason($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
	
	/**
	 * Returns all the episodes for a given show.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_ItemAbstract::buildAllLeavesEndpoint()
	 *
	 * @return Plex_Server_Library_Item_Episode[] Array of all the episodes for
	 * a given show.
	 */
	public function getAllEpisodes()
	{
		return $this->getItems(
			$this->buildAllLeavesEndpoint()
		);
	}
	
	/**
	 * Returns a single random episode for a given show.
	 *
	 * @uses Plex_Server_Library_Item_Show::getAllEpisodes()
	 *
	 * @return Plex_Server_Library_Item_Episode A single random episode.
	 */
	public function getRandomEpisode()
	{
		$allEpisodes = $this->getAllEpisodes();
		$ceiling = count($allEpisodes)-1;
		$randomNumber = mt_rand(0, $ceiling);
		return $allEpisodes[$randomNumber];
	}

	/**
	 * Returns an integer of the seasons number for the instantiated show.
	 *
	 * @uses Plex_Server_Library_ItemGrandparentAbstract::getChildCount()
	 *
	 * @return integer Count of seasons of the Plex library Show.
	 */
	public function getSeasonsCount()
	{
		return 	$this->getChildCount();
	}

	/**
	 * Returns an integer of the Episodes number for the instantiated show.
	 *
	 * @uses Plex_Server_Library_ItemGrandparentAbstract::getLeafCount()
	 *
	 * @return integer Count of episodes of the Plex library Show.
	 */
	public function getEpisodesCount()
	{
		return 	$this->getLeafCount();
	}

	/**
	 * Returns an integer of the number of episodes viewed for the instantiated show.
	 *
	 * @uses Plex_Server_Library_ItemGrandparentAbstract::getViewedLeafCount()
	 *
	 * @return integer Count of episodes viewed of the Plex library Show.
	 */
	public function getViewedEpisodesCount()
	{
		return 	$this->getViewedLeafCount();
	}
}
