$(window).on('load', function () {
    var formLoad = false;

    $('#signup-but').on('click', function () {

        if(formLoad){
            $('#signup-form-show').modal('show');
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/site/signup',
            success: function (data) {
                if(data){
                    $('#signup-form-show .modal-content').append(data);
                    $('#signup-form-show').modal('show');
                    $('#signupSubmit').on('click', signupSubmit);
                    formLoad = true;
                }
            }
        })
    });
    function signupSubmit() {
        var form = $('#form-signup');

        if(!formValidate(form))
            return;

        $.ajax({
            method: 'POST',
            url: '/site/signup',
            data: form.serialize(),
            success: function (data) {
                if(data.ex){
                    console.log(data.ex);
                    return;
                }
                if(data){
                    $('#signup-form-show .modal-content').html(data);
                    $('#signupConfirm').on('click', signupConfirm);
                }
            }
        })
    }
    
    function signupConfirm() {
        var form = $('#signup-confirm-form');

        if(!formValidate(form))
            return;

        $.ajax({
            method: 'POST',
            url: '/site/confirm-signup',
            data: form.serialize(),
            success: function (data) {
                if(data.ex){
                    console.log(data.ex);
                    return;
                }

                if(data){
                    $('#login-but').parent().last().append(data);
                    $('#login-but').remove();
                    $('#signup-form-show .close').trigger('click');
                    $('#signup-but').remove();
                    $('#signup-form-show .modal-content').html('');
                }
            }
        })
    }

    function formValidate(form) {
        form.find(':input').each(function () {
            if($(this).val().trim().length < 1)
                return false;
        });

        form.find('.invalid-feedback').each(function () {
            if($(this).text().trim().length > 0)
                return false;
        });
        return true;
    }
})