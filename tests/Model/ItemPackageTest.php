<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemPackageTest implements ItemPackageInterface 
{
    /**
     * 
     * @var ItemInterface
     */
    private $item;
    
    /**
     * 
     * @var PackagingInterface
     */
    private $packaging;
    
    /**
     * 
     * @var float
     */
    private $principalPrice;
    
    /**
     * 
     * @var float
     */
    private $quantity;
    
    /**
     * 
     * @var float
     */
    private $salePrice;
    
    public function getItem(): ItemInterface 
    {
        return $this->item;
    }

    public function getPackaging(): ?PackagingInterface 
    {
        return $this->packaging;
    }

    public function getPrincipalPrice(): ?float 
    {
        return $this->principalPrice;
    }

    public function getQuantity(): ?float 
    {
        return $this->quantity;
    }

    public function getSalePrice(): ?float 
    {
        return $this->salePrice;
    }

    public function isSmallestUnit(): bool 
    {
        return true;
    }

    public function setItem(ItemInterface $item): ItemPackageInterface 
    {
        $this->item = $item;
        
        return $this;
    }

    public function setPackaging(PackagingInterface $packaging): ItemPackageInterface 
    {
        $this->packaging = $packaging;
        
        return $this;
    }

    public function setPrincipalPrice(float $price): ItemPackageInterface 
    {
        $this->principalPrice = $price;
        
        return $this;
    }

    public function setQuantity(float $quantity): ItemPackageInterface 
    {
        $this->quantity = $quantity;
        
        return $this;
    }

    public function setSalePrice(float $price): ItemPackageInterface 
    {
        $this->salePrice = $price;
        
        return $this;
    }
}