

<?php
require_once "index.html";
//DESKTOP-APJ9EIK
$serverName = "DESKTOP-APJ9EIK"; 
$connectioninfo = array("Database"=>"MIS","CharacterSet" => "UTF-8");
$charset   = "UTF-8";
$conn = sqlsrv_connect($serverName,$connectioninfo);

if($conn){
    
    echo "<br>Connection Established</br>";
}
else{
    echo "Error connecting to Database";
    die(print_r(sqlsrv_errors(),true));
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $i = 1;
    $name = $_POST['name'];
    $sql = "SELECT PRJ_NAME,PRJ_ID FROM dbo.PROJECTS where PRJ_NAME LIKE N'%$name%' ";
    $stmt = sqlsrv_query( $conn, $sql );
    ?>
    <link rel="stylesheet" href="front.css">
    <?php 
    while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        ?>
        
        <p class ="results">
        
        <?php echo $i.". ".$row['PRJ_NAME']."<br>".'<a href="Project_details.php?id='.$row['PRJ_ID'].'">დეტალები</a>'.'[ ' .$row['PRJ_ID'].' ]';
        $i++;      

            
    }
}
?>  
</p>
