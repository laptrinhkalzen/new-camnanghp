@extends('backend.layouts.master')
@section('content')
<div class="content">
    <form action="{!!route('admin.news.update', ['id' => $record->id])!!}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Tạo mới</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="nav-item"><a href="#left-icon-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Thông tin cơ bản</a></li>
                            <li class="nav-item"><a href="#left-icon-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Thẻ meta</a></li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="left-icon-tab1">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                                        <fieldset>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Danh mục <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select class="select-search form-control" name="category_id[]"data-placeholder="Chọn danh mục" multiple="" required>
                                                        @foreach($cat_id as $key1 => $category_id)
                                                            @foreach($categories as $key => $category)
                                                            @if($category->id==$category_id)
                                                            <option value="{{$category->id}}" selected="">{{$category->title}}</option>
                                                            @endif
                                                            @if($key1==0)
                                                            <option value="{{$category->id}}" >{{$category->title}}</option>
                                                            @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Tiêu đề <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="title" value="{!!is_null(old('title'))?$record->title:old('title')!!}" required="">
                                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Url <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" readonly="" name="alias" value="{!!is_null(old('alias'))?$record->alias:old('alias')!!}" required>
                                                    {!! $errors->first('alias', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Mô tả: </label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="description">{!!is_null(old('description'))?$record->description:old('description')!!}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Hình ảnh</label>
                                                <div class="col-md-9">
                                                    <button type="button" class="btn btn-primary legitRipple" id="ckfinder-popup-1">Upload</button>
                                                    <input hidden type="text" id="ckfinder-input-1" name="images">
                                                    <div id="preview_image" class="mt-3" >
                                                        <img src="{{$record->images}}" style="width: 600px;height: auto;">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label text-right">Nội dung: </label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control ckeditor" id="content" name="content">{!!is_null(old('content'))?$record->content:old('content')!!}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                            <label class="col-form-label col-md-3 text-right">Thứ tự </label>
                            <div class="col-md-3">
                                <input type="text" name="ordering" class="form-control touchspin text-center" value="{!!is_null(old('ordering'))?$record->ordering:old('ordering')!!}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Từ khóa</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control tokenfield" name="keywords" data-fouc value="{!!$record->keywords!!}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check col-md-4 form-check-right">
                                <label class="form-check-label float-right">
                                    Hiển thị
                                    <input type="checkbox" class="form-check-input-styled" name="status" data-fouc="" @if($record->status) checked @endif>
                                </label>
                            </div>
                        
                            <div class="form-check col-md-5 form-check-right">
                                <label class="form-check-label float-right">
                                    Tin nổi bật
                                    <input type="checkbox" class="form-check-input-styled" name="is_hot" data-fouc="" @if($record->is_hot) checked @endif>
                                </label>
                            </div>
                        </div>


                                        </fieldset>
                                        <div class="text-right">
                                            <a type="button" href="{{route('admin.news.index')}}" class="btn btn-secondary legitRipple">Hủy</a>
                                            <button type="submit" class="btn btn-primary legitRipple">Lưu lại <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="left-icon-tab2">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-right">Thẻ tiêu đề (SEO)</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="meta_title" value="{!!is_null(old('meta_title'))?$record->meta_title:old('meta_title')!!}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-right">Thẻ từ khóa (SEO) </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="meta_keywords">{!!is_null(old('meta_keywords'))?$record->meta_keywords:old('meta_keywords')!!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label text-right">Thẻ mô tả (SEO) </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control maxlength-label-position" maxlength="255" name="meta_description">{!!is_null(old('meta_description'))?$record->meta_description:old('meta_description')!!}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>
@stop
@section('script')
@parent
<script type="text/javascript">
    var button1 = document.getElementById( 'ckfinder-popup-1' );

button1.onclick = function() {
    selectFileWithCKFinder( 'ckfinder-input-1' );
};


function selectFileWithCKFinder( elementId ) {

    CKFinder.modal( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                var output = document.getElementById( elementId );
                output.value = file.getUrl();
              showUploadedImage( file.getUrl() );

            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
                showUploadedImage( evt.data.resizedUrl );

            } );
        }
    } );

    function showUploadedImage( url ) {
            // Show chosen image to div tag
            var img = jQuery( '<img width="600px" height="auto">' ).attr( 'src', url );
            jQuery( '#preview_image' ).html( img );
          }
}


</script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/select2.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switch.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/touchspin.min.js') !!}"></script>

<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tagsinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/tags/tokenfield.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/ui/prism.min.js') !!}"></script>

<!-- Theme JS files -->
<script src="{!! asset('assets/global_assets/js/plugins/ui/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/daterangepicker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/anytime.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.date.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/picker.time.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/pickers/pickadate/legacy.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/notifications/jgrowl.min.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('assets/backend/js/custom.js') !!}"></script>



<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>

@stop
