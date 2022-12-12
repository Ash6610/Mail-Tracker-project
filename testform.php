<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./form.css">
</head>
<body>
    <h1>New Parcel</h1>
    <hr>
    <span>
        <div class="form1">
            <div class="sender"><!--
                <form action="testformprocess.php" method="post" name="additeam">
                    <b>Sender Information</b><br><br><br>

                    <label for="fname">Name</label>
                    <input type="text" id="sender_name" name="sender_name" placeholder="Your name"  >

                    <label for="Address">Address</label>
                    <input type="text" id="Address" name="sender_address" placeholder="Your Address"" value="<?php echo isset($sender_address) ? $sender_address : '' ?>">

                    <label for="contact">Contact Number</label>
                    <input type="text" id="contact" name="contact" placeholder="Your Contact Number" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>">
        
  
            </div>
             <div class="reciver">
              
                    <b>Reciver Information</b><br><br><br>


                    <label for="fname">Name</label>
                    <input type="text" id="name" name="recipient_name" placeholder="Reciver name" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>">

                    <label for="Address"">Address</label>
                    <input type="text" id="Address" name="recipient_address" placeholder="Reciver Address"" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>">

                    <label for="contact">Contact Number</label>
                    <input type="text" id="contact" name="recipient_contact" placeholder="Reciver Contact Number" value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" >
            
            
              
            </div>
        </div> 
    </span> 
    
    
    <h4>Parcel Information</h4>
    <hr>
    <table width="100%">
        <tr>
          <th>width</th>
          <th>Hight</th>
          <th>Length</th>
          <th>width</th>
          <th>Price</th>
        </tr>
        <tr>
          <td><input type="text" name="weight" required></td>
          <td><input type="text" name="Hight" required></td>
          <td><input type="text" name="Length"required></td>
          <th><input type="text" name="width" required></th>
          <th><input type="text" name="Price" required></th>
        </tr>
        <tr>
            <td colspan="4">Total</td>
            <td>0.00</td>
        </tr>
       
      </table>

    
      <button type="submit" value="additeam" name='additeam'>Save</button>
      <button type="cancel" value="Cancel">Cancel</button>
      </form>-->
     
    </body>
</html>


<?php $conn= new mysqli('localhost','root','','cms_db')or die("Could not connect to mysql".mysqli_error($conn));
 ?>
<style>
  textarea{
    resize: none;
  }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-danger">
		<div class="card-body">
			<form action="testformprocess.php" method="post" name="additeam">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class=""></div>
        <div class="row">
          <div class="col-md-6">
              <b>Sender Information</b>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="sender_name" id="" class="form-control form-control-sm" value="<?php echo isset($sender_name) ? $sender_name : '' ?>" >
              </div>
              <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="sender_address" id="" class="form-control form-control-sm" value="<?php echo isset($sender_address) ? $sender_address : '' ?>" >
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="sender_contact" id="" class="form-control form-control-sm" value="<?php echo isset($sender_contact) ? $sender_contact : '' ?>" >
              </div>
          </div>
          <div class="col-md-6">
              <b>Recipient Information</b>
              <div class="form-group">
                <label for="" class="control-label">Name</label>
                <input type="text" name="recipient_name" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_name) ? $recipient_name : '' ?>" >
              </div>
              <div class="form-group">
                <label for="" class="control-label">Address</label>
                <input type="text" name="recipient_address" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_address) ? $recipient_address : '' ?>" >
              </div>
              <div class="form-group">
                <label for="" class="control-label">Contact #</label>
                <input type="text" name="recipient_contact" id="" class="form-control form-control-sm" value="<?php echo isset($recipient_contact) ? $recipient_contact : '' ?>" >
              </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="dtype">Type</label>
              <input type="checkbox" name="type" id="dtype" <?php echo isset($type) && $type == 1 ? 'checked' : '' ?> data-bootstrap-switch data-toggle="toggle" data-on="Deliver" data-off="Pickup" class="switch-toggle status_chk" data-size="xs" data-offstyle="info" data-width="5rem" value="1">
              <small>Deliver = Deliver to Recipient Address</small>
              <small>, Pickup = Pickup to nearest Branch</small>
            </div>
          </div>
          <div class="col-md-6" id=""  <?php echo isset($type) && $type == 1 ? 'style="display: none"' : '' ?>>
            <?php  ?>
              <div class="form-group" id="fbi-field">
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
            </div>
            <?php  ?>
              <input type="hidden" name="from_branch_id" value="34">
            <?php ?>  
            <div class="form-group" id="tbi-field">
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
            </div>
          </div>
        </div>
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
              <?php if(!isset($id)): ?>
              <th></th>
            <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name='weight[]' value="<?php echo isset($weight) ? $weight :'' ?>" ></td>
              <td><input type="text" name='height[]' value="<?php echo isset($height) ? $height :'' ?>" ></td>
              <td><input type="text" name='length[]' value="<?php echo isset($length) ? $length :'' ?>" ></td>
              <td><input type="text" name='width[]' value="<?php echo isset($width) ? $width :'' ?>" ></td>
              <td><input type="text" class="text-right number" name='price[]' value="<?php echo isset($price) ? $price :'' ?>" ></td>
              <?php if(!isset($id)): ?>
              <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
              <?php endif; ?>
            </tr>
          </tbody>
              <?php if(!isset($id)): ?>
          <tfoot>
            <th colspan="4" class="text-right">Total</th>
            <th class="text-right" id="tAmount">0.00</th>
            <th></th>
          </tfoot>
              <?php endif; ?>
        </table>
              <?php if(!isset($id)): ?>
        <div class="row">
          <div class="col-md-12 d-flex justify-content-end">
            <button  class="btn btn-sm btn-danger bg-gradient-danger" type="button" id="new_parcel"><i class="fa fa-item"></i> Add Item</button>
          </div>
        </div>
              <?php endif; ?>
      </form>
  	</div>
  	<div class="card-footer border-top border-info">
  		<div class="d-flex w-100 justify-content-center align-items-center">
  			<button class="btn btn-flat  bg-gradient-danger mx-2" type="submit" name="additeam" href="testform.php">Save</button>
  			<a class="btn btn-flat bg-gradient-secondary mx-2" href="./index.php?page=parcel_list">Cancel</a>
  		</div>
  	</div>
	</div>
</div>
<div id="ptr_clone" class="d-none">
  <table>
    <tr>
        <td><input type="text" name='weight[]' ></td>
        <td><input type="text" name='height[]' ></td>
        <td><input type="text" name='length[]' ></td>
        <td><input type="text" name='width[]' ></td>
        <td><input type="text" class="text-right number" name='price[]' ></td>
        <td><button class="btn btn-sm btn-danger" type="button" onclick="$(this).closest('tr').remove() && calc()"><i class="fa fa-times"></i></button></td>
      </tr>
  </table>
</div>
<script>
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
  }
</script>






<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
  
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
  
input[type=submit]:hover {
    background-color: #45a049;
}
  
.sender {
    border-radius: 5px;
    background-color: #bebccf;
    padding-left: 50px;
    padding-right: 110px;
    padding-bottom: 50px;
    float: left;
    width: 500px;
    padding-top: 30px;
    font-weight: bold;
   
}
.reciver {
    border-radius: 5px;
    background-color: #bebccf;
    padding-right: 100px;
    width: 500px;
    padding-bottom: 50px;
    padding-left: 70px;
    float: right;
    padding-top: 30px;
    font-weight: bold;
   
}
table, th, td {
    border:1px solid rgb(187, 174, 197);
  }










    </style>

























