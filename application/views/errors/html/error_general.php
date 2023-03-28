<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                <title>
                    error
                </title>
                <!-- Favicon-->
                <link href="../../favicon.ico" rel="icon" type="image/x-icon">
                    <!-- Google Fonts -->
                    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
                            <!-- Bootstrap Core Css -->
                            <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
                                <!-- Waves Effect Css -->
                                <link href="assets/plugins/node-waves/waves.css" rel="stylesheet"/>
                                <!-- Custom Css -->
                                <link href="assets/css/style.css" rel="stylesheet">
                                </link>
                            </link>
                        </link>
                    </link>
                </link>
            </meta>
        </meta>
    </head>
    <body class="four-zero-four">
        <div class="four-zero-four-container">
            <div class="error-code">
                General error
            </div>
            <div class="error-message">
                <?php echo $message; ?>
            </div>
            <div class="button-place">
                <a class="btn btn-default btn-lg waves-effect" onclick="history.back()">
                    ATRAS
                </a>
            </div>
        </div>
        <!-- Jquery Core Js -->
        <script src="assets/plugins/jquery/jquery.min.js">
        </script>
        <!-- Bootstrap Core Js -->
        <script src="assets/plugins/bootstrap/js/bootstrap.js">
        </script>
        <!-- Waves Effect Plugin Js -->
        <script src="assets/plugins/node-waves/waves.js">
        </script>
    </body>
</html>