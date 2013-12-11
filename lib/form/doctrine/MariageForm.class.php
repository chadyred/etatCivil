<?php

/**
 * Mariage form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MariageForm extends BaseMariageForm
{
  public function configure()
  {
      $range = range('1903', date('Y')+2);


      $widgetDate = $this->widgetSchema['dateActe'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
          ));

//Enlever ce validator pour permettre d'enregistrer des mariages à l'avance
//      $this->validatorSchema['dateActe'] = new sfValidatorDate(
//              array(
//                 'max' => strtotime(date('d-m-Y'))
//          ));

      $widgetDate = $this->widgetSchema['dateMariage'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
          ));
      
      $widgetDate = $this->widgetSchema['dateReceptionContrat'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
          ));


      //Enlever ce validator pour permettre d'enregistrer des mariages à l'avance
      /*$this->validatorSchema['dateMariage'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));
       */
  }
}
