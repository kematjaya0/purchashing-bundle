<?php

namespace Kematjaya\PurchashingBundle\Tests\Repository;

use Kematjaya\ItemPack\Lib\Price\Repo\PriceLogRepoInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PriceLogRepository implements PriceLogRepoInterface
{
    
    public function createPriceLog(ItemInterface $item): PriceLogInterface 
    {
        $log = new \Kematjaya\ItemPack\Tests\Model\PriceLog();
        
        return $log;
    }

    public function getNewPriceLogByItem(ItemInterface $item): ?PriceLogInterface 
    {
        return null;
    }

    public function getNewPriceLogs(): Collection 
    {
        return new ArrayCollection();
    }

    public function save(PriceLogInterface $priceLog): void 
    {
        
    }

}
