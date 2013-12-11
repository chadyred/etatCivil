<?php

/**
 * image_RegistreMariage actions.
 *
 * @package    etatCivil
 * @subpackage image_RegistreMariage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class image_RegistreMariageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Image_registreMariage')
      ->createQuery('a')
                  ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreMariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->image_registre_mariage = Doctrine_Core::getTable('Image_registreMariage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->image_registre_mariage);

    $this->image_registre_mariage->telechargeMoi($request->getParameter("scan"));
  }


  // permet l'affichage des acteurs propre a un mariage
  public function executeShowByMariage(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('image_RegistreMariage')
      ->createQuery('a')
      ->where('a.mariage_id=?', $request->getParameter('mariage_id'))
                  ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreMariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    $this->setTemplate('index');
  }

/*
 * @auteur : Boyer jimmy
 * Cette fonction permet de retourner une proposition de
 * téléchargement du fichier que l'utilisateur souhaite
 * consulté.
 */
 public function executeDownload(sfWebRequest $request)
 {
     $local_file_path = sfConfig::get('sf_upload_dir')."/scans_registre/mariage/".$request->getParameter("scan");
     $downloaded_filename = $request->getParameter("scan").".pdf";

     // On appel ici la méthode de telechargement du fichier
     // demander par l'utilisateur
     return LoaderTool::downloadContent($local_file_path, $downloaded_filename, false, 'application/pdf');
 }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Image_registreMariageForm();

    $this->form->setDefault("mariage_id", $request->getParameter("id"));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Image_registreMariageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($image_registre_mariage = Doctrine_Core::getTable('Image_registreMariage')->find(array($request->getParameter('id'))), sprintf('Object image_registre_mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new Image_registreMariageForm($image_registre_mariage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($image_registre_mariage = Doctrine_Core::getTable('Image_registreMariage')->find(array($request->getParameter('id'))), sprintf('Object image_registre_mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new Image_registreMariageForm($image_registre_mariage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($image_registre_mariage = Doctrine_Core::getTable('Image_registreMariage')->find(array($request->getParameter('id'))), sprintf('Object image_registre_mariage does not exist (%s).', $request->getParameter('id')));
    $this->mariage_id = $image_registre_mariage->getMariageId();

    $path = "uploads/scans_registre/mariage/";
    $image = $request->getParameter("nomScan");

    unlink($path.$image);

    $image_registre_mariage->delete();

    $this->redirect('show_scanRegistre_Mariage', array('mariage_id' => $this->mariage_id));  // /!\ "marriage_id" et non "id" comme pour naissance
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $image_registre_mariage = $form->save();

      $this->redirect('image_RegistreMariage/showByMariage?mariage_id='.$image_registre_mariage->getMariageId());
      //GF: Changé la redirection pour retourner sur la liste des documents et non la page d'informations principale
      //code de JB :
      //$this->redirect($this->generateUrl('DetailActeMariage', array('id' => $image_registre_mariage->getMariageId())));
    }
  }
}
