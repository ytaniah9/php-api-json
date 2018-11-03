<?php
include'koneksi.php';
$id = ''; 
if( isset( $_GET['id'])) {
    $id = $_GET['id']; 
} 
$msg = '';
$code = '';
$idku = mysqli_query($conn,"select * from rpl4 where id='$id'");
$idku2 = mysqli_query($conn,"select * from rpl4");
if (!empty($id))
{
	$query = mysqli_query($conn,"select * from rpl4 where id='$id'");
	if (mysqli_num_rows($idku) > 0) {
		$code = 200;
		$msg = "Show user data success";
		}else{
			$code = 204;
			$msg = "User data not found";	
		}
}else
{
	$query = mysqli_query($conn,"select * from rpl4");
	if (mysqli_num_rows($idku2) > 0) {
		$code = 200;
		$msg = "Show user data success";
		}else{
			$code = 204;
			$msg = "User data not found";	
		}
};
	#membuat array
	$result = array();
	$result["success"] = true;
	$result["data"] = array();
	$result["message"] = $msg;
	$result["code"] = $code;
			while ($row = mysqli_fetch_assoc($query)) {
				# kerangka format penampilan data json
				$data['id'] = $row["id"];
				$data['username'] = $row["username"];
				$data['password'] = $row["password"];
				$data['level'] = $row["level"];
				$data['fullname'] = $row["fullname"];
				array_push($result["data"], $data);
			}
	echo json_encode($result);
?>