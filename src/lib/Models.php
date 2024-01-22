<?php

declare(strict_types=1);

namespace replicate\lib;

use replicate\Replicate;

class Models extends Replicate
{
    public function get(string $model_owner, string $model_name)
    {
        return $this->request("/models/{$model_owner}/{$model_name}", 'get');
    }

    public function create(array $options)
    {
        return $this->request("/models", 'post', $options);
    }

    public function listVersions(string $model_owner, string $model_name)
    {
        return $this->request("/models/{$model_owner}/{$model_name}/versions", 'get');
    }

    public function getVersion(string $model_owner, string $model_name, string $version_id)
    {
        return $this->request("/models/{$model_owner}/{$model_name}/versions/{$version_id}", 'get');
    }

    public function deleteVersion(string $model_owner, string $model_name, $version_id)
    {
        return $this->request("/models/{$model_owner}/{$model_name}/versions/{$version_id}", 'delete');
    }
}
