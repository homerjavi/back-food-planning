<?php

if (!function_exists('getModel'))
{
    function getModel( string $model )
    {
        return app("App\Models\\" . $model);
    }
}