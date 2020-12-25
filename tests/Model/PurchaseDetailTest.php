<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseDetailTest implements PurchaseDetailInterface
{
    /**
     * 
     * @var ItemInterface
     */
    private $item;
    
    /**
     * 
     * @var float
     */
    private $quantity;
    
    /**
     * 
     * @var float
     */
    private $price;
    
    /**
     * 
     * @var float
     */
    private $total;
    
    /**
     * 
     * @var float
     */
    private $tax;
    
    /**
     * 
     * @var PurchaseInterface
     */
    private $purchase;
    
    /**
     * 
     * @var PackagingInterface
     */
    private $packaging;
    
    public function getItem(): ?ItemInterface 
    {
        return $this->item;
    }

    public function getQuantity(): ?float 
    {
        return $this->quantity;
    }

    public function getPrice(): ?float 
    {
        return $this->price;
    }

    public function getTotal(): ?float 
    {
        return $this->total;
    }

    public function getTax(): ?float 
    {
        return $this->tax;
    }

    public function getPurchase(): ?PurchaseInterface 
    {
        return $this->purchase;
    }

    public function getPackaging(): ?PackagingInterface 
    {
        return $this->packaging;
    }

    public function setItem(?ItemInterface $item): PurchaseDetailInterface  
    {
        $this->item = $item;
        
        return $this;
    }

    public function setQuantity(float $quantity): PurchaseDetailInterface  
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    public function setPrice(float $price): PurchaseDetailInterface  
    {
        $this->price = $price;
    
        return $this;
    }

    public function setTotal(float $total): PurchaseDetailInterface  
    {
        $this->total = $total;
    
        return $this;
    }

    public function setTax(float $tax): PurchaseDetailInterface  
    {
        $this->tax = $tax;
    
        return $this;
    }

    public function setPurchase(?PurchaseInterface $purchase): PurchaseDetailInterface  
    {
        $this->purchase = $purchase;
    
        return $this;
    }

    public function setPackaging(?PackagingInterface $packaging): PurchaseDetailInterface  
    {
        $this->packaging = $packaging;
    
        return $this;
    }

}
