<?php
    error_reporting(E_ALL);
    session_start();

    require_once("admin_guard.php");
    require_once("partials/header.php");
    require_once("classes/payment.php");

    
?>
<?php if($_GET && isset($_GET["t"])){ $title = $_GET["t"];  $refund = $payment->refund_by_title($title); ?>
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
                   <div class="container-fluid" style="font-size:2rem">
                   <p>
            <?php if(isset($_SESSION["error_paying"])){  echo "<div class='alert alert-danger'>" . $_SESSION["error_paying"] . "</div>"; unset($_SESSION["error_paying"]);  } ?>
        </p>
                   <div class="row">
                <div class="col">
                    <p>Email address : <b><?php echo $refund["business_email"] ?></b></p>
                    <p>Project name : <b><?php echo $refund["project_title"] ?></b></p>
                    <p>Amount to Pay : <b>&#8358;<?php echo number_format($refund["pp_amt"]) ?>.00</b></p>
                    <a href="process/complete_refund.php?t=<?php echo $title ?>" class="btn btn-success" name="refund">Pay Now</a>
                </div>
            </div>
                   </div> 
                </main>
<?php
    

    require_once("partials/footer.php");

?>

<?php } ?>
