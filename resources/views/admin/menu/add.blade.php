@extends('admin.main')
@section('head')
    <script src="{{URL::asset('/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
@include('admin.alert')
<form action="" method="post">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên danh mục</label>
        <input type="text" name='name' class="form-control" placeholder="Nhập tên danh mục">
      </div>

      <div class="form-group">
        <label>Danh mục</label>
        <select name="parent_id" class="form-control">
          <option value="0">Danh mục cha</option>
            @foreach($menus as $menu) 
                <option value="{{$menu->id}}">{{$menu->name}} </option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" ></textarea>
      </div>
      <div class="form-group">
        <label>Mô tả chi tiết</label>
        <textarea name="content" class="form-control" id="ckeditor1"></textarea>
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
</script>

@endsection