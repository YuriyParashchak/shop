$('.join-attribute').on('click', choseAttribute);

function choseAttribute() {
    var el = $(this);
    var checked = 1;
    if(el.hasClass('checked'))
        checked = 0;

    var categ = el.data('category');
    var attr = el.data('attr');
    var data = {categ: categ, attr: attr, checked: checked};
    setAttribute(data, el);
}

function setAttribute(data, el) {
    $.ajax({
        method: 'POST',
        url: '/category/category/set-attribute',
        dataType: 'json',
        data: data,
        success: function (request) {
            var r = request;
            setChecked(el);
        }
    })
}

function setChecked(el) {
    if(el.hasClass('checked'))
        el.removeClass('checked');
    else
        el.addClass('checked');
}