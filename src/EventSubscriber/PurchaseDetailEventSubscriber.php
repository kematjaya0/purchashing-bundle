<?php

namespace Kematjaya\PurchashingBundle\EventSubscriber;

use Kematjaya\PurchashingBundle\Entity\PurchaseDetailInterface;
use Kematjaya\Currency\Type\PriceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseDetailEventSubscriber implements EventSubscriberInterface 
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }
    
    public function preSetData(FormEvent $event)
    {
        $obj = $event->getData();
        if (!$obj instanceof PurchaseDetailInterface) {
            
            return;
        }
        
        $form = $event->getForm();
        $form
                ->add('quantity', NumberType::class, [
                    'label' => 'quantity', 'html5' => true,
                ])
                ->add('price', PriceType::class, [
                    'label' => 'price',
                ])
                ->add('tax', PriceType::class, [
                    'label' => 'tax'
                ])
                ->add('total', PriceType::class, [
                    'label' => 'total'
                ]);
    }
    
    public function postSubmit(FormEvent $event)
    {
        $obj = $event->getData();
        if (!$obj instanceof PurchaseDetailInterface) {
            
            return;
        }
        
        $total = ($obj->getQuantity() * $obj->getPrice()) + $obj->getTax();
        $obj->setTotal($total);
        
        $event->setData($obj);
    }
}
