s<?php
require("phandau.php");
?>
<table>
    <?php
        if(isset($_REQUEST['matl'])){
        $matl=$_REQUEST['matl'];
        $sql ="select * from tailieu where matailieu='$matl'";
        $rs = $conn->query($sql);
        if($rs->num_rows>0) {
    ?>
    <tr>
        <?php
            if($row = $rs->fetch_assoc())
        ?>
        
        <td>
            <?php echo $row['tentailieu']; ?> <br/>
            <img src="<?php echo $row["hinh"];?>" width=100px height=100px />
            <br />

<?php echo $row['motatailieu'];?> <br/>

<a href="dowload.php">Tai ve</a>

</td>
<?php
}
?>
</tr>
<?php
}
?>
</table>
<?php 
require("phacuoi.php");
?>