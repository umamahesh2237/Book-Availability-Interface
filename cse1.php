<html>
    <head>
        <title>cse</title>
</head>
<body>
    <?php
    $conn=mysqli_connect("localhost","root","","library");
    if($conn->connect_error)
    {
        echo $conn->connect_error;
    }
    else
    {
        mysqli_query($conn,"insert into ece1 values(101,'english','uma',25),(102,'physics','naveen',30)");
        echo "inserted";
        $r1=mysqli_query($conn,"select* from ece1");
        while($x=mysqli_fetch_row($r1))
        {
            echo $x[0]." ".$x[1]." ".$x[2]." ".$x[3]."<br>";
        }
    }   
?>
    </body>
    </html>
