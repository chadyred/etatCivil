<?php

/**
 * Naissance_enfant
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    etatCivil
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Naissance_enfant extends BaseNaissance_enfant
{
    public function getNaissance()
    {
        $res = Doctrine::getTable('Naissance')
            ->createQuery('nai')
            ->where('nai.id = ?', $this->getNaissanceId())
            ->execute();
        
        return $res->getFirst();
    }

    public function getPere()
    {
        $res = Doctrine::getTable('Naissance_acteur')
            ->createQuery('act')
            ->where('act.naissance_id = ?', $this->getNaissanceId())
            ->andWhere('act.typeActeur = ?', "père" )
            ->execute();

        return $res->getFirst();
    }

    public function getMere()
    {
        $res = Doctrine::getTable('Naissance_acteur')
            ->createQuery('act')
            ->where('act.naissance_id = ?', $this->getNaissanceId())
            ->andWhere('act.typeActeur = ?', "mère" )
            ->execute();

        return $res->getFirst();
    }
}
