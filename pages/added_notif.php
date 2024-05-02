<?php if(isset($_SESSION['added'])){
    echo '<script>$(document).ready(function (){save_success();});</script>';
    unset($_SESSION['added']);
    } ?>
<div class="alert alert-success alert-autocloseable-add" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Successfully Added !
</div>