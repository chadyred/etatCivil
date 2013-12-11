<?php

/**
 * Officiers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    etatcivil
 * @subpackage model
 * @author     Boyer Jimmy
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Officiers extends BaseOfficiers
{
    public static function getNPOfficier($a)
    {
        $r = Doctrine_core::getTable("officiers")->find($a);
        if($r != null) {
            return ($r->getNom()." ".$r->getPrenom());
        } else {
            return $a;
        }
    }

    public static function getNomOfficier($a)
    {
        $r = Doctrine_core::getTable("officiers")->find($a);
        if($r != null) {
            return ($r->getNom());
        } else {
            return $a;
        }
    }

    public static function getPrenomOfficier($a)
    {
        $r = Doctrine_core::getTable("officiers")->find($a);
        if($r != null) {
            return ($r->getPrenom());
        } else {
            return $a;
        }
    }

    public static function getFonctionOfficier($a)
    {
        $r = Doctrine_core::getTable("officiers")->find($a);
        if($r != null) {
            return ($r->getFonction());
        } else {
            return $a;
        }
    }
}