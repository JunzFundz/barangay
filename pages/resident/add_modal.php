<!-- ========================= MODAL ======================= -->
            <div id="addCourseModal" class="modal fade">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Manage Residents</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="container-fluid">
                                <div class="col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label class="control-label" >Name:</label><br>
                                        <div class="col-sm-8">
                                            <input name="txt_lname" class="form-control input-sm" type="text" placeholder="Fullname"/>
                                        </div>
                                        <!-- <div class="col-sm-4">
                                            <input name="txt_fname" class="form-control input-sm col-sm-4" type="text" placeholder="Firstname"/>
                                        </div>
                                        <div class="col-sm-4">
                                            <input name="txt_mname" class="form-control input-sm col-sm-4" type="text" placeholder="Middlename"/>
                                        </div> -->
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Birthdate:</label>
                                        <input name="txt_bdate" class="form-control input-sm input-size" type="date" placeholder="Birthdate"/>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label">Mothers Name:</label>
                                        <input name="txt_age" class="form-control input-sm input-size" type="text" placeholder="Name"/>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Barangay:</label>
                                        <input name="txt_brgy" class="form-control input-sm input-size" type="text" placeholder="Barangay"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Household #:</label>
                                        <input name="txt_householdnum" class="form-control input-sm input-size" type="number" min="1" placeholder="Household #"/>
                                    </div>

                                 

                                    <div class="form-group">
                                        <label class="control-label">Blood Type:</label>
                                        <input name="txt_btype" class="form-control input-sm input-size" type="text" placeholder="Blood Type"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Nationality:</label>
                                        <input name="txt_dperson" class="form-control input-sm input-size" type="text" placeholder="Nationality"/>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Civil Status:</label>
                                        <input name="txt_cstatus" class="form-control input-sm input-size" type="text" placeholder="Civil Status"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Length of Stay: (in Months)</label><br>
                                        <input name="txt_length" class="form-control input-sm input-size" type="number" min="0" placeholder="Length of Stay"/>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Religion:</label>
                                        <input name="txt_religion" class="form-control input-sm input-size" type="text" placeholder="Religion"/>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label class="control-label">IgpitID:</label>
                                        <input name="txt_igpit" class="form-control input-sm input-size" type="number" placeholder="" min="1" />
                                    </div> -->

<!--                                    

                                    <div class="form-group">
                                        <label class="control-label">Land Ownership Status:</label>
                                        <select name="ddl_los" class="form-control input-sm input-size">
                                            <option>Owned</option>
                                            <option>Landless</option>
                                            <option>Tenant</option>
                                            <option>Care Taker</option>
                                        </select>
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="control-label">Water Usage:</label>
                                        <select name="txt_water" class="form-control input-sm input-size">
                                            <option>Faucet</option>
                                            <option>Deep Well</option>
                                        </select>
                                    </div> -->


                                    <!-- <div class="form-group">
                                        <label class="control-label">Sanitary Toilet:</label>
                                        <select name="txt_toilet" class="form-control input-sm input-size">
                                            <option>Water-sealed</option>
                                            <option>Antipolo</option>
                                            <option>None</option>
                                        </select>
                                    </div> -->


                                    <div class="form-group">
                                        <label class="control-label">Remarks:</label>
                                        <input name="txt_remarks" class="form-control input-sm input-size" type="text" placeholder="Remarks"/>
                                    </div>

                                

                                </div>

                                <div class="col-md-6 col-sm-12">
                                    
                                    <div class="form-group">     
                                        <label class="control-label">Gender:</label>
                                        <select name="ddl_gender" class="form-control input-sm">
                                            <option selected="" disabled="">-Select Gender-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Birthplace:</label>
                                        <input name="txt_bplace" class="form-control input-sm" type="text" placeholder="Birthplace"/>
                                    </div> 

                                     
                                    <div class="form-group">
                                        <label class="control-label">Fathers Name:</label>
                                        <input name="txt_rthead" class="form-control input-sm" type="text" placeholder="Fathers Name"/>
                                    </div>   


                                    <div class="form-group">
                                        <label class="control-label">Status:</label>
                                        <input name="txt_mstatus" class="form-control input-sm" type="text" placeholder="Marital Status"/>
                                    </div> 

                                    <div class="form-group">
                                        <label class="control-label">Religion #:</label>
                                        <input name="txt_zone" class="form-control input-sm" type="text"  placeholder="Zone #"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Total Household Member:</label>
                                        <input name="txt_householdmem" class="form-control input-sm" type="number" min="1" placeholder="Total Household Member"/>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Occupation:</label>
                                        <input name="txt_occp" class="form-control input-sm" type="text" placeholder="Occupation"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Monthly Income:</label>
                                        <input name="txt_income" class="form-control input-sm" type="number" min="1" placeholder="Monthly Income"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Nationality:</label>
                                        <input name="txt_national" class="form-control input-sm" type="text" placeholder="Nationality"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Educational Attainment</label>
                                        <select name="ddl_eattain" class="form-control input-sm input-size">
                                            <option>No schooling completed</option>
                                            <option>Elementary</option>
                                            <option>High school, undergrad</option>
                                            <option>High school graduate</option>
                                            <option>College, undergrad</option>
                                            <option>Vocational</option>
                                            <option>Bachelor’s degree</option>
                                            <option>Master’s degree</option>
                                            <option>Doctorate degree</option>
                                        </select>
                                    </div>
<!-- 
                                    <div class="form-group">
                                        <label class="control-label">Skills:</label>
                                        <input name="txt_skills" class="form-control input-sm" type="text" placeholder="Skills"/>
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="control-label">PhilHealth #:</label>
                                        <input name="txt_phno" class="form-control input-sm" type="number" max="999999999999" min="1" placeholder="eg. 010000000001"/>
                                    </div> -->
<!-- 
                                    <div class="form-group">
                                        <label class="control-label">House Ownership Status:</label>
                                        <select name="ddl_hos" class="form-control input-sm">
                                            <option value="Own Home">Own Home</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Live with Parents/Relatives">Live with Parents/Relatives</option>
                                        </select>
                                    </div> -->

<!-- 
                                    <div class="form-group">
                                        <label class="control-label">Dwelling Type:</label>
                                        <select name="ddl_dtype" class="form-control input-sm">
                                            <option value="1st Option">1st Option</option>
                                            <option value="2nd Option">2nd Option</option>
                                        </select>
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="control-label">Lightning Facilities:</label>
                                        <select name="txt_lightning" class="form-control input-sm input-size">
                                            <option>Electric</option>
                                            <option>Lamp</option>
                                        </select>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="control-label">Former Address:</label>
                                        <input name="txt_faddress" class="form-control input-sm" type="text" placeholder="Former Address"/>
                                    </div>
<!-- 
                                    
                                    <div class="form-group">
                                        <label class="control-label">Password:</label>
                                        <input name="txt_upass" class="form-control input-sm" type="password" placeholder="Password"/>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="control-label">Upload ID Picture:</label>
                                        <input name="txt_image" class="form-control input-sm" type="file" />
                                    </div>



                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" id="btn_add" value="Add Resident"/>
                    </div>
                </div>
              </div>
              </form>
            </div>

<script type="text/javascript">
    $(document).ready(function() {
 
        var timeOut = null; // this used for hold few seconds to made ajax request
 
        var loading_html = '<img src="../../img/ajax-loader.gif" style="height: 20px; width: 20px;"/>'; // just an loading image or we can put any texts here
 
        //when button is clicked
        $('#username').keyup(function(e){
 
            // when press the following key we need not to make any ajax request, you can customize it with your own way
            switch(e.keyCode)
            {
                //case 8:   //backspace
                case 9:     //tab
                case 13:    //enter
                case 16:    //shift
                case 17:    //ctrl
                case 18:    //alt
                case 19:    //pause/break
                case 20:    //caps lock
                case 27:    //escape
                case 33:    //page up
                case 34:    //page down
                case 35:    //end
                case 36:    //home
                case 37:    //left arrow
                case 38:    //up arrow
                case 39:    //right arrow
                case 40:    //down arrow
                case 45:    //insert
                //case 46:  //delete
                    return;
            }
            if (timeOut != null)
                clearTimeout(timeOut);
            timeOut = setTimeout(is_available, 500);  // delay delay ajax request for 1000 milliseconds
            $('#user_msg').html(loading_html); // adding the loading text or image
        });
  });
function is_available(){
    //get the username
    var username = $('#username').val();
 
    //make the ajax request to check is username available or not
    $.post("check_username.php", { username: username },
    function(result)
    {
        console.log(result);
        if(result != 0)
        {
            $('#user_msg').html('Not Available');
            document.getElementById("btn_add").disabled = true;
        }
        else
        {
            $('#user_msg').html('<span style="color:#006600;">Available</span>');
            document.getElementById("btn_add").disabled = false;
        }
    });
 
}
</script>