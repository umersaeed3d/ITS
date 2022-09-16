<!DOCTYPE html>
<html>

<head>
    <title>ITS | UserLogin</title>

    <!-- refer css-->
    <link rel="stylesheet" type="text/css" href="/css/adminLogin.css">

    <!-- refer font styles-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <!-- refer icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css">


</head>

<body>
    <div>
        <div class="loginHeader">
            <center>
                <img src="images/ims.jpg" />
            </center>

        </div>

        <div class="loginBody">
            <form action="" method="POST">
                @csrf
                <div class="loginInputContainer">
                    <input type="text" placeholder="&#xf007; Username"
                        style="padding: 5px; font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="user_name"/>
                        @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="loginInputContainer">
                    <input type="password" placeholder="&#xf023; Password"
                        style="padding: 5px; font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="signInButton">
                    <button type="submit">Sign In</button>
                </div>

            </form>
            <div class="loginFooter">
                <h2>Inventory Tracking System</h2>
            </div>
        </div>
    </div>
</body>

</html>
