<?php

if (!function_exists('getQuery')) {
    /**
     *
     * @param string $modelClass
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function getQuery($modelClass)
    {
        return resolve($modelClass)->query();
    }
}

