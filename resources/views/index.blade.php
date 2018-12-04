<html>
    <head>
        <title>App Name - suibian </title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <script>
            var pageData = {
              cart: <?php echo json_encode($cart); ?>
            };
        </script>

        <div id='app'>
            <cart></cart>
        </div>
    </body>
</html>
