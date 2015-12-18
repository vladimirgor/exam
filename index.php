<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="bootstrap.min.css"
        >
    <!-- Optional theme -->
    <link rel="stylesheet"
          href="bootstrap-theme.min.css"
        >
    <!-- jquery -->
    <script language="javascript" src="jquery-1.11.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script language="javascript" src="bootstrap.min.js"></script>
    <script language="javascript" src="script.js"></script>
    <title>cetera SQL</title>
</head>

<body>

    <div class="container">
        <form class="form-horizontal" method="post">

            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Фамилия И.О.</label>
                <div class="col-sm-10">
                    <input type="text" required class="form-control" id="inputName"
                           name ="name" placeholder="Фамилия И.О.">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" required class="email form-control" id="inputEmail"
                           name = "email" placeholder="Email">
                </div>
            </div>

            <div class="form-group">
                Пожалуйста, выберите хотя бы одну категорию.
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button"
                            id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true">
                        Категория
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" id = "categories" aria-labelledby="dropdownMenu">
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="inputComment" class="col-sm-2 control-label">Отзыв</label>
                <div class="col-sm-10">
                    <input type="text" required class="form-control" id="inputComment"
                           name ="comment" placeholder="Отзыв">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="reset" class="btn btn-default">Очистить поля</button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" id = "sent" class="btn btn-default">Отправить отзыв</button>
                </div>
            </div>
        </form>
        <h4 id = "log"></h4>
    </div>

</body>
</html>