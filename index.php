<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>MY PRACTICE AJAX </title>
  </head>
  <body>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#myModal">
  Open Modal
</button>
<div id="show"></div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserve tickets</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
         <div class="row">
           <div class="col-md-6">
             <form id="reserve_form" method="POST">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="enter your name">
              <label>Age</label>
               <input type="text" name="age" id="age" class="form-control" placeholder="enter your date of birth">
               <label>City</label>
               <input type="text" name="city" id="city" class="form-control" placeholder="enter your destination city">
              
                <label>Select Picture</label>
                <input type="file" name="pic" id="pic" class="btn btn-primary">
               <label>Contact No</label>
               <input type="text" name="contact" id="contact" class="form-control" placeholder="enter your contact no">
               <input type="hidden" name="hide_id" id="hide_id">
                
           </div>
         </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Book" class="btn btn-primary">
      </form>
      </div>
         </div>
  
      </div>
    </div>
  </div>
</div>
    




    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#open').click(function(){
      $('#hide_id').val('');
    });
 
  function fetch(){
      $.ajax({
        url : "req/insert.php",
        success : function(response){
          $("#show").html(response);
        }

      });
    }
  fetch();

    $("#reserve_form").submit(function(e){
       e.preventDefault();

       $.ajax({
        type : "POST",
        url : "req/insert.php",
        data : new FormData(this),
        contentType : false,
                      cache: false,
                      processData:false,
        
        success : function(response){
         $("#reserve_form")[0].reset();
         $("#show").html(response);
          $("#myModal").modal("hide");
         setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 1000);
                                  
        }

       });

    });
    
  });
</script>