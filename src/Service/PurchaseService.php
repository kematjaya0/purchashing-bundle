<?php

namespace Kematjaya\PurchashingBundle\Service;

use Kematjaya\PurchashingBundle\Repo\PurchaseRepoInterface;
use Kematjaya\ItemPack\Service\ServiceTrait;
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
class PurchaseService implements PurchashingServiceInterface
{
    /**
     * 
     * @var PurchaseRepoInterface
     */
    protected $purchaseRepo;
    
    /**
     * 
     * @var StockServiceInterface
     */
    protected $stockService;
    
    /**
     * 
     * @var PriceLogServiceInterface
     */
    protected $priceService;
    
    /**
     * 
     * @var StockCardServiceInterface
     */
    protected $stockCardService;
    
    use ServiceTrait;
    
    function __construct(PurchaseRepoInterface $purchaseRepo, StockServiceInterface $stockService, PriceLogServiceInterface $priceService, StockCardServiceInterface $stockCardService) 
    {
        $this->purchaseRepo = $purchaseRepo;
        $this->stockService = $stockService;
        $this->priceService = $priceService;
        $this->stockCardService = $stockCardService;
    }
    
    
    public function update(PurchaseInterface $entity):PurchaseInterface
    {
        
        if(!$entity->getIsLocked()) {
            return $entity;
        }
        
        $entity->setTotal($this->countTotal($entity));
        
        $this->purchaseRepo->save($entity);
        
        return $entity;
    }
    
    public function countTotal(PurchaseInterface $entity):float
    {
        $total = 0;
        foreach($entity->getPurchaseDetails() as $purchaseDetail) {
            if(!$purchaseDetail instanceof PurchaseDetailInterface) {
                continue;
            }
            
            $total += $purchaseDetail->getTotal();
            $item = $this->stockService->addStock($purchaseDetail->getItem(), $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
            if($purchaseDetail instanceof ClientStockCardInterface) {
                $this->stockCardService->insertStockCard($item, $purchaseDetail);
            }

            $price = $this->countPrincipalPrice($item, $purchaseDetail->getTotal(), $purchaseDetail->getQuantity(), $purchaseDetail->getPackaging());
            $this->priceService->saveNewPrice($item, $price);
        }
        
        return $total;
    }
    
    protected function countPrincipalPrice(ItemInterface $item, float $price, float $quantity, PackagingInterface $packaging) : float
    {
        $itemPack = $this->getItemPackByPackagingOrSmallestUnit($item, $packaging);
        if(!$itemPack instanceof ItemPackageInterface) {
            throw new \Exception(sprintf('cannot found item package for item %s', $item->getCode()));
        }
        
        $smallestQuantity = ($itemPack->isSmallestUnit()) ? $quantity : $quantity * $itemPack->getQuantity();
        
        return $price / $smallestQuantity;
    }
}
