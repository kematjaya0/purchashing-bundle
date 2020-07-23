<?php

namespace Kematjaya\PurchashingBundle\Entity;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseDetailInterface 
{
    public function getId(): ?\Ramsey\Uuid\UuidInterface;

    public function getItem(): ?ItemInterface;

    public function setItem(?ItemInterface $item): self;

    public function getQuantity(): ?float;

    public function setQuantity(float $quantity): self;

    public function getPrice(): ?float;

    public function setPrice(float $price): self;

    public function getTotal(): ?float;

    public function setTotal(float $total): self;

    public function getTax(): ?float;

    public function setTax(float $tax): self;

    public function getPurchase(): ?PurchaseInterface;

    public function setPurchase(?PurchaseInterface $purchase): self;
    
    public function getPackaging(): ?PackagingInterface;
    
    public function setPackaging(?PackagingInterface $packaging): self;
}
