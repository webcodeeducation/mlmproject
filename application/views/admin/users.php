<div class="row">
<div class="col-md-12">

<table border="1" class="table table-bordered">  
      <tbody>
      <thead>  
         <tr>  
            <th>Country Id</th>  
            <th>Country Name</th>  
         </tr>  
     </thead>
         <?php  
         foreach ($users as $key=>$row)  
         {  
            ?><tr>  
            <td><?php echo $row['name'];?></td>  
            <td><?php echo $row['email'];?></td>  
            </tr>  
         <?php }  
         ?>  
      </tbody>  
   </table>

</div>

</div>