<?php
if(isset($_POST['btn_add'])){
    $txt_householdno = $_POST['txt_householdno'];
    $txt_zone = $_POST['txt_zone'];
    $txt_totalmembers = $_POST['txt_totalmembers'];
    $txt_hof = $_POST['txt_hof'];

    $chkdup = mysqli_query($con, "SELECT * from tblhousehold where householdno = ".$txt_householdno." ");
    $num_rows = mysqli_num_rows($chkdup);

    if(isset($_SESSION['role'])){
        $action = 'Added Household Number '.$txt_householdno;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }


    if($num_rows == 0){
        $query = mysqli_query($con,"INSERT INTO tblhousehold (householdno,zone,totalhouseholdmembers,headoffamily) 
            values ('$txt_householdno', '$txt_zone', '$txt_totalmembers', '$txt_hof')") or die('Error: ' . mysqli_error($con));
        if($query == true)
        {
            $_SESSION['added'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
        }     
    }
    else{
        $_SESSION['duplicate'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $hiddennum = $_POST['hiddennum'];
    $txt_edit_zone = $_POST['txt_edit_zone'];
    //$txt_edit_totalmembers = $_POST['txt_edit_totalmembers'];
    //$txt_edit_hof = $_POST['txt_edit_hof'];

    $update_query = mysqli_query($con,"UPDATE tblhousehold set zone ='".$txt_edit_zone."' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if(isset($_SESSION['role'])){
        $action = 'Update Household Number '.$hiddennum;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    if($update_query == true){
        $_SESSION['edited'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblhousehold where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>