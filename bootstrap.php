<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use App\Infrastructure\Events\EventDispatcher;
use App\Infrastructure\Events\SendWelcomeEmail;
use App\Domain\User\Events\UserRegisteredEvent;

require_once "vendor/autoload.php";


$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . "/src/Domain"],
    isDevMode: true,
);


$cache = new ArrayAdapter();
$config->setMetadataCache($cache);
$config->setQueryCache($cache);
$config->setResultCache($cache);


$connection = DriverManager::getConnection([
    'dbname'   => 'user_db',
    'user'     => 'user',
    'password' => 'password',
    'host'     => 'mysql_db',
    'driver'   => 'pdo_mysql',
    'port'     => 3306
], $config);

$entityManager = new EntityManager($connection, $config);
EventDispatcher::addListener(UserRegisteredEvent::class, [new SendWelcomeEmail(), 'handle']);

return $entityManager;
