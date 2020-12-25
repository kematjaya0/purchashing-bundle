<?php

namespace Kematjaya\PurchashingBundle\Tests\Repository;

use Kematjaya\ItemPack\Tests\Model\StockCard;
use Kematjaya\ItemPack\Lib\Stock\Repo\StockCardRepoInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\StockCardInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StockCardRepository implements StockCardRepoInterface
{
    
    public function createStockCard(): StockCardInterface 
    {
        return new StockCard();
    }

    public function save(StockCardInterface $package): void 
    {
        
    }

}
