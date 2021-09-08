<!DOCTYPE html>
    <head>
        <title>Donor List</title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="CSS\style.css">
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

        <div class="container" style="margin-top:50px; margin-bottom:50px;">
            <div class="jumbotron" style="background-color:rgba(0,0,0,0.6);">
                <h3 data-aos='fade-up' data-aos-duration='1000' style="color:white;"><b>Registered Donors:</h3></b><br>
                <table data-aos="fade-up" data-aos-duration="1000" class="table table-hover table-bordered" style="background-color: white;">
                    <?php
                        //$servername = "sql302.epizy.com";
                        //$usernameDB = "epiz_25899308";
                        //$passwordDB = "MIShdzzsf8";
                        //$DBname = "epiz_25899308_Blood_Donation";

                        $servername = "localhost";
                        $usernameDB = "root";
                        $passwordDB = "";
                        $DBname = "Blood_Donation_DB";

                        $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);

                        //Check Connection
                        if($connection->connect_error)
                        {
                            die("Connection failed: " . $connection->connect_error);
                            echo "<br>";
                        }

                        echo "<thead class= 'thead-dark' ><tr> <th>Name</th><th>Email</th><th>City</th><th>Country</th><th>Contact Number</th><th>Blood Type</th><th>Gender</th> </tr></thead>";
                        echo "<tbody>";

                        $sql_query_fetch = "Select * From donors Where Donor_State = 'Donor'";

                        $result = $connection->query($sql_query_fetch);

                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["City"] . "</td><td>" . $row["Country"] . "</td><td>" . $row["Contact_no"] . "</td><td>" . $row["Blood_Type"] . "</td><td>" . $row["Gender"] . "</td></tr>";
                            }
                        }

                        echo "</tbody></table><br>";

                        $connection->close();
                    ?>
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