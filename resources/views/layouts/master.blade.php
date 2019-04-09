<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title')</title>
    <meta charset='utf-8'>

    @yield('head')
</head>
<body>



<section>
    <header>
        <a href='http://nwlsmith.com'><img src='http://nwlsmith.com/images/general/Nate-logo-200.png'
                                           alt='Logo'
                                           id='logo'></a>
        <h1>Project 3</h1>
    </header>
    @yield('content')
</section>

</body>
</html>