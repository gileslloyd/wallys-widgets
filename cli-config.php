<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'src/Wallys/Infrastructure/bootstrap.php';

$entityManager = ORM::instance()->getEntityManager();

$helperSet = ConsoleRunner::createHelperSet($entityManager);

return $helperSet;