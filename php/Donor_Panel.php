<?php
    $Search_State = $State_Word = $Search_Blood = "";

    //$servername = "sql302.epizy.com";
    //$usernameDB = "epiz_25899308";
    //$passwordDB = "MIShdzzsf8";
    //$DBname = "epiz_25899308_Blood_Donation";

    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $DBname = "Blood_Donation_DB";

    session_start();
    $Username = $_SESSION["Username"];
    $Donor_ID = $_SESSION["Donor_ID"];
    $Address = $_SESSION["Address"];
    $Email = $_SESSION["Email"];
    $City = $_SESSION["City"];
    $Country = $_SESSION["Country"];
    $CNIC = $_SESSION["CNIC"];
    $Contact_no = $_SESSION["Contact_no"];
    $Blood_Type = $_SESSION["Blood_Type"];
    $Gender = $_SESSION["Gender"];

    $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);
    $sql_query_fetch = "Select Donor_State From donors Where Donor_ID = '".$Donor_ID."' ";
    $result = $connection->query($sql_query_fetch);
    $row = $result->fetch_assoc();
    $Donor_State = $row["Donor_State"];


    $connection->close();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($Donor_State == "Donor")
        {
            $Donor_State = "Receiver";
            $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);
            $sql_query_update = "Update donors Set Donor_State = 'Receiver' Where Donor_ID = '".$Donor_ID."' ";
            $connection->query($sql_query_update);
            $connection->close();
        }
        else
        {
            $Donor_State = "Donor";
            $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);
            $sql_query_update = "Update donors Set Donor_State = 'Donor' Where Donor_ID = '".$Donor_ID."' ";
            $connection->query($sql_query_update);
            $connection->close();
        }
    }

    if($Donor_State == "Donor")
    {
        $Search_State = "Receiver";
        $State_Word = "Receivers";
    }
    else
    {
        $Search_State = "Donor";
        $State_Word = "Donors";
    }


?>

<!DOCTYPE html>
    <head>
        <title>Donor Panel</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/dd6257b12f.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

        <div class="container mt-5">
            <br>
            <div class="jumbotron" style="background-color:rgba(0,0,0,0.6);">
                <div class="jumbotron" style="text-align: center; background-color:#343a40; color:white;">
                    <h1>Welcome <?php echo $Username; ?> </h1><br>
                </div><br>

                <h3 style="color:white;">Your Contact Information: </h3>
                <table class="table table-bordered" style="background-color:white;">
                    <thead class="thead-dark">
                        <tr><th scope="col">Email:</th><td><?php echo $Email; ?></td></tr>
                        <tr><th scope="col">Address</th><td><?php echo $City; ?>, <?php echo $Country; ?></td></tr>
                        <tr><th scope="col">Contact Number:</th><td><?php echo $Contact_no; ?></td></tr>
                        <tr><th style="width:200px;">CNIC:</th><td style=><?php echo $CNIC; ?></td></tr>
                    </thead>
                </table><br>

                <h3 style="color:white;">Your Bio Information: </h3>
                <table class="table table-bordered" style="background-color:white;">
                    <thead class="thead-dark">
                        <tr><th style="width:200px;">Gender:</th><td style=><?php echo $Gender; ?></td></tr>
                        <tr><th>Blood Type:</th><td style=><?php echo $Blood_Type; ?></td></tr>
                        <tr><th>Donor Status:</th><td style=><?php echo $Donor_State; ?></td></tr>
                    </thead>
                </table>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <button type="submit" class="btn btn-danger">Change State to: <?php echo $Search_State; ?></button><br><br>
                </form>

                <h3 style="color:white;"><?php echo $State_Word; ?> Availabe: </h3>
                <table class="table table-bordered table-hover" style="background-color:white;">
                    <thead class= 'thead-dark' >
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Contact Number</th>
                            <th>Blood Type</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);

                            //Check Connection
                            if($connection->connect_error)
                            {
                            die("Connection failed: " . $connection->connect_error);
                            echo "<br>";
                            }

                            $sql_query_fetch = "Select Name, Email, City, Country, Contact_no, Blood_Type, Gender From donors Where Donor_State = '".$Search_State."' ";

                            $result = $connection->query($sql_query_fetch);

                            if($result->num_rows > 0)
                            {
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["City"] . ", " . $row["Country"] . "</td><td>" . $row["Contact_no"] .  "</td><td>" . $row["Blood_Type"] .  "</td><td>" . $row["Gender"] .  "</td></tr>";
                                }
                            }

                            $connection->close();
                        ?>
                    </tbody>
                </table><br>
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

