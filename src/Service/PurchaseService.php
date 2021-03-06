<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\PurchashingBundle\Repo\PurchaseRepoInterface;
use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\Packaging\Entity\PackagingInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Kematjaya\ItemPack\Lib\Stock\Entity\ClientStockCardInterface;
use Kematjaya\ItemPack\Service\StockServiceInterface;
use Kematjaya\ItemPack\Service\PriceLogServiceInterface;
use Kematjaya\ItemPack\Service\StockCardServiceInterface;
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
            PriceLogServiceInterface $priceService, 
            StockCardServiceInterface $stockCardService) 
    {
        $this->purchaseRepo = $purchaseRepo;
        $this->stockService = $stockService;
        $this->priceService = $priceService;
        $this->stockCardService = $stockCardService;
    }
    
    protected function getItemPackByPackagingOrSmallestUnit(ItemInterface $item, PackagingInterface $packaging = null):?ItemPackageInterface
    {
        if($item->getItemPackages()->isEmpty())
        {
            throw new \Exception('item package is empty');
        }
        return $item->getItemPackages()->filter(function (ItemPackageInterface $itemPackage) use ($packaging) {
            if($packaging)
            {
                return $packaging->getCode() === $itemPackage->getPackaging()->getCode();
            }
            return $itemPackage->isSmallestUnit();
        })->first();
    }
    
    public function countPrincipalPrice(ItemInterface $item, float $price, float $quantity, PackagingInterface $packaging = null) : float
    {
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        if($itemPack instanceof ItemPackageInterface)
        {
            $quantity = ($itemPack->isSmallestUnit()) ? $quantity : $quantity * $itemPack->getQuantity();
        }
        
        return $price / $quantity;
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
                    
                    $price = $this->countPrincipalPrice($item, $purchaseDetail->getTotal(), $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
                    $priceLog = $this->priceService->saveNewPrice($item, $price);
                }
            }
            
            $entity->setTotal($total);
        }
        
        $this->purchaseRepo->save($entity);
        
        return $entity;
    }
}
