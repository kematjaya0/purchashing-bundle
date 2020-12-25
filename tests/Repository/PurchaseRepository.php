<?php

namespace Kematjaya\PurchashingBundle\Tests\Repository;

use Kematjaya\PurchashingBundle\Repo\PurchaseRepoInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Tests\Model\PurchaseTest;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseRepository implements PurchaseRepoInterface
{
    
    public function createObject(): PurchaseInterface 
    {
        return new PurchaseTest();
    }

    public function save(PurchaseInterface $package): void 
    {
        
    }

}
