<html>
<head>
    <title>@yield('title')</title>
    <style>
        body {
            font-size:16px; color:#999; margin:5px;
        }
        h1 {
            font-size:50px; text-align: right; color: #f6f6f6; margin: -20px 0px -30px 0px; letter-spacing: -4px;
        }
        ul {
            font-size: 12px;
        }
        hr {
            margin: 25px 100px; border-top: 1px dashed #dddddd;
        }
        .menutitle {
            font-size: 14px; font-weight: bold; margin: 0px;
        }
        .content {
            margin:10px;
        }
        .footer {
            text-align: right; font-size: 10px; margin:10px; border-bottom: solid 1px #ccc; color: #ccc;
        }
        th {
            background: #999; color: #fff; padding: 5px 10px;            
        }
        td {
            border: #999 solid 1px; color: #999; padding: 5px 10px;
        }

    </style>
</head>
<body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <p class="menutitile">メニュー</p>
    <ul>
        <li>親メニュー</li>
        @show
    </ul>
    <hr size="1">
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')        
    </div>
</body>
</html>