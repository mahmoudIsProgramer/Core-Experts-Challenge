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
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode(Repository::getRepos(),true);
    return json_encode(Repository::getRepos(),true);
  }
}
