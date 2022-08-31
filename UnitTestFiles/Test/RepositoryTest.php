<?php

namespace UnitTestFiles\Test;

use app\core\Request;
use app\models\Repository;
use PHPUnit\Framework\TestCase;

final class RepositoryTest extends TestCase
{
  public function testGetRepos()
  {
    $request_date = [
      'start_date' => "2020-01-01",
    ];
    $repos = Repository::getRepos($request_date);
    $this->assertNotEquals(0,$repos['total_count']);
  }
}
