<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;
use App\Repositories\ToplistCategoryRepository;
use App\Helpers\StringHelper;

class TopListCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TopListCategoryRepository $toplistcategoryRepo) {
        $this->toplistcategoryRepo = $toplistcategoryRepo;
    }

    public function index() {
        $records = $this->toplistcategoryRepo->getAll();
        return view('backend/toplist_cat/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parent_html = StringHelper::getSelectOptions(\App\ToplistCategory::all());
        return view('backend/toplist_cat/create', compact('parent_html'));
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
        $validator = \Validator::make($input, $this->toplistcategoryRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->toplistcategoryRepo->create($input);
        return redirect()->route('admin.toplist_category.index')->with('success', 'Tạo mới thành công');
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
        $record = $this->toplistcategoryRepo->find($id);
        $parent_html = StringHelper::getSelectOptions(\App\ToplistCategory::all(), $record->parent_id);
        return view('backend/toplist_cat/edit', compact('record', 'parent_html'));
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
        if($input['image']==null){
            unset($input['image']);
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $validator = \Validator::make($input, $this->toplistcategoryRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->toplistcategoryRepo->update($input, $id);
        return redirect()->route('admin.toplist_category.index')->with('success', 'Cập nhật thành công');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $res = $this->toplistcategoryRepo->delete($id);
        return redirect()->route('admin.toplist_category.index')->with('success', 'Xóa thành công');
    }

}
