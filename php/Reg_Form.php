<?php
    $Name = $Password = $CPassword = $Email = $Contact_no = $Address = $CNIC = $City = $Country = $Blood_Type = $Gender = $Donor_State = $error = $error2 = $error3 = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //$servername = "sql302.epizy.com";
        //$usernameDB = "epiz_25899308";
        //$passwordDB = "MIShdzzsf8";
        //$DBname = "epiz_25899308_Blood_Donation";

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "";
        $DBname = "Blood_Donation_DB";

        //Create Connection
        $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);

        //Check Connection
        if($connection->connect_error)
        {
            die("Connection failed: " . $connection->connect_error);
            echo "<br>";
        }

        $Name = input($_POST["name"]);
        $Password = input($_POST["pwd"]);
        $CPassword = input($_POST["pwdc"]);
        $Email = input($_POST["email"]);
        $Contact_no = input($_POST["contact_no"]);
        $Address = input($_POST["address"]);
        $City = input($_POST["city"]);
        $Country = input($_POST["country"]);
        $Blood_Type = input($_POST["blood_type"]);
        $Gender = input($_POST["gender"]);
        $CNIC = input($_POST["CNIC"]);
        $Donor_State = input($_POST["donor_state"]);

        if($Password == $CPassword)
        {
            $sql_query_check = "Select count(CNIC) From donors Where CNIC = '".$CNIC."' ";
            $result = $connection->query($sql_query_check);
            $check_state = $result->fetch_assoc();

            $sql_query_check2 = "Select count(Email) From donors Where Email = '".$Email."' ";
            $result2 = $connection->query($sql_query_check2);
            $check_state2 = $result2->fetch_assoc();

            if($check_state["count(CNIC)"] == "1" )
            {
                $error = "*This CNIC number has already been registered in the database";
            }
            elseif($check_state2["count(Email)"] == "1" )
            {
                $error3 = "*This Email has already been registered in the database";
            }
            else
            {
                $sql_query_insert_donors = "Insert into donors(Name, Email, Address, City, Country, CNIC, Contact_no, Blood_Type, Gender, Donor_State) Values('".$Name."', '".$Email."', '".$Address."', '".$City."', '".$Country."', '".$CNIC."', '".$Contact_no."', '".$Blood_Type."', '".$Gender."', '".$Donor_State."')";
                $sql_query_insert_users = "Insert into users(User_Name, Password, User_Type) Values('".$Name."', '".$Password."', 0)";
                $connection->query($sql_query_insert_donors);
                $connection->query($sql_query_insert_users);
                echo $connection->error;

                $sql_query_fetch = "Select * From donors Where Name = '".$Name."' ";
                $result = $connection->query($sql_query_fetch);

                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        session_start();
                        $_SESSION["Username"] = $row["Name"];
                        $_SESSION["Donor_ID"] = $row["Donor_ID"];
                        $_SESSION["Address"] = $row["Address"];
                        $_SESSION["Email"] = $row["Email"];
                        $_SESSION["City"] = $row["City"];
                        $_SESSION["Country"] = $row["Country"];
                        $_SESSION["CNIC"] = $row["CNIC"];
                        $_SESSION["Contact_no"] = $row["Contact_no"];
                        $_SESSION["Blood_Type"] = $row["Blood_Type"];
                        $_SESSION["Gender"] = $row["Gender"];
                        $_SESSION["Donor_State"] = $row["Donor_State"];

                        header("Location: Donor_Panel.php");
                    }
                }
            }
        }
        else
        {
            $error2 = "*Password mismatch, please enter correct password";
        }

        $connection->close();
    }

    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
    <head>
        <title>Donor Registration</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/dd6257b12f.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            .error{color: #FF0000;}
        </style>
    </head>

    <body style="background-image: url(../Resources/BG_img2.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="container-md-fluid">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fas fa-phone" style="color: #eb4242;"></span> +923365918689</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fas fa-envelope" style="color: #eb4242;"></span> info@dontor.com</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Follow us |</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-facebook"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-twitter"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-google"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-linkedin"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-youtube"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><span class="fab fa-instagram"></span></a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container-md-fluid">
            <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
                <a class="navbar-brand" href="../index.html">
                    <img src="../Resources/BD_logo.png" width="30%" height="30%">
                </a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item font-weight-bold mr-3 uLine">
                        <a class="nav-link" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item font-weight-bold mr-3 uLine">
                        <a class="nav-link" href="About_Us.php">About Us</a>
                    </li>
                    <li class="nav-item font-weight-bold mr-3 uLine">
                        <a class="nav-link" href="Donor_List.php">Donor List</a>
                    </li>
                    <li class="nav-item font-weight-bold mr-3 uLine">
                        <a class="nav-link" href="Reg_Form.php"><i class="fas fa-user-plus"></i> Register With Us</a>
                    </li>
                    <li class="nav-item font-weight-bold mr-3 uLine">
                        <a class="nav-link" href="Login_Page.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline" method="" action="">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search Blood Group or Location" style="width:300px;">
                            <button class="btn btn-danger" type="submit"><span class="fas fa-search"> Search</span></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container">

            <div data-aos="fade-up" data-aos-duration="1000" class="jumbotron" style="background-color:rgba(0,0,0,0.6); width:750px; margin-top:70px; margin-left:200px;">

                <h1 style="color:white; font-weight:bold; text-align:center;">Register with Us!</h1><br>
                <h4 style="color:white; font-weight:bold; text-align:center;">Fill in the details and join us.</h4><br>


                <form  style="margin-left:100px;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="Name" style="color:white; font-weight:bold;">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" id="Name" name="name" style="width:500px;">
                    </div>
                    <div class="form-group">
                        <label for="email" style="color:white; font-weight:bold;">Email address:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" style="width:500px;">
                        <span class="error"><?php echo $error3; ?></span>
                    </div>
                    <div class="form-group" style="color:white; font-weight:bold;">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" style="width:500px;">
                    </div>
                    <div class="form-group" style="color:white; font-weight:bold;">
                        <label for="address">City:</label>
                        <input type="text" class="form-control" placeholder="Enter City" id="address" name="city" style="width:500px;">
                    </div>
                    <div class="form-group" style="color:white; font-weight:bold;">
                        <label for="address">Country:</label>
                        <input type="text" class="form-control" placeholder="Enter Country" id="address" name="country" style="width:500px;">
                    </div>
                    <div class="form-group">
                        <label for="CNIC" style="color:white; font-weight:bold;">CNIC:</label>
                        <input type="text" class="form-control" placeholder="Enter CNIC number" id="CNIC" name="CNIC" style="width:500px;">
                        <span class="error"><?php echo $error; ?></span>
                    </div>
                    <div class="form-group" style="color:white; font-weight:bold;">
                        <label for="address">Contact Number:</label>
                        <input type="text" class="form-control" placeholder="Enter Contact Number" id="address" name="contact_no" style="width:500px;">
                    </div>
                    <div class="form-group" style="color:white; font-weight:bold;">
                        <label for="address">Blood Type:</label>
                        <input type="text" class="form-control" placeholder="Enter Blood Type" id="address" name="blood_type" style="width:500px;">
                    </div>
                    <label for="address" style="color:white; font-weight:bold;">Gender:</label><br>
                    <div class="form-check-inline" style="color:white; font-weight:bold;">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" value="Male">Male
                        </label>
                    </div>
                    <div class="form-check-inline" style="color:white; font-weight:bold;">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="gender" value="Female">Female
                        </label>
                    </div><br><br>
                    <label for="address" style="color:white; font-weight:bold;">Are you registering as a Donor or a Receiver:</label><br>
                    <div class="form-check-inline" style="color:white; font-weight:bold;">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="donor_state" value="Donor">Donor
                        </label>
                    </div>
                    <div class="form-check-inline" style="color:white; font-weight:bold;">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="donor_state" value="Receiver">Receiver
                        </label>
                    </div><br><br>
                    <div class="form-group">
                        <label for="pwd" style="color:white; font-weight:bold;">Password:</label>
                        <input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd" style="width:500px;">
                        <span class="error"><?php echo $error2; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pwdc" style="color:white; font-weight:bold;">Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Password" id="pwdc" name="pwdc" style="width:500px;">
                        <span class="error"><?php echo $error2; ?></span>
                    </div>

                    <button type="Submit" class="btn btn-danger" style="margin-bottom:100px;">Submit</button>
                </form>
            </div>
        </div>

        <footer class="page-footer font-small pt-4" style="background-color:#343a40;">
            <div class="container-fluid text-center text-md-left">
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <img src="..\Resources\BD_logo2.png" width="30%">
                    </div>

                    <div class="col-md-3 mb-md-0 mb-3">
                        <h5 class="text-uppercase" style="color:white;">Join Us in our Mission |</h5>
                        <ul class="list-unstyled" style="color: white;">
                            <li>
                                <a href="Donor_List.php">Our Donors</a>
                            </li>
                            <li>
                                <a href="About_Us.php">About Us</a>
                            </li>
                            <li>
                                <a href="Learn_More.php">Learn More</a>
                            </li>
                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-md-0 mb-3">
                        <h5 class="text-uppercase" style="color:white;">Follow us |</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#"><span class="fab fa-facebook"></span></a> <a href="#"><span class="fab fa-twitter"></span></a> <a href="#"><span class="fab fa-google"></span></a> <a href="#"><span class="fab fa-linkedin"></span></a> <a href="#"><span class="fab fa-youtube"></span></a> <a href="#"><span class="fab fa-instagram"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();

            var slideIndex = 0;
            showSlides();

            function showSlides()
            {
                var i;
                var slides = document.getElementsByClassName("mySlides");

                for (i = 0; i < slides.length; i++)
                {
                slides[i].style.display = "none";
                }

                slideIndex++;
                if (slideIndex > slides.length)
                {
                    slideIndex = 1
                }

                slides[slideIndex-1].style.display = "block";
                setTimeout(showSlides, 3000);
            }
        </script>

    </body>
</html>