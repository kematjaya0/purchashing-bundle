<?php

namespace Kematjaya\PurchashingBundle\EventSubscriber;

use Kematjaya\PurchashingBundle\Entity\PurchaseInterface;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class PurchaseFormEventSubscriber implements EventSubscriberInterface 
{
    private $propertyInfoExtractor;
    
    public function __construct(PropertyInfoExtractorInterface $propertyInfoExtractor) 
    {
        $this->propertyInfoExtractor = $propertyInfoExtractor;
    }
    
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit'
        ];
    }
    
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        if($data instanceof PurchaseInterface)
        {
            $camelToSnakeCase = function ($input)
            {
                preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
                $ret = $matches[0];
                foreach ($ret as &$match) {
                  $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
                }
                return implode('_', $ret);  
            };
            $form = $event->getForm();
            if($data->getIsLocked())
            {
                foreach ($this->propertyInfoExtractor->getProperties(get_class($data)) as $prop)
                {
                    $name = $camelToSnakeCase($prop);
                    if($form->has($name))
                    {
                        $attr = $form->get($name)->getConfig()->getOptions();
                        $attr['attr']['readonly'] = true;
                        $form->add($name, null, $attr);
                    }
                }   
                $form->add('is_locked', HiddenType::class);
            } else 
            {
                if($data->getPurchaseDetails()->isEmpty())
                {
                    $form->add('is_locked', HiddenType::class);
                }
            }
        }
        
    }
    
    public function postSubmit(FormEvent $event)
    {
        $obj = $event->getData();
        if($obj instanceof PurchaseInterface)
        {
            
        }
    }
}
