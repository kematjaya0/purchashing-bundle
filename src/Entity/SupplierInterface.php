<?php

namespace Kematjaya\PurchashingBundle\Entity;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface SupplierInterface 
{
    public function getName():?string;
    
    public function getAddress():?string;
    
    public function getPhone():?string;
}
