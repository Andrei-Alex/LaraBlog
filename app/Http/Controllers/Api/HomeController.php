<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $articles = [
            ['id' => 1, 'title' => 'First article', 'body' => 'This is the first article.'],
            ['id' => 2, 'title' => 'Second article', 'body' => 'This is the second article.'],
        ];

        return response()->json($articles);
    }
}
