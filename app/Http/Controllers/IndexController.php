<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function member_register()
    {
        $block = DB::table('mst_block')->get();
        $const = DB::table('mst_const')->get();
        $district = DB::table('mst_district')->get();
        $taluk = DB::table('mst_taluk')->get();

        return view('member_register', compact(
            'block',
            'const',
            'district',
            'taluk'
        ));
    }
}
