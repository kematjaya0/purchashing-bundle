<?php

namespace Kematjaya\ItemPack\Tests;

use Kematjaya\ItemPack\Service\PriceLogServiceInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceLogServiceTest extends KmjItemPackBundleTest
{
    public function testInstance():PriceLogServiceInterface
    {
        $container = $this->getContainer();
        $this->assertTrue($container->has('kematjaya.price_log_service'));
        $service = $container->get('kematjaya.price_log_service');
        $this->assertInstanceOf(PriceLogServiceInterface::class, $service);
        
        return $service;
    }
    
    /**
     * @depends testInstance
     */
    public function testSaveNewPrice(PriceLogServiceInterface $service)
    {
        $item = $this->buildObject();
        
        $priceLog = $service->saveNewPrice($item, 1200);
        $this->assertInstanceOf(PriceLogInterface::class, $priceLog);
        $this->assertEquals(PriceLogInterface::STATUS_NEW, $priceLog->getStatus());
        
        $service->rejectPrice($priceLog);
        $this->assertEquals(PriceLogInterface::STATUS_REJECTED, $priceLog->getStatus());
        
        $service->approvePrice($priceLog);
        $this->assertEquals(PriceLogInterface::STATUS_APPROVED, $priceLog->getStatus());
    }
}
