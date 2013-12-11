<?php

/**
 * Deces form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DecesForm extends BaseDecesForm
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

      $widgetDate2 = $this->widgetSchema['dateDeces'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
      ));


      $widgetDate2 = $this->widgetSchema['dateNaissanceDefunt'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
      ));

      $widgetDate3 = $this->widgetSchema['dateTranscription'] =
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

      $this->validatorSchema['dateDeces'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));

      $this->validatorSchema['dateNaissanceDefunt'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));

      $this->validatorSchema['dateTranscription'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));

    }


}
