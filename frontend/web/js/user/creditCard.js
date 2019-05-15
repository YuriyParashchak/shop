$('#addCard').on('click',function (e) {
    e.preventDefault();
    $("#modalCard").modal("show");


    $.ajax({
        method:'POST',
        url: 'create-credit-card',
        success: function (data) {
            console.log(data);
            $('.modal-body').html(data);
            $(".form").find(".cd-numbers").find(".fields").find("input").on('keyup change',addFormCard1);
            $(".form").find(".cd-holder").find("input").on('keyup change',addFormCard2);
            $(".form").find(".cd-validate").find(".expiration").find('select#month').on('keyup change',addFormCard3);
            $(".form").find(".cd-validate").find(".expiration").find('select#year').on('keyup change',addFormCard4);

        },
        error: function () {
            console.log('form error');
        }

    })
});


function addFormCard1(e){

    var charLength = $(this).val().length;

    $(".card").removeClass("flip");

    if(charLength == 4){
        $(this).next("input").focus();
    }

    if($(this).hasClass("1")){
        var inputVal = $(this).val();
        if(!inputVal.length == 0){
            $(".card").find(".front").find(".cd-number").find("span.num-1").text(inputVal);
        }
    }

    if($(this).hasClass("2")){
        var inputVal = $(this).val();
        if(!inputVal.length == 0){
            $(".card").find(".front").find(".cd-number").find("span.num-2").text(inputVal);
        }
    }

    if($(this).hasClass("3")){
        var inputVal = $(this).val();
        if(!inputVal.length == 0){
            $(".card").find(".front").find(".cd-number").find("span.num-3").text(inputVal);
        }
    }

    if($(this).hasClass("4")){
        var inputVal = $(this).val();
        if(!inputVal.length == 0){
            $(".card").find(".front").find(".cd-number").find("span.num-4").text(inputVal);
        }
    }

};
function addFormCard2(e){
    var inputValCdHolder = $(this).val();

    $(".card").removeClass("flip");

    if(!inputValCdHolder.length == 0){
        $(".card").find(".front").find(".bottom").find(".cardholder").find("p.holder").text(inputValCdHolder)
    }

};


function addFormCard3(e){

    $(".card").removeClass("flip");
    if(!$(this).val().length == 0){
        $(".card").find('.bottom').find('.expires').find("p").find("span.month").text($(this).val())
    }

};
function addFormCard4(e){

    $(".card").removeClass("flip");
    if(!$(this).val().length == 0){
        $(".card").find('.bottom').find('.expires').find("p").find("span.year").text($(this).val())
    }

};
$("button.submit").on('click', function(e){

    $(this).parents("form").submit();


});

$('.deleteCard').on('click',function (e) {

    e.preventDefault();
    var idCard = $(this).data('card-id');

    $.ajax({
        url: 'delete',
        type: 'POST',
        data: {idCard:idCard},
        success: function(res){
            console.log(res);
            $('#card_'+idCard).remove();


        },
        error: function(){
            alert('Error!');
        }
    })

})

