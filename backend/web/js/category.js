
$('.category-text').on('click', collapse);

function collapse() {
    var elOl = $(this).parent().next();
    var el = $(this).find('i');

    if(elOl.hasClass('category-hide-ol')){
        elOl.addClass('category-show-ol');
        elOl.removeClass('category-hide-ol');
        el.addClass('category-open');
    }
    else{
        elOl.removeClass('category-show-ol');
        elOl.addClass('category-hide-ol');
        el.removeClass('category-open');
    }
}

function addCategory(el) {
    var item = $(el).parent().data('item');
    if(!item)
        item = $(el).data('item');
    var url = '/category/category/create';
    showModal(url, item);
}

function showModal(url, item) {
    $.ajax({
        method: 'POST',
        url: url,
        success: function (data) {
            if(data){
                $('#category-form-modal .modal-content').html(data);
                $('#category-form-modal').show();
                 setParentItem($('#category-form-modal .save'), item);
                $('#category-form-modal .close').on('click', closeModalWindow);
            }
        }
    })
}

function setParentItem(el, item) {
    var action = el.data('action');

    if(+action === 0)
        $('#categoryform-parentid').val(item);
}

function closeModalWindow() {
    $('#category-form-modal').hide();
}

function editCategory(el) {
    var item = $(el).parent().data('item');
    var url = '/category/category/update?id=' + item;
    showModal(url);
}

function removeCategory(el) {
    if (confirm('Are you sure you want to delete category?')) {
        var item = $(el).parent().data('item');
        $.ajax({
            method: 'POST',
            url: '/category/category/delete?id=' + item,
        });
    } else {
       return;
    }
}