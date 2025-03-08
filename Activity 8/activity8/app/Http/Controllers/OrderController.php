<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    function customer($customerId, $name, $address){
        return view('customer', compact('customerId', 'name', 'address'));
    }
    
    function item($itemNo, $name, $price){
        return view('item', compact('itemNo', 'name', 'price'));
    }

    function order($customerId, $name, $orderNo, $date){
        return view('order', compact('customerId','name', 'orderNo',  'date'));
    }
    
    function orderDetails($transNo, $orderNo, $itemNo, $name, $price, $qty){
        return view('orderDetails', compact('transNo','orderNo', 'itemNo',  'name', 'price', 'qty'));
    }
}
