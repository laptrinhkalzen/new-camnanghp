<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

    //
    protected $table = "news";
    protected $fillable = [
        'title', 'alias', 'category_id', 'description', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'is_hot', 'status', 'ordering', 'keywords', 'images', 'created_by', 'view_count', 'member_id', 'language'
    ];

    public function categories() {
        return $this->belongsToMany('App\NewsCategory', 'news_category', 'news_id', 'category_id');
    }

    public function newsCategories() {
        return $this->hasMany('App\NewsCategory');
    }

    public function url() {
        return route('news.detail', ['alias' => $this->alias]);
    }

    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

}
