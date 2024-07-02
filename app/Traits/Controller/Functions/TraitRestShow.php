<?php

namespace App\Traits\Controller\Functions;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

trait TraitRestShow
{
    public function show($id)
    {
        try {
            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            $enableCache = $this->repository->getModel()?->enableCache ?? false;
            $cachePrefix = $this->repository->getModel()?->cachePrefix ?? null;
            $cacheControllerMethodList = $this->repository->getModel()?->cacheControllerMethodList ?? null;
            $checkCacheEnable = $enableCache && !empty($cachePrefix) && in_array('show', $cacheControllerMethodList);
            if ($checkCacheEnable) {
                $cacheKey = "{$cachePrefix}.id.{$id}";
                return Cache::remember($cacheKey, Config::get('cache.duration.long'), function () use ($id) {
                    $result = $this->repository->show($id);
                    $response = isset($this->resource) ? new $this->resource($result) : $result;
                    return $this->successResourceResponse($response);
                });
            } else {
                $result = $this->repository->show($id);
                $response = isset($this->resource) ? new $this->resource($result) : $result;
                return $this->successResourceResponse($response);
            }
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }
}
