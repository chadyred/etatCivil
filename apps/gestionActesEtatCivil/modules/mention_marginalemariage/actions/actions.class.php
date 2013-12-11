<?php

/**
 * mention_marginalemariage actions.
 *
 * @package    etatCivil
 * @subpackage mention_marginalemariage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mention_marginalemariageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Mention_marginaleMariage')
      ->createQuery('a')
                ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleMariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mention_marginale_mariage = Doctrine_Core::getTable('Mention_marginaleMariage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mention_marginale_mariage);
  }

  public function executeShowByMariage(sfWebRequest $request)
  {
      $q = Doctrine_Core::getTable('Mention_marginaleMariage')
      ->createQuery('a')
      ->where("mariage_id=?", $request->getParameter('mariage_id'))
                      ->orderBy("a.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleMariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

      $this->setTemplate("index");
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Mention_marginaleMariageForm();

    // Cette commande permet de definir la relation entre le mariage et l'acteur automatiquement
    $this->form->setDefault('mariage_id', $request->getParameter("mariage_id"));

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Mention_marginaleMariageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mention_marginale_mariage = Doctrine_Core::getTable('Mention_marginaleMariage')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleMariageForm($mention_marginale_mariage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mention_marginale_mariage = Doctrine_Core::getTable('Mention_marginaleMariage')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleMariageForm($mention_marginale_mariage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mention_marginale_mariage = Doctrine_Core::getTable('Mention_marginaleMariage')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_mariage does not exist (%s).', $request->getParameter('id')));
    $mention_marginale_mariage->delete();

    $this->redirect('mention_marginalemariage/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mention_marginale_mariage = $form->save();

      $this->redirect('mention_marginalemariage/edit?id='.$mention_marginale_mariage->getId());
    }
  }
}
