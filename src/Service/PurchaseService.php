<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseService 
{
    protected $entityManager, $stockService, $priceService;
    
    function __construct(EntityManagerInterface $entityManager, StockServiceInterface $stockService, PriceServiceInterface $priceService) 
    {
        $this->entityManager = $entityManager;
        $this->stockService = $stockService;
        $this->priceService = $priceService;
    }
    
    protected function doPersist($entity)
    {
        $uow = $this->entityManager->getUnitOfWork();
        $this->entityManager->persist($entity);
        $classMetadata = $this->entityManager->getClassMetadata(get_class($entity));
        $uow->computeChangeSet($classMetadata, $entity);
        
        return $entity;
    }
    
    public function update(PurchaseInterface $entity)
    {
        if($entity->getIsLocked())
        {
            $total = 0;
            foreach($entity->getPurchaseDetails() as $purchaseDetail)
            {
                if($purchaseDetail instanceof PurchaseDetailInterface)
                {
                    $total += $purchaseDetail->getTotal();
                    $this->stockService->updateStock($purchaseDetail->getItem(), $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
                    $this->priceService->updatePrincipalPrice($purchaseDetail->getItem(), $purchaseDetail->getPrice(), $purchaseDetail->getPackaging());
                }
            }
            
            $entity->setTotal($total);
            $entity->setIsLocked(true);
            return $this->doPersist($entity);
        }
    }
}
