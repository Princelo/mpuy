<?php
namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineEntityListenerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('app_bundle.doctrine.entity_listener_resolver');
        $services = $container->findTaggedServiceIds('app_bundle.entity_listener');
        echo "<pre>";
        print_r($definition);
        print_r($services);exit;

        foreach ($services as $service => $attributes) {
            $definition->addMethodCall(
                'addMapping',
                array($container->getDefinition($service)->getClass(), $service)
            );
        }
    }
}