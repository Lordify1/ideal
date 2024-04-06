<?php
    error_reporting(E_ALL);
    session_start();

    require_once("admin_guard.php");
    require_once("partials/header.php");
    require_once("classes/Project.php");
    require_once("classes/Marketer.php");
    require_once("classes/Business.php");
    require_once("classes/payment.php");
    require_once("classes/Newsletter.php");

    
?>
    <style>
        .head
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .col, .row{
            text-align: center;
            padding: 10px;
        }


        .sections{
            background-color: rgba(0,0,0,0.5);
        }

        .col:hover{
            background-color: rgba(255,255,255,0.2);
        }
    </style>

        <div id="layoutSidenav">
            
            <!--sidebar goes here-->
            <?php require_once("partials/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row">
                           <div class="col head">
                           <h1 class="mt-4">Dashboard</h1>
                           <h3>Welcome To Authority <i>SUPERADMIN</i></h3>
                           </div>
                        </div>
                        <div class="row row-cols-3">
                            <div class="col sections">
                                <h3>Marketers</h3>
                                <span class="display-2">
                                <?php  
                                
                                $data = $market->all_marketers();

                                $count = count($data);

                                echo $count;
                                
                                
                                ?>
                                </span>
                            </div>
                            <div class="col sections">
                                <h3>Businesses</h3>
                                <span class="display-2">
                                <?php  
                                
                                $data = $business->all_businesses();

                                $count = count($data);

                                echo $count;
                                
                                
                                ?>
                                </span>
                            </div>
                            <div class="col sections">
                                <h3>Projects</h3>
                                <span class="display-2">
                                <?php  
                                
                                $data = $project->all_projects();

                                $count = count($data);

                                echo $count;
                                
                                
                                ?>
                                </span>
                            </div>
                            <div class="col sections">
                                <h3>Newsletter Subscribers</h3>
                                <span class="display-2">
                                <?php  
                                
                                $data = $newsletter->newsletter();

                                $count = count($data);

                                echo $count;
                                
                                
                                ?>
                                </span>
                            </div>
                            <!-- <div class="col sections">
                                <h3>Project Payments</h3>
                                <span class="display-2">
                                <?php  
                                
                                $total = $payment->total_project_payments();

                                echo '&#8358;' . number_format($total['total']) . '.00'
                                
                                
                                ?>
                                </span>
                            </div> -->
                        </div>
                    </div>
                </main>
<?php
    error_reporting(E_ALL);

    require_once("partials/footer.php");

?>

