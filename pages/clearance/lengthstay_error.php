<?php if(isset($_SESSION['lengthofstay'])){
    echo '<script>$(document).ready(function (){lengthstay();});</script>';
    unset($_SESSION['lengthofstay']);
    } ?>
<div class="alert alert-length alert-autocloseable-length" style="background: #d9534f; position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     <p style="font-size: 14px;">Cannot Request Clearance. You are below 6 months in your current address !</p>
</div>