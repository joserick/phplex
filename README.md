# ${\color{red}This\ repository\ is\ abandoned}$


**Warning:** This project is no longer in active development and is considered abandoned. No updates or additional support will be provided.

## Reason for abandonment

Due to time and resource constraints, this project has been abandoned. Unfortunately, I no longer have the time to maintain it and give it the active development it deserves.

In addition, since the creation of this project, new alternatives and more advanced solutions have emerged that cover current needs more efficiently. I recommend exploring the following alternatives, which offer additional features and improvements:

## Alternative

- [Plex API](https://github.com/jc21/plex-api): This alternative has an active community and continuous development. It offers more advanced functionalities and more intuitive commands.

We appreciate the interest and support this project has received thus far. If you have any questions or concerns, please do not hesitate to contact us, but please note that it is unlikely that you will receive an answer or solution.

# PHPlex

PHPlex is a library for interacting with the [Plex Manager Server](https://www.plex.tv) thought its [API-HTTP](https://github.com/Arcanemagus/plex-api/wiki/Plex-Web-API-Overview).

## Requirements

 - PHP >= 5.6
 - Curl PHP Extension
 - XML PHP Extension
 - JSON PHP Extension

## What It Does
Allows access to your Plex library so that you can retrieve your shows, seasons, episodes, movies, artists, albums, and tracks in a number of convenient ways.

Has simple commands for playback and navigation and also an interface for playing episodes, movies, and tracks.

## What It Does Not Do
Photos have not been implemented yet.

Playback is only implemented at the episode, movies, and track level. The plan is to implement passing a season or album to the application controller and have it play through the entire thing.

Paging has not been implemented for lists of items.

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install PHPlex.

```bash
composer require joserick/phplex
```
## Documentation
You can see more function of PHPlex in [Github Wiki](https://github.com/joserick/phplex/wiki).

Also you can see all the classes, methods and properties  in the [Documentation](https://joserick.com/docs/phplex/index.html).
## Getting a PlexServer Instance

```php
// include composer autoload
require 'vendor/autoload.php';

// import the Joserick Plex
use Joserick\PHPlex\Plex;

// build plex object with you account data.
$plex = new Plex('username', 'password', 'address');

// to finally create server instances
$server = $plex->getServer();
```
If you want add multiples  servers with data  more specifics.
```php
$servers = array(
	'my_server' => array( // Name with which you want to identify the configuration of the server.
		'username' => 'username|email', // Username or email of the plex.tv account.
		'password' => 'password' // Password of the plex.tv account.
		'address' => '192.168.11.9', // Ip of the server, default localhost.
		'port' => '32401' // Ip port, default 32400.
		'token' => '********' // Connexion token, default phplex generate one.
	),
	// ...
);
$plex = new Plex();
$plex->registerServers($servers);
$server = $plex->getServer('my_server');
```
## Examples
### Example 1: List all unwatched movies.
```php
// First get a section of type movie.
$section = $server->getLibrary()->getSection('Movies');
$movies = $section->getUnwatched();
foreach ($movies as $movie){
	echo $movie->getTitle();
}
```
### Example 2: List all clients connected to the Server.
```php
$clients = $plex->getAllClients();
foreach ($clients as $client){
	echo $client->getName();
}
// Get a client specific.
$client_version = $plex->getClient('Chrome')->version;
```
### Example 3: List all genres in a section of type movie.
```php
$section = $server->getLibrary()->getSection('TV Shows')
foreach ($section->getGenres() as $genre){
	echo $genre->getName();
}
```
### Example 4: List all movies in a section with the word 'Terminator' in the title.
```php
$section = $server->getLibrary()->getSection('Movies');
foreach ($section->search('terminator') as $movie){
	echo $movie->getTitle();
}
```
### Example 5: List all file for the latest episode of 'Friends'.
```php
$last_episode = $server->getLibrary()->getSection('TV Shows')->get('Friends')->getEpisodes()[-1];
foreach ($last_episode->getMedia()->getFiles() as $file){
	echo $file->getPath();
}
```
### Example 6: List of the first character of each item of a section
```php
$alphabet = $server->getLibrary()->getSection('TV Shows')->getAlphabet();
foreach ($alphabet as $letter){
	echo $letter;
}
```
## Changelog
Please see [CHANGELOG](https://github.com/joserick/phplex/blob/master/CHANGELOG.md) for more information what has changed recently.
## Credits

 - [Nick Bart](https://github.com/nickbart)
 - [All Contributors](https://github.com/joserick/phplex/graphs/contributors)

## License

The GNU Public License (GPLv3). Please see [License File](https://github.com/joserick/phplex/blob/master/LICENSE) for more information.
