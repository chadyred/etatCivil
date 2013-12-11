<?php

/**
 * image_RegistreDeces actions.
 *
 * @package    etatCivil
 * @subpackage image_RegistreDeces
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class image_RegistreDecesActions extends sfActions
{
  /**
   * Affichage des Scan du registre avec une pagination
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Image_registreDeces')
      ->createQuery('a')
      ->execute();

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreDeces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  /**
   * Affiche le détails d'un Scan /!\ non utilisé dans l'application
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->image_registre_deces = Doctrine_Core::getTable('Image_registreDeces')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->image_registre_deces);
  }

  /**
   * Affiche tous les scans de l'acte selectionné avec une pagination
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShowByDeces(sfWebRequest $request)
  {
    $this->setTemplate('index');

    $q = Doctrine_Core::getTable('image_RegistreDeces')
      ->createQuery('a')
      ->where('a.deces_id=?', $request->getParameter('deces_id'))
              ->orderBy("a.id DESC");


    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreDeces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  /**
   * Affichage du formulaire d'ajout d'un nouveau scan
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Image_registreDecesForm();

    $this->form->setDefault('deces_id', $request->getParameter('deces_id'));
  }

  /**
   * Appel a la création du formulaire et à l'enregistrement dans la BDD
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Image_registreDecesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * @version 1.0
   * Suppression de l'acte dans la BDD, et sur le serveur
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($image_registre_deces = Doctrine_Core::getTable('Image_registreDeces')->find(array($request->getParameter('id'))), sprintf('Object image_registre_deces does not exist (%s).', $request->getParameter('id')));
    $this->deces_id = $image_registre_deces->getDecesId();
    
    $path = "uploads/scans_registre/deces/";
    $image = $request->getParameter("nomScan");

    unlink($path.$image);

    $image_registre_deces->delete();

    $this->redirect('show_scanRegistre_Deces', array('deces_id' => $this->deces_id));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $image_registre_deces = $form->save();

      $this->redirect('image_RegistreDeces/showByDeces?deces_id='.$image_registre_deces->getDecesId());
    }
  }

/**
 * @auteur : Boyer jimmy
 * Cette fonction permet de retourner une proposition de
 * téléchargement du fichier que l'utilisateur souhaite
 * consulté.
 */
 public function executeDownload(sfWebRequest $request)
 {
     $local_file_path = sfConfig::get('sf_upload_dir')."/scans_registre/deces/".$request->getParameter("scan");
     $downloaded_filename = $request->getParameter("scan").".pdf";

     // On appel ici la méthode de telechargement du fichier
     // demander par l'utilisateur
     return LoaderTool::downloadContent($local_file_path, $downloaded_filename, false, 'application/pdf');
 }
 
}
