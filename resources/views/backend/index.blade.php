@extends('backend.layouts.master')
@section('content')
<!-- Content area -->
<div class="content">
    <div class="row">
        <div class="col-sm-4">
            <a href="{{route('admin.toplist.index')}}">
                <div class="tile-stats tile-red"> 
                    <div class="icon"><i class="icon-list"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="3350" data-postfix="" data-duration="1500" data-delay="0">
                         {{$toplist_count}}</div>
                    <h3>Toplist</h3>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('admin.news.index')}}">
                <div class="tile-stats tile-aqua"> 
                    <div class="icon"><i class="icon-newspaper"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="85" data-postfix="" data-duration="1500" data-delay="0">
                        {{$news_count}}</div>
                    <h3>Tin tức</h3>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('admin.member.index')}}">  
                <div class="tile-stats tile-green"> 
                    <div class="icon"><i class="icon-bubble-dots4"></i>
                    </div> 
                    <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">
                        {{$member_count}}</div>
                    <h3>Thành viên</h3>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /content area -->
@stop
