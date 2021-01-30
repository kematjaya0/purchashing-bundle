<?php

namespace Kematjaya\PurchashingBundle\Listener;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Service\PurchashingServiceInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchasingListener 
{
    /**
     * 
     * @var PurchashingServiceInterface
     */
    private $service;
    
    public function __construct(PurchashingServiceInterface $service) 
    {
        $this->service = $service;
    }
    
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if (!$entity instanceof PurchaseInterface) {
                continue;
            }
            
            $this->updatePurchase($entity);
        }
        
        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if (!$entity instanceof PurchaseInterface) {
                continue;
            }
            
            $this->updatePurchase($entity);
        }
        
        foreach($uow->getScheduledEntityDeletions() as $entity) {
            if (!$entity instanceof PurchaseInterface) {
                continue;
            }
            
            $this->updatePurchase($entity);
        }
    }
    
    private function updatePurchase(PurchaseInterface $entity)
    {
        $this->service->update($entity);
    }
}
