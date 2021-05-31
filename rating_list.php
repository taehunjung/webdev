<?php
$link = mysqli_connect("localhost", "root","","rateMyCourses");
$result = mysqli_query($link, "SELECT * FROM userratingform ORDER BY id DESC LIMIT 3");

if(mysqli_num_rows($result)>0) 
{
    while($row=mysqli_fetch_object($result)){
        ?>
        <div class="col-md-3"> <?php echo $row->coursecode;?></div>
        <div class="col-md-7"> <?php echo $row->difficultylevel;?></div>
        <div class="col-md-9"> <?php echo $row->applicabilitylevel;?></div>
        <p>&nbsp;</p>
        <?php
    }
}

?>

