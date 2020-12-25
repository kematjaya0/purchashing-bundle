<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
use Kematjaya\PurchashingBundle\Entity\SupplierInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseTest implements PurchaseInterface 
{
    /**
     * 
     * @var float
     */
    private $total;
    
    /**
     * 
     * @var SupplierInterface
     */
    private $supplier;
    
    /**
     * 
     * @var \DateTimeInterface
     */
    private $purchase_at;
    
    /**
     * 
     * @var bool
     */
    private $is_locked;
    
    /**
     * 
     * @var string
     */
    private $description;
    
    /**
     * 
     * @var string
     */
    private $code;
    
    /**
     * 
     * @var Collection
     */
    private $purchaseDetails;
    
    public function __construct() 
    {
        $this->purchaseDetails = new ArrayCollection();
    }
    
    public function __toString() 
    {
        return $this->getCode();
    }

    public function getCode(): ?string 
    {
        return $this->code;
    }

    public function getDescription(): ?string 
    {
        return $this->description;
    }

    public function getIsLocked(): ?bool 
    {
        return $this->is_locked;
    }

    public function getPurchaseAt(): ?\DateTimeInterface 
    {
        return $this->purchase_at;
    }

    public function getPurchaseDetails(): Collection 
    {
        return $this->purchaseDetails;
    }
    
    public function addPurchaseDetails(PurchaseDetailInterface $detail): self 
    {
        $this->purchaseDetails->add($detail);
        
        return $this;
    }

    public function getSupplier(): ?SupplierInterface 
    {
        return $this->supplier;
    }

    public function getTotal(): ?float 
    {
        return $this->total;
    }

    public function setCode(string $code): PurchaseInterface 
    {
        $this->code = $code;
        
        return $this;
    }

    public function setDescription(?string $description): PurchaseInterface 
    {
        $this->description = $description;
        
        return $this;
    }

    public function setIsLocked(?bool $is_locked): PurchaseInterface 
    {
        $this->is_locked = $is_locked;
        
        return $this;
    }

    public function setPurchaseAt(\DateTimeInterface $purchase_at): PurchaseInterface 
    {
        $this->purchase_at = $purchase_at;
        
        return $this;
    }

    public function setSupplier(SupplierInterface $supplier): PurchaseInterface 
    {
        $this->supplier = $supplier;
        
        return $this;
    }

    public function setTotal(float $total): PurchaseInterface 
    {
        $this->total = $total;
        
        return $this;
    }
    
}
