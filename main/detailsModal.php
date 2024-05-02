
<!-- ========================= MODAL ======================= -->
<div id="detailsModal<?php echo $row['id'];?>" class="modal fade">
<form method="post">
  <div class="modal-dialog " >
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Details of <?php echo '<b>'.$row['cname'].'</b>';?></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                
                <?php
                echo '
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name:</label><br>
                        '.$row['cname'].'
                    </div>
                    <div class="form-group">
                        <label>Gender:</label><br>
                        '.$row['gender'].'
                    </div>
                    <div class="form-group">
                        <label>Birthdate:</label><br>
                        '.$row['bdate'].'
                    </div>
                    <div class="form-group">
                        <label>Barangay:</label><br>
                        '.$row['barangay'].'
                    </div>
                    <div class="form-group">
                        <label>Total Household:</label><br>
                        '.$row['totalhousehold'].'
                    </div>
                    <div class="form-group">
                        <label>Relation to Head:</label><br>
                        '.$row['relationtohead'].'
                    </div>
                    <div class="form-group">
                        <label>Bloodtype:</label><br>
                        '.$row['bloodtype'].'
                    </div>
                    <div class="form-group">
                        <label>Monthly Income:</label><br>
                        '.$row['monthlyincome'].'
                    </div>
                    <div class="form-group">
                        <label>Length of Stay:</label><br>
                        '.$row['lengthofstay'].'
                    </div>
                    <div class="form-group">
                        <label>Nationality:</label><br>
                        '.$row['nationality'].'
                    </div>
                    <div class="form-group">
                        <label>Nationality:</label><br>
                        '.$row['nationality'].'
                    </div>
                    <div class="form-group">
                        <label>Philhealth #:</label><br>
                        '.$row['philhealthNo'].'
                    </div>
                    <div class="form-group">
                        <label>House Ownership Status:</label><br>
                        '.$row['houseOwnershipStatus'].'
                    </div>
                    <div class="form-group">
                        <label>Dwelling Type:</label><br>
                        '.$row['dwellingtype'].'
                    </div>
                    <div class="form-group">
                        <label>Lightning Facilities:</label><br>
                        '.$row['lightningFacilities'].'
                    </div>
                    <div class="form-group">
                        <label>Former Address:</label><br>
                        '.$row['formerAddress'].'
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Age:</label><br>
                        '.$row['age'].'
                    </div>
                    <div class="form-group">
                        <label>Civil Status:</label><br>
                        '.$row['civilstatus'].'
                    </div>
                    <div class="form-group">
                        <label>Birth Place:</label><br>
                        '.$row['bplace'].'
                    </div>
                    <div class="form-group">
                        <label>Zone:</label><br>
                        '.$row['zone'].'
                    </div>
                    <div class="form-group">
                        <label>Differently Abled Person:</label><br>
                        '.$row['differentlyabledperson'].'
                    </div>
                    <div class="form-group">
                        <label>Marital Status:</label><br>
                        '.$row['maritalstatus'].'
                    </div>
                    <div class="form-group">
                        <label>Occupation:</label><br>
                        '.$row['occupation'].'
                    </div>
                    <div class="form-group">
                        <label>Household #:</label><br>
                        '.$row['householdnum'].'
                    </div>
                    <div class="form-group">
                        <label>Religion:</label><br>
                        '.$row['religion'].'
                    </div>
                    <div class="form-group">
                        <label>Skills:</label><br>
                        '.$row['skills'].'
                    </div>
                    <div class="form-group">
                        <label>Igpit ID:</label><br>
                        '.$row['igpitID'].'
                    </div>
                    <div class="form-group">
                        <label>Highest Educational Attainment:</label><br>
                        '.$row['highestEducationalAttainment'].'
                    </div>
                    <div class="form-group">
                        <label>Land Ownership Status:</label><br>
                        '.$row['landOwnershipStatus'].'
                    </div>
                    <div class="form-group">
                        <label>Water Usage:</label><br>
                        '.$row['waterUsage'].'
                    </div>
                    <div class="form-group">
                        <label>Sanitary Toilet:</label><br>
                        '.$row['sanitaryToilet'].'
                    </div>
                    <div class="form-group">
                        <label>Remarks:</label><br>
                        '.$row['remarks'].'
                    </div>
                </div>';
                ?>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Close"/>
        </div>
    </div>
  </div>
  </form>
</div>