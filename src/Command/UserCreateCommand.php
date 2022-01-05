<?php
namespace ASPTest\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Lock\Store\PdoStore;

use ASPTest\Model\User;

/**
 * @see Create a user
 * @author Santos L. Victor [victorluissantos@live.com]
 */
class UserCreateCommand extends Command
{
    protected static $defaultName = 'user:create';

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    protected function configure():void
    {
        $this->addArgument('first_name', InputArgument::REQUIRED, 'The first name of the user.');
        $this->addArgument('last_name', InputArgument::REQUIRED, 'The last name name of the user.');
        $this->addArgument('email', InputArgument::REQUIRED, 'The e-mail of the user.');
        $this->addArgument('age', InputArgument::OPTIONAL, 'The age of the user.');
        $this->setDescription('Creation of a new user that meets the following specifications');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {        
        $user = $this->isValid($input);

        if (!isset($user['errors'])) {
            
            $user['id'] = $this->userModel->insert($user);
            $output->writeln($user['id']);

            if (!is_null($user['id'])) {
                $output->writeln(json_encode($user));
            } else {
                $output->writeln('Have internal error, please contact support!');
            }
        } else {
            $output->writeln($user['errors']);
        }
        return Command::SUCCESS;
    }

    /**
     * @see Check if the input is valid object (VO)
     */
    public function isValid(InputInterface $input) : array
    {
        $data = array();

        if(strlen($input->getArgument('first_name'))>=2) {
            $data['first_name'] = $input->getArgument('first_name');
        } else {
            $data['errors'][] = 'The first name must be at least 2 digits !';
        }

        if(strlen($input->getArgument('last_name'))>=2) {
            $data['last_name'] = $input->getArgument('last_name');
        } else {
            $data['errors'][] = 'The last name must be at least 2 digits !';
        }

        if (self::isValidEmail($input->getArgument('email'))) {
            if(count($this->userModel->getbyEmail($input->getArgument('email')))==0) {
                $data['email'] = $input->getArgument('email');
            } else {
                $data['errors'][] = 'E-mail already registered';   
            }
        } else {
            $data['errors'][] = 'The e-mail is not valid!';

        }

        if($input->getArgument('age')) {
            if (strlen($input->getArgument('age')) <= 4
                    &&
                $input->getArgument('age') <= 150
            ) {
                $data['age'] = $input->getArgument('age');
            } else {
                $data['errors'][] = 'The age must be positive and under 150!';
            }
        }

        return $data;
    }

    /**
     * @see Check the e-mail is valid
     */
    public function isValidEmail(string $email) : bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
    
        //Get host name from email and check if it is valid
        $email_host = array_slice(explode("@", $email), -1)[0];
    
        // Check if valid IP (v4 or v6). If it is we can't do a DNS lookup
        if (!filter_var($email_host,FILTER_VALIDATE_IP, [
            'flags' => FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE,
        ])) {
            //Add a dot to the end of the host name to make a fully qualified domain name
            // and get last array element because an escaped @ is allowed in the local part (RFC 5322)
            // Then convert to ascii (http://us.php.net/manual/en/function.idn-to-ascii.php)
            $email_host = idn_to_ascii($email_host.'.');
    
            //Check for MX pointers in DNS (if there are no MX pointers the domain cannot receive emails)
            if (!checkdnsrr($email_host, "MX")) {
                return false;
            }
        }
        return true;
    }
}