@extends('main')

@section('content')
    <!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="{{url('/')}}" class="stext-109 cl8 hov-cl1 trans-04">
				Trang chủ
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Giỏ hàng
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	@include('admin.alert')
	@if(count($products) > 0)
	<form class="bg0 p-t-75 p-b-85" method="post">
		
		@csrf
		
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							@php $subTotal = 0 @endphp
							
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Sản phẩm</th>
									<th class="column-2"></th>
									<th class="column-3">Giá</th>
									<th class="column-4">Số lượng</th>
									<th class="column-5">Tổng</th>
									<th class="column-5">&nbsp;</th>
								</tr>
									
								@foreach ($products as $product)
									@php
										$carts = session('carts',[]);
										$qty = $carts[$product->id];
										$total = $product->price_sale != 0 ? $product->price_sale * $qty : $product->price * $qty;
										$subTotal += $total;
									@endphp
									<tr class="table_row">
										<td class="column-1">
											<div class="how-itemcart1">
												<img src="{{URL::asset($product->thumb)}}" alt="IMG">
											</div>
										</td>
										<td class="column-2">{{$product->name}}</td>
										<td class="column-3"> {{$product->price_sale != 0 ? number_format($product->price_sale) : number_format($product->price)}} VNĐ</td>
										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product[{{$product->id}}]" value="{{$qty}}">

												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>
										<td class="column-5">{{number_format($total)}} VND</td>
										<td>
											<a href="{{url('carts/delete/'. $product->id)}}">Xóa</a>
										</td>
									</tr>
								@endforeach
								

							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<input class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" type="submit" value="Update Cart" formaction="{{url('/update-cart')}}">
							
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Tổng giỏ hàng
						</h4>
						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Tiền sản phẩm:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									{{number_format($subTotal)}} VNĐ
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">


							<div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Thông tin khách hàng
									</span>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách hàng">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa chỉ">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" placeholder="Email liên hệ">
									</div>
									
									<div class="bor8 bg0 m-b-22">
										<textarea class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="content" placeholder="Ghi chú"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Tổng cộng:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-101 cl2">
									{{number_format($subTotal)}} VNĐ
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Đặt hàng
						</button>
					</div>
				</div>
			</div>
		</div>
		
	</form>
	@else
		<div class="text-center m-b-200 m-t-200"><h2>Giỏ hàng trống</h2></div>
	@endif
@endsection
