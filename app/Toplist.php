<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toplist extends Model {

    //
    protected $table = "toplist";
    protected $fillable = [
        'title', 'address', 'category_id', 'content', 'images','vote_sum', 'status', 'odering', 'created_by','updated_by','language'
    ];

    public function getPostSchedule() {
        return date('d/m/Y', strtotime($this->post_schedule != '0000-00-00 00:00:00' ?: $this->created_at));
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
