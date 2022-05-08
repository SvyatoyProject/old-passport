<html lang="en">
<head>
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Cabin', sans-serif;
            font-size: 23px;
            background-color: transparent;
        }

        .logo_block {
            height: 150px;
            padding-top: 20px;
            text-align: center;
            background-color: #fbea41;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .content {
            position: relative;
            top: -70px;
            padding: 5px;
            background-color: white;
        }

        .center_block {
            text-align: center;
        }

        .btn {
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            background-color: #0087ee;
            color: white;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #0091ff;
        }

        .d_block {
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="logo_block">
    <img style="width: 50px;" src="data:image/png;base64,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" alt="logo"/>
</div>
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
