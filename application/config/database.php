<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	/*Datos MySQL*/
	/*'username' => 'ssadb',
	'password' => 'SeguimientoenelAula', */
	/*Datos MariaDB*/
  //
	// 'username' => 'ssa',
	// 'password' => 'ceaf5bc8757',
	// 'database' => 'ssadb',
	'username' => 'root',
	'password' => '',
	'database' => 'ssadb',

	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
