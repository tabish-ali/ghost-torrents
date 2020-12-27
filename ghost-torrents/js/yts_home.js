$(document).ready(function (e) {


    setTimeout(() => {
        loadMeta();
    }, 2000);

    function loadMeta() {

        $('.title-year-div').fadeTo(1000, 1);

        $('.quality-div').fadeTo(300, 0.7);

        var img_div = $('.img-div');

        img_div.mouseenter(function () {
            $(this).find($('.rating-div')).fadeTo(300, 1);
            $(this).find($('.img-div img')).fadeTo(300, 0.2);
            $(this).find($('.genres-div')).fadeTo(300, 1);

        });
        img_div.mouseleave(function () {
            $(this).find($('.rating-div')).fadeTo(300, 0);
            $(this).find($('.img-div img')).fadeTo(300, 1);
            $(this).find($('.genres-div')).fadeTo(300, 0);

        });

    }

});