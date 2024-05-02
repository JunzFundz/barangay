<?php echo '<div id="viewModal'.$row['id'].'" class="modal fade">
<form method="post"  enctype="multipart/form-data">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">View Photo for Activity '.$row['activity'].'</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="hidden_id" value="'.$row['id'].'">
            <input type="checkbox" id="cbxMainphoto" /><label> Select All</label>
        <div class="row">';
            $p = mysqli_query($con,"SELECT * from tblactivityphoto where activityid = '".$row['id']."' ");
            while($row1 = mysqli_fetch_array($p)){
                echo '<div class="col-md-4">
                    <input type="checkbox" name="chk_deletephoto[]" class="chk_deletephoto" value="'.$row1['id'].'" />
                    <image src="photo/'.basename($row1['filename']).'" style="width:170px;height:170px;"/>
                </div>';
            }
        
        echo '
        </div>
        </div>
        <div class="modal-footer">
            <div class="col-md-6"><input name="photos[]" class="form-control input-sm" type="file" multiple/></div>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_addimage" value="Add"/>
            <input type="submit" class="btn btn-danger btn-sm" name="btn_remove" value="Remove Selected"/>
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Close"/>
        </div>
    </div>
  </div>
</form>
</div>';?>