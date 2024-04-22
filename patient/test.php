<?php  
ob_start(); // Start output buffering
session_start();

if(isset($_SESSION['flash_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 

                        $message = $_SESSION['flash_message'];
                        unset($_SESSION['flash_message']);
                        echo $message;
                    ?>
                </div>
                <?php } ?>