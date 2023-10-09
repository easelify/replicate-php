<?php

declare(strict_types=1);

namespace replicate\lib;

use replicate\Replicate;

class Trainings extends Replicate
{
    public function list()
    {
        return $this->request('/trainings', 'get');
    }

    public function get($training_id)
    {
        return $this->request('/trainings/' . $training_id, 'get');
    }

    public function create(string $model_owner, string $model_name, string $version_id, array $options)
    {
        return $this->request("/models/{$model_owner}/{$model_name}/versions/{$version_id}/trainings", 'post', $options);
    }

    public function cancel($training_id)
    {
        return $this->request('/trainings/' . $training_id . '/cancel', 'post');
    }
}
