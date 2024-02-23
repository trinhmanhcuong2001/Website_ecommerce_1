
    <h1>Có một đơn đặt hàng</h1>
    <table class="table">
        <tbody>
        <tr class="table_head">
            <th class="column-1">Tên</th>
            <th class="column-2">Giá</th>
            <th class="column-3">Số lượng</th>
            <th class="column-4">Tổng</th>
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
                <td class="column-1">{{$cart->product->name}}</td>
                <td class="column-2"> {{number_format($cart->price)}} VNĐ</td>
                <td class="column-3">{{$cart->qty}}</td>
                <td class="column-4">{{number_format($total)}} VND</td>
            </tr>
        @endforeach
            <tr>
                <td colspan="4" style="text-align: right;">Tổng tiền: </td>
                <td>{{number_format($subTotal)}} VNĐ</td>
            </tr>
        </tbody>
    </table>
