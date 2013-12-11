<?php

/**
 * Image_registreNaissance form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Image_registreNaissanceForm extends BaseImage_registreNaissanceForm
{
    public function configure()
    {
        $this->widgetSchema['nomImage'] = new sfWidgetFormInputFile (
                array(
                   'label' => 'nom du Scan :',
                ));

        $this->validatorSchema['nomImage'] = new sfValidatorFile (
                array(
                    'required' => true,
                    'path' =>  'uploads/scans_registre/naissance',
                    'mime_types' => array('application/pdf') ),
                                    array ('invalid' => 'Fichier invalide.',
                                           'required' => 'Selectionner votre pdf à enregistrer.',
                                           'mime_types' => 'Le fichier doit être au format pdf.'

                ));


        $this->widgetSchema['naissance_id'] =
              new sfWidgetFormInputHidden();
    }
}
