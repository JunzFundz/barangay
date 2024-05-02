<?php
if(isset($_POST['btn_add'])){
    $txt_cname = $_POST['txt_cname'];
    $txt_cage = $_POST['txt_cage'];
    $txt_cadd = $_POST['txt_cadd'];
    $txt_ccontact = $_POST['txt_ccontact'];

    $txt_pname = $_POST['txt_pname'];
    $txt_page = $_POST['txt_page'];
    $txt_padd = $_POST['txt_padd'];
    $txt_pcontact = $_POST['txt_pcontact'];

    $txt_complaint = $_POST['txt_complaint'];
    $ddl_acttaken = $_POST['ddl_acttaken'];
    $ddl_stat = $_POST['ddl_stat'];
    $txt_location = $_POST['txt_location'];
    $year = date('Y');
    $date = date('Y-m-d');

    if(isset($_SESSION['role'])){
        $action = 'Added Blotter Request by '.$txt_cname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    $query = mysqli_query($con,"INSERT INTO tblblotter (yearRecorded,dateRecorded,complainant,cage,caddress,ccontact,personToComplain,page,paddress,pcontact,complaint,actionTaken,sStatus,locationOfIncidence,recordedby) 
        values ('$year', '$date', '$txt_cname', '$txt_cage', '$txt_cadd', '$txt_ccontact', '$txt_pname', '$txt_page', '$txt_padd', '$txt_pcontact', '$txt_complaint', '$ddl_acttaken', '$ddl_stat', '$txt_location', '".$_SESSION['username']."')") or die('Error: ' . mysqli_error($con));
    if($query == true)
    {
        $_SESSION['added'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }   
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cname = $_POST['txt_edit_cname'];
    $txt_edit_cage = $_POST['txt_edit_cage'];
    $txt_edit_cadd = $_POST['txt_edit_cadd'];
    $txt_edit_ccontact = $_POST['txt_edit_ccontact'];

    $txt_edit_pname = $_POST['txt_edit_pname'];
    $txt_edit_page = $_POST['txt_edit_page'];
    $txt_edit_padd = $_POST['txt_edit_padd'];
    $txt_edit_pcontact = $_POST['txt_edit_pcontact'];

    $txt_edit_complaint = $_POST['txt_edit_complaint'];
    $ddl_edit_acttaken = $_POST['ddl_edit_acttaken'];
    $ddl_edit_stat = $_POST['ddl_edit_stat'];
    $txt_edit_location = $_POST['txt_edit_location'];

    $update_query = mysqli_query($con,"UPDATE tblblotter set complainant = '".$txt_edit_cname."', cage = '".$txt_edit_cage."', caddress= '".$txt_edit_cadd."', personToComplain = '".$txt_edit_pname."', page = '".$txt_edit_page."', paddress= '".$txt_edit_padd."', pcontact = '".$txt_edit_pcontact."', complaint = '".$txt_edit_complaint."', actionTaken= '".$ddl_edit_acttaken."', sStatus = '".$ddl_edit_stat."', locationOfIncidence= '".$txt_edit_location."'  where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if(isset($_SESSION['role'])){
        $action = 'Update Blotter Request by '.$txt_edit_cname;
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
            $delete_query = mysqli_query($con,"DELETE from tblblotter where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>