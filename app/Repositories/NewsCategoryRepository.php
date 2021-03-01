<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/10/2019
 * Time: 7:18 AM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class NewsCategoryRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\NewsCategory';
    }
    public function validateCreate() {
        return $rules = [
            'title' => 'required|unique:news_category'
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'title' => 'required|unique:news_category,title,' . $id . ',id'
        ];
    }
    
    public function readCategoryByType() {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function readParentCategory($parent_id) {
        return $this->model->where('id', $parent_id)->first();
    }
    public function getCurrentCategory($id) {
        $data = $this->model->where('id', $id)->first();
        return $data;
    }
    
   

}