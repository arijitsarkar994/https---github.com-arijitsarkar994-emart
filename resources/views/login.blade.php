<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        } */

        /* WRAPPER FORM */

        .wrapper {
            background: #ecf0f3;
        }

        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #000408, -13px -13px 20px #000408
        }

        .logo {
            width: 80px;
            margin: auto
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            color: #555
        }

        .wrapper .poweredby {
            font-weight: 600;
            font-size: 0.8rem;
            letter-spacing: 1.3px;
            padding-left: 0px;
            color: #555
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.0rem;
            color: #666;
            padding: 10px 15px 10px 10px
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
        }

        .wrapper .form-field .fa {
            color: #555
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            letter-spacing: 1.3px
        }

        .wrapper .btn:hover {
            background-color: #039BE5
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4
        }

        .wrapper a:hover {
            color: #039BE5
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px
            }
        }
        /* WRAPPER FORM */
    </style>
    <!-- <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=email], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        }

        button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        }

        button:hover {
        opacity: 0.8;
        }

        .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
        }

        .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        }

        img.avatar {
        width: 40%;
        border-radius: 50%;
        }

        .container {
        padding: 16px;
        }

        span.password {
        float: right;
        padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
        span.password {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
        }
    </style> -->
</head>
<body style="background-color:black;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="d-flex align-items-center">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">                
                <li class="nav-item">
                    <a class="nav-link navbar-brand" href="{{ route('emart_home') }}">emart</a>
                </li>
            </ul>
        </div>
        
        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">                
                <?php
                    $hour = date('H');
                    if ($hour > 16)
                        $greetings = "Good Evening"; 
                    elseif ($hour >=  12)
                        $greetings = "Good Afternoon";
                    elseif ($hour < 12)
                        $greetings = "Good Morning";
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ $greetings }}</a>
                </li>                
            </ul>
        </div>
        <!-- Right elements -->
    </nav>
    <!-- Navbar -->
    <div class="wrapper">
        <div class="logo"> <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt=""> </div>
        <div class="text-center mt-4 name">emart</div>
        <form class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="fa fa-envelope"></span>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fa fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="icheck-primary">                
                <input type="checkbox" onclick="myFunction()">Show Password
                <br>
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember_me" checked>
                <label for="remember_me">Remember Me</label>
            </div>
            <button type="button" class="btn mt-3 userLoginBtn">Login</button>
        </form>
        <div class="text-center fs-6"> <a href="#">Forget password?</a> or <a href="{{ route('emart_signup') }}">Sign up</a> </div>
        <div class="text-center mt-4 poweredby">Powered by Landhoper</div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        
        $(document).on("click", ".userLoginBtn", function(){

            var username = $('#username').val();
            if(username.length == 0){
                $("#username").focus();
                alert('Username is required');
                return false;
            }

            var password = $('#password').val();
            if(password.length == 0){
                $("#password").focus();
                alert('Password is required');
                return false;
            }

            // var rememberme = $("#remember_me").val();
            var rememberme = $("#remember_me input[type='checkbox']").val();
            // var rememberme = $('#remember_me:checked').val();

            $('.userLoginBtn').attr('disabled',true);
            $.ajax({
                url:"{{ route('emart_userLogin') }}",
                type:"POST",
                data:{_token: '{{ csrf_token() }}',
                username:username, password:password, remember_me:rememberme},
                success: function(response) {
                    $('.userLoginBtn').attr('disabled',false);
                    if(response.status == 'success'){
                        alert('Login successfully');
                        window.location.href = "{{ route('emart_home') }}";
                    } else if(response.status=='login_details_are_not_valid') {
                        alert('Login details are not valid');
                    } else {
                        alert('Something went wrong');
                    }
                },
                error:function(err){
                    $('.userLoginBtn').attr('disabled',false);
                    alert('Something went wrong. No response error');
                    console.log('Error is: '+err);
                }
            });
        });
    </script>
</body>
</html>
