$(window).ready(function(){

    $('.sub_box').hide();

    $('.news').click(function() {
        $('#news_links a').each(function(){
            window.open($(this).attr('href'));
        });
    });

    $('.sub_li_hover').hover(function(){
        $(this).children('.sub_box').slideDown();
    }, function(){
        $(this).children('.sub_box').slideUp();
    });

    $('.table-wrapper i').click(function() {

        var title = $(this).parent().siblings('.li_title').html();
        $(this).parents('tr').remove();

        $.ajax({
            url: 'functions.php?f=delLink',
            type: 'POST',
            data:  {
                title: title
            },
            success: function(data) {
                console.log(data);
            }
        });

    });

});