var btnAddPhone = $('.addPhone');
var phoneIndex = 1;

$(document).ready(function() {
    if(PHONES_COUNT>=5)
        $('#addPhone').hide();
});



$('#addPhone').on('click',function (e) {
    e.preventDefault();

    if(PHONES_COUNT<5)
    {
        var html = PHONE_INPUT.slice();
        html = html.replace(/__INDEX__/g, phoneIndex);

        var element = $(html);

        element.find('.save-phone').click(savePhone);

        //  var $newForm = $('.adPhone').append(element);
        $(element).insertAfter($("#px"));
        //  btnAddPhone.before($newForm);
        phoneIndex++;
        //$('#addPhone').remove();
        $('#addPhone').hide();
    }



});

function savePhone(e) {
    var index = $(this).data('index');
    var phoneEl = $('#add-phone'+ index);

    var number = phoneEl.val();
    //alert(number);

    $.ajax({
        url: 'add-phone',
        type: 'POST',
        data: {number:number},
        success: function(res){
            console.log(res);
            PHONES_COUNT++;
           // var html = ROW_PHONE_JS.slice();
          //  html = html.replace(/__INDEX__/g, phoneIndex);
            window.location.href='edit';
           // $('#addPhone').show();

        },
        error: function(){
            alert ('Error!!');
           // swal()
        }
    })
}

$('.deletePhone').on('click',function (e) {
    e.preventDefault();
 var idPhone = $(this).data('phone-id');

    $.ajax({
        url: 'delete-phone',
        type: 'POST',
        data: {idPhone:idPhone},
        success: function(res){
            console.log(res);
            $('#phone_'+idPhone).remove();
            PHONES_COUNT--;
            if(PHONES_COUNT<5)
                $('#addPhone').show();

        },
        error: function(res){
            alert('88888');

        }
    })

});





