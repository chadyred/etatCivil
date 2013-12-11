<?php

/**
 * mariage actions.
 *
 * @package    etatCivil
 * @subpackage mariage
 * @author     Boyer Jimmy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mariageActions extends sfActions
{

  /**
   * Cette fonction permet d'afficher tous les actes de mariages déja
   * enregistrés. Une pagination est effectué et affiche les actes par 20.
   * 
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {

    $q = Doctrine_Query::create()
    ->from('Mariage m')
          ->orderBy("m.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Mariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    $this->mariages = $q->execute();

  }

  /**
   * Cette fonction permet d'afficher le détail d'un acte de mariages.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->mariage = Doctrine_Core::getTable('Mariage')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mariage);
  }

  /**
   * Cette fonction permet de créer le formulaire d'un nouvel acte de mariages.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MariageForm();
  }

  /**
   * Cette fonction permet d'afficher le formulaire de création d'un acte
   * de mariages.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {

    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MariageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

    /**
   * Cette fonction permet d'entré en édition sur l'acte de mariages selectionné.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mariage = Doctrine_Core::getTable('Mariage')->find(array($request->getParameter('id'))), sprintf('Object mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new MariageForm($mariage);
  }

  /**
   * Cette fonction permet d'insérrer dans la BDD les informations de l'acte 
   * de mariages modifié.
   * 
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mariage = Doctrine_Core::getTable('Mariage')->find(array($request->getParameter('id'))), sprintf('Object mariage does not exist (%s).', $request->getParameter('id')));
    $this->form = new MariageForm($mariage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * Cette fonction permet de supprimer l'acte de mariages selectionné.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mariage = Doctrine_Core::getTable('Mariage')->find(array($request->getParameter('id'))), sprintf('Object mariage does not exist (%s).', $request->getParameter('id')));
    $mariage->delete();

    $this->redirect('mariage/index');
  }

    /**
   * @version 1.0
   *
   *  fonction permet de rechercher l'acte de mariage depuis les formulaires
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeSearch(sfWebRequest $request)
  {
      // Création et affichage de notre formulaire de recherche
 
      $this->form = new SearchMariageForm();
  }


  /**
   * Cette fonction permet d'afficher la liste des résultats de la recherche
   * Elle gere une pagination en conservant la requete de la recherche
   * dans un attribut flash de l'utilisateur "sf_user"
   *
   * @author Boyer jimmy
   * @param sfWebRequest $request
   */
  public function executeResult(sfWebRequest $request)
  {
      
      // Pour que l'affichage des resultats soit correct, il faut stocker
      // les informations saisies dans le formulaire de recherche.

      // Pour cela on test si la requete demande une pagination
      if(!$request->hasParameter("page"))
      {
        // Si non, on recupère le parametre envoyer par le formulaire
        $recherche = $request->getParameter("Recherche");
        // et on stock ce parametre dans un attribut flash de l'utilisateur
        $this->getUser()->setAttribute('RechercheC', $recherche);
      } else {
        // Si une pagination est demander, cela signifi que l'affichage des premiers
        // résultats à déja été effectuer, et que la requete ne contien plus nos infos
        // du formulaire de recherche. On les récupère donc dans l'attribut flash stocker dans notre user.
        $recherche = $this->getUser()->getAttribute('RechercheC');
      }

      /*
      * C'est ici que l'on construit la requete SQL permettant la recherche multi-critere
      * Elle s'appui sur le requetage SQL ==> LIKE %VALUE%
      * Pour rajouter un champs il suffira d'ajouter un élement dans le
      * formulaire de recherche ( SearchMariageForm ) Puis d'ajouter une ligne
      * "andWhere" similaire a celles ci dessous
      */
      $q = Doctrine_Query::create()
        ->select('DISTINCT *')
        ->from("mariage m")
        ->leftJoin("mariage_acteur m2 on m.id = m2.mariage_id")
        ->where("m.id = m2.mariage_id")
        ->andwhere("m.id LIKE ?"                ,"%".$recherche["Id Acte"]."%")
        ->andWhere("YEAR(m.dateActe) LIKE ?"    ,"%".$recherche["Date Acte"]["year"]."%")
        ->andWhere("MONTH(m.dateActe) LIKE ?"   ,"%".$recherche["Date Acte"]["month"]."%")
        ->andWhere("DAY(m.dateActe) LIKE ?"     ,"%".$recherche["Date Acte"]["day"]."%")

        ->andWhere("m2.prenom LIKE ?"           ,"%".$recherche["Prenom Conjoint 1"]."%")
        ->andWhere("m2.nom LIKE ?"              ,"%".$recherche["Nom Conjoint 1"]."%")
        ->andWhere("m2.prenom LIKE ?"           ,"%".$recherche["Prenom Conjoint 2"]."%")
        ->andWhere("m2.nom LIKE ?"              ,"%".$recherche["Nom Conjoint 2"]."%");

//      $q = Doctrine_Query::create()
//  ->from('User u')
//  ->where('u.id NOT IN (SELECT u.id FROM mariage_acteur m_a INNER JOIN u2.Groups g WHERE g.name = ?)', 'Group 2');


//      $q = Doctrine_Query::create()
//        ->select('*')
//        ->from("mariage m")
//
//        ->where("m.id LIKE ?"                ,"%".$recherche["Id Acte"]."%")
//        ->andWhere("YEAR(m.dateActe) LIKE ?"    ,"%".$recherche["Date Acte"]["year"]."%")
//        ->andWhere("MONTH(m.dateActe) LIKE ?"   ,"%".$recherche["Date Acte"]["month"]."%")
//        ->andWhere("DAY(m.dateActe) LIKE ?"     ,"%".$recherche["Date Acte"]["day"]."%")
//        ->andWhere("m.id IN (SELECT m_a.mariage_id
//                             FROM mariage_acteur m_a
//                             WHERE m_a.prenom LIKE ?","%".$recherche["Prenom Conjoint1"]."%")
//         ;

      
//      $q = Doctrine_Query::create()
//        ->select('*')
//        ->from("mariage, mariage_acteur")
//        ->where("mariage.id=mariage_acteur.mariage_id")
//        ->andwhere("m.id LIKE ?"                ,"%".$recherche["Id Acte"]."%")
//        ->andWhere("YEAR(m.dateActe) LIKE ?"    ,"%".$recherche["Date Acte"]["year"]."%")
//        ->andWhere("MONTH(m.dateActe) LIKE ?"   ,"%".$recherche["Date Acte"]["month"]."%")
//        ->andWhere("DAY(m.dateActe) LIKE ?"     ,"%".$recherche["Date Acte"]["day"]."%")
        //->andWhere("m_a.prenom LIKE ?"          ,"%".$recherche["Prenom Conjoint1"]."%")
         




//            AND m_a.nom LIKE '%".$recherche["Prenom Conjoint1"]."%'
//            AND m_a.prenom LIKE '%".$recherche["Prenom Conjoint2"]."%'
//            AND m_a.nom LIKE '%".$recherche["Nom Conjoint2"]."%'")


        

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);
    // on conserve la recherche
    $this->RechercheC = $recherche;
    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);
    // On demande a notre plugin d'afficher nbResult résultats par page
    $this->pager = new sfDoctrinePager('Mariage', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    //var_dump($this->pager);
   // die;
    // On stock dans une variable ( ci besoin ) le nombre de de résultats total
    $this->lastId = $q->count();
  }




    /**
   * Cette fonction permet d'enregisrter les données d'un formulaire dans la BDD.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mariage = $form->save();
  
      $this->redirect('mariage/show?id='.$mariage->getId());
    }
  }

  /**
   * Fonction permettant la génération de l'acte de Mariage, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeMariage(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $pereEpx = $conjoint1->getPere();
    $mereEpx = $conjoint1->getMere();

    $conjoint2 = $mariage->getConjoint2();
    $pereEps = $conjoint2->getPere();
    $mereEps = $conjoint2->getMere();

    // On part du principe que tous les contacts ont une adresse propre
    $ilFautDeuxAdresse = true;
    
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On merge l'en tete du document
    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    $doc->mergeXmlField('PrenomNomConjoint1', $conjoint1->getPrenom()." ".$conjoint1->getNom());
    $doc->mergeXmlField('PrenomNomConjoint2', $conjoint2->getPrenom()." ".$conjoint2->getNom());
    
    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte en toute lettre
    $madate = strtotime($mariage->getDateMariage());
    $dateLettre = $this->getDateEnLettre($madate,1);
    // on la remplace dans le document
   
    $doc->mergeXmlField('dateLettre',$dateLettre);
    $doc->mergeXmlField('heure', $this->getHeureEnLettre($mariage->getHeureActe()));

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('PrenomNomConjoint1', $conjoint1->getPrenom()." ".$conjoint1->getNom());
        $doc->mergeXmlField('professionConjoint1', $conjoint1->getProfession());
        
        if($conjoint1->getSexe()=="homme")
        {
             $doc->mergeXmlField('lieuNaissanceConjoint1', "né à ".Ville_france::getVilleDepartement($conjoint1->getLieuNaissance()));
        }
        else
        {
             $doc->mergeXmlField('lieuNaissanceConjoint1', "née à ".Ville_france::getVilleDepartement($conjoint1->getLieuNaissance()));
            
        }
        
        // le substr qui suit sert à couper l'espace qui se trouve à la fin de la chaine de caractères renvoyée par getDateEnLettre
        // (0: on commence au premier caractère, -1: on coupe le dernier caractère)
        $doc->mergeXmlField('dateNaissanceConjoint1', substr($this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),1), 0, -1));
        
        if($conjoint1->getSexe()=="homme")
        {
            $doc->mergeXmlField('domicileConjoint1', ", domicilié à ".$conjoint1->getDomicile());
        }
        else
        {
             $doc->mergeXmlField('domicileConjoint1', ", domiciliée à ".$conjoint1->getDomicile());
        }
            
            
        if ($pereEpx != null && $mereEpx != null)
        {
            if ($pereEpx->getDomicile()!=$mereEpx->getDomicile())
                $ilFautDeuxAdresse = true;
            else
                $ilFautDeuxAdresse = false;
        }

        // Ssi le pere de l'époux est présent, on merge les balises correspondantes
        if($pereEpx != null)
        {      
            
            if($conjoint1->getSexe()=="homme")
            {           
                $doc->mergeXmlField('nomPrenomPereConjoint1', "fils de ".$pereEpx->getPrenom()." ". $pereEpx->getNom());
            }
            else
            {
                 $doc->mergeXmlField('nomPrenomPereConjoint1', "fille de ".$pereEpx->getPrenom()." ". $pereEpx->getNom()); 
            }
            
            if ($pereEpx->getInfo() != "décédé(e)")
            {
                $doc->mergeXmlField('professionPereConjoint1', $pereEpx->getProfession());
                // Si il faut deux adresses, on met celle du pere, sinon elle apparaitre apres les infos de la mere
                if ($ilFautDeuxAdresse == true){
                    $doc->mergeXmlField('domicilePereConjoint1', ", domicilié à ".$pereEpx->getDomicile());
                } else $doc->mergeXmlField('domicilePereConjoint1', "");

                $doc->mergeXmlField('infoPereConjoint1', "");
            }else {
                $doc->mergeXmlField('professionPereConjoint1', "");
                $doc->mergeXmlField('domicilePereConjoint1', "");
                $doc->mergeXmlField('infoPereConjoint1', "décédé");
            }
        }

        // Ssi la mere de l'époux est présent, on merge les balises correspondantes
        if($mereEpx != null)
        {
            $doc->mergeXmlField('nomPrenomMereConjoint1', $mereEpx->getPrenom()." ".$mereEpx->getNom());

            if ($mereEpx->getInfo() != "décédé(e)")
            {
                $doc->mergeXmlField('professionMereConjoint1', $mereEpx->getProfession());
                // Si il faut deux adresses ont accrode domiciliéE sinon domiciliéS
                if($ilFautDeuxAdresse == true)
                {
                    $doc->mergeXmlField('domicileMereConjoint1', ", domiciliée à ".$mereEpx->getDomicile());
                } else { $doc->mergeXmlField('domicileMereConjoint1', ", domiciliés à ".$mereEpx->getDomicile()); }
                
                $doc->mergeXmlField('infoMereConjoint1', "");
            }else {
                $doc->mergeXmlField('professionMereConjoint1', "");
                $doc->mergeXmlField('domicileMereConjoint1', "");
                $doc->mergeXmlField('infoMereConjoint1', "décédée");
            }
        }
        
            
 
            if($conjoint1->getNomprenomprecconjoint()!=null)
            {

                if($conjoint1->getSexe()=="homme")
                {
                    //Divorce, veuf .....
                     $etat="";
                    if($conjoint1->getEtatanterieurmariage()=="divorcé(e)"){$etat="divorcé";}
                    if($conjoint1->getEtatanterieurmariage()=="veuf(ve)"){$etat="veuf";}

                    if($etat!="")
                    {
                        $doc->mergeXmlField('divorceC1',"et ".$etat." de ".$conjoint1->getNomprenomprecconjoint());
                    }
                    else 
                    {
                            $doc->mergeXmlField('divorceC1',"");
                    }
                  
                }
                else 
                {
           
                    //Divorce, veuf .....
                    $etat="";
                    if($conjoint1->getEtatanterieurmariage()=="divorcé(e)"){$etat="divorcée";}
                    if($conjoint1->getEtatanterieurmariage()=="veuf(ve)"){$etat="veuve";}
                 
                    if($etat!="")
                    {
                        $doc->mergeXmlField('divorceC1',"et ".$etat." de ".$conjoint1->getNomprenomprecconjoint());
                    }
                    else 
                    {
                            $doc->mergeXmlField('divorceC1',"");
                    }
                }
            }
        
        // Si la résidense de l'époux n'est pas vide on indique la résidence
        // sinon on laisse vide
        if ($conjoint1->getResidence() != "")
        {
             if($conjoint1->getSexe()=="homme")
                {
                    $doc->mergeXmlField('ResidenceConjoint1', ", résident à ".$conjoint1->getResidence());
                }
                else
                {
                    $doc->mergeXmlField('ResidenceConjoint1', ", résidente à ".$conjoint1->getResidence());
                    
                }
        } else {
            $doc->mergeXmlField('ResidenceConjoint1', "");
        }
    }

    
    $ilFautDeuxAdresse = true;
    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('PrenomNomConjoint2', $conjoint2->getPrenom()
                                                ." ".$conjoint2->getNom());
        $doc->mergeXmlField('professionConjoint2', $conjoint2->getProfession());

        if($conjoint2->getSexe()=="homme")
        {
             $doc->mergeXmlField('lieuNaissanceConjoint2', "né à ".Ville_france::getVilleDepartement($conjoint2->getLieuNaissance()));
        }
        else
        {
             $doc->mergeXmlField('lieuNaissanceConjoint2', "née à ".Ville_france::getVilleDepartement($conjoint2->getLieuNaissance()));
            
        }
        
        
        $doc->mergeXmlField('dateNaissanceConjoint2', substr($this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),1) , 0, -1));
        
        if($conjoint2->getSexe()=="homme")
        {
            $doc->mergeXmlField('domicileConjoint2', ", domicilié à ".$conjoint2->getDomicile());
        }
        else
        {
            $doc->mergeXmlField('domicileConjoint2', ", domiciliée à ".$conjoint2->getDomicile());
            
        }
        
        
        if ($pereEps != null && $mereEps != null)
        {
            if ($pereEps->getDomicile()!=$mereEps->getDomicile())
                            $ilFautDeuxAdresse = true;
            else
                            $ilFautDeuxAdresse = false;
        }

        // Ssi le pere de l'épouse est présent, on merge les balises correspondantes
        if($pereEps != null)
        {
             if($conjoint2->getSexe()=="homme")
            {           
                $doc->mergeXmlField('nomPrenomPereConjoint2', "fils de ".$pereEps->getPrenom()." ". $pereEps->getNom());
            }
            else
            {
                 $doc->mergeXmlField('nomPrenomPereConjoint2', "fille de ".$pereEps->getPrenom()." ". $pereEps->getNom()); 
            }
            
            if ($pereEps->getInfo() != "décédé(e)")
            {
                $doc->mergeXmlField('professionPereConjoint2', $pereEps->getProfession());
                // Si il faut deux adresses, on met celle du pere, sinon elle apparaitre apres les infos de la mere
                if ($ilFautDeuxAdresse == true){
                    
                    
                    $doc->mergeXmlField('domicilePereConjoint2', ", domicilié à ".$pereEps->getDomicile());
                    
                    
                } else $doc->mergeXmlField('domicilePereConjoint2', "");

                $doc->mergeXmlField('infoPereConjoint2', "");
            }else {
                $doc->mergeXmlField('professionPereConjoint2', "");
                $doc->mergeXmlField('domicilePereConjoint2', "");
                $doc->mergeXmlField('infoPereConjoint2', "décédé");
            }
        }

        // Ssi la mere de l'épouse est présente, on merge les balises correspondantes
        if($mereEps != null)
        {
            $doc->mergeXmlField('nomPrenomMereConjoint2', $mereEps->getPrenom()." ".$mereEps->getNom());
            if ($mereEps->getInfo() != "décédé(e)")
            {
                $doc->mergeXmlField('professionMereConjoint2', $mereEps->getProfession());
                // Si il faut deux adresses ont accrode domiciliéE sinon domiciliéS
                if($ilFautDeuxAdresse == true)
                {
                    $doc->mergeXmlField('domicileMereConjoint2', ", domiciliée à ".$mereEps->getDomicile());
                } else { $doc->mergeXmlField('domicileMereConjoint2', ", domiciliés à ".$mereEps->getDomicile()); }

                $doc->mergeXmlField('infoMereConjoint2', "");
            } else {
                $doc->mergeXmlField('professionMereConjoint2', "");
                $doc->mergeXmlField('domicileMereConjoint2', "");
                $doc->mergeXmlField('infoMereConjoint2', "décédée");
            }
        }
        
              if($conjoint2->getNomprenomprecconjoint()!=null)
            {
                if($conjoint2->getSexe()=="homme")
                {
                    //Divorce, veuf .....
                    $etat="";
                    if($conjoint2->getEtatanterieurmariage()=="divorcé(e)"){$etat="divorcé";}
                    if($conjoint2->getEtatanterieurmariage()=="veuf(ve)"){$etat="veuf";}

                    if($etat!="")
                    {
                      $doc->mergeXmlField('divorceC2',"et ".$etat." de ".$conjoint2->getNomprenomprecconjoint());
                    }
                    else
                    {
                      $doc->mergeXmlField('divorceC2',""); 
                    }
                }
                else 
                {
                      $etat="";
                    //Divorce, veuf .....
                    if($conjoint2->getEtatanterieurmariage()=="divorcé(e)"){$etat="divorcée";}
                    if($conjoint2->getEtatanterieurmariage()=="veuf(ve)"){$etat="veuve";}
                    
                    if($etat!="")
                    {
                      $doc->mergeXmlField('divorceC2',"et ".$etat." de ".$conjoint2->getNomprenomprecconjoint());
                    }
                    else
                    {
                      $doc->mergeXmlField('divorceC2'," "); 
                    }
                }
            }

         
        // Si la résidense de l'épouse n'est pas vide on indique la résidence
        // sinon on laisse vide
        if ($conjoint2->getResidence() != "")
        {
             if($conjoint2->getSexe()=="homme")
             {
                    $doc->mergeXmlField('ResidenceConjoint2', ", résident à ".$conjoint2->getResidence());
             }
             else
             {
                 $doc->mergeXmlField('ResidenceConjoint2', ", résidente à ".$conjoint2->getResidence());
             }
             
        } else {
            $doc->mergeXmlField('ResidenceConjoint2', "");
        }
    }

    //--------------------------------------------------------------------------
    // Ssi un notaire est renseigné on merge les informations
    if ($mariage->getNomPrenomNotaire() != "")
    {
        $doc->mergeXmlField('infoContratNotaire',"qu'un contrat de mariage a été reçu le "
                .$this->getDateEnLettre(strtotime(
                    $mariage->getDateReceptionContrat()),0)." par "
                ."".Notaires::getNPNotaire($mariage->getNomPrenomNotaire())." notaire à "
                ."".Notaires::getAdresseNotaire($mariage->getNomPrenomNotaire()));
    }else {
        $doc->mergeXmlField('infoContratNotaire', "qu'il n'a pas été fait de contrat de mariage");
    }

    //--------------------------------------------------------------------------
    // On récupere les informations des témoins puis on remplis les balises
    $info = $this->getInfosTemoins($mariage);
    $doc->mergeXmlField('infosTemoinConjoint1', $info);

    //--------------------------------------------------------------------------
    // Si aucun officier d'etat civil n'est renseigné, on prend par default
    // l'utilisateur de la session, sinon on remplis les balise avec
    // les infos de l'officier
    if($mariage->getOfficierEtatCivil() == null)
    {
        $doc->mergeXmlField('prenomU', $this->getUser()
                                     ->getAttribute("MyClient")->getPrenom());
        $doc->mergeXmlField('nomU', $this->getUser()
                                     ->getAttribute("MyClient")->getNom());
        $doc->mergeXmlField('infoU', $this->getUser()
                                     ->getAttribute("MyClient")->getFonction());
    } else {
        $doc->mergeXmlField('prenomU', Officiers::getNomOfficier($mariage
                                                    ->getOfficierEtatCivil()));
        $doc->mergeXmlField('nomU', Officiers::getPrenomOfficier($mariage
                                                    ->getOfficierEtatCivil()));
        $doc->mergeXmlField('infoU', Officiers::getFonctionOfficier($mariage
                                                    ->getOfficierEtatCivil()));
    }

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()),3)
        .".odt"));
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'acte de Mariage, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executePlurilinguesMariage(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();


    // On part du principe que tous les contact ont une adresse propre
    $ilFautDeuxAdresse = true;

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On merge l'en tete du document
    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    $doc->mergeXmlField('etat', "France");


    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,2);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariageF', $dateMariageF);

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomExAvtM', $conjoint1->getPrenom());
        $doc->mergeXmlField('lieuNConjoint1', Ville_france::getVilleDepartement($conjoint1->getLieuNaissance()));
        $doc->mergeXmlField('dateNExF', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),2));
        $doc->mergeXmlField('nomExApM', $conjoint1->getNomApresMariage());
    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomEseAvtM', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('lieuNConjoint2', Ville_france::getVilleDepartement($conjoint2->getLieuNaissance()));
        $doc->mergeXmlField('dateNEseF', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),2));
        $doc->mergeXmlField('nomEseApM', $conjoint1->getNomApresMariage());
    }


    $doc->mergeXmlField('dateActeF', $this->getDateEnLettre(strtotime($mariage->getDateActe()),2) );
    //--------------------------------------------------------------------------
    // On récupere les informations des témoins puis on remplis les balises
    $info = $this->getInfosTemoins($mariage);
    $doc->mergeXmlField('infosTemoinConjoint1', $info);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_mariage_"
        .$mariage->getId()
            ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()),3)
            .".odt"));
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'acte de Mariage, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeArticleLoiMariage(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
 
    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
    }

    
    if ($conjoint2 != null && $conjoint1 != null)
    {
          if($conjoint2->getSexe()=="homme")
          {
                    $doc->mergeXmlField('phrase1', "Consentez-vous à prendre pour époux");
          }
          else
          {
                 $doc->mergeXmlField('phrase1', "Consentez-vous à prendre pour épouse");
          }
    
          if($conjoint1->getSexe()=="homme")
          {
                    $doc->mergeXmlField('phrase2', "Consentez-vous à prendre pour époux");
          }
          else
          {
                 $doc->mergeXmlField('phrase2', "Consentez-vous à prendre pour épouse");
          }
    }
    
    
    
    
    
    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "article_loi_mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()),3)
        .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDossierTribunal(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    $doc->mergeXmlField('annee', date('Y'),$mariage->getDateActe()); // ne marche pas

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());

    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "dossier_tribunal__mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionDivorceProc(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNaissanceConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNaissanceConjoint1', $conjoint1->getLieuNaissance());

    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('dateNaissanceConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNaissanceConjoint2', $conjoint2->getLieuNaissance());
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "dossier_tribunal__mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionMariageEpouse(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');
    
    
     if($conjoint2->getSexe()=="homme")
    {
            $doc->mergeXmlField('marC',"Marié");
            $doc->mergeXmlField('NC',"Né");
            $doc->mergeXmlField('intC',"intéressé");
    }
    else
    {
        $doc->mergeXmlField('marC',"Mariée");
         $doc->mergeXmlField('NC',"Née");
         $doc->mergeXmlField('intC',"intéressée");
    }

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    $doc->mergeXmlField('villeNaissance', $this->getVille(Ville_france::getVilleCP($conjoint2->getLieuNaissance())));
    $doc->mergeXmlField('CP', $this->getCP(Ville_france::getVilleCP($conjoint2->getLieuNaissance())));
    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNaissanceConjoint1', $conjoint1->getLieuNaissance());

    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('dateNConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNaissanceConjoint2', $conjoint2->getLieuNaissance());

        if ($conjoint2->getEtatAnterieurMariage() == "pacsé(e)" ) {
            $doc->mergeXmlField('prenomConjoint', $conjoint1->getPrenom());
            $doc->mergeXmlField('nomConjoint', $conjoint1->getNom());
        }else{
            $doc->mergeXmlField('prenomConjoint', "");
            $doc->mergeXmlField('nomConjoint', "");
        }
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);

    $madate=strtotime($mariage->getDateActe());
    $dateActeF = $this->getDateEnLettre($madate,0);
    $doc->mergeXmlField('dateActe', $dateActeF);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_epouse_mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionMariageEpoux(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');
    
    
        //titre colonne 
    if($conjoint1->getSexe()=="homme")
    {
            $doc->mergeXmlField('marC',"Marié");
            $doc->mergeXmlField('NC',"Né");
            $doc->mergeXmlField('intC',"intéressé");
    }
    else
    {
        $doc->mergeXmlField('marC',"Mariée");
         $doc->mergeXmlField('NC',"Née");
         $doc->mergeXmlField('intC',"intéressée");
    }
    
    

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    $doc->mergeXmlField('villeNaissance', $this->getVille(Ville_france::getVilleCP($conjoint1->getLieuNaissance())));
    $doc->mergeXmlField('CP', $this->getCP(Ville_france::getVilleCP($conjoint1->getLieuNaissance())));
    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint1', $conjoint1->getLieuNaissance());

        if ($conjoint1->getEtatAnterieurMariage() == "pacsé(e)" ) {
            $doc->mergeXmlField('prenomConjoint', $conjoint2->getPrenom());
            $doc->mergeXmlField('nomConjoint', $conjoint2->getNom());
        }else{
            $doc->mergeXmlField('prenomConjoint', "");
            $doc->mergeXmlField('nomConjoint', "");
        }
    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('dateNConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint2', $conjoint2->getLieuNaissance());
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);

    $madate=strtotime($mariage->getDateActe());
    $dateActeF = $this->getDateEnLettre($madate,0);
    $doc->mergeXmlField('dateActe', $dateActeF);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_epoux_mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionMariageProc(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint1', $conjoint1->getLieuNaissance());

    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('dateNConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint2', $conjoint2->getLieuNaissance());
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);

    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_mariage_proc_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  public function executeAvisMentionMariageEpouxProc(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    

    if($conjoint1->getSexe()=="homme")
    {
            $doc->mergeXmlField('marC',"Marié");
            $doc->mergeXmlField('NC',"Né");
            $doc->mergeXmlField('intC',"intéressé");
    }
    else
    {
        $doc->mergeXmlField('marC',"Mariée");
         $doc->mergeXmlField('NC',"Née");
         $doc->mergeXmlField('intC',"intéressée");
    }
    

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));

        if ($conjoint1->getEtatAnterieurMariage() == "pacsé(e)" ) {
            $doc->mergeXmlField('prenomConjoint', $conjoint2->getPrenom());
            $doc->mergeXmlField('nomConjoint', $conjoint2->getNom());
        }else{
            $doc->mergeXmlField('prenomConjoint', "");
            $doc->mergeXmlField('nomConjoint', "");
        }
    }

    if ($conjoint2 != null){
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
    }
    
    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);


    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_mariage_epoux_proc_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  public function executeAvisMentionMariageEpouseProc(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $conjoint2 = $mariage->getConjoint2();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');
    
      //titre colonne 

    
    
    if($conjoint2->getSexe()=="homme")
    {
        

            $doc->mergeXmlField('marC',"Marié");
            $doc->mergeXmlField('NC',"Né");
            $doc->mergeXmlField('intC',"intéressé");
    }
    else
    {
        $doc->mergeXmlField('marC',"Mariée");
         $doc->mergeXmlField('NC',"Née");
         $doc->mergeXmlField('intC',"intéressée");
    }
    
    

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('dateNConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));

        if ($conjoint2->getEtatAnterieurMariage() == "pacsé(e)" ) {
            $doc->mergeXmlField('prenomConjoint', $conjoint1->getPrenom());
            $doc->mergeXmlField('nomConjoint', $conjoint1->getNom());
        }else{
            $doc->mergeXmlField('prenomConjoint', "");
            $doc->mergeXmlField('nomConjoint', "");
        }
    }

    if ($conjoint1 != null){
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite
    $madate = strtotime($mariage->getDateMariage());
    $dateMariageF = $this->getDateEnLettre($madate,0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);


    //--------------------------------------------------------------------------
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_mariage_epouse_proc_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }


  /**
   * Fonction permettant la génération du dossier tribunale pour l'acte de
   * mariage , elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeLivretModele(sfWebRequest $request)
  {
    // On commence par récupéré l'acte de mariage avec son ID
    $mariage = $this->getMariageById($request->getParameter("id"));
    // On réupère ensuite les époux ainsi que leur parents.
    $conjoint1 = $mariage->getConjoint1();
    $pere = $conjoint1->getPere();
    $mere = $conjoint1->getMere();

    $conjoint2 = $mariage->getConjoint2();
    $pereE = $conjoint2->getPere();
    $mereE = $conjoint2->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $mariage->getNumeroActe());
    
    
    //titre colonne 
    if($conjoint1->getSexe()=="homme")
    {
            $doc->mergeXmlField('titreC',"Epoux ou Père");
            $doc->mergeXmlField('NC',"Né");
    }
    else
    {
        $doc->mergeXmlField('titreC',"Epouse ou Mère");
         $doc->mergeXmlField('NC',"Née");
    }
    
    if($conjoint2->getSexe()=="homme")
    {
            $doc->mergeXmlField('titreV',"Epoux ou Père");
            $doc->mergeXmlField('NV',"Né");
    }
    else
    {
        $doc->mergeXmlField('titreV',"Epouse ou Mère");
        $doc->mergeXmlField('NV',"Née");
    }
    

    //--------------------------------------------------------------------------
    // Ssi l'époux est présent, on merge les balises correspondantes
    if ($conjoint1 != null)
    {
        $doc->mergeXmlField('nomConjoint1', $conjoint1->getNom());
        $doc->mergeXmlField('prenomConjoint1', $conjoint1->getPrenom());
        $doc->mergeXmlField('dateNConjoint1', $this->getDateEnLettre(strtotime($conjoint1->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint1', Ville_france::getVilleDepartement($conjoint1->getLieuNaissance()));

        if ($pere != null)
        {
            $doc->mergeXmlField('NPPereConjoint1', $pere->getPrenom()." ".$pere->getNom());
        } else {
            
        }

        if ($mere != null)
        {
            $doc->mergeXmlField('NPMereConjoint1', $mere->getPrenom()." ".$mere->getNom());
        }

    }

    //--------------------------------------------------------------------------
    // Ssi l'épouse est présente, on merge les balises correspondantes
    if ($conjoint2 != null)
    {
        $doc->mergeXmlField('prenomConjoint2', $conjoint2->getPrenom());
        $doc->mergeXmlField('nomConjoint2', $conjoint2->getNom());
        $doc->mergeXmlField('dateNConjoint2', $this->getDateEnLettre(strtotime($conjoint2->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNConjoint2', Ville_france::getVilleDepartement($conjoint2->getLieuNaissance()));

        if ($pereE != null)
        {
            $doc->mergeXmlField('NPPereConjoint2', $pereE->getPrenom()." ".$pereE->getNom());
        }

        if ($mereE != null)
        {
            $doc->mergeXmlField('NPMereConjoint2', $mereE->getPrenom()." ".$mereE->getNom());
        }
    }

    //--------------------------------------------------------------------------
    // On récupere la date de l'acte et on la formatte pour les cases reduite

    $dateMariageF = $this->getDateEnLettre(strtotime($mariage->getDateMariage()),0);
    // on la remplace dans le document
    $doc->mergeXmlField('dateMariage', $dateMariageF);
    $doc->mergeXmlField('heureMariage', str_replace(":","h",substr($mariage->getHeureActe(),0,-3)));
    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($mariage->getDateActe()), 3));

    //--------------------------------------------------------------------------

    if($mariage->getOfficierEtatCivil() == null)
    {
       $doc->mergeXmlField('officier', "");
       $doc->mergeXmlField('fonctionOfficier', "");
       $doc->mergeXmlField('infoOfficier', "");
    } else {
       $doc->mergeXmlField('officier', Officiers::getPrenomOfficier($mariage->getOfficierEtatCivil())." ".Officiers::getNomOfficier($mariage->getOfficierEtatCivil()));
       $fonctionOfficier=Officiers::getFonctionOfficier($mariage->getOfficierEtatCivil());
       $doc->mergeXmlField('fonctionOfficier', strstr($fonctionOfficier, "," , true ));
       $doc->mergeXmlField('infoOfficier', substr(strstr($fonctionOfficier, ", ", false),2));
    }
    //--------------------------------------------------------------------------

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "livret_famille_mariage_"
        .$mariage->getId()
        ."_".$this->getDateEnLettre(strtotime($mariage->getDateMariage()), 3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Cette Fonction a �t� �crite pour �crire le jour et le mois de la date
   * en lettre. Elle permet �galement de former la date de deux facon.
   *
   * Si le parametre sreduit envoyer = 1
   * Elle retourne une chaine de charactere sous la forme :
   *        "Lundi 02 Septembre 2011"
   * Si il est = 0
   *        "Lundi deux Septembre deux mille onze"
   * 
   * @author Boyer Jimmy
   * @param int $date
   * @return String
   */
  public function getDateEnLettre($date, $format)
  {

    $mois = date('F', $date);
    $moisChiffre = date('F', $date);

    switch($mois) {
        case 'January': $mois = 'janvier'; break;
        case 'February': $mois = 'février'; break;
        case 'March': $mois = 'mars'; break;
        case 'April': $mois = 'avril'; break;
        case 'May': $mois = 'mai'; break;
        case 'June': $mois = 'juin'; break;
        case 'July': $mois = 'juillet'; break;
        case 'August': $mois = 'août'; break;
        case 'September': $mois = 'septembre'; break;
        case 'October': $mois = 'octobre'; break;
        case 'November': $mois = 'novembre'; break;
        case 'December': $mois = 'décembre'; break;
        default: $mois =''; break;
    }

    switch($moisChiffre) {
        case 'January': $moisChiffre = '01'; break;
        case 'February': $moisChiffre = '02'; break;
        case 'March': $moisChiffre = '03'; break;
        case 'April': $moisChiffre = '04'; break;
        case 'May': $moisChiffre = '05'; break;
        case 'June': $moisChiffre = '06'; break;
        case 'July': $moisChiffre = '07'; break;
        case 'August': $moisChiffre = '08'; break;
        case 'September': $moisChiffre = '09'; break;
        case 'October': $moisChiffre = '10'; break;
        case 'November': $moisChiffre = '11'; break;
        case 'December': $moisChiffre = '12'; break;
        default: $moisChiffre =''; break;
    }

    $jour_nb = date('d', $date);
    $annee = date('Y', $date);
    
    if($format == 0) {              // pour un format de type "10 janvier 2011"
        return ($jour_nb." ".$mois." ".$annee);
    
    }else if($format == 1) {        // Pour un format du type "dix Janvier deux mil onze"
        $jour_nb = $this->int2str($jour_nb);
        $annee = $this->int2str($annee);
        return ($jour_nb." ".$mois." ".$annee);
    
    } else if($format == 2) {       // Pour un format du type " 10|01|2011
        //return ($jour_nb."   | ".$moisChiffre."  |    ".$annee);
        return ($jour_nb."  |  ".$moisChiffre."  |  ".$annee);
    
    } else if ($format == 3) {      // Pour un format du type " 10/01/2011" ou " 10_01_2011" si c'est un nom de document
        return ($jour_nb."/".$moisChiffre."/".$annee);
    }
    
    
  }

  /**
   * Cette fonction assure la transformation de nos heures en Lettre
   *
   * @author Boyer Jimmy
   * @param <int> $heure
   * @return string
   */
  public function getHeureEnLettre($heure)
  {
      $tabHeure = explode(":",$heure);

      $heures = $tabHeure[0];
      $min = $tabHeure[1];

      $heures = $this->int2str($heures);
      $min = $this->int2str($min);

      //Tests pour savoir si on affiche le "s" à minute(s) et à heure(s)
      (($tabHeure[0]>1) ? $enLettre = $heures." heures " : $enLettre = $heures." heure ");
      (($tabHeure[1]>1) ? $enLettre = $enLettre .$min." minutes" : $enLettre = $enLettre .$min." minute");
      return $enLettre;
  }

  /**
   * Fonction récupéré sur le site Developpez.net, autheur inconnu
   * qui permet de transformer les chiffre en lettre.
   * @param <int> $a
   * @return String
   */
  public function int2str($a) {
        $joakim = explode('.',$a);
        if (isset($joakim[1]) && $joakim[1]!=''){
            return $this->int2str($joakim[0]).' virgule '.$this->int2str($joakim[1]) ;
        }
        if ($a<0) return 'moins '.$this->int2str(-$a);
            if ($a<17){
                switch ($a){
                    case 0: return 'zéro';
                    case 1: return 'premier';
                    case 2: return 'deux';
                    case 3: return 'trois';
                    case 4: return 'quatre';
                    case 5: return 'cinq';
                    case 6: return 'six';
                    case 7: return 'sept';
                    case 8: return 'huit';
                    case 9: return 'neuf';
                    case 10: return 'dix';
                    case 11: return 'onze';
                    case 12: return 'douze';
                    case 13: return 'treize';
                    case 14: return 'quatorze';
                    case 15: return 'quinze';
                    case 16: return 'seize';
                }
            } else if ($a<20){
                return 'dix-'.$this->int2str($a-10);
            } else if ($a<100){
                if ($a%10==0){
                    switch ($a){
                        case 20: return 'vingt';
                        case 30: return 'trente';
                        case 40: return 'quarante';
                        case 50: return 'cinquante';
                        case 60: return 'soixante';
                        case 70: return 'soixante-dix';
                        case 80: return 'quatre-vingt';
                        case 90: return 'quatre-vingt-dix';
                    }
                } elseif (substr($a, -1)==1){
                    if( ((int)($a/10)*10)<70 ){
                        return $this->int2str((int)($a/10)*10).'-et-un';
                } elseif ($a==71) {
                        return 'soixante-et-onze';
                } elseif ($a==81) {
                        return 'quatre-vingt-un';
                } elseif ($a==91) {
                        return 'quatre-vingt-onze';
                }
            } elseif ($a<70){
                return $this->int2str($a-$a%10).'-'.$this->int2str($a%10);
            } elseif ($a<80){
                return $this->int2str(60).'-'.$this->int2str($a%20);
            } else{
                return $this->int2str(80).'-'.$this->int2str($a%20);
            }
        } else if ($a==100){
            return 'cent';
        } else if ($a<200){
            return $this->int2str(100).' '.$this->int2str($a%100);
        } else if ($a<1000){
            return $this->int2str((int)($a/100)).' '.$this->int2str(100).' '.$this->int2str($a%100);
        } else if ($a==1000){
            return 'mil';
        } else if ($a<2000){
            return $this->int2str(1000).' '.$this->int2str($a%1000).' ';
        } else if ($a<1000000){
            return $this->int2str((int)($a/1000)).' '.$this->int2str(1000).' '.$this->int2str($a%1000);
        }
  }

  /**
   * Cette fonction permet de récupéré l'objet Deces grace à son "id"
   * identifiant unique dans la base de données
   *
   * @param int $id
   * @return Mariage
   */
  public function getMariageById($id)
  {
      $mariageC = Doctrine::getTable("Mariage")
        ->createQuery("mar")
            ->where("mar.id = ?", $id)
            ->execute();

      $mariage = $mariageC->getFirst();

      return $mariage;
  }

  /**
   * Permet de retourner les informations formatt�es des témoins des actes de mariage
   *
   * @param Mariage $mariage
   * @return string
   */
  public function getInfosTemoins(Mariage $mariage)
  {
      $infosTemoin = "";

      foreach ($mariage->getTemoinsConjoint1() as $temoin){

          if($temoin->getSexe() == "masculin")
               $domicilie = ", domicilié à ";
          else $domicilie = ", domiciliée à ";

          $infosTemoin = $infosTemoin." ".$temoin->getPrenom()
                  ." ".$temoin->getNom()
                  .", ".$temoin->getProfession()
                   .$domicilie.$temoin->getDomicile();

          if ($mariage->getTemoinsConjoint1()->getLast() == $temoin)
                $infosTemoin = $infosTemoin.".";
          else  $infosTemoin = $infosTemoin.", et";
      }

      $infosTemoin = $infosTemoin." Et de ";

      foreach ($mariage->getTemoinsConjoint2() as $temoin){

          if($temoin->getSexe() == "masculin")
               $domicilie = ", domicilié à ";
          else $domicilie = ", domiciliée à ";

          $infosTemoin = $infosTemoin." ".$temoin->getPrenom()
                  ." ".$temoin->getNom()
                  .", ".$temoin->getProfession()
                  .$domicilie.$temoin->getDomicile();

          if ($mariage->getTemoinsConjoint2()->getLast() == $temoin)
                $infosTemoin = $infosTemoin."";
          else  $infosTemoin = $infosTemoin.", et";
      }

      $infosTemoin = $infosTemoin.", témoins majeurs";

      return $infosTemoin;
  }

  
  /**
   * Cette fonction permet de récupérer la ville dans la chaine de caractère composée comme suit: ville (codePostal)
   *
   * @author Guillaume FLAMENT
   * @param <string> $lieuNaissance
   * @return string
   */
  public function getVille($lieuNaissance){
      return strstr($lieuNaissance, " (", true);
  }

  public function getCP($lieuNaissance){
      return substr($lieuNaissance,-6,5);
  }


  /* Appel Ajax
   * @param sfWebRequest $request
   * @return Json Retourne un tableau Json array des objets Notaires en
   * resultats convertis préalablement en String
   */
  public function executeGetNotaires(sfWebRequest $request)
  {
    $q = $request->getParameter('q');

    $limit = $request->getParameter('limit');

    $notaires = Doctrine::getTable('notaires')->createQuery("c")
            ->where('c.nom LIKE ?', $q.'%')
            ->limit($limit)
            ->execute();

    $list = array();
    foreach($notaires as $notaire)
    {
       $list[$notaire->getId()] = sprintf('%s, %s', $notaire->getNom(), $notaire->getPrenom());
    }

    return $this->renderText(json_encode($list));
  }

    /* Appel Ajax
   * @param sfWebRequest $request
   * @return Json Retourne un tableau Json array des objets Notaires en
   * resultats convertis préalablement en String
   */
  public function executeGetOfficiers(sfWebRequest $request)
  {
    $q = $request->getParameter('q');

    $limit = $request->getParameter('limit');

    $officiers = Doctrine::getTable('officiers')->createQuery("c")
            ->where('c.nom LIKE ?', $q.'%')
            ->limit($limit)
            ->execute();

    $list = array();
    foreach($officiers as $officier)
    {
       $list[$officier->getId()] = sprintf('%s, %s', $officier->getNom(), $officier->getPrenom());
    }

    return $this->renderText(json_encode($list));
  }

  public function executePopUpDocuments(sfWebRequest $request)
  {
    $this->mariage = Doctrine_Core::getTable('Mariage')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->mariage);
  }

}