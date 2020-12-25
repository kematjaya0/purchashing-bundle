<?php

namespace Kematjaya\PurchashingBundle\Tests\Model;

use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PackagingTest implements PackagingInterface
{
    /**
     * 
     * @var string
     */
    private $code;
    
    /**
     * 
     * @var string
     */
    private $name;
    
    public function getCode(): ?string 
    {
        return $this->code;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function setCode(string $code): PackagingInterface 
    {
        $this->code = $code;
        
        return $this;
    }

    public function setName(string $name): PackagingInterface 
    {
        $this->name = $name;
        
        return $this;
    }

}
