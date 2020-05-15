<?php

namespace Kematjaya\PurchashingBundle\Repo;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseDetailRepoInterface extends ObjectRepository 
{
    public function createObject(PurchaseInterface $purchase):PurchaseDetailInterface;
}
