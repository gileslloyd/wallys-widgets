<?php
define("SRC", realpath(__DIR__."/../../").'/');
define("ROOT", realpath(SRC."../").'/');
define("APPLICATION", realpath(__DIR__."/../Application"));
define("INFRASTRUCTURE", realpath(__DIR__));

ORM::addEntityPath(__DIR__.'/Doctrine/Mapping/');

$container = \DI\Container::instance();
