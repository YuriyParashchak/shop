$('.autorizing').on('click', loginForm);

function loginForm(event) {
    event.preventDefault();
    $('#login-but').trigger('click')
}

$('#advert-items-list .preference').on('click', function () {
    var el = $(this);
    if(el.hasClass('autorizing'))
        return;
    var url = '/product/preference';
    if(el.find('img').hasClass('liked')){
        url = '/product/delete-preference'
    }
    setPreference(el, url);
})

function setPreference(el, url) {
    var item = el.data('item');
    $.ajax({
        method: 'POST',
        url: url,
        data: {item : item},
        dataType: 'json',
        success: function (data) {
            if(data)
                swal(data.type, data.message,data.typeMessage);
            if(data.typeMessage === 'success')
                if(el.find('img').hasClass('liked'))
                    el.find('img').removeClass('liked');
                else
                    el.find('img').addClass('liked');
        }
    })
}