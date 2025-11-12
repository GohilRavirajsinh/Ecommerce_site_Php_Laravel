<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliateLinksController extends Controller
{
    public function index(){
        return view('admin.affiliate_links');
    }
}
