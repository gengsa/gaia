<?php

namespace Gaia\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class ControllerBase extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // TODO
        $urlPrefix = '';
        $headerLinks = ['header' => []];
        $cartNum = 22;
        $returlUrl = '/'; // TODO

        View::share([
            'headerLinks' => $headerLinks,
            'cartNum' => $cartNum,
            'returnUrl' => $returlUrl,
        ]);
    }
}
