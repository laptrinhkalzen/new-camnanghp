<?php

namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class ToplistCategoryRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ToplistCategory';
    }

    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:toplist_category',
            'alias' => 'required'
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:toplist_category,title,' . $id . ',id',
            'alias' => 'required'
        ];
    }

    public function readCategoryByType($type) {
        return $this->model->where('type', $type)->orderBy('created_at', 'desc')->get();
    }

    public function readParentCategory($type, $parent_id) {
        return $this->model->where('type', $type)->where('id', $parent_id)->first();
    }

    public function readHomeProductCategory() {
        return $this->model->where('type', \App\Category::TYPE_PRODUCT)->where('parent_id', \App\Category::PRODUCT_SHOP_ID)->get();
    }

    public function readHomeGalleryCategory($limit = 10) {
        return $this->model->where('type', \App\Category::TYPE_GALLERY)->where('parent_id', \App\Category::GALLERY_ALBUM)->take($limit)->get();
    }

    public function getCurrentCategory($id) {
        $data = $this->model->where('id', $id)->first();
        return $data;
    }
    
    public function getParent($parent_id, $type = 'product') {
        $item = $this->model->where('id', $parent_id)->first();        
        $item->parent = $this->getParent($item->parent_id, $type);
        return $item;
    }
    public function getChildren($parent_id, $type = 'product') {
        $item = $this->model->where('parent_id', $parent_id)->get();        
        return $item;
    }

    public function readVideoCategory() {
        return $this->model->where('type', \App\Category::TYPE_VIDEO)->where('parent_id', '!=', 0)->orderBy('ordering','asc')->get();
    }

    public function readHomeNewsCategory($limit = 10) {
        return $this->model->where('type', \App\Category::TYPE_NEWS)->where('is_home', 1)->take($limit)->get();
    }

    /*Custom*/
     public function getAll() {
        $value = $this->model->select('id','title','created_at','status')->orderBy('created_at', 'desc')->get();
        return $value;
    }

}
