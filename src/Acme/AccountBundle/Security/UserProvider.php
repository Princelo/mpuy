<?php
namespace Acme\AccountBundle\Security;

use FOS\UserBundle\Security\UserProvider as FOSProvider;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class UserProvider extends FOSProvider {

    /**
     *
     * @var ContainerInterface
     */
    protected $container;


    public function __construct(UserManagerInterface $userManager, ContainerInterface $container) {
        parent::__construct($userManager);
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findUserBy(array(
            'username'=>$username,
        ));

        if (!$user) {
            $user = $this->findUserBy(array(
                'email'=>$username,
            ));
            if (!$user) {
                $user = $this->findUserBy(array(
                    'mobile'=>$username,
                ));
            } else {
                throw new Exception(sprintf('User "%s" does not exist.', $username));
            }
        }

        return $user;
    }

    public function findUserBy(array $criteria) {
        return $this->userManager->findUserBy($criteria);
    }

}