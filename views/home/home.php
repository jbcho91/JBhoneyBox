<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/public/style/login.css" rel="stylesheet" id="bootstrap-css">
</head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">Timecard System</h1>
<div class="login-form">
<div class="main-div">
<div class="panel">
   <h2>Timecard Login</h2>
   <p>Please enter your ID and Password</p>
   </div>
    <form id="Login" action="/member/auth" method="post">
        <div class="form-group">

            <input type="text" class="form-control" id="LOGIN_ID" name="LOGIN_ID" placeholder="Id">

        </div>

        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
<!--        <div class="forgot">
        <a href="/member/reset_pw">Forgot password?</a>
</div>
-->
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
    </div>
<p class="botto-text">Made by JB</p>
</div></div></div>


</body>
</html>
