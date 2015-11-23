<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 11/12/15
 * Time: 15:09
 */
namespace AppBundle\Doctrine;

use Doctrine\ORM\Mapping\DefaultEntityListenerResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityListenerResolver extends DefaultEntityListenerResolver
{
    private $container;
    private $mapping;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->mapping = array(
        );
    }

    public function addMapping($className, $service)
    {
        $this->mapping[$className] = $service;
        print_r($this->mapping);exit;
    }

    public function resolve($className)
    {
        if (isset($this->mapping[$className]) && $this->container->has($this->mapping[$className])) {
            print_r($this->container->get($this->mapping[$className]));
            //return $this->container->get($this->mapping[$className]);
        }
        exit;

        return parent::resolve($className);
    }
}