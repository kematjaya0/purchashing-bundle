<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\PurchashingBundle\Repo\PurchaseRepoInterface;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseService 
{
    protected $purchaseRepo, $stockService, $priceService;
    
    function __construct(PurchaseRepoInterface $purchaseRepo, StockServiceInterface $stockService, PriceServiceInterface $priceService) 
    {
        $this->purchaseRepo = $purchaseRepo;
        $this->stockService = $stockService;
        $this->priceService = $priceService;
    }
    
    public function update(PurchaseInterface $entity):PurchaseInterface
    {
        if($entity->getIsLocked())
        {
            $total = 0;
            foreach($entity->getPurchaseDetails() as $purchaseDetail)
            {
                if($purchaseDetail instanceof PurchaseDetailInterface)
                {
                    $total += $purchaseDetail->getTotal();
                    $item = $purchaseDetail->getItem();
                    $item = $this->stockService->addStock($item, $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
                    $item = $this->priceService->updatePrincipalPrice($item, $purchaseDetail->getPrice(), $purchaseDetail->getPackaging());
                }
            }
            
            $entity->setTotal($total);
            
            $this->purchaseRepo->save($entity);
            
        }
        
        return $entity;
    }
}
