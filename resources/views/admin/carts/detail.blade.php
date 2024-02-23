@extends('admin.main')

@section('content')
    <div class="customer">
        <ul>
            <li>Tên khách hàng: <strong>{{$customer->name}}</strong></li>
            <li>Số điện thoại: <strong>{{$customer->phone}}</strong></li>
            <li>Địa chỉ: <strong>{{$customer->address}}</strong></li>
            <li>Email: <strong>{{$customer->email}}</strong></li>
            <li>Ghi chú: <strong>{{$customer->content}}</strong></li>  
        </ul>    
    </div> 
    <div class="carts">
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Sản phẩm</th>
                <th class="column-2">Tên</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng</th>
                <th class="column-5">&nbsp;</th>
            </tr>
                @php
                    $subTotal =0;
                @endphp 
            @foreach ($carts as $cart)
                @php
                    $total = $cart->price * $cart->qty;
                    $subTotal += $total;
                @endphp
                <tr class="table_row">
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{URL::asset($cart->product->thumb)}}" alt="IMG" width="100px">
                        </div>
                    </td>
                    <td class="column-2">{{$cart->product->name}}</td>
                    <td class="column-3"> {{number_format($cart->price)}} VNĐ</td>
                    <td class="column-4">{{$cart->qty}}</td>
                    <td class="column-5">{{number_format($total)}} VND</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;">Tổng tiền: </td>
                    <td>{{number_format($subTotal)}} VNĐ</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection