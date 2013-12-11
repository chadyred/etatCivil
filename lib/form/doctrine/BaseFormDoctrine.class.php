<?php

/**
 * Project form base class.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    $context = sfContext::getInstance();

    if(isset($this["lieuDeces"]))
    {
      /*$this->setWidget('lieuDeces', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getCitys'),
        'value_callback' => array("Ville_france","getVilleCP")
      )));*/

      $this->widgetSchema['lieuDeces'] = new sfWidgetFormJQueryAutocompleter(array(
       'url'    => $context->getController()->genUrl('@ajax_getCitys'),
       'config' => '{ extraParams: { second_parametre: function() { return jQuery("#id_html").val(); } },
                      scrollHeight: 600 ,
                      autoFill: false }'
       ));

    }

    if(isset($this["lieuNaissanceDefunt"]))
    {
      $this->setWidget('lieuNaissanceDefunt', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getCitys'),
        'value_callback' => array("Ville_france","getVilleCP")
      )));
    }

    if(isset($this["lieuNaissance"]))
    {
      $this->setWidget('lieuNaissance', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getCitys'),
        'value_callback' => array("Ville_france","getVilleCP")
      )));
    }

    if(isset($this["nomPrenomNotaire"]))
    {
      $this->setWidget('nomPrenomNotaire', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getNotaires'),
        'value_callback' => array("Notaires","getNPNotaire")
      )));
    }
    if(isset($this["officierEtatCivil"]))
    {
      $this->setWidget('officierEtatCivil', new sfWidgetFormJQueryAutocompleter(array(
        'url'   =>  $context->getController()->genUrl('@ajax_getOfficiers'),
        'value_callback' => array("Officiers","getNPOfficier")
      )));
    }








    parent::setup();
  }
}
