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
            <label for="menu">Tên sản phẩm</label>
            <input type="text" name='name' value="{{old('name')}}" class="form-control" placeholder="Nhập tên sản phẩm">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Danh mục</label>
            <select name="menu_id" class="form-control">
              @foreach($menus as $menu) 
                  <option value="{{$menu->id}}">{{$menu->name}} </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="menu">Giá gốc</label>
            <input type="number" name='price' class="form-control" value="{{old('price')}}">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Giá giảm</label>
            <input type="number" name='price_sale' class="form-control" value=" {{old('price_sale')}}">
          </div>
        </div>
      </div>
      

      
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" >{{old('description')}}</textarea>
      </div>
      <div class="form-group">
        <label>Mô tả chi tiết</label>
        <textarea name="content" class="form-control" id="ckeditor1" ></textarea>
      </div>
      <div class="form-group">
        <label for="formFile" >Ảnh sản phẩm</label>
        <input class="form-control" type="file" id="upload">
        <div id="image-show">

        </div>
        <input type="hidden" name="thumb" id="thumb">
      </div>
      <div class="form-group">
        <label>Kích hoạt</label>
        <div class="custom-control custom-radio">
          <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked>
          <label for="active" class="custom-control-label">Có</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="custom-control-input" type="radio" value="0" id="no-active" name="active">
          <label for="no-active" class="custom-control-label">Không</label>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('ckeditor1');
    var uploadUrl = "{{URL::to('/admin/upload/services')}}";
</script>

@endsection