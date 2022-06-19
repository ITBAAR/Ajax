<?php 
error_reporting(0);
 ?>
<?php 
$con = mysqli_connect("localhost","root","","ajax");


if (isset($_POST['contact'])) {

  if (! ($_FILES['pic']['name']=="") )
   {
    $file_name = $_FILES["pic"]["name"];
    $temp_name = $_FILES["pic"]["tmp_name"];
    $file_array = explode(".", $file_name);
    $file_extention = end($file_array);
  }

  $name = $_POST['name'];
  $age = $_POST['age'];
  $city = $_POST['city'];
  $contact = $_POST['contact'];


  if ($_POST["hide_id"]!= '') {
// we will work on update query here 
    $id =  $_POST['hide_id'];
    if ((! ($_FILES['pic']['name'])) )
    {
    
    $query = "UPDATE reserve_tickets SET name = '$name' , age = '$age' , city = '$city' AND contact = '$contact'  WHERE id = '$id' ";
    $msg = "<div class = 'alert alert-success'>Data Updated</div>";

  }else{  
    $location = 'uploads/' .$file_name;
      move_uploaded_file($temp_name, $location);

    $query = "UPDATE reserve_tickets SET name = '$name' , age = '$age' , city = '$city' ,contact = '$contact' , pic = '$file_name'  WHERE id = '$id' ";
  }
    $msg = "<div class = 'alert alert-success'>Data Updated</div>";

}else{
  $location = 'uploads/' .$file_name;
      move_uploaded_file($temp_name, $location);

  $query ="INSERT INTO reserve_tickets(name, age, city, pic, contact)VALUES('$name', '$age', '$city', '$file_name', '$contact') ";

  $msg = "<div class = 'alert alert-success'>Data Inserted</div>";
}
  $ready = mysqli_query($con,$query);
echo $msg;

}

 ?>

<table class="table">
  <tr>
    <th>IMAGE</th>
    <th>Name</th>
    <th>Age</th>
    <th>City</th>
    
    <th>Contact No</th>
    <th colspan="2" class="text-center">Action</th>
  </tr>
  <?php 
  $query = mysqli_query($con,"SELECT * FROM reserve_tickets");
  while ($row = mysqli_fetch_array($query)) {
    
   ?>
  <tr>
    <td><img src="req/uploads/<?php echo $row['pic'];?>" height = "120" width="100"></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['age'];?></td>
    <td><?php echo $row['city'];?></td>
   
    <td><?php echo $row['contact'];?></td>
    <td><input type="submit" name="delete" value="Delete" class="btn btn-danger delete" id="<?php echo $row['id'];?>"></td>
    <td><input type="submit" name="update" value="Update" class="btn btn-success update" id="<?php echo $row['id'];?>"></td>
  </tr>
 <?php } ?>
 </table> 
 <div id="show"></div>
 <script type="text/javascript">
  $('.delete').click(function(){

    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
     var el = this;
    var delid = this.id;
    $.ajax({
      type : "POST",
      url : "req/del.php",
      data : {id:delid},
      success : function(response){
        $("show").html(response);
        $(el).closest('tr').css('background','red');
        $(el).closest('tr').fadeOut(200,function(){
          $(el).remove();
        });
      }
    })
  } else {
    swal("Your imaginary file is safe!");
  }
});
    

  });

    

$(".update").click(function(){

   var el = this;
   var updid = this.id;
   $.ajax({
        type : "POST",
        url : "req/update.php",
        dataType : "json",
        data : {id:updid},
        success : function(response){
          $('#myModal').modal('show');
          $('#name').val(response.name);
          $('#age').val(response.age);
          $('#city').val(response.city);
          $('#contact').val(response.contact);

          $("#hide_id").val(response.id);
        }

   });

});
    
  
 </script>
