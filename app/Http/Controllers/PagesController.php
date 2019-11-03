<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

   public function welcome() {

   	return view('welcome');
   
   }

   public function sessionreceipt(){
      return view('session/sessionreceipt');
   }
}
