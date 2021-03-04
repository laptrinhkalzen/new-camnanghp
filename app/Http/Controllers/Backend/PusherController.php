<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\HelloPusherEvent;
use DB;
use Carbon\Carbon;


class PusherController extends Controller {

    public function pusher(Request $request) {
            event(new HelloPusherEvent($request));
            return redirect('getPusher');
    }

    
    

}
