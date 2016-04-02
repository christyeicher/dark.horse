<html>
<head>
    <title>Image Rater</title>
    <link rel="stylesheet" href="src/styles/style.css" type="text/css" />
</head>
<body>
    <div id="wrapper">

        <h1>Image Rater [logo]</h1>

        <div id="header-links">
            <a href="">SIGN IN</a>
             |
            <a href="">SIGN UP</a>
        </div>


        <h2>Recent Images</h2>

        <!-- MAKE SURE TITLES HAVE EXTENSION ON THEM OR IT WON'T WORK -->

        <div id="recent-images" class="wrapper-box">

        <?php
        use dark_horse\hw3\configs as cfg;
        require_once("./src/configs/Config.php");
        // Create connection
        $conn = new mysqli( cfg\Config::host, 
                            cfg\Config::username, 
                            cfg\Config::password, 
                            cfg\Config::db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT IMG_ID,
                       RATING,
                       USER_ID,
                       CAPTION,
                       POSTED FROM PICTURES ORDER BY IMG_ID DESC LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {

                $image = "./src/controllers/img.php?img=" . $row["IMG_ID"];
                $caption = $row["CAPTION"];
                $user = $row["USER_ID"];
                $rating = $row["RATING"];
                $date = $row["POSTED"];

                echo <<<XYZ
            
            <div class = "image">
                <img src = "$image"><br/>
                <span class="image-text">
                    Caption: $caption<br/>
                    Uploaded by: $user<br/>
                    Rating: $rating<br/>
                    Date: $date
                </span>
            </div>
                
XYZ;
            }
        } else {
            echo "No images have been uploaded.";
        }
        $conn->close();

        ?>

        </div>


        <h2>Popular Images</h2>

        <div id="popular-images" class="wrapper-box">

        </div>
    </div>
</body>
</html>
