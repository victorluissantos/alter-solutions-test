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
        $this->addArgument('password', InputArgument::REQUIRED, 'The password of the user.');
        $this->addArgument('password_confirmation', InputArgument::REQUIRED, 'The confirmation of password the user.');
        $this->addArgument('user_id', InputArgument::REQUIRED, 'The id of the user.');;
        $this->setDescription('Allow setting a password for an existing user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }

    /**
     * @see Check if the input is valid password and id(key) for user
     * @author Santos L. Victor
     */
    public static function validPassword(InputInterface $input) : array
    {
        $data = array();

        return [];
    }
}