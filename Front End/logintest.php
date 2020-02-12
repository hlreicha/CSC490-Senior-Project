
<?php


session_start();
$user = NULL;

?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="foundation/bootstrap/css/bootstrap.css" />

<script src="foundation/jquery/jquery-3.4.1.min.js"></script>
<script src="foundation/bootstrap/js/bootstrap.js"></script>
<script src="foundation/js/foundation.js"></script>
</head>
<div class="container">
	<h4 class="title">Joe coffee</h4>
	<div class="about">Description</div>
</div>



<div class="container" id="notifications"></div>
<script>
    function onSignIn(googleUser) {
        var token = googleUser.getAuthResponse().id_token;
        $.post("/cs340/foundation/rest/Auth/auth.php",{id_token:token},(response)=>{
            var resp = JSON.parse(response);
            if(resp.status === "success"){
                window.location.href = "/cs340/index.php";
            }else{
                var notif = new Notification(NotificationTypes.DANGER,"Login Failed",resp.message);
                notif.show();
            }
        }).fail((resp)=>{
            var notif = new Notification(NotificationTypes.DANGER,"Login Failed",resp);
            notif.show();
        });
    }
</script>
</html>
