<?php
session_start();
require_once("./src/controllers/FrontPage.php");

\dark_horse\hw3\controllers\FrontPage::frontPage();
exit();
/////////////////////////////////////
//NOTHING IS USED BELOW THIS LINE
?>     <?php
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

                $res = $conn->query("SELECT NAME
                                     FROM USER
                                     WHERE USER_ID=" . $user . ";");
                if ($res->num_rows > 0) {
                    $user = $res->fetch_assoc();
                    $user = $user["NAME"];
                }

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
