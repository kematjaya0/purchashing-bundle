<?php

namespace Kematjaya\PurchashingBundle\Tests\Repository;

use Kematjaya\ItemPack\Tests\Model\Item;
use Kematjaya\ItemPack\Lib\Item\Repo\ItemRepoInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemRepository implements ItemRepoInterface
{
    public function createItem(): ItemInterface 
    {
        return new Item();
    }

    public function save(ItemInterface $item): void 
    {
        
    }

    public function findIdenticItem(ItemInterface $item): ?ItemInterface 
    {
        return null;
    }

}
