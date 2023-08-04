<?php include "header.php"; 
 if($_SESSION['user_role'] == '0'){

  header("Location: {$header}/admin/post.php");

}

if(isset($_POST['sumbit'])) {
  include 'config.php';
  $cat_id = $_POST['cat_id'];
  $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
  $sql = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = '{$cat_id }'";
   if(mysqli_query($conn, $sql)) {
    header("Location: {$header}/admin/category.php");
   }
}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>

              <?php
                 include 'config.php';
                 
                 $category_id = $_GET['eid'];
                 $sql = "SELECT * FROM category WHERE category_id = '{$category_id}'";
                 $result = mysqli_query($conn, $sql) or die("Query failed");

                 if(mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {

            
               ?>
              <div class="col-md-offset-3 col-md-6">
                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                         }
                    
                        }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
