<?php
namespace ASPTest\Command;

use ASPTest\Model\UserMapper;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class UserCreatePWDCommand extends Command
{
    protected static $defaultName = 'user:create-pwd';

    public function __construct(bool $requirePassword = false)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->requirePassword = $requirePassword;

        parent::__construct();
    }

    protected function configure():void
    {
        $this->addArgument('first_name', InputArgument::REQUIRED, 'The first name of the user.');
        $this->addArgument('last_name', InputArgument::REQUIRED, 'The last name name of the user.');
        $this->addArgument('mail', InputArgument::REQUIRED, 'The e-mail of the user.');
        $this->addArgument('age', InputArgument::OPTIONAL, 'The age of the user.');
        $this->setDescription('Allow setting a password for an existing user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln(True);
        $output->writeln('Username: '.$input->getArgument('username'));
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('create a user.');

        return Command::SUCCESS;
    }
}