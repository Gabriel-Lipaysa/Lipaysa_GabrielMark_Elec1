<?php

namespace App\Http\Controllers;
use NumberFormatter;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    function calculate ($amount){
        $cash = [1000, 500, 200, 100, 50, 20, 10, 5, 1];
        $change = [];
        $ogAmount = $amount;
        $color = $amount%2 == 0 ? 'red' : 'green';
        
        foreach($cash as $pay){
            if($amount >= $pay){
                $change[$pay] = floor($amount/$pay);
                $amount %= $pay;
            }
        }
        $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $result = ucfirst($formatter->format($ogAmount));
        
        return view('money')->with('change',$change)->with('ogAmount', $ogAmount)->with('result', $result)->with('color',$color);
    }
}
