<?php
/**
 * Cette classe permet la création du formulaire de recherche
 * sur les actes de naissance
 *
 * @author Boyer Jimmy
 */
class SearchNaissanceForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
        'Id Acte' => new sfWidgetFormInput(),
        'Date Acte' => new sfWidgetFormDate(),

        'Nom Enfant' => new sfWidgetFormInput(),
        'Prenom Enfant' => new sfWidgetFormInput(),
        'Date Naissance' => new sfWidgetFormDate(),

//        'Nom Declarant' => new sfWidgetFormInput(),
//        'Prenom Declarant' => new sfWidgetFormInput(),

//        'Nom Pere' => new sfWidgetFormInput(),
//        'Prenom Pere' => new sfWidgetFormInput(),
//
//        'Nom Mere' => new sfWidgetFormInput(),
//        'Prenom Mere' => new sfWidgetFormInput(),

    ));

    $this->widgetSchema->setNameFormat('Recherche[%s]');

    $this->setValidators(array(
        'Id Acte' => new sfValidatorInteger(),
        'Date Acte' => new sfValidatorDate(),

        'Nom Enfant' => new sfValidatorString(),
        'Prenom Enfant' => new sfValidatorString(),
        'Date Naissance' => new sfValidatorDate(),

//        'Nom Declarant' => new sfValidatorString(),
//        'Prenom Declarant' => new sfValidatorString(),

//        'Nom Pere' => new sfValidatorString(),
//        'Prenom Pere' => new sfValidatorString(),
//
//        'Nom Mere' => new sfValidatorString(),
//        'Prenom Mere' => new sfValidatorString(),
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

    $widgetDate2 = $this->widgetSchema['Date Naissance'] =
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
