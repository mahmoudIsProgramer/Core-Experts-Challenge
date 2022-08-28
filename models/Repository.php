<?php

namespace app\models;

use GuzzleHttp;

class Repository
{
  public string $repoName;

  public static function getRepos()
  {
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'https://api.github.com/search/repositories?q=created:%3E2019-01-11&sort=stars&order=desc', [
      // 'query' => ['foo' => 'bar']
    ]);

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
        'url'        => $value['url'],
        'created_at' => $value['created_at'],
      ];
    }
    return [
      "total_count" => $data['total_count'],
      "repos" => $repos,
    ];
  }
}
