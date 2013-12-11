<?php

/**
 * image_RegistreNaissance actions.
 *
 * @package    etatCivil
 * @subpackage image_RegistreNaissance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class image_RegistreNaissanceActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Image_registreNaissance')
      ->createQuery('a')
        ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreNaissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->image_registre_naissance = Doctrine_Core::getTable('Image_registreNaissance')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->image_registre_naissance);
  }

  public function executeShowByNaissance(sfWebRequest $request)
  {
      $q = Doctrine_Core::getTable('Image_RegistreNaissance')
      ->createQuery('scan')
      ->where('scan.naissance_id=?', $request->getParameter('id'))
              ->orderBy("scan.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Image_registreNaissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    //$this->naissanceScan = $this->getRoute()->getObject();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Image_registreNaissanceForm();

    $this->form->setDefault('naissance_id', $request->getParameter('id'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Image_registreNaissanceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($image_registre_naissance = Doctrine_Core::getTable('Image_registreNaissance')->find(array($request->getParameter('id'))), sprintf('Object image_registre_naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new Image_registreNaissanceForm($image_registre_naissance);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($image_registre_naissance = Doctrine_Core::getTable('Image_registreNaissance')->find(array($request->getParameter('id'))), sprintf('Object image_registre_naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new Image_registreNaissanceForm($image_registre_naissance);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($image_registre_naissance = Doctrine_Core::getTable('Image_registreNaissance')->find(array($request->getParameter('id'))), sprintf('Object image_registre_naissance does not exist (%s).', $request->getParameter('id')));
    $this->naissance_id = $image_registre_naissance->getNaissanceId();

    $path = "uploads/scans_registre/naissance/";
    $image = $request->getParameter("scan");

    unlink($path.$image);

    $image_registre_naissance->delete();

    $this->redirect('show_scansRegistre_Naissance', array('id' => $this->naissance_id));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $image_registre_naissance = $form->save();

      $this->redirect('image_RegistreNaissance/showByNaissance?id='.$image_registre_naissance->getNaissanceId());
      //GF: Changé la redirection pour retourner sur la liste des documents et non la page d'informations principale
      //code de JB :
      //$this->redirect($this->generateUrl('DetailActeNaissance', array('id' => $image_registre_naissance->getNaissanceId())));
    }
  }

  /*
 * @auteur : Boyer jimmy
 * Cette fonction permet de retourner une proposition de
 * téléchargement du fichier que l'utilisateur souhaite
 * consulter.
 */
 public function executeDownload(sfWebRequest $request)
 {

     $local_file_path =  sfConfig::get('sf_upload_dir')."/scans_registre/naissance/".$request->getParameter("scan");
     $downloaded_filename = $request->getParameter("scan").".pdf";

     // On appel ici la méthode de telechargement du fichier
     // demander par l'utilisateur
     return LoaderTool::downloadContent($local_file_path, $downloaded_filename, false, 'application/pdf');

     
    
 }
}
