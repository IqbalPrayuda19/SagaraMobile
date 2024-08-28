<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sagara Mobile</title>
    <link rel="stylesheet" crossorigin href="/css/app.css">
    <link rel="stylesheet" crossorigin href="/css/app-dark.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <script src="SagaraMobile/resources/initTheme.js"></script>
        <div id="app" class="d-flex " style="width: 100vw; min-height: 100vh; padding-left: 299px;">
                @include('dashboard.section.sidebar.index')   

            <div style="width: 100%; max-width=100vw;">
                @include('dashboard.section.header.index')
                @yield('container')
            </div>
        </div>
    <script>
      feather.replace()
    </script>
</body>

</html>