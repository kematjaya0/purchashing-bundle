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
        if($obj instanceof PurchaseDetailInterface)
        {
            $form = $event->getForm();
            
            $quantityAttr = ($form->has('quantity')) ? $form->get('quantity')->getConfig()->getOption('attr') : [];
            $quantityAttr['onchange'] = 'return countTotal()';
            $form->add('quantity', NumberType::class, [
                'label' => 'quantity', 'html5' => true,
                'attr' => $quantityAttr
            ]);
            
            $priceAttr = ($form->has('price')) ? $form->get('price')->getConfig()->getOption('attr') : [];
            $priceAttr['onchange'] = 'return countTotal()';
            if(!isset($priceAttr['class']))
            {
                $priceAttr['class'] = ' ';
            }
            $priceAttr['class'] = (strpos('priceformat', $priceAttr['class']) !== false) ? trim($priceAttr['class']) : trim($priceAttr['class'] . ' priceformat');
            $form->add('price', PriceType::class, [
                'label' => 'price',
                'attr' => $priceAttr
            ]);
            
            $taxAttr = ($form->has('tax')) ? $form->get('tax')->getConfig()->getOption('attr') : [];
            $taxAttr['onchange'] = 'return countTotal()';
            if(!isset($taxAttr['class']))
            {
                $taxAttr['class'] = ' ';
            }
            $taxAttr['class'] = (strpos('priceformat', $taxAttr['class']) !== false) ? trim($taxAttr['class']) : trim($taxAttr['class'] . ' priceformat');
            $form->add('tax', PriceType::class, [
                'label' => 'tax',
                'attr' => $taxAttr
            ]);
            
            $totalAttr = ($form->has('total')) ? $form->get('total')->getConfig()->getOption('attr') : [];
            $quantityAttr['readonly'] = true;
            if(!isset($quantityAttr['class']))
            {
                $quantityAttr['class'] = ' ';
            }
            $quantityAttr['class'] = (strpos('priceformat', $quantityAttr['class']) !== false) ? trim($quantityAttr['class']) : trim($quantityAttr['class'] . ' priceformat');
            $form->add('total', PriceType::class, [
                'label' => 'total',
                'attr' => $quantityAttr
            ]);
        }
    }
    
    public function postSubmit(FormEvent $event)
    {
        $obj = $event->getData();
        if($obj instanceof PurchaseDetailInterface)
        {
            
        }
    }
}
