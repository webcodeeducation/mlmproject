<?php

//print_r($anil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Students Data</h2>
          <!-- Status message -->
                 <?php  
                    /*if(!empty($delete_student_status)){ 
                        echo '<br><p class="status-msg success">'.$delete_student_status.'</p>'; 
                    }elseif(!empty($this->session->flashdata('delete_student_error'))){ 
                        echo '<br><p class="status-msg red">'.$this->session->flashdata('delete_student_error').'</p>'; 
                    }*/ 
                ?>
                <?php
        if ($this->session->flashdata('delete_student_status')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('delete_student_status') ?></div> 
            <?php
        }

        if ($this->session->flashdata('delete_student_error')) {
            ?> 
            <div class="alert alert-danger"><?= $this->session->flashdata('delete_student_error') ?></div> 
            <?php
        }
        ?>

        <form>
        <div class="row">
            
            <div class="col-sm-3 col-md-3">
              
              <input type="text" class="form-control query" name="search" placeholder="Type Hotel Name">

            </div>

            
            
            <div class="col-sm-2 col-md-4">
              <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i> Search</button>
            </div>
          
           
        </div>
        </form>

        <div id="response_here"></div>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>City</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($anil as $key=>$value) { ?>
      <tr>
        <td><?=$value->name?></td>
        <td><?=$value->city?></td>
        <td><?=$value->phone?></td>
        <td><a class="btn btn-danger" href="delete?id=<?=$value->id?>">Delete</a>
        <button class="btn btn-warning btnDeleteStudent" id="<?=$value->id?>">Delete by AJAX</button>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>



  <a class="btn btn-primary" href="<?=base_url(); ?>">Add New</a>
  <a class="btn btn-primary" href="<?=base_url(); ?>login">Login</a>
</div>


<script type="text/javascript">
  $(document).ready(function(){

$('.btnDeleteStudent').click(function(){
  var id = $(this).attr('id');
console.log(id);
  $.ajax({
    url: 'delete_student',
    method: 'post',
    data: {'sid':id},
    success: function(response){
    console.log(response);
    location.reload();
    $('#response_here').html(response);
    },
    error: function(error){
      console.log('in error function');
      console.log(error);
    }
  });

});

});
</script>

</body>
</html>
