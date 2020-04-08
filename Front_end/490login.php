<html lang="en">
<head>
<title>WJJC Log In Page</title>
<!--imported from bootstrap website from here until closing head tag-->
<meta charset="utf-8">
<!--this allows the webpage to be the length and zoom of device being used-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--other classes for database communication-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--this is the information taken from getbootstrap.com-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <!--This is the main jumbotron for the log in-->
    <div class="jumbotron jumbotron-fluid">
        <!--describes the container with the log in text, logo will be added-->
        <div class="container">
            <h1 class="display-1">Log In</h1>
        </div>
    </div>


    <!--this is the container for the username and password form-->
    <div class="container">
        <!--sends input to arbitrary action page, adjust in final-->
        <form action="/action_page.php">
            <!--formatting for input box-->
            <div class="form-group">
                <!--this box is for the user id-->
                <label for="usr">User ID:</label>
                    <input type="text" class="form-control" placeholder="User ID" id="usr" name="username">
            </div>
        <!--formatting for input box-->
            <div class="form-group">
                <!--this box is for the password-->
                <label for="pwd">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" id="pwd" name="password">
            </div>

        <!--button to submit and check if credentials pass-->
        <!--currently, has no authentication check, just passes to employee screen default-->
        <a href="490employeehome.html" class="btn btn-primary">Submit</a>
        <!--end form-->
        </form>
    </div>
</html>