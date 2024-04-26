<?php

declare(strict_types=1);

namespace replicate\lib;

use replicate\Replicate;

class Commons extends Replicate
{
    public function get(string $route)
    {
        return $this->request($route, 'get');
    }

    public function post(string $route, array $options)
    {
        return $this->request($route, 'post', $options);
    }
}
