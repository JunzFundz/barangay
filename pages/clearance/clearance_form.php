<!DOCTYPE html>
<html id="clearance">
<style>
    @media print {
        .noprint {
            visibility: hidden;
        }
    }

    @page {
        size: auto;
        margin: 4mm;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    $_SESSION['clr'] = $_GET['clearance'];
    include('../head_css.php'); ?>

    <body class="skin-black">
        <?php

        include "../connection.php";
        ?>

        <?php
        $qry = mysqli_query($con, "SELECT * from tblofficial");
        while ($row = mysqli_fetch_array($qry)) {
            if ($row['sPosition'] == "Captain") {
                echo '
                                    <p>
                                    <b>' . strtoupper($row['completeName']) . '</b><br>
                                    <span style="font-size:12px;">PUNONG BARANGAY</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Ordinance)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Sports / Law / Ordinance</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Public Safety)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Public Safety / Peace and Order</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Tourism)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Culture & Arts / Tourism / Womens Sector</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Budget & Finance)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Budget & Finance / Electrification</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Agriculture)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Agriculture / Livelihood / Farmers Sector / PWD Sector</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Education)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Health & Sanitation / Education</span>
                                    </p>
                                    ';
            } elseif ($row['sPosition'] == "Kagawad(Infrastracture)") {
                echo '
                                    <p>
                                    KAG. ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;">Infrastracture / Labor Sector/ Environment / Beautification</span>
                                    </p>
                                    ';
            }
        }
        ?>
        </div>
        </div>
        <div class="col-xs-7 col-sm-5 col-md-8" style="background: white;  ">

            <?php $qry1 = mysqli_query($con, "SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '" . $_GET['resident'] . "' and clearanceNo = '" . $_GET['clearance'] . "' ");
            while ($row1 = mysqli_fetch_array($qry1)) {
            }
            ?>
            <br>
            <br>
            <br>
            <br>
            <br>

            <style>
                .container-- {
                    display: grid;
                }
            </style>

            <div class="col-xs-12 col-md-12 text-center">

                <div class="container--" style="display: flex; flex-direction: row">
                    <div>
                        <img src="Pamplona.png" alt="" srcset="" style=" object-fit: contain; aspect-ratio: 3/2; width: 20%;">
                    </div>

                    <div>
                        <p class="text-center">Republic of the Philippines</p>
                        <p class="text-center">Province of Negros Oriental </p>
                        <p class="text-center">Municipality of Pamplona </p>
                        <p class="text-center">Barangay San Isidro </p>
                    </div>

                    <div>
                        <img src="Isidro.png" alt="" srcset="" style="transform: translateX(-50rem); transform: translateY(-10rem); margin-right: -7rem; margin-bottom: -30rem ; object-fit: contain; aspect-ratio: 3/2; width: 20%;">
                    </div>
                </div>





                <br>
                <br>
                <p class="text-center" style="font-size: 20px; font-size:bold;"><b style="font-size: 28px;">BARANGAY
                        CLEARANCE</b></p>
                <br>
                <br>
                <p style="font-size: 18px;">TO WHOM IT MAY CONCERN:</p>
                <?php
                // Check if 'resident' parameter is set in the URL
                if (isset($_GET['resident'])) {
                    $qry = mysqli_query($con, "SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '" . $_GET['resident'] . "' and clearanceNo = '" . $_GET['clearance'] . "' ");
                    $row = mysqli_fetch_array($qry);

                    if ($row) {
                        $bdate = date_create($row['bdate']);
                        $date = date_create($row['dateRecorded']); ?>

                        <p style="text-indent:40px;text-align: justify;">This is to certify that <u><input type="text" value="<?php echo strtoupper($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']); ?>"></u>,<input type="text"> years old, <input type="text" value="<?php echo strtoupper($row['formerAddress']); ?>">, Filipino,
                            <?php echo strtoupper($row['formerAddress']); ?> Negros Oriental.
                        </p>

                        <br>
                        <br>


                        <p style="text-indent:40px;text-align: justify;">
                            This is to certify further that the above-named is of good moral character standing in the community has
                            no case filed against him/her in any tribunal.
                        </p>
                        <br>
                        <br>
                        <p style="text-indent:40px;text-align: justify;">
                            This clearance is being issued upon the request of
                            <u><?php echo strtoupper($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']); ?></u> for
                            whatever purpose it may serve him/her best.
                        </p>

                        <!-- <p><b>
 
            ADDRESS: <u><?php echo strtoupper($row['formerAddress']); ?></u><br>
            BIRTHDATE & PLACE: <u><?php echo strtoupper(date_format($bdate, "m-d-Y")) . '/' . strtoupper($row['bplace']); ?></u><br>
            GENDER/CIVIL STATUS: <u><?php echo strtoupper($row['gender']) . '/SINGLE'; ?></u><br>
            NATIONALITY: <u><?php echo strtoupper($row['nationality']); ?></u><br>
            RELIGION: <u><?php echo strtoupper($row['religion']); ?></u><br>
            PURPOSE: <u><?php echo strtoupper($row['purpose']); ?></u><br>
            FINDINGS: <u>NO DEROGATORY RECORD</u><br>
        </b></p>
        <p><b>
            RES. CERT. NO.: <u><?php echo strtoupper($row['clearanceNo']); ?></u><br>
            ISSUED ON: <u><?php echo strtoupper(date_format($date, "F j, o")); ?></u><br>
            ISSUED AT: <u>IGPIT OFFICE</u><br>
            OR. NO.: <u><?php echo strtoupper($row['orNo']); ?></u><br>
            ISSUED ON: <u><?php echo strtoupper(date_format($date, "F j, o")); ?></u><br>
        </b></p> -->
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                <?php
                    } else {
                        // Handle case when no resident details are found
                        echo "No resident details found.";
                    }
                } else {
                    // Handle case when 'resident' parameter is not set in the URL
                    echo "No resident ID provided.";
                }
                ?>
            </div>


            <div class="col-md-5 col-xs-4" style="float:right;margin-top: -160px;">
                <br><br>
                <p style="text-align: right;">RENANTE L. BALDADO </p>
                <p style="text-align: right;">Punong Barangay </p>
            </div>
        </div>
        <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4"><br><br><br>

        </div>
        <div class="col-xs-8 col-md-4">

        </div>
        <div class="col-xs-3 pull-right" style="margin-bottom:40px;">
            <!-- <img class=" pull-right" src="barcode.php?clr=<?php echo base64_decode($_GET['val']); ?>" style="width:170px; height: 60px; " /> -->

            <!-- <span class="pull-right"><?php echo substr_replace($_GET['clearance'], '****', 0, 3); ?> </span>
                -->
        </div>
        </div>
        </div>
        <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button>
    </body>
<?php
}
?>


<script>
    function PrintElem(elem) {
        window.print();
    }

    function Popup(data) {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        //mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        //mywindow.document.write('</head><body class="skin-black" >');
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        mywindow.document.write(data);
        //mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();

        printButton.style.visibility = 'visible';
        mywindow.close();

        return true;
    }
</script>

</html>