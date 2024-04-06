<?php
    error_reporting(E_ALL);

require_once("classes/Project.php");
require_once("classes/payment.php");
require_once("classes/Business.php");
require_once("classes/Marketer.php");
require_once "classes/Message.php";

$pending_marketers = $market->pending_marketers();

$pending_businesses = $business->pending_businesses();

$pending_projects = $project->pending_project();


$pending_messages = $message->pending_messages();





?>

<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu fw-bolder">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">ADMIN MENU</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>                            
                            
                            <a class="nav-link" href="marketers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Marketers
                                &nbsp;
                            <?php $data = $market->pending_marketers();

                                $marketers = count($data);

                                if(!$marketers == null){
                                ?>
                                <span class="badge bg-warning mb-1">
                                <?php echo $marketers ?>
                                </span>

                            <?php } ?>
                            </a>

                            <a class="nav-link" href="businesses.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Businesses
                                &nbsp;
                                <?php $data = $business->pending_businesses();

                                    $businesses = count($data);

                                    if(!$businesses == null){
                                    ?>
                                    <span class="badge bg-warning mb-1">
                                    <?php echo $businesses ?>
                                    </span>

                                <?php } ?>
                            </a>

                            <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                             Category
                            </a>


                            <a class="nav-link" href="addblogpost.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Blog
                            </a>

                            <a class="nav-link" href="industry.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Industry
                            </a>

                            <a class="nav-link" href="first_payment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                30% Payment
                                &nbsp;
                                    <?php $data = $payment->pending_payments();

                                        $payments = count($data);

                                        if(!$payments == null){
                                        ?>
                                        <span class="badge bg-warning mb-1">
                                        <?php echo $payments ?>
                                        </span>

                                    <?php } ?>
                            </a>

                            <a class="nav-link" href="second_payment.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                70% Payment
                                &nbsp;
                                    <?php $data = $payment->pending_payments_complete();

                                        $payments = count($data);

                                        if(!$payments == null){
                                        ?>
                                        <span class="badge bg-warning mb-1">
                                        <?php echo $payments ?>
                                        </span>

                                    <?php } ?>
                            </a>

                            <a class="nav-link" href="projects.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                 Projects
                                 &nbsp;
                                    <?php $data = $project->pending_project();

                                        $projects = count($data);

                                        if(!$projects == null){
                                        ?>
                                        <span class="badge bg-warning mb-1">
                                        <?php echo $projects ?>
                                        </span>

                                    <?php } ?>
                            </a>

                            <a class="nav-link" href="customer_care.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Messages
                                &nbsp;
                                    <?php $data = $message->pending_messages();

                                        $messages = count($data);

                                        if(!$messages == null){
                                        ?>
                                        <span class="badge bg-warning mb-1">
                                        <?php echo $messages ?>
                                        </span>

                                    <?php } ?>
                            </a>

                            <!-- <a class="nav-link" disabled href="testimonials.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Testimonials
                            </a>

                            <a class="nav-link" href="FAQ.php" disabled>
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                FAQ
                            </a> -->
                            
                        </div>
                        
                    </div>
                    
                    <div class="sb-sidenav-footer bg-dark text-white">
                        <div class="small fw-bolder">Logged in as:</div>
                        Super Admin
                    </div>
                </nav>
            </div>