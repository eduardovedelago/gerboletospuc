<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 15/08/17
 * Time: 15:37
 */
require_once('vendor/autoload.php');
include_once('controller/Geral.php');
include_once('Geral.php');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Logging\DebugStack;

date_default_timezone_set('America/Sao_Paulo');

$paths = array("./src/models");
$config = Setup::createAnnotationMetadataConfiguration($paths, Geral::$AmbienteHomologacao);
$entityManager = EntityManager::create(Geral::getParametersConnectionDataBase(), $config);

//$entityManager->getConnection()->getConfiguration()->setSQLLogger();

//function getCreateQueryBuilderLogged($entityManager)
//{
//
//    // Start setup logger
//    $doctrine = $entityManager;
//    $doctrineConnection = $doctrine->getConnection();
//    $stack = new \Doctrine\DBAL\Logging\DebugStack();
//    $doctrineConnection->getConfiguration()->setSQLLogger($stack);
//    file_put_contents('/Applications/MAMP/logs/sql.log', json_encode($stack), FILE_APPEND);
//    return $doctrine;

//    $config = $entityManager->getConnection()->getConfiguration();

//    $stack = new \Doctrine\DBAL\Logging\DebugStack();
//    $config->setSQLLogger($stack);
//
//
//
//
//
//    file_put_contents('/Applications/MAMP/logs/sql.log', json_encode($stack), FILE_APPEND);
//
//    return $entityManager->createQueryBuilder();
//}

//php vendor/doctrine/orm/bin/doctrine orm:schema-tool:update --force
