<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Clearance
                    </h1>
                </section>

                <section class="content">
                    <div class="btn-group">
                        <br>
                    </div>
                    <br>
                    
                    <?php
                    if ($_SESSION['role'] == "Administrator" || isset($_SESSION['staff'])) {
                    ?>
                        <div class="row">
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Clearance</button>
                                        <?php
                                        if (!isset($_SESSION['staff'])) {
                                        ?>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        <?php
                                        }
                                        ?>
                                        <a target="_blank" class="btn btn-primary btn-sm" href="clearance_form.php">Print</a>
                                    </div>

                                </div>

                                <div class="box-body table-responsive">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                        <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                    </ul>



                                    <form method="post">
                                        <div class="tab-content">
                                            <div id="approved" class="tab-pane active in">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <?php
                                                            if (!isset($_SESSION['staff'])) {
                                                            ?>
                                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                            <?php
                                                            }
                                                            ?>
                                                            <th>Clearance #</th>
                                                            <th>Resident Name</th>
                                                            <th>Findings</th>
                                                            <th>Purpose</th>
                                                            <th>OR Number</th>
                                                            <th>Amount</th>
                                                            <th style="width: 15% !important;">Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        if (!isset($_SESSION['staff'])) {

                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                                                            <td>' . $row['clearanceNo'] . '</td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                            <td>' . $row['orNo'] . '</td>
                                                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                                                            <td>

                                                            <div class="dropdown">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select<span class="caret"></span>
                                                                </button>

                                                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                 <li><a href="#" data-target="#editModal' . $row['pid'] . '" data-toggle="modal">Edit</a></li>

                                                                 <li><a target="_blank" href="clearance2.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Baranggay Clearance</a></li>

                                                                 <li>
                                                                 <a target="_blank" href="indigency2.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Indigency</a></li>
                                                                <li>

                                                                 <li>
                                                                 <a target="_blank" href="certification.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Certification</a></li>
                                                                <li>
                                                              </ul>
                                                            </div>
                                                    
                                                          
                                                          <!-- Modal -->
                                                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  ...   
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                
</td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        } else {
                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'Approved'") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo ' <tr>
                                                            <td>' . $row['clearanceNo'] . '</td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                            <td>' . $row['orNo'] . '</td>
                                                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                                                            <td>
                                                            
                                                            <div class="dropdown">
                                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select<span class="caret"></span>
                                                                </button>

                                                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                 <li><a href="#" data-target="#editModal' . $row['pid'] . '" data-toggle="modal">Edit</a></li>

                                                                 <li><a target="_blank" href="clearance2.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Baranggay Clearance</a></li>

                                                                 <li>
                                                                 <a target="_blank" href="indigency2.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Indigency</a></li>
                                                                <li>

                                                                 <li>
                                                                 <a target="_blank" href="certification.php?resident=' . $row['residentid'] . '&clearance=' . $row['clearanceNo'] . '&val=' . base64_encode($row['clearanceNo'] . '|' . $row['residentname'] . '|' . $row['dateRecorded']) . '">Certification</a></li>
                                                                <li>
                                                              </ul>
                                                            </div>

                                                            </td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        }
                                                        ?>

                                                    </tbody>

                                                </table>

                                            </div>

                                            <div id="disapproved" class="tab-pane">
                                                <table id="table1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <?php
                                                            if (!isset($_SESSION['staff'])) {
                                                            ?>
                                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                            <?php
                                                            }
                                                            ?>
                                                            <th>Resident Name</th>
                                                            <th>Findings</th>
                                                            <th>Purpose</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!isset($_SESSION['staff'])) {

                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        } else {
                                                            $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                        <tr>
                                                            <td>' . $row['residentname'] . '</td>
                                                            <td>' . $row['findings'] . '</td>
                                                            <td>' . $row['purpose'] . '</td>
                                                        </tr>
                                                        ';

                                                                include "edit_modal.php";
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>


                                        </div>
                                        <?php include "../deleteModal.php"; ?>

                                    </form>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <?php include "../edit_notif.php"; ?>

                            <?php include "../added_notif.php"; ?>

                            <?php include "../delete_notif.php"; ?>

                            <?php include "../duplicate_error.php"; ?>

                            <?php include "add_modal.php"; ?>

                            <?php include "function.php"; ?>


                        </div> <!-- /.row -->
                    <?php
                    } elseif ($_SESSION['role'] == "Zone Leader") {
                    ?>
                        <div class="row">
                            <!-- left column -->
                            <div class="box">

                                <div class="box-body table-responsive">

                                    <form method="post">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                    <th>Resident Name</th>
                                                    <th>Purpose</th>
                                                    <th style="width: 25% !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblclearance p left join tblresident r on r.id = p.residentid  where status = 'New'") or die('Error: ' . mysqli_error($con));
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                                                        <td>' . $row['residentname'] . '</td>
                                                        <td>' . $row['purpose'] . '</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm" data-target="#approveModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                                                            <button class="btn btn-danger btn-sm" data-target="#disapproveModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Disapprove</button>
                                                        </td>
                                                    </tr>
                                                    ';
                                                    include "approve_modal.php";
                                                    include "disapprove_modal.php";
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </form>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                            <?php include "function.php"; ?>


                        </div> <!-- /.row -->

                    <?php
                    } else {
                    ?>

                        <div class="row">
                            <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">

                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reqModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Request Clearance</button>

                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a data-target="#new" data-toggle="tab">New</a></li>
                                        <li><a data-target="#approved" data-toggle="tab">Approved</a></li>
                                        <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
                                    </ul>
                                    <form method="post">
                                        <div class="tab-content">
                                            <div id="new" class="tab-pane active in">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Purpose</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'New' ") or die('Error: ' . mysqli_error($con));
                                                        if (mysqli_num_rows($squery) > 0) {
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                    <tr>
                                                        <td>' . $row['purpose'] . '</td>
                                                    </tr>
                                                    ';
                                                            }
                                                        } else {
                                                            echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                                        }


                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div id="approved" class="tab-pane ">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Clearance #</th>
                                                            <th>Findings</th>
                                                            <th>Purpose</th>
                                                            <th>OR Number</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'Approved' ") or die('Error: ' . mysqli_error($con));
                                                        if (mysqli_num_rows($squery) > 0) {
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                    <tr>
                                                        <td>' . $row['clearanceNo'] . '</td>
                                                        <td>' . $row['findings'] . '</td>
                                                        <td>' . $row['purpose'] . '</td>
                                                        <td>' . $row['orNo'] . '</td>
                                                        <td>₱ ' . number_format($row['samount'], 2) . '</td>
                                                    </tr>
                                                    ';
                                                            }
                                                        } else {
                                                            echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                                        }


                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div id="disapproved" class="tab-pane">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Findings</th>
                                                            <th>Purpose</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $squery = mysqli_query($con, "SELECT * FROM tblclearance p left join tblresident r on r.id = p.residentid where r.id = " . $_SESSION['userid'] . " and status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                                        if (mysqli_num_rows($squery) > 0) {
                                                            while ($row = mysqli_fetch_array($squery)) {
                                                                echo '
                                                    <tr>
                                                        <td>' . $row['findings'] . '</td>
                                                        <td>' . $row['purpose'] . '</td>
                                                    </tr>
                                                    ';
                                                            }
                                                        } else {
                                                            echo '
                                                <tr>
                                                <td colspan="5" style="text-align: center;">No record found</td>
                                                </tr>
                                                ';
                                                        }


                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </form>
                                    <?php
                                    include "../duplicate_error.php";
                                    include "lengthstay_error.php";
                                    include "req_modal.php";
                                    include "function.php";
                                    ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div> <!-- /.row -->

                    <?php
                    }
                    ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
    <?php }
include "../footer.php"; ?>
    <script type="text/javascript">
        <?php
        if (!isset($_SESSION['staff'])) {
        ?>
            $(function() {
                $("#table").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0, 7]
                    }],
                    "aaSorting": []
                });
                $("#table1").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0, 3]
                    }],
                    "aaSorting": []
                });
                $(".select2").select2();
            });
        <?php
        } else {
        ?>
            $(function() {
                $("#table").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [6]
                    }],
                    "aaSorting": []
                });
                $("#table1").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [2]
                    }],
                    "aaSorting": []
                });
                $(".select2").select2();
            });
        <?php
        }
        ?>
    </script>
    </body>

</html>