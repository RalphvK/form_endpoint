<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php if (isset($this->title)) { echo $this->escape($this->title); } else { echo "Admin Panel"; } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto+Mono:500" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <header>
        <!-- navbar -->
        <div id="main-nav" class="navbar">
            <div class="container">
                <div class="navbar-button" data-var="navbar-button">
                    <?php include(path::component('admin', 'partials/navbar-button.php')) ?>
                </div>
                <div class="dropdown account-btn btn-group">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon ion-ios-contact icon-lg"></i>
                        <?= $_SESSION['name']; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item button-text" href="/users"><i class="icon ion-ios-people icon-md"></i> Manage Users</a>
                        <a class="dropdown-item button-text" href="/account"><i class="icon ion-ios-contact icon-md"></i> My Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item button-text text-danger" href="/auth/logout"><i class="icon ion-md-exit icon-md"></i> Logout</a>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- concatenated javascript -->
    <script src="/js/scripts.min.js"></script>

    <script>
        // init varset
        var varset = new Varset();

        $(document).ready(function() {
            // enable material-style inputs in entire body
            $('body').materializeInputs();
            // init varset
            varset.setKeysFromDocument();
            // tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('.example-btn').tooltip();
            });
        });
    </script>

    <!-- ace -->
    <script src="/js/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $(document).ready(function () {
            var editor_options = {
                autoScrollEditorIntoView: true,
                maxLines: 100,
                theme: "ace/theme/dracula",
                mode: "ace/mode/json"
            };
            window.editor_rules = ace.edit("editor-rules", editor_options);
            window.editor_notify = ace.edit("editor-notify", editor_options);
        });
    </script>

</body>

</html>