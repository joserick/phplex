<?php

namespace Joserick\Plex;

use Joserick\Plex\Exception\Plex_Exception_Machine;
use Joserick\Plex\Exception\Plex_Exception_Server;

/**
 * Plex Bootstrap
 *
 * This is the file to be included in your application and will bootstrap the
 * rest of what is required.
 * 
 * @category php-plex
 * @package Plex
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
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
 * Bootstrap class for using php-plex to interact with the Plex HTTP API.
 * 
 * @category php-plex
 * @package Plex
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.6
 */
class Plex
{
	/**
	 * A list of Plex server machines on the network. This is defined by the 
	 * instantiating software.
	 * @var Plex_Server[]
	 */
	private static $servers = array();

	/**
	 * A list of the Plex client machines on the network This is found upon
	 * registering of Plex server. The first registered Plex server will go out
	 * and get the list of available clients and register them accordingly.
	 * @var Plex_Client[]
	 */
	private static $clients = array();

	/**
	 * Sets up our Plex using the minimum amount of data required to
	 * interact.
	 *
	 * @param string $username The username of the Plex acount.
	 * @param string $password The password of the Plex acount.
	 * @param string $address The IP address of the Plex server.
	 * @param integer $port The port on which the Plex server is listening.
	 *
	 * @return void
	 */
	public function __construct($username = NULL, $password = NULL, $address = NULL, $port = NULL)
	{
		if (!is_null($username) && !is_null($password)) {
			$this->registerServers(['Plex' => compact('username', 'password', 'address', 'port'));
		}
	}
	
	/**
	 * Allows an instantiating software to define a list of Plex servers on the
	 * network. In addition, the first server listed will be used to find the
	 * list of available clients and will register them accordingly.
	 *
	 * @param array $servers An associative array of Plex server machines on the
	 * network define thusly:
	 *
	 * array (
	 *     'server-1-name' => array(
	 *         'address' => '192.168.1.5',
	 *         'username' => 'username',
	 *         'password' => 'password',
	 *         'port' => 32400
	 *     ),
	 *     'server-2-name' => array(
	 *         'address' => '192.168.1.10',
	 *         'username' => 'email',
	 *         'password' => 'password',
	 *         'port' => 32400
	 *     )
	 * )
	 *
	 * @uses Plex::$servers
	 * @uses Plex::registerClients()
	 * @uses Plex::getServer()
	 * @uses Plex_Server::getClient()
	 *
	 * @return void
	 */
	public function registerServers(array $servers)
	{
		// Register each server.
		foreach ($servers as $name => $server) {
			$address = isset($server['address']) ? $server['address'] : NULL;
			$port = isset($server['port']) ? $server['port'] : NULL;
			$token = isset($server['token']) ? $server['token'] :
				$this->getToken($server['username'], $server['password']);
			self::$servers[$name] = new Plex_Server(
				$name,
				$address,
				$port,
				$token
			);
		}
		
		// We are going to use the first server in the list to get a list of the
		// available clients and register those automatically.
		$serverKeys = array_keys(self::$servers);
		$serverName = reset($serverKeys);
		$this->registerClients(
			$this->getServer($serverName)->getClients()
		);
	}
	
	/**
	 * Registers each found client with the bootstrap, so they can be found and
	 * used by the instantiating software.
	 *
	 * @param Plex_Client[] $clients An associative array of Plex client machines on the
	 * network.
	 *
	 * @uses Plex::$clients
	 *
	 * @return void
	 */
   	private function registerClients(array $clients)
	{
		self::$clients = $clients;
	}
	
	/**
	 * Returns the requested server by the unique name under which it was registered.
	 *
	 * @param string $serverName The unique name of the requested server.
	 *
	 * @uses Plex::$servers
	 *
	 * @return Plex_Server The requested Plex server machine.
	 *
	 * @throws Plex_Exception_Server
	 */
	public function getServer($serverName)
	{
		if (!isset(self::$servers[$serverName])) {
			throw new Plex_Exception_Server(
				'RESOURCE_NOT_FOUND', 
				array($serverName)
			);
		}

		return self::$servers[$serverName];
	}
	
	/**
	 * Returns the requested client by the unique name under which it was registered.
	 *
	 * @param string $clientName The unique name of the requested client.
	 *
	 * @uses Plex::$clients
	 *
	 * @return Plex_Client The requested Plex client machine.
	 */
	public function getClient($clientName)
	{
		return self::$clients[$clientName];
	}
	
	/**
	 * Returns the token of the Plex server
	 *
	 * @author <joserick.92@gmail.com> José Erick Carreón
	 *
	 * @param string $username The username of the Plex server account.
	 * @param string $password The password of the Plex server account.
	 *
	 * @uses Plex::$registerServers()
	 *
	 * @return string The token Plex account.
	 *
	 * @throws Plex_Exception_Server Server token not obtained.
	 */
	public function getToken($username, $password) {
		$host = "https://plex.tv/users/sign_in.json";
		$header = array(
			'Content-Type: application/xml; charset=utf-8',
			'Content-Length: 0',
			'X-Plex-Client-Identifier: 8334-8A72-4C28-FDAF-29AB-479E-4069-C3A3',
			'X-Plex-Product: PhpPlexAPI', 'X-Plex-Version: v1_00', );
		$process = curl_init($host);
		curl_setopt($process, CURLOPT_HTTPHEADER, $header);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($process, CURLOPT_POST, 1);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($process);
		if ($data === FALSE) {
			throw new Plex_Exception_Machine(
				'CURL_ERROR',
				array(curl_errno($data), curl_error($data))
			);
		}
		curl_close($process);
		
		return json_decode($data, true)['user']['authentication_token'];
	}
}
