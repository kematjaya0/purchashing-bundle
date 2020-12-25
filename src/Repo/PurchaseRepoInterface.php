<?php

namespace Kematjaya\PurchashingBundle\Repo;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseRepoInterface
{
    public function createObject():PurchaseInterface;
    
    public function save(PurchaseInterface $package): void;
}
