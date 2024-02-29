<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;


class ReceiptController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$arr['receipt'] = Receipt::orderBy('receiptNo', 'DESC')->get(); 
    	return view('return/checkList')->with($arr);
    }
}
