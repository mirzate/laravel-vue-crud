<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CLS</title>
        <!--
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        -->
    </head>
    <body >
        <div id="app">
        </div>
        <script>
           window.Laravel = <?php echo json_encode([
               'csrfToken' => csrf_token(),
                    ]); ?>
          </script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>