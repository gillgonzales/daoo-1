<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index():void {
        echo "HomeController: olá mundo";
        dd("Terminou...");
    }
}
