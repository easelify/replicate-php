<?php

declare(strict_types=1);

namespace replicate\lib;

use replicate\Replicate;

class Predictions extends Replicate
{
    public function list()
    {
        return $this->request('/predictions', 'get');
    }

    public function get($prediction_id)
    {
        return $this->request('/predictions/' . $prediction_id, 'get');
    }

    public function create(array $options)
    {
        return $this->request('/predictions', 'post', $options);
    }

    public function cancel($prediction_id)
    {
        return $this->request('/predictions/' . $prediction_id . '/cancel', 'post');
    }
}
