<?php

namespace Nurzzzone\AdminPanel\Support;

/**
 * @className WithUrlDependencies
 * @package Nurzzzone\AdminPanel\Support
 */
trait WithUrlDependencies
{
    /**
     * @var array
     */
    protected $urlDependencies = [];

    /**
     * @param array $params
     * @param array $arguments
     * @return $this
     */
    public function setUrlDependencies(array $params, array $arguments): self
    {
        if (empty($arguments)) {
            return $this;
        }

        foreach($params as $param) {
            foreach($arguments as $argument) {
                if (! is_null($param['className']) && class_exists($param['className'])) {
                    $model = call_user_func([$param['className'], 'query'])->find($argument);
                }

                $this->urlDependencies[$param['name']] = $model ?? $argument;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getUrlDependencies(): array
    {
        return $this->urlDependencies;
    }
}
