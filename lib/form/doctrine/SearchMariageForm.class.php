<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Cette classe permet la création du formulaire de recherche
 * sur les actes de mariage
 *
 * @author Boyer Jimmy
 */
class SearchMariageForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
        'Id Acte' => new sfWidgetFormInput(),
        'Date Acte' => new sfWidgetFormDate(),

        'Nom Conjoint 1' => new sfWidgetFormInput(),
        'Prenom Conjoint 1' => new sfWidgetFormInput(),
        'Nom Conjoint 2' => new sfWidgetFormInput(),
        'Prenom Conjoint 2' => new sfWidgetFormInput()

    ));

    $this->widgetSchema->setNameFormat('Recherche[%s]');

    $this->setValidators(array(
        'Id Acte' => new sfValidatorInteger(),
        'Date Acte' => new sfValidatorDate(),

        'Nom Conjoint 1' => new sfValidatorString(),
        'Prenom Conjoint 1' => new sfValidatorString(),
        'Nom Conjoint 2' => new sfValidatorString(),
        'Prenom Conjoint 2' => new sfValidatorString()
    ));

    $range = range('1903', date('Y')+2);


    $widgetDate = $this->widgetSchema['Date Acte'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
    ));

    parent::setup();
  }
}
?>
