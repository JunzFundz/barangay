<div id="startModal<?php echo $row['id'];?>" class="modal fade">
<form method="post">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Startterm Confirmation</h4>
        </div>
        <div class="modal-body">

             <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_id" id="hidden_id"/>
            <p>Are you sure you want to start the term of <?php echo $row['completeName']; ?> ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_start" id="btn_start" value="Yes"/>
        </div>
    </div>
  </div>
  </form>
</div>