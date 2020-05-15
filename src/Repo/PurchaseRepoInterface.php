<?php

namespace Kematjaya\PurchashingBundle\Repo;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Doctrine\Common\Persistence\ObjectRepository;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseRepoInterface extends ObjectRepository
{
    public function createObject():PurchaseInterface;
}
