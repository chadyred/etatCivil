<?php

/**
 * mention_marginalenaissance actions.
 *
 * @package    etatCivil
 * @subpackage mention_marginalenaissance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mention_marginalenaissanceActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Mention_marginaleNaissance')
      ->createQuery('a')
        ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleNaissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mention_marginale_naissance = Doctrine_Core::getTable('Mention_marginaleNaissance')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mention_marginale_naissance);
  }

  public function executeShowByNaissance(sfWebRequest $request)
  {
      $q = Doctrine::getTable('Mention_marginaleNaissance')
      ->createQuery('a')
      ->where("naissance_id=?", $request->getParameter('id'))
        ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleNaissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

      $this->naissanceMM = $this->getRoute()->getObject();

      $this->setTemplate("index");
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Mention_marginaleNaissanceForm();
    
    $this->form->setDefault('naissance_id', $request->getParameter('id'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Mention_marginaleNaissanceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mention_marginale_naissance = Doctrine_Core::getTable('Mention_marginaleNaissance')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleNaissanceForm($mention_marginale_naissance);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mention_marginale_naissance = Doctrine_Core::getTable('Mention_marginaleNaissance')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleNaissanceForm($mention_marginale_naissance);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mention_marginale_naissance = Doctrine_Core::getTable('Mention_marginaleNaissance')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_naissance does not exist (%s).', $request->getParameter('id')));
    $mention_marginale_naissance->delete();

    $this->redirect('mention_marginalenaissance/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mention_marginale_naissance = $form->save();

      $this->redirect($this->generateUrl('DetailActeNaissance', array('id' => $mention_marginale_naissance->getNaissanceId())));
    }
  }
}
