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