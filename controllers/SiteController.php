<?php

namespace app\controllers;


use app\core\Controller;
use app\models\Repository;

class SiteController extends Controller
{
  public function home()
  {
    return $this->render('home', [
      'name' => 'Mahmoud Ahmed'
    ]);
  }

  public function getRepositories()
  {

    var_dump(Repository::getRepos()); 
  }
}
