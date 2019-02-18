<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bootstrap Theme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto+Mono:500" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <!-- navbar -->
        <div id="main-nav" class="navbar">
            <div class="container">
                <div class="navbar-button" data-var="navbar-button">
                    <button type="button" class="btn btn-danger icon-padding"><i class="icon ion-ios-save icon-md"></i> Save</button>
                </div>
                <div class="dropdown account-btn">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-ios-contact icon-lg"></i>
                        John
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-glow"></div>
    </header>

    <div class="content">

        <div class="container" data-var="view-container">

            <?= $this->yieldView(); ?>

        </div>

    </div>

    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- concatenated javascript -->
    <script src="js/scripts.min.js"></script>

    <script>
        $(document).ready(function() {
            // enable material-style inputs in entire body
            $('body').materializeInputs();
            // init varset
            var varset = new Varset();
            // tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        });
    </script>

    <!-- ace -->
    <script src="js/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $(document).ready(function () {
            var editor_options = {
                autoScrollEditorIntoView: true,
                maxLines: 100,
                theme: "ace/theme/dracula",
                mode: "ace/mode/json"
            };
            var editor_rules = ace.edit("editor-rules", editor_options);
            var editor_notify = ace.edit("editor-notify", editor_options);
        });
    </script>

</body>

</html>