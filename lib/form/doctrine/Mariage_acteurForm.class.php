<?php

/**
 * Mariage_acteur form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Mariage_acteurForm extends BaseMariage_acteurForm
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
        
        $this->widgetSchema['mariage_id'] =
              new sfWidgetFormInputHidden();
        $this->widgetSchema['typeActeur'] =
              new sfWidgetFormInputHidden();

        $this->validatorSchema['dateNaissance'] = new sfValidatorDate(
              array(
                 'max' => strtotime(date('d-m-Y')
              )));
    }
}