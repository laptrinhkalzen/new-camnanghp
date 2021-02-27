<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopListCategory extends Model {

    protected $table = 'toplist_category';
    protected $fillable = [
        'title', 'parent_id', 'alias', 'image', 'description', 'status', 'ordering'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    /* Get all children */

    public function children() {
        return $this->hasMany('\App\Category', 'parent_id');
    }

    /**/
    /* Get all parent */

    public function parents() {
        return $this->belongsTo('\App\Category', 'parent_id');
    }

    public function parentCategories() {
        return $this->belongsTo('\App\Category', 'parent_id')->with('parents');
    }

    /**/

    public function urlNews() {
        return route('news_category.index', ['alias' => $this->alias]);
    }

    public function url() {
        return '#';
    }

    public function news() {
        return $this->belongsToMany('\App\News', 'news_category', 'category_id', 'news_id');
    }


}
