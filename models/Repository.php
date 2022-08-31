<?php

namespace app\models;

use GuzzleHttp;

class Repository
{
  public string $repoName;

  public static function getRepos($request_data)
  {
    $date = date('Y-m-d', strtotime($request_data['start_date']));
    $per_page = $request_data['per_page'] ?? 10;
    $page = $request_data['page'] ?? 1;
    $url = "https://api.github.com/search/repositories?q=created:%3E$date&sort=stars&order=desc&per_page=$per_page&page=$page";
    
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $url);

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
