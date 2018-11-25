<meta charset="UTF-8">
<?php
session_start();
ini_set('display_errors',0);
if($_SESSION['user'])
{
	unset($_SESSION['user']);
	unset($_SESSION['googleCode']);
    header("Location: ".$url."Dang-nhap.html");

}
else {

	?>
    <script>
	location.href='<?php echo $url?>index.php';
	</script>
    <?php
}

?>
