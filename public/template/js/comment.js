$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.addEventListener('DOMContentLoaded',function(){
    var productId = $('#product-id').val();
    var preComment = $('#pre-comment');
    var nextComment = $('#next-comment');
    let page = 1;
    function loadComment(product_id, page) {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            data: { product_id: product_id, page: page },
            url: urlComment,
            success: function (result) {
                $('#list-comment').html(result.html);
                preComment.off('click').prop('disabled', page <= 1);
                nextComment.off('click').prop('disabled', page >= result.totalPage);

                preComment.on('click', function () {
                    if (page > 1) {
                        page--;
                        loadComment(productId, page);
                    }
                });

                nextComment.on('click', function () {
                    if (page < result.totalPage) {
                        page++;
                        loadComment(productId, page);
                    }
                });
            }
        });
    }
    window.addEventListener('beforeunload', function(){
        page = 1;
    });
    loadComment(productId,page);
});