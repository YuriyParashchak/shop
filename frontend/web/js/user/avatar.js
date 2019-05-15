




var cropper;
var preview = document.getElementById('avatar');
var file_input = document.getElementById('usereditform-imagefile');

$('#avatarka').on('click',function (e) {
    e.preventDefault();
   $('#usereditform-imagefile').click();

    // $("#myModal").css("opacity",0);

});

file_input.onchange  = function ()
{
    var file = file_input.files[0];

    if (!file)
    {
        return $("#myModal").modal("hide");
    }

    $("#myModal").modal("show");

    var reader = new FileReader();

    reader.addEventListener('load', function (event)
    {
        preview.src = reader.result
    }, false);

    setTimeout(function () {
        reader.readAsDataURL(file);
    }, 500);



};
preview.addEventListener('load', function (event)
{
    // $("#myModal").css("opacity",1);
    if(cropper)
        cropper.destroy();
    cropper= new Cropper(preview, {
        aspectRatio: 1/1,
        minCropBoxHeight:100,
        minCropBoxWidth:100,
        scalable:false,
        zoomable:false,
    });


});

$('#myModal').on('hidden.bs.modal', function () {
    if(cropper)
    {
        cropper.destroy();

    }
    $('#avatar').hide();
});


$('#save_avatar').on('click', function closeCropper(){

    event.preventDefault();

    cropper.getCroppedCanvas({
        maxHeight: 1000,
        maxWidth: 1000
    }).toBlob(function (blob)
    {
        ajaxWith(blob)
        //console.log(blob);
    })

} );

function ajaxWith(blob)
{
    if(!blob)
        return;

    var data = new FormData();
    data.append('file', blob);

    $.ajax({
        url:'add-avatar',
        method: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(data){
          //  console.log('Upload success');
            $("#imgFile").attr('src', '/avatar/'+data);

        },
        error: function(){
            console.log('Upload error');
        }
    });
}
