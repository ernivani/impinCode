<?php
// config/bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Configuration;

require_once __DIR__ . '/../vendor/autoload.php';

// Entity paths
$paths = [__DIR__ . '/../src/Entity']; // Ensure correct path to entity directory

// Configuration for annotation metadata
$config = Setup::createAnnotationMetadataConfiguration(
    $paths,
    true, // Enable development mode
    __DIR__ . '/proxies', // Optional proxy directory path
    null, // Custom cache implementation (optional)
    false // Do not use simple annotation reader
);

// Database connection configuration
$dbParams = require __DIR__ . '/db.php';
$conn = DriverManager::getConnection($dbParams);

// Create EntityManager
$entityManager = EntityManager::create($conn, $config);

// Migrations configuration
$migrationsConfig = new PhpFile(__DIR__ . '/../migrations.php');

// DependencyFactory for migrations
$dependencyFactory = DependencyFactory::fromEntityManager($migrationsConfig, new ExistingEntityManager($entityManager));

// Debug output for entity list
echo "List of entities: \n";
foreach ($entityManager->getMetadataFactory()->getAllMetadata() as $metadata) {
    echo $metadata->getName() . "\n";
}

// Return EntityManager and DependencyFactory
return [
    'entityManager' => $entityManager,
    'dependencyFactory' => $dependencyFactory
];
