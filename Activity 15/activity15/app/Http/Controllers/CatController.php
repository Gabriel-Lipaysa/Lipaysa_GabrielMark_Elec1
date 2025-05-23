<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CatController extends Controller
{
    public function showCats(){
        $response = Http::get('https://api.thecatapi.com/v1/images/search', [
            'limit' => 10
        ]);

        if($response->successful()){
            $cats = $response->json();
        } else {
            $cats = [];
        }
        return view('cats', ['cats' => $cats]);
    }
}
