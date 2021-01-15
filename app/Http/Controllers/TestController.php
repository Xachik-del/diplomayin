<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{


    public function testStore(Request $request)
    {
        DB::table('test_data_migration')->updateOrInsert(['name' => $request->get('name')], $request->all());
    }

    public function testGet(Request $request)
    {
        return DB::table('test_data_migration')->where('name', $request->get('name'))->get();
    }

}
