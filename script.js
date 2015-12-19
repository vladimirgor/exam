$(document).ready(function() {
    var categories, name, email, comment, posted_categories;
    $.getJSON('/php/getCategories.php',
        {},
        processResult_categories
    );

    $('#sent').click(function () {
        $('#log').html('');
        name = $('#inputName').val();
        if (name == '') {
            $('#log').html('Ошибка: Не введено - Фамилия И.О.');
        } else {
            email = $('#inputEmail').val();
            if (email == '') {
                $('#log').html('Ошибка: Не введено - Email');
            } else {
                if (!(email.indexOf('@') + 1)) {
                    $('#log').html('Ошибка: В Email нет символа -\'@\'');
                } else {
                    comment = $('#inputComment').val();
                    if (comment == '') {
                        $('#log').html('Ошибка: Не введено - Отзыв');
                    } else {
                        posted_categories = [];
                        var checked = false;
                        $.each(categories, function (i, e) {
                            if ($('#' + categories[i]).prop('checked')) {
                                posted_categories.push(categories[i]);
                                checked = true;
                            }
                        });
                        if (!checked) {
                            $('#log').html('Ошибка: Ни одна категория не выбрана.');
                        }
                        else {
                            $.getJSON('/php/getName.php',
                                {email: email},
                                processResult_name
                            );
                        }
                    }
                }
            }
        }
    });


    function processResult_name(json) {
        // is the saved name for the entered email  equal to the entered name ?
        if (json != '' && json != name) {
            // it is not
            $('#log').html('Ошибка: Фамилия И.О. не соответствует Емаil.');
        }
        else {
            // insert comment
            $.getJSON('/php/insertComment.php',
                {
                    email: email, name: name, comment: comment,
                    posted_categories: posted_categories
                },
                processResult_insert
            );
        }
    }

    function processResult_insert(json) {
        if (json) {
            $('#log').html('Благодарим Вас за отзыв!' +
            ' Нам очень важно знать Ваше мнение.');
        }
    }

    function processResult_categories(json) {
        createHtml(json);
    }

    function createHtml(array) {
        categories = [];
        $.each(array, function (i, e) {
            categories.push(array[i]);
            $('#categories').append('<div class="checkbox">' +
            '<label><input type="checkbox" id = "' + array[i] + '">' +
            array[i] + ' </label></div></li>');
        })
    }

});