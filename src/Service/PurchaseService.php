<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\PurchashingBundle\Repo\PurchaseRepoInterface;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Service\PriceServiceInterface;
use Kematjaya\ItemPack\Service\StockCardServiceInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\ClientStockCardInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseService 
{
    protected $purchaseRepo, $stockService, $priceService, $stockCardService;
    
    function __construct(
            PurchaseRepoInterface $purchaseRepo, 
            StockServiceInterface $stockService, 
            PriceServiceInterface $priceService, 
            StockCardServiceInterface $stockCardService) 
    {
        $this->purchaseRepo = $purchaseRepo;
        $this->stockService = $stockService;
        $this->priceService = $priceService;
        $this->stockCardService = $stockCardService;
    }
    
    public function update(PurchaseInterface $entity):PurchaseInterface
    {
        $total = 0;
        if($entity->getIsLocked())
        {
            foreach($entity->getPurchaseDetails() as $purchaseDetail)
            {
                if($purchaseDetail instanceof PurchaseDetailInterface)
                {
                    $total += $purchaseDetail->getTotal();
                    $item = $purchaseDetail->getItem();
                    $item = $this->stockService->addStock($item, $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
                    if($purchaseDetail instanceof ClientStockCardInterface) 
                    {
                        $stockCard = $this->stockCardService->insertStockCard($item, $purchaseDetail);
                    }
                    
                    
                    $item = $this->priceService->updatePrincipalPrice($item, $purchaseDetail->getPrice(), $purchaseDetail->getPackaging());
                }
            }
            
            $entity->setTotal($total);
        }
        
        $this->purchaseRepo->save($entity);
        
        return $entity;
    }
}
