
<?php
$conn= new mysqli('localhost','root','','cms_db')or die("Could not connect to mysql".mysqli_error($conn));

if($conn === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}    if (isset($_POST['additeam'])) {

 $id=$_POST['id'];
		$sender_name = $_POST['sender_name'];
		$sender_address = $_POST['sender_address'];
    $sender_contact = $_POST['sender_contact'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_contact = $_POST['recipient_contact'];
    $type = $_POST['type'];    
		$from_branch_id = $_POST['from_branch_id'];
		$to_branch_id = $_POST['to_branch_id'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $length =$_POST['length'];
    $width = $_POST['width'];
    $price = $_POST['price'];
    $state = $_POST['state'];
    $date_created = $_POST['date_created'];



$query="INSERT INTO parcels (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`, `status`, `date_created`)
VALUES(50,2,$sender_name,$sender_address,$sender_contact,$recipient_name,$recipient_address,$recipient_contact,1,423423,4234, '1', '21', '12', '21', '23', '2022-12-29 13:26:29')"; 
if(mysqli_query($conn, $query)){
    echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";

} else{
    echo "ERROR: Hush! Sorry $query. "
        . mysqli_error($conn);
}
}
// Close connection
mysqli_close($conn);
?>
