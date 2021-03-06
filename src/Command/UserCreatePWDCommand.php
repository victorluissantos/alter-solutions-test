<?php
namespace ASPTest\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use ASPTest\Model\User;

class UserCreatePWDCommand extends Command
{
    protected static $defaultName = 'user:create-pwd';

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    protected function configure():void
    {
        $this->addArgument('user_id', InputArgument::REQUIRED, 'The id of the user.');
        $this->addArgument('password', InputArgument::REQUIRED, 'The password of the user.');
        $this->addArgument('password_confirmation', InputArgument::REQUIRED, 'The confirmation of password the user.');
        $this->setDescription('Allow setting a password for an existing user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->validation($input);

        if (!isset($user['errors'])) {
            if(!$this->userModel->setPWD($user['password'], $user['user_id'])) {
                $output->writeln('Password successfully entered!');
            } else {
                $output->writeln('Have internal error, please contact support!');
            }
        } else {
            $output->writeln($user['errors']);
        }

        return Command::SUCCESS;
    }

    /**
     * @see Check if the input is valid password and id(key) for user
     * @return [array] $data
     * @author Santos L. Victor
     */
    public function validation(InputInterface $input) : array
    {
        $data = array();

        if(!empty($this->userModel->getByID($input->getArgument('user_id'))))
        {
            $data['user_id'] = $input->getArgument('user_id');
        } 
        else 
        {
            $data['errors'][] = 'User id not found!';
        }

        if(strlen($input->getArgument('password'))>=6) 
        {
            $data['password'] = $input->getArgument('password');
        } 
        else 
        {
            $data['errors'][] = 'The password name must be at least 6 digits!';
        }

        if($input->getArgument('password')!=$input->getArgument('password_confirmation'))
        {
            $data['errors'][] = 'The password and confirmation do not match!';
        } 
        else if (!$this->passwordStrength($input->getArgument('password'))) 
        {
            $data['errors'][] = 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
        }

        return $data;
    }

    /**
     * @see Responsible for validating the strength of a trinsg to be used as a password
     * @param [String] $input, input value for validation
     * @return 
     */
    public function passwordStrength(String $password)
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
            return False;
        } else {
            return True;
        }
    }
}