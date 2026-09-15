<?php

namespace App\Http\Controllers\taskManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class listController extends Controller
{
    //
    public function index()
    {
        //
        return Inertia::render('taskManager/lists/Index');
    }
}
