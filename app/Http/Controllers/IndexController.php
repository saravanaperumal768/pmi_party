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
        $blood = DB::table('mst_blood')->get();
        $community = DB::table('tbl_community')->get();

        $qualification = DB::table('mst_qual')->get();

        return view('member_register', compact(
            'block',
            'const',
            'district',
            'taluk',
            'blood',
            'community',
            'qualification'
        ));
    }
}
