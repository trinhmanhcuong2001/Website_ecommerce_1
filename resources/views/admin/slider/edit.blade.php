@extends('admin.main')
@section('head')
    <script src="{{URL::asset('/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
@include('admin.alert')
<form action="" method="post">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="menu">Tiêu Đề</label>
            <input type="text" name='name' value="{{$slider->name}}" class="form-control" placeholder="Nhập tiêu đề">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Đường dẫn</label>
            <input type="text" class="form-control" name='url' value="{{$slider->url}}" placeholder="Nhập đường dẫn">
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label for="formFile" >Ảnh</label>
        <input class="form-control" type="file" id="upload">
        <div id="image-show">
            <a href="{{URL::to($slider->thumb)}}" target="_blank">
                <img src="{{URL::to($slider->thumb)}}" alt="" width="100px">
            </a>
        </div>
        <input type="hidden" name="thumb" id="thumb">
      </div>
      <div class="form-group">
        <label for="">Sắp xếp</label>
        <input type="number" class="form-control" name='sort_by' value="{{$slider->sort_by}}">
      </div>
      <div class="form-group">
        <label>Kích hoạt</label>
        <div class="custom-control custom-radio">
          <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$slider->active == 1 ? 'checked' : ""}}>
          <label for="active" class="custom-control-label">Có</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="custom-control-input" type="radio" value="0" id="no-active" name="active" {{$slider->active == 0 ? 'checked' : ""}}>
          <label for="no-active" class="custom-control-label">Không</label>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Thêm slider</button>
    </div>
</form>
@endsection

@section('footer')
<script>
    var uploadUrl = "{{URL::to('/admin/upload/services')}}";
</script>

@endsection