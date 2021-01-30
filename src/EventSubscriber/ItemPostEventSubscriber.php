<?php

namespace Kematjaya\PurchashingBundle\EventSubscriber;

use Kematjaya\ItemPack\Lib\Item\Entity\ItemInterface;
use Kematjaya\ItemPack\Lib\ItemPackaging\Entity\ItemPackageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ItemPostEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'postSetData',
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }
    
    public function postSetData(FormEvent $event)
    {
        $this->changePackaging($event->getForm()->getParent(), $event->getForm()->getData());
    }
    
    public function postSubmit(FormEvent $event)
    {
        $this->changePackaging($event->getForm()->getParent(), $event->getForm()->getData());
    }
    
    private function changePackaging(FormInterface $form, ItemInterface $item = null)
    {
        
        if (!$item) {
            return;
        }
        
        $choices = [];
        foreach ($item->getItemPackages() as $itemPackage) {
            if (!$itemPackage instanceof ItemPackageInterface) {
                continue;
            }
            
            $choices[] = $itemPackage->getPackaging();
        }
        
        $form->add('packaging', null, [
            'label' => 'packaging',
            'choices' => $choices, "required" => true
        ]);
    }
}
