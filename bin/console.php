#!/usr/bin/env php
<?php
require_once __DIR__.'/../vendor/autoload.php';
set_time_limit(0);

use Doctrine\DBAL\Tools\Console\Command\ImportCommand;
use Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand;
use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand;
use Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand;
use Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\RunDqlCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Dvaqueiro\Infrastructure\Ui\Api\Application as Application2;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'),
    getenv('SYMFONY_ENV') ?: 'dev');

$app = Application2::bootstrap();
        
$console = new Application('Api Rest Base', '1.0');
$console->getDefinition()->addOption(new InputOption('--env', '-e',
    InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);
$console
    ->register('my-command')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('My command description')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
        // do something
    })
;

$console->setHelperSet(new HelperSet(array(
    'db' => new ConnectionHelper($app["db"]),
    'em' => new EntityManagerHelper($app["orm.em"])
)));

$console->addCommands(array(
    new MetadataCommand,
    new QueryCommand,
    new ResultCommand,
    new CreateCommand,
    new DropCommand,
    new UpdateCommand,
    new ConvertDoctrine1SchemaCommand,
    new ConvertMappingCommand,
    new EnsureProductionSettingsCommand,
    new GenerateEntitiesCommand,
    new GenerateProxiesCommand,
    new GenerateRepositoriesCommand,
    new InfoCommand,
    new RunDqlCommand,
    new ValidateSchemaCommand,
    new ImportCommand,
    new ReservedWordsCommand,
    new RunSqlCommand
));


$console->run();
