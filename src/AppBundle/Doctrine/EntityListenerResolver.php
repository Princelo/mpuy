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
            'prePersistHandle',
            'postPersistHandle',
            'preUpdateHandle',
        );
    }

    public function addMapping($className, $service)
    {
        $this->mapping[$className] = $service;
    }

    public function resolve($className)
    {
        if (isset($this->mapping[$className]) && $this->container->has($this->mapping[$className])) {
            return $this->container->get($this->mapping[$className]);
        }

        return parent::resolve($className);
    }
}