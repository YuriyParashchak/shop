$(window).on('load', function () {
var formLoad = false;

$('#login-but').on('click', function () {
    if(formLoad){
        $('#login-form-show').modal('show');
        return;
    }

    $.ajax({
        method: 'POST',
        url: '/site/login',
        success: function (data) {
            if(data){
                $('#login-form-show .modal-content').append(data);
                $('#login-form-show').modal('show');
                $('#loginSubmit').on('click', loginSubmit);
                formLoad = true;
            }
        }
    })
});

function loginSubmit(event){
        var form = $('#login-form');

        if(!validate(form))
            return;
        validPassName(form);
    }

    function validate(form) {
        var name = $('#loginform-email').val().trim();
        var pass = $('#loginform-password').val().trim();
        if(name.length >0 && pass.length > 0){
            return true;
        }
    }

    function validPassName(form) {
        $.ajax({
            method: 'POST',
            url: '/site/validation',
            data: form.serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.length == 0){
                    login(form);
                }
                else{
                    var text = data['loginform-password'][0];
                    var el = $($('#loginform-password').next());
                    el.text(text);
                    el.show();
                }
            }
        })
    }

    function login(form) {
        $.ajax({
            method: 'POST',
            url: '/site/login',
            data: form.serialize(),
            success: function (data) {
                $('#login-but').parent().last().append(data);
                $('#login-but').remove();
                $('#login-form-show .close').trigger('click');
                $('#signup-but').remove();
                $('#login-form-show .modal-content').html('');
                var currentUrl = window.location.origin;
                var url = window.location.href;
                if(currentUrl + '/' === url || currentUrl + '/#' === url)
                    window.location.reload();

                //removeAutorizing();
            }
        })
    }

    function removeAutorizing() {
        $('.autorizing').each(function (index) {
            $(this).removeClass('autorizing');
        })
    }
});