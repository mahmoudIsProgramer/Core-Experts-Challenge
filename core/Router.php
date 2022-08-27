<?php

namespace app\core;

class Router
{
  private Request $request;
  private Response $response;
  private array $routeMap = [];

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function get(string $url, $callback)
  {
    $this->routeMap['get'][$url] = $callback;
  }

  public function resolve()
  {
    $method = $this->request->getMethod();
    $url = $this->request->getUrl();
    $callback = $this->routeMap[$method][$url] ?? false;
    if (!$callback) {
      $this->response->statusCode(404);
      return 'Not Found';
    }
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    return call_user_func($callback);
  }

  public function renderView($view, $params = [])
  {
    return 'Rendering view ' . $view;
  }
}
