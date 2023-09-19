<?php

declare(strict_types=1);

namespace replicate;

class Replicate
{
    private string $auth;
    private string $userAgent;
    private string $baseUrl;

    public function __construct(array $options = [])
    {
        $this->auth = $options['auth'] ?? '';
        $this->userAgent = $options['userAgent'] ?? 'replicate-php/0.0.1';
        $this->baseUrl = $options['baseUrl'] ?? 'https://api.replicate.com/v1';
    }

    public function request(string $route, $method = 'post', array $options = [])
    {
        $method = strtolower($method);
        if (!in_array($method, ['post', 'get'])) {
            $method = 'post';
        }

        $headers = [];
        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Token ' . $this->auth;
        $headers['User-Agent'] = $this->userAgent;

        $client = new \GuzzleHttp\Client([
            'headers' => $headers,
            'timeout'  => 20.0
        ]);

        $route = ltrim($route, '/');
        if ($method == 'post') {
            $res = $client->post($this->baseUrl . '/' . $route, ['json' => $options]);
        } else {
            $res = $client->get($this->baseUrl . '/' . $route);
        }

        $statusCode = $res->getStatusCode();
        if (!in_array($statusCode, [200, 201])) {
            $msg = 'HTTP ' . $statusCode . ' ' . $res->getBody()->getContents();
            throw new \Exception($msg);
        }

        $contents = $res->getBody()->getContents();
        $contents = json_decode($contents, true);

        return $contents;
    }
}
