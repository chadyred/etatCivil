<?php

/**
 * Project filter form base class.
 *
 * @package    etatCivil
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
public function setup()
  {
    $context = sfContext::getInstance();

    if(isset($this["lieuDeces"]))
    {
      $this->setWidget('lieuDeces', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getCitys'),
        'value_callback' => array(Doctrine::getTable('Ville_france'), "__toString" )
      )));
    }
    parent::setup();
  }
}
