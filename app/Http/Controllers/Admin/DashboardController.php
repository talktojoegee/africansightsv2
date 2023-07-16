<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->post = new Post();
        $this->postcomment = new PostComment();
    }
    public function dashboard()
    {
        return view('super-admin.overview',[
            'recentArticles'=>$this->post->getArticles(),
            'articles'=>$this->post->getCurrentYearArticles(),
            'lastYear'=>$this->post->getLastYearArticles(),
            'currentMonth'=>$this->post->getCurrentMonthArticles(),
            'lastMonth'=>$this->post->getLastMonthArticles(),
            'recentComments'=>$this->postcomment->getRecentComments()
        ]);
    }
}
