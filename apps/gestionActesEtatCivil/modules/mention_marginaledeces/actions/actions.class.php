<?php

/**
 * mention_marginaledeces actions.
 *
 * @package    etatCivil
 * @subpackage mention_marginaledeces
 * @author     Boyer Jimmy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mention_marginaledecesActions extends sfActions
{
    /**
     * Cette fonction permet d'afficher la liste des mentions marginales.
     *
     * @author Boyer Jimmy
     * @param sfWebRequest $request
     */
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Core::getTable('Mention_marginaleDeces')
      ->createQuery('a')
            ->orderBy('a.id DESC');

        // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleDeces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
  }

  /**
   * Cette fonction affiche les details de la mention marginale
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->mention_marginale_deces = Doctrine_Core::getTable('Mention_marginaleDeces')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mention_marginale_deces);
  }

  /**
   * Cette fonction permet d'afficher la liste des mentions marginales 
   * de l'acte de deces, avec une pagination
   * 
   * @author Boyer Jimmy
   * @param sfWebRequest $request 
   */
  public function executeShowByDeces(sfWebRequest $request)
  {
      $q = Doctrine_Core::getTable('Mention_marginaleDeces')
      ->createQuery('a')
      ->where("deces_id=?", $request->getParameter('deces_id'))
                  ->orderBy('a.id DESC');

        // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mention_marginaleDeces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

      $this->setTemplate("index");
  }

  /**
   * Créée le formulaire pour la nouvelle mention marginale
   * et défini le deces_id de l'acte
   *
   * @authorBoyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Mention_marginaleDecesForm();

    // Cette commande permet de definir la relation entre le mariage et l'acteur automatiquement
    $this->form->setDefault('deces_id', $request->getParameter("deces_id"));
  }

  /**
   * Création du formaulaire pour la mention et appel a la methide
   * process pour l'enregistrement dans la BDD
   *
   * @author Boyer jimmy
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Mention_marginaleDecesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Affiche le formulaire d'edition de la mention selectionnée
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mention_marginale_deces = Doctrine_Core::getTable('Mention_marginaleDeces')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_deces does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleDecesForm($mention_marginale_deces);
  }

  /**
   * Met à jour dans la base de donnée les information modifié
   * du formulaire d'édition
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mention_marginale_deces = Doctrine_Core::getTable('Mention_marginaleDeces')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_deces does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mention_marginaleDecesForm($mention_marginale_deces);

    $this->processForm($request, $this->form);

    $this->setTemplate('show');
  }

  /**
   * Suppression de la mention en question dans la BDD
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mention_marginale_deces = Doctrine_Core::getTable('Mention_marginaleDeces')->find(array($request->getParameter('id'))), sprintf('Object mention_marginale_deces does not exist (%s).', $request->getParameter('id')));
    $mention_marginale_deces->delete();

    $this->redirect('mention_marginaledeces/index');
  }

  /**
   * Enregistrement de la mention dans la BDD
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   * @param sfForm $form
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mention_marginale_deces = $form->save();

      $this->redirect('mention_marginaledeces/show?id='.$mention_marginale_deces->getId());
    }
  }
}
