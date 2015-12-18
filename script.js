$(document).ready(function() {
    var categories;
    $.getJSON('getCategories.php',
        {},
        processResult_categories
    );

    $('#sent').click( function(){
        var email = $('#inputEmail').val();
        $('#log').html('');
        $.getJSON('getName.php',
            {email:email},
            processResult_name
        );

    })
})

function processResult_name(json) {
    var email = $('#inputEmail').val();
    var name  = $('#inputName').val();
    var comment = $('#inputComment').val();
    var posted_categories = [];
    var checked = false;
    $.each(categories,function(i,e){
        if ( $('#'+ categories[i]).prop('checked') ) {
            posted_categories.push(categories[i]);
            checked = true;
        }
    });
    if ( !checked ) {
        $('#log').html('Ошибка: Ни одна категория не выбрана.');}
    else {
        if ( json != ''&& json != name  ){
            $('#log').html('Ошибка: Фамилия И.О. не соответствует Емаil.');}
        else {
            $.getJSON('insertComment.php',
                {email:email, name:name, comment:comment,
                    posted_categories:posted_categories},
                processResult_insert
            );
        }
    }
}
function processResult_insert(json) {
    if ( json ) {
        $('#log').html('Благодарим Вас за отзыв!' +
       ' Нам очень важно знать Ваше мнение.');
    };
}
function processResult_categories(json) {
    createHtml(json);
}
function createHtml(array){
    var check;
    categories = [];
    $.each(array,function(i,e){
        categories.push(array[i]);
        if ( i == 0 ) { check = 'checked';}
        else { check = '';}
    $('#categories').append('<div class="checkbox">'+
    '<label><input type="checkbox"'+ check +' id = "'+ array[i]+'">'+
    array[i]+ ' </label></div></li>') ;
    })
}

