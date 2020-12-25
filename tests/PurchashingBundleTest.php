<?php

namespace Kematjaya\PurchashingBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Kematjaya\PurchashingBundle\Service\PurchashingServiceInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Tests\Model\PurchaseTest;
use Kematjaya\PurchashingBundle\Tests\Model\PurchaseDetailTest;
use Kematjaya\PurchashingBundle\Tests\Model\PackagingTest;
use Kematjaya\PurchashingBundle\Tests\Model\ItemTest;
use Kematjaya\PurchashingBundle\Tests\Model\ItemPackageTest;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchashingBundleTest extends WebTestCase
{
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
    
    protected function getContainer(): ContainerInterface
    {
        $client = parent::createClient();
        return $client->getContainer();
    }
    
    public function testInstance(): PurchashingServiceInterface
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.purchasing_service'));
        $this->assertInstanceOf(PurchashingServiceInterface::class, $container->get('kematjaya.purchasing_service'));
        
        return $container->get('kematjaya.purchasing_service');
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdateWithNotLocked(PurchashingServiceInterface $service)
    {
        $entity = (new PurchaseTest());
        $actual = $service->update($entity);
        $this->assertInstanceOf(PurchaseInterface::class, $actual);
        $this->assertEquals($entity->getIsLocked(), $actual->getIsLocked());
        $this->assertEquals(0, $actual->getTotal());
    }
    
    /**
     * @depends testInstance
     */
    public function testUpdateWithLocked(PurchashingServiceInterface $service)
    {
        $entity = new PurchaseTest();
        $entity->setIsLocked(true);
        
        $actual = $service->update($entity);
        $this->assertInstanceOf(PurchaseInterface::class, $actual);
        $this->assertEquals($entity->getIsLocked(), $actual->getIsLocked());
        $this->assertEquals(0, $actual->getTotal());
        
        $packaging = (new PackagingTest())->setCode('pcs')->setName('PCS');
        $item = new ItemTest();
        $item->setCode('test')->setName('TEST')
                ->setPrincipalPrice(1000)
                ->setLastPrice(1200);
        $itemPackage = (new ItemPackageTest())
                ->setItem($item)
                ->setPackaging($packaging)
                ->setPrincipalPrice($item->getPrincipalPrice())
                ->setQuantity(1)
                ->setSalePrice($item->getLastPrice());
        $item->addItemPackage($itemPackage);
        
        $totals = 0;
        for($i = 1; $i<=5; $i++) {
            $price = 1000;
            $total = $price * $i;
            $detail = (new PurchaseDetailTest())
                    ->setItem($item)
                    ->setPackaging($packaging)
                    ->setPrice($price)
                    ->setPurchase($entity)
                    ->setQuantity($i)
                    ->setTax(0)
                    ->setTotal($total);
            
            $totals += $total;
            $entity->addPurchaseDetails($detail);
        }
        
        $actual = $service->update($entity);
        $this->assertInstanceOf(PurchaseInterface::class, $actual);
        $this->assertEquals($entity->getIsLocked(), $actual->getIsLocked());
        $this->assertEquals($totals, $actual->getTotal());
    }
}
