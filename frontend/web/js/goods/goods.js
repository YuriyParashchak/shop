var addPhoto = $('.photo-items-add');
var input_photo = $('#image_imageFile');
var previews = $('#photos-block');
var inForm;

$('form').bind('submit', function() { inForm = true; });

window.addEventListener('click', function (event) {
    if(($(event.target).hasClass('remove')))
        removeImage($(event.target));
    else if (($(event.target).hasClass('reverse')))
        rotateImage($(event.target));
})

window.onunload = function(ev) {
    var returnValue = undefined;
    if (!inForm) {
        returnValue = true;
    }
    return returnValue;
};


window.previewFile = function(){
    var files = input_photo[0].files;
    var lengh = files.length;
    var file;

    var reader = new FileReader();
    reader.addEventListener('load', function () {
        if(isPhotoLimit())
            return;

        var html = getElement(reader.result);

        $(html).insertBefore('.photo-items-add');

        uploadPhoto(file, html);
        if(lengh !== 0){
            if(files[--lengh]){
                file = files[lengh];
                reader.readAsDataURL(files[lengh]);
            }
        }
    });
    if(files[--lengh]){
        file = files[lengh];
        reader.readAsDataURL(files[lengh]);
    }
}

function uploadPhoto(file, html) {
    var form = new FormData();
    form.append("file0", file);
    $.ajax({
        type: 'POST',
        url: '/product/save-img',
        data: form,
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            $(html).find('.holder').hide();
            if(data.result == 0){
                return;
            }
            setImageUrl(data, html);
        }
    })
}

 function removeImage(event) {
    var el = $(event).parent();
    el.parent().find('.holder').show();
    var imageUrl = el.prev().data('url');
    $.ajax({
        type: 'POST',
        url: '/product/remove-img',
        data: {name: imageUrl},
        dataType: 'json',
        success: function (data) {
            if(data.key != 0){
                el.parent().remove();
                removeFormField(data.key);
            }
        }
    })
}

function setImageUrl(data, html){
    var image  = $(html).find('.img-item');
    image.attr('data-url', data);
    addFormImage(data);
}

function isPhotoLimit(){
    var countPhotos = $('.photo-items').length;

    if(countPhotos >= 11)
        $('.photo-items-add').hide();
    else
        $('.photo-items-add').css('display', 'flex');
    if(countPhotos >= 12){
        return true;
    }
    else
        return false;
}

addPhoto.on('click', function () {
    input_photo.trigger('click');
});

function addFormImage(data) {
    var img = new ImageObj(data, 0);
    var el = $('#goodsform-img');
    var array = el.val();
    if(array.length == 0){
        el.val(JSON.stringify([img.getObj()]));
        return;
    }

    array = JSON.parse(array);
    array.push(img.getObj());
    el.val(JSON.stringify(array));
}

function removeFormField(img){

    var el = $('#goodsform-img');
    var array = el.val();
    if(array.length > 0){
        array = JSON.parse(array);
        var arrInd = getIndex(array, img);
        if(arrInd === -1)
            return;
        array.splice(arrInd, 1);
        array = array.length === 1 ? [array] : array ;
        el.val(JSON.stringify(array));
    }
    isPhotoLimit();
}

function rotateImage(el) {
    var img = el.parent().prev();
    var imgName = img.data('url');
    var el = $('#goodsform-img');
    var array = JSON.parse(el.val());
    var ind = getIndex(array, imgName);
    var obj = array[ind];
    var rotate = obj.rotation;
    img.removeClass('photo-rotate-' +rotate * 90);
    if(rotate == 3)
        rotate = 0;
    else
        rotate++;
    obj.rotation = rotate;
    array[ind] = obj;
    el.val(JSON.stringify(array));
    img.addClass('photo-rotate-' +rotate * 90);
}

$('#select-category select').on('change', addChildCategory);

function addChildCategory() {
    var element = $(this)
    deleteChildrenCategory(element);
    var el = element.find(":selected").val();

    if(!el)
        return;

    $.ajax({
        method: 'POST',
        url: '/product/categories',
        data: {name: el},
        dataType: 'json',
        success: function (data) {
            var categories = data.categories;
            var error = data.error;

            if(categories.length){
                getSelectCategory(categories);
            }
            else
                setCategory(el);

            if(error){
                console.log(error);
            }
        }
    })
}

function deleteChildrenCategory(element) {
    categorySelected = false;
    var children = element.nextAll();
    children.each(function () {
        this.remove();
    });
}

function setCategory(selected) {
    $('#goodsform-category_id').val(selected);
}

function getElement(result) {
   var wrap = document.createElement('div');
       wrap.innerHTML = '<div class="photo-items">\n' +
        '                <img src="" alt="" class="img-item" style="background-image: url('+ result +')">\n' +
        '                <div class="photo-items-footer"><i class="fa fa-refresh reverse"></i><i class="fa fa-trash-o remove"></i></div>\n' +
        '<div class="holder">\n' +
        '  <div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>\n' +
        '</div>            </div>';
   return wrap.firstChild;
}

function getSelectCategory(categories) {
    var catelement = $('#select-category');
    var sel = $('<select class="form-control is-valid">');
    sel.append($('<option>').val(0).text('Chose category'));
    for(var i = 0; i < categories.length; i++)
        sel.append($('<option>').attr('value', categories[i].id).text(categories[i].title));
    catelement.append(sel);
    sel.on('change', addChildCategory);
}


function ImageObj(url, rotation) {

    this.getObj = function() {
        return {url: url, rotation: rotation};
    }
}

function getIndex(array , data) {
    for(var i = 0; i < array.length; i++){
        if(array[i].url === data)
            return i;
    }
    return -1;
}

/* js slider start */
var index = 0;
var photos = PHOTOS_LIST;
$('#photos-block-slider .photo-items-wrapper img').on('click', chosePhoto);
$('#photos-block-slider .previous-slide').on('click', previous);
$('#photos-block-slider .next-slide').on('click', next);


function chosePhoto() {
    var currentIndex = $(this).data('index');
    if(currentIndex === index)
        return;
    else
        index = currentIndex;

    var imgActive = $('#photos-block-slider .slider-photo img.active');
    var img = $('#photos-block-slider .slider-photo img.inactive');
    var photo = photos[index].url;
    imgActive.css('opacity', '1');
    img.show();
    img.css('backgroundImage', 'url(' +photo + ')').css('opacity', 0).css('left', 0);
    imgActive.animate({opacity : 0}, 1000);
    img.animate({opacity : 1}, 1000);

    changeImage(img, imgActive);

    //showPhoto(index, '+');
}
function showPhoto(index, direction) {
    var imgActive = $('#photos-block-slider .slider-photo img.active');
    var img = $('#photos-block-slider .slider-photo img.inactive');
    var photo = photos[index].url;
    img.show();
    img.css('backgroundImage', 'url(' +photo + ')').css('opacity', 1);
    img.animate({left : 0}, 700);
    imgActive.animate({left : direction + '100%'}, 'swing');
    changeImage(img, imgActive);
}

function changeImage(img, imgActive) {
    img.removeClass('inactive').addClass('active');
    imgActive.removeClass('active').addClass('inactive');
}

function previous() {
    var img = $('#photos-block-slider .slider-photo img.inactive');
    img.hide().css('left', '100%');
    index--;
    index = index < 0 ? (photos.length - 1) : index;
    showPhoto(index, '-');
}

function next() {
    var img = $('#photos-block-slider .slider-photo img.inactive');
    img.hide().css('left', '-100%').css('left', '-100%');
    index++;
    index = photos.length > index ? index : 0;
    showPhoto(index, '+');
}

/* js slider end */

$('.delete-product-action').on('click', function () {
    var el = $(this);
    $.ajax({
        method: 'GET',
        url: el.data('url'),
        dataType: 'JSON',
        success: function (data) {
            var element = el.parent().parent();
            element.find('.status-span').text(data.status);
            element.find('.product-image').css('background-image', 'url("/images/icons/product.png")');
        }
    })
})
