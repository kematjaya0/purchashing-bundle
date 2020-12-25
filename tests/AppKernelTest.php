<?php

namespace Kematjaya\PurchashingBundle\Tests;

use Kematjaya\PurchashingBundle\PurchashingBundle;
use Kematjaya\ItemPack\KmjItemPackBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class AppKernelTest extends Kernel
{
    public function registerBundles()
    {
        return [
            new PurchashingBundle(),
            new KmjItemPackBundle(),
            new FrameworkBundle()
        ];
    }
    
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) use ($loader) 
        {
            $loader->load(__DIR__ .'/config/config.yml');
            
            $container->addObjectResource($this);
        });
    }
}
