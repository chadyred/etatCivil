<?php

/**
 * Naissance form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NaissanceForm extends BaseNaissanceForm
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

      $widgetDate = $this->widgetSchema['dateReconnaissance'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                                            'format' => '%day%/%month%/%year%',
                                                                            'years' => array_combine($range, $range) ))


      ));

      $this->validatorSchema['dateActe'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));

  }
}
