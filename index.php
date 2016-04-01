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

        // Create connection
        $conn = new mysqli("localhost", "guest", "guest", "DarkHorse");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Images ORDER BY upload_time DESC LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {

                $title = "src/resources/" . $row["title"];
                $caption = $row["caption"];
                $user = $row["user_id"];
                $rating = $row["rating"];
                $date = $row["upload_time"];

                echo <<<XYZ
            
            <div class = "image">
                <img src = "$title"><br/>
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