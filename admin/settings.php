<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <?php
          include 'config.php';
    
          $sql = "SELECT * FROM setting";
         
         $result = mysqli_query($conn, $sql) or die("Query failed");
          if(mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
  
        

        ?>
            
                  <form action="update-settings.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="websiteName">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $row['websitename']; ?>" class="form-control" autocomplete="off" required>
                      </div>
        
                      <div class="form-group">
                          <label for="logo" >Logo</label>
                          <input type ="file" name="logo">
                          <img  src="images/<?php echo $row['logo']; ?>" height="100px">
                          <input type="hidden" name="old-logo" value="<?php echo $row['logo']; ?>">
                      </div>

                      <div class="form-group">
                          <label for="footer_dec">Footer</label>
                          <textarea name="footer_dec" class="form-control" rows="5"  required><?php echo $row['footerdesc']; ?></textarea>
                      </div>
                
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <?php
               }
            }else {
                echo "No Record found";
            }
        ?>

                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
