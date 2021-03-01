<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NewsCategoryRepository;
use App\Helpers\StringHelper;
use DB;

class NewsCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NewsCategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    public function index() {
        $records = DB::table('news_category')->orderBy('id','desc')->get();
        return view('backend/news_category/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parent_html = StringHelper::getSelectOptions(\App\NewsCategory::all());
        return view('backend/news_category/create', compact('parent_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;    
        }
        $validator = \Validator::make($input, $this->categoryRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->categoryRepo->create($input);
        return redirect()->route('admin.news_category.index')->with('success', 'Tạo mới thành công');
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
        $record = $this->categoryRepo->find($id);
        $parent_html = StringHelper::getSelectOptions(\App\NewsCategory::all(), $record->parent_id);
        return view('backend/news_category/edit', compact('record', 'parent_html'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        
        if ($input['parent_id'] == null) {
            $input['parent_id'] = 0;
        }
        $validator = \Validator::make($input, $this->categoryRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->categoryRepo->update($input, $id);
        return redirect()->route('admin.news_category.index')->with('success', 'Cập nhật thành công');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id) {
        $res = $this->categoryRepo->delete($id);
        return redirect()->route('admin.news_category.index')->with('success', 'Xóa thành công');
    }

}
