<?php
$conn = mysqli_connect('inetdb.nameserver.sk','mpca86','DikfowjefJiHeb6', 'pws_mpca86');

if (!$conn) {
    echo "Debugging error: " . mysqli_connect_error();
    exit;
    }

    //var_dump($result);

    //$sql = "INSERT INTO `ams_BRE0` (`T`,`H`,`W`,`G`,`B`,`R`,`RR`,`P`) VALUES ('25', '60', '30', '22', '22')";
    $sql = "INSERT INTO ams_BRE0 (T,H,W,G,B,R,RR,P) VALUES ('25', '60', '30', '22', '22','22','22','22')";
    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?> 
