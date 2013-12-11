<?php

class commonActions extends sfActions
{
  /**
   * Ajax call
   * @param sfWebRequest $request
   * @return Json return Json array of matching City objects converted to string
   */
  public function executeGetVilles(sfWebRequest $request)
  {
    $q = $request->getParameter('q');
    $limit = $request->getParameter('limit');

    $citys = Doctrine::getTable('Ville_france')->createQuery("c")
            ->where('c.ville LIKE ?', $q.'%')
            ->limit($limit)
            ->execute();

    $list = array();
    foreach($citys as $city)
    {
       $list[$city->getId()] = sprintf('%s (%d)', $city->getVille(), $city->getCP());
    }
  
    return $this->renderText(json_encode($list));
  }
}
?>
