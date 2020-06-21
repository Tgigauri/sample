
<?php
$id = $_GET['id'];
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

$sql = "SELECT * FROM dbo.PROJECTS where PRJ_ID = '$id' ";
$stmt = sqlsrv_query( $conn, $sql );

?>







<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="tables.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!------------------------------------------------------ -->
    <table align="center" id  = "table1">
        
    <t>
        <th>ID</th>
        <th>Code</th>
        <th>Name</th>
        <th>PROGRAM</th>
        <th>DONOR</th>
        <th>REGION</th>
        <th>MUNICIPALITY</th>
        <th>TYPE</th>
    </t>
    <?php

    while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
    {       
        ?>
        <tr>        
                <td><?php echo $row['PRJ_ID'];   ?></td>
                <td><?php echo $row['PRJ_CODE'];   ?></td>
                <td><?php echo $row['PRJ_NAME'];   ?></td>
                <td><?php echo $row['PRJ_PROGRAM'];   ?></td>
                <td><?php echo $row['PRJ_DONOR'];   ?></td>
                <td><?php echo $row['PRJ_REGION'];   ?></td>
                <td><?php echo $row['PRJ_MUNICIPALITY'];   ?></td>
                <td><?php echo $row['PRJ_TYPE'];   ?></td>

        </tr>
        <?php 
    }

    ?>
    </table>
<!------------------------------------------------------ --><!------------------------------------------------------ -->
<table id = "table2" align="center">
        
        <t>
            <th>CON_NAME</th>
            <th>CON_NAME_EN</th>
            <th>RES_AMOUNT</th>
            <th>ADV_PERCENT</th>
            <th>PRJ_STATUS_GE</th>

        </t>
        <?php
        $sql = "SELECT CON_NAME_GE,CON_NAME_EN,PASSPORT.RES_AMOUNT,ADV_PERCENT,PRJ_STATUS_GE
        FROM PROJECTS
        INNER JOIN PASSPORT ON Projects.PRJ_CODE=PASSPORT.PRJ_CODE
        where PROJECTS.PRJ_ID ='$id' ";
        $stmt = sqlsrv_query( $conn, $sql );
        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
        {       
            ?>
            <tr>        
                    <td><?php echo $row['CON_NAME_GE'];   ?></td>
                    <td><?php echo $row['CON_NAME_EN'];   ?></td>
                    <td><?php echo $row['RES_AMOUNT'];   ?></td>
                    <td><?php echo $row['ADV_PERCENT'];   ?></td>
                    <td><?php echo $row['PRJ_STATUS_GE'];   ?></td>

    
            </tr>
            <?php 
        }
    
        ?>
        
        </div>
<!------------------------------------------------------ -->
<table id = "table3" align="center">
        
        <t>
            <th>PAY_ID</th>
            <th>SAW_CODE</th>
            <th>PAY_CODE</th>
            <th>PAY_RATE</th>
            <th>PAY_DATE</th>

        </t>
        <?php
        $sql = "SELECT PAY_ID,SAW_CODE,PAY_CODE,PAY_RATE,PAY_DATE
        FROM PROJECTS
        INNER JOIN PAY ON PAY.PRJ_CODE=PROJECTS.PRJ_CODE
        where PROJECTS.PRJ_ID ='$id' ";
        $stmt = sqlsrv_query( $conn, $sql );
       
        
        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
        {         $converted = date_format($row['PAY_DATE'],"Y/m/d H:i:s");
            ?>
            <tr>       
                    <td><?php echo $row['PAY_ID'];   ?></td>
                    <td><?php echo $row['SAW_CODE'];   ?></td>
                    <td><?php echo $row['PAY_CODE'];   ?></td>
                    <td><?php echo $row['PAY_RATE'];   ?></td>
                    <td><?php echo $converted   ?></td>

    
            </tr>
            <?php 
        }
    
        ?>
        
        </div>

</body>
</html>