<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\ItemPack\Event\PriceEventInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceEvent implements PriceEventInterface
{
    
    public function onApprovalPrincipalPrice(PriceLogInterface $priceLog): void 
    {
        
    }

    public function onNewPrincipalPrice(PriceLogInterface $priceLog): void 
    {
        
    }

    public function onRejectPrincipalPrice(PriceLogInterface $priceLog): void 
    {
        
    }

}
