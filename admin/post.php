<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
            
              <div class="col-md-12 col-sm-12">
              <?php
                   include 'config.php';

                   $limit = 3;
                   if(isset($_GET['page'])) {
                      $page = $_GET['page'];
                   }else {
                    $page = 1;
                
                   }

                   $offset = ($page - 1) * $limit;

                   if($_SESSION["user_role"] == '1') {
                    $sql = "SELECT post.post_id, post.title, post.category, post.post_date, post.author, 
                    user.user_id, user.username, post.category, user.role, category.category_id, 
                    category.category_name, category.post
                    FROM post LEFT JOIN user ON post.author = user.user_id 
                    LEFT JOIN category ON post.category = category.category_id
                     ORDER BY post_id DESC LIMIT {$offset}, {$limit}";

                   }elseif($_SESSION["user_role"] == '0') {
                    $sql = "SELECT post.post_id, post.title, post.category, post.post_date, post.author, 
                    user.user_id, user.username, post.category, user.role, category.category_id, 
                    category.category_name, category.post
                    FROM post LEFT JOIN user ON post.author = user.user_id 
                    LEFT JOIN category ON post.category = category.category_id 
                    WHERE post.author = {$_SESSION["user_id"]}
                     ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
                   }


                    $result = mysqli_query($conn, $sql) or die("Query failed");

                    if(mysqli_num_rows($result) > 0) {
                        
                
                    ?>
                 
     
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                       $serial = $offset + 1;

                                while($row = mysqli_fetch_assoc($result)) {


                                ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-post.php?eid=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                            $serial++;

                                }
                          ?>
                      </tbody>
                  </table>
                  <?php

                            }
                         $sql1 = "SELECT * FROM post";

                         $result1 = mysqli_query($conn, $sql1) or die("Query failed");
  
                         if(mysqli_num_rows($result1) > 0) {
                           $total_records = mysqli_num_rows($result1);
                         
                           $total_page = ceil($total_records / $limit);
                            
                           echo "<ul class='pagination admin-pagination'>";
                           if($page > 1) {
                              echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';
                           }  
                         
                           for($i = 1; $i <= $total_page; $i++) {
                              if($i == $page) {
                                  $active = "active";
                              }else {
                                 $active = "";
                              }
                              echo '<li class="'.$active.'" ><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                           }
                           if($total_page > $page)
                           echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                            echo " </ul>";
  
                         }
  
                       ?>

                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
