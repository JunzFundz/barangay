<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .clearance-body {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;

        .header {
            display: grid;
            place-items: center;
        }

        #pamp,
        #isi {
            display: flex;
            justify-content: center;
        }

        #pamp img {
            object-fit: contain;
            aspect-ratio: 1/1;
            width: 44%;
        }

        #isi img {
            object-fit: contain;
            aspect-ratio: 1/1;
            width: 50%;
        }
    }

    p {
        margin-bottom: 30px;
        line-height: 1.5rem;
    }
    

    .clearance-container {
        margin-inline: 20rem;
        padding-block: 2rem;
        padding-inline: 2em;
        height: auto;
        border: 1px solid black;

        .letter-header {
            padding-top: 4rem;
        }

        .letter-body {
            padding-block: 5rem;
            padding-inline: 10rem;

            #footer {
                float: right;

            }
        }

        input {
            border: none;
            border-bottom: 1px solid black;
        }
    }

    .clearance-body {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;

        .header {
            display: grid;
            place-items: center;
        }
    }
    button{
        position: fixed;
        transform: translate(10rem, 8rem);
        padding: 2rem;
        background-color: green;
        color: white;
        border-radius: 10px;
    }
    @media print {
        button {
            display: none;
        }

        .clearance-container {
            margin-inline: 1rem;
            padding-block: 2em;
            padding-inline: 2em;
            border: none;

            .letter-header {
                padding-top: 1rem;
            }

            .letter-body {
                padding-block: 10px;
                padding-inline: 1rem;

                #footer {
                    float: right;

                }
            }
        }

        .clearance-body {
            .header {
                display: grid;
                place-items: center;
            }

            #pamp,
            #isi {
                position: absolute;
                display: flex;
                justify-content: center;
            }

            #pamp img {
                transform: translateX(-15rem);
                width: 38%;
            }

            #isi img {
                transform: translateX(15rem)translateY(-5px);
                width: 42%;
            }
        }
    }
</style>

<button class="btn" onclick="print()"><i class="bi bi-printer" style="font-size: 30px;"></i></button>


<div class="clearance-container">

    <div class="clearance-body">
        <div id="pamp">
            <img src="Pamplona.png" alt="">
        </div>

        <div class="header">
            <div>Republic of the Philippines</div>
            <div>Province of Negros Oriental</div>
            <div>Municipality of Pamplona</div>
            <div>Barangay San Isidro</div>
            <h3>CERTIFICATE OF INDIGENCY</h3>
        </div>

        <div id="isi">
            <img src="isidro.png" alt="">
        </div>
    </div>

    <p class="letter-header">TO WHOM IT MAY CONCERN:</p>

    <?php
    require_once "../connection.php";

    if (isset($_GET['resident'])) {
        $qry = mysqli_query($con, "SELECT * FROM tblresident r LEFT JOIN tblclearance c ON c.residentid = r.id WHERE residentid = '" . $_GET['resident'] . "' and clearanceNo = '" . $_GET['clearance'] . "' ");
        $row = mysqli_fetch_array($qry);

    ?>

        <div class="letter-body">
            <p>This is to certify that <input type="text" value="<?php echo strtoupper($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']); ?>">, <input type="text" style="width: 40px;"> years old, <input type="text">, Filipino, a resident of Barangay San Isidro, Pamplona, Negros Oriental.</p>

            <p>
                This is to certify further that:
            </p>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 30px;  margin-bottom: 7px;">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Above-named resident is an indigent with:
                </label>
            </div>

            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px;">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    No income
                </label>
            </div>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Less than ₱2,000.00 monthly.
                </label>
            </div>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    As such he/she not filed an Income Tax Return being exempted to file same
                </label>
            </div>
            <p style="margin-left: 17%; margin-top: -7px; width: 80%">
                and in lieu of which this certification is issued:
            </p>

            <p>
                This is to certify furthermore that:
            </p>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px;">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    This certification is issued to support for <input type="text" style="width: 15rem;">
                </label>
            </div>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    This certification is issued for Burial/Medical Assistance/Cash Assistance.
                </label>
            </div>
            <div class="form-check" style="display: flex; align-items: center; margin-left: 12%; margin-bottom: 7px">
                <input class="form-check-input" type="checkbox" value="" style="width: 20px; height: 20px;" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Due to his/her financial capacity, he/she could not hire a private lawyer to
                </label>
            </div>

            <p style="margin-left: 17%; margin-top: -7px; width: 80%">
                represent him/her on a case he/she seeks to file or filed against him/her and thus would seek the assistance of the Public Attorney’s Office.
            </p>


            <p id="footer">RENANTE L. BALDADO <br>Punong Barangay</p>
        </div>
</div>
<?php } ?>