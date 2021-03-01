<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Repositories\NewsRepository;
use Repositories\ConfigRepository;
use DB;



class BackendController  extends Controller
{
    

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NewsRepository $newRepo, \Repositories\ConfigRepository $configRepo) {
        
        $this->newsRepo = $newRepo;
        $this->configRepo = $configRepo;
    }
    public function index()
    {
        $news_count = $this->newsRepo->all()->count();
        $toplist_count = DB::table('toplist')->count();
        $member_count = DB::table('member')->count();;
        
        return view('backend/index', compact('news_count','member_count','toplist_count'));
    }


}