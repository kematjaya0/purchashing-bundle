<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchashingServiceInterface 
{
    public function update(PurchaseInterface $entity):PurchaseInterface;
    
    public function countTotal(PurchaseInterface $entity):float;
}
