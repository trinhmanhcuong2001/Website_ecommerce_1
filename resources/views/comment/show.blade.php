
<div class="flex-w flex-t p-b-68 p-l-14">
    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
        <img src="{{URL::asset('template/images/avatar-01.jpg')}}" alt="AVATAR">
    </div>

    <div class="size-207">
        <div class="flex-w flex-sb-m p-b-17">
            <span class="mtext-107 cl2 p-r-20">
                {{$comment->name}}
            </span>

            <span class="fs-18 cl11">
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star"></i>
                <i class="zmdi zmdi-star-half"></i>
            </span>
            <div class="cl2 p-r-10">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </div>
        </div>

        <p class="stext-102 cl6">
            {{$comment->content}}
        </p>
    </div>
</div>