# ${\color{red}Este\ repositorio\ está\ abandonado}$


**Atención:** Este proyecto ya no está en desarrollo activo y se considera abandonado. No se realizarán actualizaciones ni se brindará soporte adicional.

## Motivo del abandono

Debido a limitaciones de tiempo y recursos, este proyecto ha sido abandonado. Lamentablemente, ya no dispongo del tiempo necesario para mantenerlo y brindarle el desarrollo activo que se merece.

Además, desde la creación de este proyecto han surgido nuevas alternativas y soluciones más avanzadas que cubren las necesidades actuales de manera más eficiente. Recomiendo explorar las siguientes alternativas, que ofrecen características y mejoras adicionales:

## Alternativo

- [Plex API](https://github.com/jc21/plex-api): Esta alternativa cuenta con una comunidad activa y continuo desarrollo. Ofrece funcionalidades más avanzadas y comandos más intuitiva.

Agradecemos el interés y el apoyo que este proyecto ha recibido hasta ahora. Si tienes alguna pregunta o inquietud, no dudes en contactarnos, pero ten en cuenta que es poco probable que recibas una respuesta o solución.

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
