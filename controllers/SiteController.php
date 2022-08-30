<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\Repository;

class SiteController extends Controller
{
  public function home()
  {
    return $this->render('home');
  }

  public function getRepositories(Request $request)
  {
    return json_encode(Repository::getRepos($request),true);
  }
}
