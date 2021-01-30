<?php

namespace Kematjaya\PurchashingBundle\EventSubscriber;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Kematjaya\PurchashingBundle\Service\PurchaseService;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
/**
 * @deprecated since version 2.5, use Kematjaya\PurchashingBundle\Listener\PurchasingListener instead 
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseEventSubscriber implements EventSubscriber
{
    private $purchaseService;
    
    public function __construct(PurchaseService $purchaseService) 
    {
        $this->purchaseService = $purchaseService;
    }
    
    public function getSubscribedEvents() {
        return [
            Events::onFlush
        ];
    }
    
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();
        
        foreach ($uow->getScheduledEntityInsertions() as $entity) 
        {
            if ($entity instanceof PurchaseInterface) {
                $this->updatePurchase($entity);
            }
        }
        
        foreach ($uow->getScheduledEntityUpdates() as $entity) 
        {
            if ($entity instanceof PurchaseInterface) {
                $this->updatePurchase($entity);
            }
        }
        
        foreach($uow->getScheduledEntityDeletions() as $entity) 
        {
            if ($entity instanceof PurchaseInterface) {
                $this->updatePurchase($entity);
            }
        }
    }
    
    private function updatePurchase(PurchaseInterface $entity)
    {
        $this->purchaseService->update($entity);
    }
}
