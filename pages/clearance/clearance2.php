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
        margin-bottom: 50px;
        line-height: 1.5rem;
    }

    .clearance-container {
        margin-inline: 20rem;
        padding-block: 2em;
        padding-inline: 2em;
        height: auto;
        border: 1px solid black;

        .letter-header {
            padding-top: 4rem;
        }

        .letter-body {
            padding-block: 4rem;
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

            .letter-body {
                padding-block: 1rem;
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

<?php
require_once "../connection.php";

if (isset($_GET['resident'])) {
    $qry = mysqli_query($con, "SELECT * FROM tblresident r LEFT JOIN tblclearance c ON c.residentid = r.id WHERE residentid = '" . $_GET['resident'] . "' and clearanceNo = '" . $_GET['clearance'] . "' ");
    $row = mysqli_fetch_array($qry);

?>
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
            <h3>BARANGAY CLEARANCE</h3>
        </div>

        <div id="isi">
            <img src="isidro.png" alt="">
        </div>
    </div>

    <p class="letter-header">TO WHOM IT MAY CONCERN:</p>

    <div class="letter-body">
        <p>This is to certify that <input type="text" style="width: fit-content;" value="<?php echo strtoupper($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']); ?>">, <input type="text" style="width: 40px;"> years old, <input type="text" >, Filipino, a resident of Barangay San Isidro, Pamplona, Negros Oriental.</p>

        <p>This is to certify further that the above-named is of good moral character standing in the community has no case filed against him/her in any tribunal.
        </p>

        <p>
            This clearance is being issued upon the request of <input type="text"> for whatever purpose it may serve him/her best.
        </p>

        <p>
            Issued this <input type="text"> day of <input type="text">, <input type="text"> at Barangay San Isidro, Pamplona, Negros Oriental.
        </p>

        <p id="footer">RENANTE L. BALDADO <br>Punong Barangay</p>
    </div>
</div>

<?php } ?>