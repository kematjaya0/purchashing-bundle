<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\PurchashingBundle\Entity\SupplierInterface;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class SupplierTest implements SupplierInterface
{
    
    /**
     * 
     * @var string
     */
    private $name;
    
    /**
     * 
     * @var string
     */
    private $address;
    
    /**
     * 
     * @var string
     */
    private $phone;
    
    function getName(): ?string 
    {
        return $this->name;
    }

    function getAddress(): ?string 
    {
        return $this->address;
    }

    function getPhone(): ?string
    {
        return $this->phone;
    }

    function setName(string $name): self 
    {
        $this->name = $name;
        
        return $this;
    }

    function setAddress(string $address): self 
    {
        $this->address = $address;
        
        return $this;
    }

    function setPhone(string $phone): self 
    {
        $this->phone = $phone;
        
        return $this;
    }


}
