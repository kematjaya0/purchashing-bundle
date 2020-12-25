<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\ItemPack\Lib\Price\Entity\PriceLogClientInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemCategory\Entity\ItemCategoryInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemTest implements ItemInterface, PriceLogClientInterface
{
    /**
     * 
     * @var ItemCategoryInterface
     */
    private $category;
    
    /**
     * 
     * @var string
     */
    private $code;
    
    /**
     * 
     * @var float
     */
    private $last_price;
    
    /**
     * 
     * @var float
     */
    private $last_stock;
    
    /**
     * 
     * @var string
     */
    private $name;
    
    /**
     * 
     * @var float
     */
    private $principal_price;
    
    /**
     * 
     * @var bool
     */
    private $use_barcode;
    
    /**
     * 
     * @var Collection
     */
    private $itemPackages;
    
    public function __construct() 
    {
        $this->itemPackages = new ArrayCollection();
    }
    
    public function getCategory(): ?ItemCategoryInterface 
    {
        return $this->category;
    }

    public function getCode(): ?string 
    {
        return $this->code;
    }

    public function getItemPackages(): Collection 
    {
        return $this->itemPackages;
    }

    public function addItemPackage(ItemPackageInterface $itemPackage): self
    {
        if (!$this->itemPackages->contains($itemPackage)) {
            $this->itemPackages[] = $itemPackage;
        }

        return $this;
    }

    public function removeItemPackage(ItemPackageInterface $itemPackage): self
    {
        if ($this->itemPackages->contains($itemPackage)) {
            $this->itemPackages->removeElement($itemPackage);
        }

        return $this;
    }
    
    public function getLastPrice(): ?float 
    {
        return $this->last_price;
    }

    public function getLastStock(): ?float 
    {
        return $this->last_stock;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getPrincipalPrice(): ?float 
    {
        return $this->principal_price;
    }

    public function getUseBarcode(): ?bool 
    {
        return $this->use_barcode;
    }

    public function setCategory(?ItemCategoryInterface $category): ItemInterface 
    {
        $this->category = $category;
        
        return $this;
    }

    public function setCode(string $code): ItemInterface 
    {
        $this->code = $code;
        
        return $this;
    }

    public function setLastPrice(float $last_price): ItemInterface 
    {
        $this->last_price = $last_price;
        
        return $this;
    }
    
    public function setLastStock(float $last_stock): ItemInterface 
    {
        $this->last_stock = $last_stock;
        
        return $this;
    }

    public function setName(string $name): ItemInterface 
    {
        $this->name = $name;
        
        return $this;
    }

    public function setPrincipalPrice(float $principal_price): ItemInterface 
    {
        $this->principal_price = $principal_price;
        
        return $this;
    }

    public function setUseBarcode(bool $use_barcode): ItemInterface 
    {
        $this->use_barcode = $use_barcode;
        
        return $this;
    }

    public function getActivePrincipalPrice(): ?float 
    {
        return $this->getPrincipalPrice();
    }

    public function getActiveSalePrice(): ?float 
    {
        return $this->getLastPrice();
    }

    public function setActivePrincipalPrice(float $price): PriceLogClientInterface 
    {
        return $this->setPrincipalPrice($price);
    }

    public function setActiveSalePrice(float $price): PriceLogClientInterface 
    {
        return $this->setLastPrice($price);
    }

}
