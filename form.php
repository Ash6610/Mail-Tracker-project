
			<form action="#" id="manage-parcel" method="post">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
   
              <b>Sender Information</b>
                <label for="" class="control-label">Name</label>
                <input type="text" name="sender_name" id="" class="form-control form-control-sm" value="<?php echo isset($sender_name) ? $sender_name : '' ?>" >
                 <label for="" class="control-label">Address</label>
                <input type="text" name="sender_address" id="" class="form-control form-control-sm" value="<?php echo isset($sender_address) ? $sender_address : '' ?>" >
            <label for="" class="control-label">Contact #</label>
                <input type="text" name="sender_contact" id="" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" >
                <b>Recipient Information</b>
                <label for="" class="control-label">Name</label>
                <input type="text" name="recipient_name" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" >
                <label for="" class="control-label">Address</label>
                <input type="text" name="recipient_address" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" >
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="recipient_contact" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" >
            <hr>
           <label for="dtype">Type</label>
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?> data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk" data-size="xs" data-offstyle="info" data-width="5rem" value="1">
              <small>Deliver = Deliver to Recipient Address</small>
              <small>, Pickup = Pickup to nearest Branch</small>
                      <label for="" class="control-label">Branch Processed</label>
              <select name="from_branch_id" id="from_branch_id" class="form-control select2">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($from_branch_id) && $from_branch_id == $row['id'] ? "selected":'' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>
              <input type="hidden" name="from_branch_id" value="<?php echo $_SESSION['login_branch_id'] ?>">
              <label for="" class="control-label">Pickup Branch</label>
              <select name="to_branch_id" id="to_branch_id" class="form-control select2">
                <option value=""></option>
                <?php 
                  $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches");
                    while($row = $branches->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['id'] ?>" <?php echo isset($to_branch_id) && $to_branch_id == $row['id'] ? "selected":'' ?>><?php echo $row['branch_code']. ' | '.(ucwords($row['address'])) ?></option>
                <?php endwhile; ?>
              </select>
           <hr>
        <b>Parcel Information</b>
        <table class="table table-bordered" id="parcel-items">
          <thead>
            <tr>
              <th>Weight</th>
              <th>Height</th>
              <th>Length</th>
              <th>Width</th>
              <th>Price</th>
              <?php  ?>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name='weight' value="<?php echo isset($weight) ? $weight :'' ?>" ></td>
              <td><input type="text" name='height' value="<?php echo isset($height) ? $height :'' ?>" ></td>
              <td><input type="text" name='length' value="<?php echo isset($length) ? $length :'' ?>" ></td>
              <td><input type="text" name='width' value="<?php echo isset($width) ? $width :'' ?>" ></td>
              <td><input type="text" class="text-right number" name='price' value="<?php echo isset($price) ? $price :'' ?>" ></td>
              <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
            </tr>
          </tbody>
          <tfoot>
            <th colspan="4" class="text-right">Total</th>
            <th class="text-right" id="tAmount">0.00</th>
            <th></th>
          </tfoot>
        </table>
            <button  class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="new_parcel"><i class="fa fa-item"></i> Add Item</button>
           </form>
   			<button  type="submit" form="manage-parcel"name="additeam">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list">Cancel</a>

  <table>
    <tr>
        <td><input type="text" name='weight' ></td>
        <td><input type="text" name='height' ></td>
        <td><input type="text" name='length' ></td>
        <td><input type="text" name='width' ></td>
        <td><input type="text" class="text-right number" name='price' ></td>
        <td><button class="btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i>close</button></td>
      </tr>
  </table>
                    </form>
<?php
if (isset($_POST['additeam'])) {
		
		$sender_name = $_POST['sender_name'];
		$sender_address = $_POST['sender_address'];
    $sender_contact = $_POST['sender_contact'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_contact = $_POST['recipient_contact'];
    //$type = $_POST['type'];    
		$from_branch_id = $_POST['from_branch_id'];
		$to_branch_id = $_POST['to_branch_id'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $price = $_POST['price'];
    //$state = $_POST['state'];
    //$date_created = $_POST['date_created'];
/*
		// checking required fields
		$req_fields = array('first_name', 'last_name', 'email', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}

		// checking if email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($conn, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}

		if (empty($errors)) {
	*/		// no errors found... adding new record
			$sender_name = mysqli_real_escape_string($conn, $_POST['sender_name']);
			$sender_address = mysqli_real_escape_string($conn, $_POST['sender_address']);
			$sender_contact = mysqli_real_escape_string($conn, $_POST['sender_contact']);
			$recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
      $recipient_address = mysqli_real_escape_string($conn, $_POST['recipient_address']);
      $recipient_contact = mysqli_real_escape_string($conn, $_POST['recipient_contact']);
      //$type = mysqli_real_escape_string($conn, $_POST['type']);
      $from_branch_id = mysqli_real_escape_string($conn, $_POST['from_branch_id']);
      $to_branch_id = mysqli_real_escape_string($conn, $_POST['to_branch_id']);
      $weight = mysqli_real_escape_string($conn, $_POST['weight']);
      $height = mysqli_real_escape_string($conn, $_POST['height']);
      $width = mysqli_real_escape_string($conn, $_POST['width']);
      $price = mysqli_real_escape_string($conn, $_POST['price']);
      //$state = mysqli_real_escape_string($conn, $_POST['state']);
      //$date_created = mysqli_real_escape_string($conn, $_POST['date_created']);
    
      // email address is already sanitized
			//$hashed_password = sha1($password);

			$query = "INSERT INTO parcels (id,sender_name, sender_address, sender_contact, recipient_name, recipient_address, recipient_contact,type,from_branch_id,to_branch_id,weight,width,price,state,date_created)
			 VALUES (10,'{$sender_name}', '{$sender_address}', '{$sender_contact}', '{$recipient_name}','{$recipient_address}','{$recipient_contact}','{$from_branch_id}','{$to_branch_id}','{$weight}','{$width}','{$price}')";

			$result = mysqli_query($conn, $query);

			if ($result) {
				// query successful... redirecting to users page
				header("Location:parcel_list.php?parcel_added=true");
			} else {
				$errors[] = 'Failed to add the new record.';
			}
/*INSERT INTO parcels (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`, `status`, `date_created`)VALUES('16','123','fddsfs','dfsd','4545','fdsf','fsdfsd','4234234', '1', '21', '12', '21', '23', '23', '23', '233', '2', '2022-12-29 13:26:29'); */

		//}
  }
?>

<script>/*
  $('#dtype').change(function(){
      if($(this).prop('checked') == true){
        $('#tbi-field').hide()
      }else{
        $('#tbi-field').show()
      }
  })
    $('[name="price[]"]').keyup(function(){
      calc()
    })
  $('#new_parcel').click(function(){
    var tr = $('#ptr_clone tr').clone()
    $('#parcel-items tbody').append(tr)
    $('[name="price[]"]').keyup(function(){
      calc()
    })
    $('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })

  })
	$('#manage-parcel').submit(function(e){
		e.preventDefault()
		start_load()
    if($('#parcel-items tbody tr').length <= 0){
      alert_toast("Please add atleast 1 parcel information.","error")
      end_load()
      return false;
    }
		$.ajax({
			url:'ajax.php?action=save_parcel',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
			 if(resp){
             resp = JSON.parse(resp)
             if(resp.status == 1){
               alert_toast('Data successfully saved',"success");
               end_load()
               var nw = window.open('print_pdets.php?ids='+resp.ids,"_blank","height=700,width=900")
             }
			 }
        if(resp == 1){
            alert_toast('Data successfully saved',"success");
            setTimeout(function(){
              location.href = 'index.php?page=parcel_list';
            },2000)

        }
			}
		})
	})
  function displayImgCover(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#cover').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  function calc(){

        var total = 0 ;
         $('#parcel-items [name="price[]"]').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })
         if($('#tAmount').length > 0)
         $('#tAmount').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
  }*/ 
</script>

<?php 

$conn= new mysqli('localhost','root','','cms_db')or die("Could not connect to mysql".mysqli_error($con));


?>