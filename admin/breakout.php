<?php
    error_reporting(E_ALL);

    require_once("admin_guard.php");
    require_once("partials/header.php");
    require_once("classes/Topic.php");

    $tp = new Topic();
    $topics = $tp->fetch_all_topics();

?>
        <div id="layoutSidenav">

        <?php
        
        require_once("partials/sidebar.php");

        ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Break-out Topics</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Breakout Topics</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            Presentation, discussion, or activity that takes place as part of a larger event for which some of the event's participants temporarily separate themselves from the others. 
                               &nbsp;&nbsp; <a href="addtopic.html" class="btn btn-outline-primary">Add Topic</a>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Topics Created
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Level</th>
      <th scope="col">Cover</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php  
    $sn = 1;
    foreach($topics as $topic){
  ?>
    <tr>
      <th scope="row"><?php echo $sn++; ?></th>
      <td><?php echo $topic["topic_name"]; ?></td>
      <td><?php echo $topic["level_name"]; ?></td>
      <td><img src="../uploads/<?php echo $topic["topic_image"]; ?>" height="40"></td>
      <td><a href="" class="btn btn-sm btn-primary">Edit</a> <a href="" class="btn btn-sm btn-danger">Delete</a> <a href="" class="btn btn-sm btn-success">Published</a></td>
    </tr>
     
  <?php  } ?>  
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </main>

<?php

    require_once("partials/footer.php");
?>