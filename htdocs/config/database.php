<?php

$mysql_services = json_decode(getenv('mysql_service'), true);
$mysql_credentials = $mysql_services['cleardb'][0]['credentials'];
/*
 *  "jdbcUrl": "jdbc:mysql://us-cdbr-iron-east-03.cleardb.net/ad_58885de0ae049e3?user=b1e4e0fb7f5c2f&password=cf228ef4",
    "uri": "mysql://b1e4e0fb7f5c2f:cf228ef4@us-cdbr-iron-east-03.cleardb.net:3306/ad_58885de0ae049e3?reconnect=true",
    "name": "xxx",
    "hostname": "us-cdbr-iron-east-03.cleardb.net",
    "port": "3306",
    "username": "xxx",
    "password": "xxx"
 */

$redis_services = json_decode(getenv('redis_service'), true);
$redis_credentials = $redis_services['rediscloud'][0]['credentials'];
/*
 * "hostname": "pub-redis-19574.dal-05.1.sl.garantiadata.com",
   "password": "xxx",
   "port": "19574"
 */

$memcached_services = json_decode(getenv('memcached_service'), true);
$memcached_credentials = $memcached_services['memcachedcloud'][0]['credentials'];
/**
 * "password": "xxx",
	"servers": "pub-memcache-17141.dal-05.1.sl.garantiadata.com:17141",
	"username": "xxx"
 */

return [

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	|
	| By default, database results will be returned as instances of the PHP
	| stdClass object; however, you may desire to retrieve records in an
	| array format for simplicity. Here you can tweak the fetch style.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	*/

	'default' => 'mysql',

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => [

		'sqlite' => [
			'driver'   => 'sqlite',
			'database' => storage_path().'/database.sqlite',
			'prefix'   => '',
		],

		'mysql' => [
			'driver'    => 'mysql',
			'host'      => empty($mysql_credentials)?env('DB_HOST', 'localhost'):$mysql_credentials['hostname'],
			'database'  => empty($mysql_credentials)?env('DB_DATABASE', 'forge'):$mysql_credentials['hostname'],
			'username'  => empty($mysql_credentials)?env('DB_USERNAME', 'forge'):$mysql_credentials['hostname'],
			'password'  => empty($mysql_credentials)?env('DB_PASSWORD', ''):$mysql_credentials['hostname'],
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'strict'    => false,
		],

		'pgsql' => [
			'driver'   => 'pgsql',
			'host'     => env('DB_HOST', 'localhost'),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		],

		'sqlsrv' => [
			'driver'   => 'sqlsrv',
			'host'     => env('DB_HOST', 'localhost'),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'prefix'   => '',
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run in the database.
	|
	*/

	'migrations' => 'migrations',

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer set of commands than a typical key-value systems
	| such as APC or Memcached. Laravel makes it easy to dig right in.
	|
	*/

	'redis' => [

		'cluster' => false,

		'default' => [
			'host'     => empty($redis_credentials)?env('REDIS_HOST', 'localhost'):$redis_credentials['hostname'],
			'port'     => empty($redis_credentials)?env('REDIS_PORT', 'localhost'):$redis_credentials['port'],
			'password' => empty($redis_credentials)?env('REDIS_PASSWORD', 'localhost'):$redis_credentials['password'],
			'database' => 0,
		],

	],

];
