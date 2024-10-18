<style type="text/css">
.alert {
    height: 35px;
    line-height: 35px;
    padding: 0px 15px;
}
</style>
<?php 
if(isset($_GET['msg'])){
	echo '<div class="alert alert-success alert-dismissible best_font">'.$_GET['msg'].'</div>';
}
elseif(isset($_SESSION['msg'])){
	echo '<div class="alert alert-success alert-dismissible best_font">'.$_SESSION['msg'].'</div>';
	unset($_SESSION['msg']);
}
elseif(isset($_GET['error'])){
	echo '<div class="alert alert-danger alert-dismissible best_font">'.$_GET['error'].'</div>';
}
elseif(isset($_SESSION['error'])){
	echo '<div class="alert alert-danger alert-dismissible best_font">'.$_SESSION['error'].'</div>';
	unset($_SESSION['error']);
}
?>