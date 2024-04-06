<?php
    error_reporting(E_ALL);

    require_once("partials/header.php");
    require_once("classes/Level.php");

    $le = new Level();
    $levels = $le->fetch_level();
?>


        <div id="layoutSidenav">
           
        <?php
        
        require_once("partials/sidebar.php");
        ?>


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Levels</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Levels</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                              Levels/Categories
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Level</th>
    
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    
        <?php
        $sn = 1;
        foreach($levels as $level){ ?>
    <tr>
      <th scope="row"><?php echo $sn++ ?></th>
      <td><?php echo $level["level_name"]; ?></td>
       
      <td><a href="" class="btn btn-sm btn-primary">Edit</a> <a href="" class="btn btn-sm btn-danger">Delete</a> <a href="" class="btn btn-sm btn-success">Published</a></td>
      </tr>
      <?php } ?>
    
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </main>
                
<?php
require_once("partials/footer.php");
?>