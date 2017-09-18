<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $newsList = News::get();
        return view('news.index')->with('newsList', $newsList);
    }
}
