<html>

<head>
    <meta charset="utf-8">
    <title>Form</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="logo">
        <img class="hinh hinh1" src="{{ asset("images/black_logo.png") }}" alt="">
        <img class="hinh hinh2" src="{{ asset("images/white_logo.png") }}" alt="">
    </div>
    <div class="circle"></div>
    <div class="container">
        <div class="tieude">
            <strong>Register</strong>
        </div>

        <form method="post" action="{{ route('index.register') }}" autocomplete="on">

            @csrf
            <!--First name-->
            <div class="box">
                <label for="userName" class="fl fontLabel"> UserName: </label>
                <div class="new iconBox">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="fr">
                    <input type="text" name="username" placeholder="UserName" class="textBox" autofocus="on" required>
                </div>
            </div>
            @if ($errors->has('username'))
                <div class="error-message" class="alert alert-danger">
                    {{$errors->first('username')}}
                </div>
            @endif
            <!--First name-->
            <!---Email ID---->
            <div class="box">
                <label for="email" class="fl fontLabel"> Email ID: </label>
                <div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="fr">
                    <input type="email" required name="email" placeholder="Email Id" class="textBox">
                </div>
            </div>
            @if ($errors->has('email'))
                <div class="error-message" class="alert alert-danger">
                    {{$errors->first('email')}}
                </div>
            @endif
            <!--Email ID----->

            <!---Phone No.------>
            <div class="box">
                <label for="phone" class="fl fontLabel"> Phone No.: </label>
                <div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
                <div class="fr">
                    <input type="text" required name="phoneNo" maxlength="10" placeholder="Phone No." class="textBox">
                </div>
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            @if ($errors->has('phoneNo'))
                <div class="error-message" class="alert alert-danger">
                    {{$errors->first('phoneNo')}}
                </div>
            @endif
            <!---Phone No.---->


            <!---Password------>
            <div class="box">
                <label for="password" class="fl fontLabel"> Password: </label>
                <div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
                <div class="fr">
                    <input type="Password" required name="password" placeholder="Password" class="textBox">
                </div>
            </div>
            @if ($errors->has('password'))
                <div class="error-message" class="alert alert-danger">
                    {{$errors->first('password')}}
                </div>
            @endif
            <!---Password---->

            <!---Confirm Password------>
            <div class="box">
                <label for="Confirmpassword" class="fl fontLabel"> Confirm Password: </label>
                <div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
                <div class="fr">
                    <input type="Password" required name="confirmpassword" placeholder="Confirm Password"
                        class="textBox">
                </div>
            </div>
            @if ($errors->has('confirmpassword'))
                <div class="error-message" class="alert alert-danger">
                    {{$errors->first('confirmpassword')}}
                </div>
            @endif
            <!---ConfirmPassword---->

            <!---Submit Button------>
            <div class="box box-submit">
                <input type="submit" name="Submit" class="submit" value="SUBMIT">
            </div>
            <!---Submit Button----->
        </form>
    </div>
    <!--Body of Form ends--->
</body>

</html>

<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background-color: #d8d8d8;
    }

    .container {
        color: #f3f3f3;
        display: grid;
        place-items: center;
        background: #f7f7f7;
        width: 350px;
        padding-bottom: 20px;
        position: absolute;
        top: 50%;
        right: 150px;
        transform: translate(0%, -50%);
        margin: auto;
        padding: 60px 60px 70px 60px;
        font-family: verdana;
        border-radius: 5px;
        box-shadow: 10px 10px 0px 0px #818181;
    }

    .fl {
        float: left;
        width: 120px;
        line-height: 35px;
    }

    .fontLabel {
        color: #535353;
    }

    .fr {
        float: right;
    }

    .clr {
        clear: both;
    }

    .box {
        width: 360px;
        height: 35px;
        margin-top: 20px;
        font-family: verdana;
        font-size: 12px;
    }

    .textBox:focus {
        outline: none;
    }

    .textBox {
        height: 35px;
        width: 190px;
        border: none;
        padding-left: 20px;
        border-radius: 3px;
    }

    .new {
        float: left;
    }

    .iconBox {
        height: 35px;
        width: 40px;
        line-height: 38px;
        text-align: center;
        background: #9f9f9f;
        border-radius: 3px;
    }


    .submit {
        font-weight: bold;
        border: none;
        color: #f8f8f8;
        width: 110px;
        height: 35px;
        background: #6c7ae0;
        text-transform: uppercase;
        cursor: pointer;
        border-radius: 3px;
    }

    ::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */

    }

    .fa {
        display: inline-block;
        font: normal normal normal 14px / 1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        margin-top: 10px;
        margin-bottom: auto;
    }

    .tieude {
        font-family: 'Montserrat', sans-serif;
        color: #6c7ae0;
        font-size: 50;
        margin-bottom: 60px;
    }

    .box-submit {
        margin-top: 50px;
        display: grid;
        place-items: center;
    }

    .circle {
        z-index: -1;
        position: fixed;
        background-color: #ededed;
        width: 2600px;
        height: 2600px;
        border-radius: 50%;
        left: -125px;
        top: -1860px;
        animation: circle 9s infinite ease-in-out;
    }

    @keyframes circl1e {
        0% {
            left: -125px;
            top: -1860px;
        }

        50% {
            left: -125px;
            top: -2070px;
        }

        100% {
            left: -125px;
            top: -1860px;
        }
    }

    .logo {
        position: absolute;
        top: 45%;
        left: 30%;
        transform: translate(-50%, -50%);
    }

    .hinh {
        position: absolute;
        top: 0;
        left: 0;
        transform: translate(-50%, -50%);
        width: 700px;
    }

    .hinh2 {
        opacity: 1;
        animation: hinh2 4s infinite ease-in-out;
    }

    @keyframes hinh2 {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .error-message {
        color: red;
        font-size: 10px;
    }
</style>