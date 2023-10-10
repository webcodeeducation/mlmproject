<div class="row">
<div class="col-md-12">

<form action="/action_page.php">
   <div class="form-group">
    <label for="email">Select Sponsor ID:</label>
    <select class="form-control" placeholder="Enter email" id="sponsor_id">
      <option>Select Sponsor</option>
      <?php  
         foreach ($users as $key=>$row)  
         {  
            ?><option><?php echo $row['name'];?><option>Select Sponsor</option>
         <?php }  
         ?>
   </select>
   </div>
  <div class="form-group">
    <label for="email">Sponsor ID:</label>
    <input type="email" class="form-control" placeholder="Enter email" id="email">
  </div>
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" class="form-control" placeholder="Enter name" id="name">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" placeholder="Enter email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" placeholder="Enter password" id="pwd">
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox"> Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</div>