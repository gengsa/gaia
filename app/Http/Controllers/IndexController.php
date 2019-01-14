<?php

namespace Gaia\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IndexController extends ControllerBase
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        
        $cart = [
            'items'=> [
                'goods1',
                'goods2',
                'goods3',
                'goods4',
                'goods5',
                'goods6',
                'goods7',
            ],
        ];
        return view('index', ['cart' => $cart]);
    }
}
