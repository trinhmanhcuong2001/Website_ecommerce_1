$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//Xóa ajax
function removeRow(id, url){
    if(confirm('Xóa không thể khôi phục, bạn có chắc chắn muốn xóa?')){
        $.ajax({
            method: "DELETE",
            dataType: "JSON",
            data: {id},
            url: url,
            success: function (result){
                if(result.error===false){
                    alert(result.message);
                    location.reload();
                }else {
                    alert('Lỗi! Vui lòng thử lại.');
                }
            }
        })
    }
}

//Upload file
$('#upload').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
    $.ajax({
        url :  uploadUrl,
        processData : false,
        contentType : false,
        type : 'POST',
        dataType : 'JSON',
        data : form,
        success : function (results){
            if(results.error == false ){
                $('#image-show').html('<a href="'+ results.pathUrl +'" target="_blank" >'+
                '<img src="' + results.pathUrl + '" width="100px"></a>');
                $('#thumb').val(results.url);
            }
            else {
                alert('Lỗi upload file');
            }
        }
    });
});

