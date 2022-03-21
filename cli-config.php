<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 15/08/17
 * Time: 15:43
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner;


require_once 'database.php';


return ConsoleRunner::createHelperSet($entityManager);