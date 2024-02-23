$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if(confirm('Bạn có chắc muốn xóa danh mục không!')){
        $.ajax({
            method: DELETE,
            dataType: 'json',
            data: id,
            url: url,
            success: function(result){
                console.log(result);
            }
        });

        
    }
}

$('#upload').change(function(){
    var form = new FormData();
    form 
})