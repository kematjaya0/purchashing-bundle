<?php

namespace Kematjaya\PurchashingBundle\Tests\Repository;

use Kematjaya\ItemPack\Tests\Model\Packaging;
use Kematjaya\ItemPack\Tests\Model\ItemPackage;
use Kematjaya\ItemPack\Lib\ItemPackaging\Repo\ItemPackageRepoInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemPackageRepository implements ItemPackageRepoInterface
{
    
    public function createPackage(ItemInterface $item): ItemPackageInterface 
    {
        $object = new ItemPackage();
        $object->setItem($item);
        
        return $object;
    }

    public function findSmallestUnitByItem(ItemInterface $item): ?ItemPackageInterface 
    {
        $packaging = (new Packaging())->setCode('pcs')->setName('PCS');
        
        return (new ItemPackage())
                ->setItem($item)
                ->setPackaging($packaging)
                ->setQuantity(1)
                ->setPrincipalPrice($item->getPrincipalPrice())
                ->setSalePrice($item->getLastPrice());
    }

    public function save(ItemPackageInterface $itemPackage): void 
    {
        
    }

}
