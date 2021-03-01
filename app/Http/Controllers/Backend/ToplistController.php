<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TopListRepository;
use App\Repositories\TopListCategoryRepository;
use Carbon\Carbon;
use DB;

class ToplistController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ToplistRepository $toplistRepo, ToplistCategoryRepository $toplistcategoryRepo) {
        $this->toplistRepo = $toplistRepo;
        $this->toplistcategoryRepo = $toplistcategoryRepo;
    }

    public function index() {
        
        if (\Auth::user()->role_id == \App\User::ROLE_ADMINISTRATOR || \Auth::user()->role_id == \App\User::ROLE_EDITOR) {
            $records = $this->toplistRepo->getAll();
        } else {
            $records = $this->toplistRepo->getAllByUserId(\Auth::user()->id);
        }

            $cats=DB::table('toplist_category')->get();
        return view('backend/toplist/index', compact('records','cats'));
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $options = $this->toplistcategoryRepo->getAll();
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options);
        return view('backend/toplist/create', compact('category_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->except(['_token']);
        $validator = \Validator::make($input, $this->toplistRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['created_by'] = \Auth::user()->id;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        // $input['updated_at'] = '0000-00-00 00:00:00 ';
        $count=0;
        foreach ($input['category_id'] as $key => $value) {
            $count++;
        }

        //dd($count);
       // dd($input['category_id']);
        foreach ($input['category_id'] as $key => $value) {
            if($key==0){
            $input['category_id']=$value;
        }
        elseif($key==$count-1 ){
            $input['category_id'].=','.$value;
        }
        else{
            $input['category_id'].=','.$value;
        }
        }
        $toplist = DB::table('toplist')->insert($input);
                if ($toplist) {
            return redirect()->route('admin.toplist.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.toplist.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = $this->toplistRepo->find($id);
        foreach( explode(',',$record->category_id) as $key => $value){
            $cat_id[]=$value;
        }
        $categories=DB::table('toplist_category')->get();
        return view('backend/toplist/edit', compact('record','cat_id','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->except(['_token']);
        $validator = \Validator::make($input, $this->toplistRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        $input['status'] = (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) ? 1 : 0;
        
        $count=0;
        foreach ($input['category_id'] as $key => $value) {
            $count++;
        }

        //dd($count);
       // dd($input['category_id']);
        foreach ($input['category_id'] as $key => $value) {
            if($key==0){
            $input['category_id']=$value;
        }
        elseif($key==$count-1 ){
            $input['category_id'].=','.$value;
        }
        else{
            $input['category_id'].=','.$value;
        }
        }

        $res = DB::table('toplist')->where('id',$id)->update($input);
        if ($res == true) {
            
            return redirect()->route('admin.toplist.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.toplist.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $toplist = $this->toplistRepo->find($id);
        $toplist->categories()->detach();
        $this->toplistRepo->delete($id);
        return redirect()->route('admin.toplist.index')->with('success', 'Xóa thành công');
        //
    }

}
