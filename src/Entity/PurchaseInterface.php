<?php

namespace Kematjaya\PurchashingBundle\Entity;

use Doctrine\Common\Collections\Collection;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface PurchaseInterface 
{
    public function __toString();
    
    public function getId(): ?int;

    public function getCode(): ?string;

    public function setCode(string $code): self;

    public function getPurchaseAt(): ?\DateTimeInterface;

    public function setPurchaseAt(\DateTimeInterface $purchase_at): self;

    public function getTotal(): ?float;

    public function setTotal(float $total): self;

    public function getDescription(): ?string;

    public function setDescription(?string $description): self;

    public function getIsLocked(): ?bool;

    public function setIsLocked(?bool $is_locked): self;
    
    public function getPurchaseDetails(): Collection;
}
