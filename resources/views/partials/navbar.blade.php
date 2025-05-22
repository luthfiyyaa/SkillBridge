<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #bcd4ff;
        padding: 10px 20px;
    }

    .navbar-left, .navbar-right {
        display: flex;
        align-items: center;
    }

    .logo img {
        width: 70px;
        height: auto;
    }

    .icon a img, .navbar-right a img {
        width: 24px;
        height: 24px;
        margin-left: 15px;
    }

    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="SkillBridge Logo">
            </div>

            <div class="icon">
                <a href="#"><img src="{{ asset('images/home.png') }}" alt="SkillBridge Logo"></a>
                <a href="#"><img src="{{ asset('images/notif.png') }}" alt="SkillBridge Logo"></a>
                <a href="#"><img src="{{ asset('images/manusia.png') }}" alt="SkillBridge Logo"></a>
            </div>
            
        </div>
        <div class="navbar-right">
            <a href="#"><img src="{{ asset('images/hamburger.png') }}" alt="SkillBridge Logo"></a>
        </div>
    </nav>
</body>
</html>