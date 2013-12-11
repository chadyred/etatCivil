<?php

/**
 * Mention_marginaleMariage form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Mention_marginaleMariageForm extends BaseMention_marginaleMariageForm
{
  public function configure()
  {
      $range = range('1903', date('Y')+2);


      $widgetDate = $this->widgetSchema['dateAjout'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))


          ));

            $this->widgetSchema['mariage_id'] =
              new sfWidgetFormInputHidden();
  }
}
