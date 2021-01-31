<?php

namespace Kematjaya\PurchashingBundle\Repo;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseDetailRepoInterface 
{
    public function createObject(PurchaseInterface $purchase):PurchaseDetailInterface;
    
    public function save(PurchaseDetailInterface $package): void;
}
