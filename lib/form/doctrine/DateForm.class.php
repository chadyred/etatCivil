<?php

/**
 * Mariage form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Boyer jimmy
 */
class DateForm extends BaseMariageForm
{
  public function configure()
  {
    $this->setWidgets(array(

      'Date' => new sfWidgetFormDate(),
    ));

    $this->widgetSchema->setNameFormat('Recherche[%s]');

    $this->setValidators(array(
      'Date' => new sfValidatorDate()
    ));

    $range = range('1903', date('Y')+2);


    $widgetDate = $this->widgetSchema['Date'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%year%',
                                                    'years' => array_combine($range, $range) ))
          ));

  }
}
?>
