@extends('admin.main')

@section('content')
@include('admin.alert')
    <table class='table'>
        <thead>
            <tr>
                <th style="width:50px">ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width:100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key=>$product)
            <tr>
                <td>{{$product->id}}</td>
                <td> {{$product->name}} </td>
                <td> {{$product->menu->name}} </td>
                <td> {{number_format($product->price)}} </td>
                <td> {{number_format($product->price_sale)}} </td>
                <td> {!! \App\Helpers\Helper::active($product->active) !!} </td>
                <td> {{$product->updated_at}} </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{url('/admin/product/edit/'.$product->id)}}" >
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow({{$product->id}},'{{ url('admin/product/delete') }}')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $products->links() !!}
@endsection