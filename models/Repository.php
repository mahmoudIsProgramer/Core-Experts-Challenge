<?php

namespace app\models;

use app\core\Request;
use GuzzleHttp;

class Repository
{
  public string $repoName;

  public static function getRepos($request)
  {
    $request_data = $request->getBody();
    $client = new GuzzleHttp\Client();

    $url = "https://api.github.com/search/repositories?q=created:%3E".$request_data['start_date']."&sort=stars&order=desc&per_page=".$request_data['per_page']."&page=2"; 
    $res = $client->request('GET',$url);

    $statusCode = $res->getStatusCode();
    if ($statusCode >= 200 && $statusCode < 300) {
      return self::formateRepos(json_decode($res->getBody(), true));
    }
    return [];
  }

  public static function formateRepos($data)
  {
    $repos = [];
    foreach ($data['items'] as $key => $value) {
      $repos[] = [
        'full_name'  => $value['full_name'],
        'avatar_url' => $value['owner']['avatar_url'],
        'html_url'        => $value['html_url'],
        'created_at' => $value['created_at'],
      ];
    }
    return [
      "total_count" => $data['total_count'],
      "repos" => $repos,
    ];
  }
}
