<?php 
function Redirect_to($url){
    echo '<script>window.location.href = "'.$url.'";</script>';
}
function clearSession(){
    $_SESSION["ErrorMessage"] = null;
    $_SESSION["SuccessMessage"] = null;
}
?>