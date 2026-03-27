<?php 
$_ALLOW_SESSION = true;
include_once "../_cogs.php";
include_once  $GLOBALS["DOCUMENT_ROOT"]."/ControlPanel/assets/b4w-framework/UtilService.php"; 
?>

<html lang="en">
<head>
    <title>Login - Website & Application Control Panel</title>
    <?php include  $GLOBALS["DOCUMENT_ROOT"]."/ControlPanel/assets/b4w-framework/IncludeLibrary.php"; ?>
</head>
<body>
    <?php 
    if(isset($_POST["btnLogin"]))
    {
        UserService::_UserLogin($_POST["inputUserName"],$_POST["inputPassword"]);
    }
    ?>
    <style>
        .form-signin {
            width: 100%;
            margin: 50px auto;
        }
        @media(min-width:768px) {
            .form-signin {
                width: 430px;
            }
        }
        .auth-form-light {
            background: #fff;
            padding: 3.5rem;
            border-radius: 20px;
        }
    </style>
    <div class="container">
        <?php $website = SelectRow("select * from website", array()); ?>
        <form class="form-signin auth-form-light" method="post">
            <div class="brand-logo text-center">
                <img style="height: 80px;max-width: 100%;object-fit: fill;" src="<?php echo $website["Image3"] ?>" alt="logo">
            </div>
            <h3 class="text-danger text-center"><?php echo $website["WebName"]; ?></h5>
            <h4 class="text-warning text-center" style="margin-top: 0; margin-bottom: 20px;">Control Panel</h2>
            <label for="inputUserName" class="sr-only">Username</label>
            <input type="text" id="inputUserName" name="inputUserName" class="form-control input-lg" placeholder="Username" required autofocus>
            <br />
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control input-lg" placeholder="Password" required>
            <br />
            <input type="submit" name="btnLogin" id="btnLogin" value="เข้าสู่ระบบ" class="btn btn-lg btn-success btn-block" />
        </form>
    </div>
    <!-- /container -->
    <script>
        $("img").on("error", function() {
			$(this).prop("src", "<?php echo $GLOBALS["ROOT"] ?>/ControlPanel/assets/images/cp.png");
		});
    </script>
</body>
</html>
