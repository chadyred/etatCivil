<?php

/**
 * Naissance_enfant form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Naissance_enfantForm extends BaseNaissance_enfantForm
{
  public function configure()
  {
      $range = range('1903', date('Y')+2);


      $widgetDate = $this->widgetSchema['dateNaissance'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                                            'format' => '%day%/%month%/%year%',
                                                                            'years' => array_combine($range, $range) ))
          ));

      $widgetDate2 = $this->widgetSchema['dateMariageParents'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                                            'format' => '%day%/%month%/%year%',
                                                                            'years' => array_combine($range, $range) ))
          ));

       $this->widgetSchema['naissance_id'] =
              new sfWidgetFormInputHidden();

       $this->validatorSchema['dateNaissance'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));
       

       // Met la vérification sur la date de mariage des parents
       /*$this->validatorSchema['dateMariageParents'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));*/

       
  }
}
