<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION["staff_id"])) {
    header("Location: ../../");
} else {

    $staff_id = $_SESSION["staff_id"];
}

$ad = $mysqli->query("SELECT user_name FROM admin WHERE staff_id='$staff_id'");

if ($ad->num_rows == 1) {
    while ($row = $ad->fetch_assoc()) {
        $user_name = $row['user_name'];
        $_SESSION["admin"] = $user_name;
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Punuka Library App</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <style type="text/css">
            .hideAll  {
                visibility:hidden;
            }
        </style>
        <script src="assets/media/js/jquery.js"></script>
        <script src="assets/media/js/jquery.dataTables.min.js"></script>


        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />






        <script src="assets/media/js/dataTables.buttons.js"></script>
        <script src="assets/media/ex/buttons.html5.min.js"></script>
        <script src="assets/media/ex/pdfmake.min.js"></script>
        <script src="assets/media/ex/jszip.min.js"></script>
        <script src="assets/media/ex/vfs_fonts.js"></script>
        <script src="assets/media/ex/dataTables.responsive.min.js"></script>
        <script src="assets/media/ex/dataTables.rowReorder.min.js"></script>

        <script src="dist/sweetalert.min.js"></script>
        <script src="assets/js/javascript.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="assets/media/css/buttons.dataTables.css">
        <link rel="stylesheet" type="text/css" href="assets/media/ex/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="assets/media/ex/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

        <script>
            $(document).ready(function () {
                // Setup - add a text input to each footer cell
                $('#matter tfoot th').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                });

                // DataTable
                var table = $('#matter').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    columnDefs: [
                        {"targets": [1], "orderable": false, "visible": true, "searchable": false, className: "hide"},
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 1, targets: 3},
                        {responsivePriority: 1, targets: -1},
                    ],
                    dom: 'lBfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ]
                });

                // Apply the search
                /*  table.columns().every( function () {
                 var that = this;
                 
                 $( 'input', this.footer() ).on( 'keyup change', function () {
                 if ( that.search() !== this.value ) {
                 that
                 .search( this.value )
                 .draw();
                 }
                 } );
                 } ); */
            });
        </script>
        <script src="assets/js/soop.js"></script>

        <style>
            .loader {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('images/loading_big1.gif') 50% 50% no-repeat rgb(249,249,249);
            }
        </style>
        <style>
            .hide {
                display: none!important;
            }
        </style>
    </head>
    <body>
        <div class="loader"></div>
        <?php
        $currentdate = date('Y-m-d');

        $resultset = $mysqli->query("SELECT * FROM admin where user_name = '$user_name'");

        if ($resultset->num_rows != 0) {


            while ($rows = $resultset->fetch_assoc()) {

                $location = $rows ['location'];
            }
        }
        ?>	
        <div class="moda">
            <div class="moda_close die"></div>
            <div class="modal_mail ex">
                <img src="images/i783wQYjrKQ.png" class="die ic">
                <form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="return_book_mail.php" onsubmit="swal({
                    title: 'Success!',
                    text: 'Mail sent successfully.',
                    type: 'success',
                    timer: 5000,
                    showConfirmButton: false
                });">
                    <input class="r_name" style="display:none" name="r_name"/>
                    <input class="r_mail" style="display:none" name="r_mail"/>
                    <p class="pom">Type in the mail you want to send</p>
                    <input placeholder="Mail title" class="oop" name="m_title" required>
                    <textarea class="text" placeholder="mail content goes here" name="m_content" required></textarea>
                    <div class="fox tilt">
                        <button class="mo ed">Send</button>
                        <div class="mo k die">Cancel</div>
                    </div>
                </form>

            </div>
        </div>



        <div class="modal">
            <div class="modal_close close"></div>
            <div class="modal_main mode">
                <img src="images/i783wQYjrKQ.png" class="close ic">
                <form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="../send_multi_user_mail.php" onsubmit="swal({
                            title: 'Success!',
                            text: 'User data updated successfully.',
                            type: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        });">
                    <input style="display:none" name="location_m" value="<?= $location ?>"/>
                    <p class="pom">Type in the mail you want to send</p>
                    <input placeholder="Mail title" class="oop" name="m_title" required>
                    <textarea class="text" placeholder="mail content goes here" name="m_content" required></textarea>
                    <div class="fox tilty">
                        <button class="mo ed">Send</button>
                        <div class="mo k">Cancel</div>
                    </div>
                </form>
            </div>
        </div>



        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Main -->
            <div id="main">
                <div class="inner">

                    <!-- Header -->
                    <header id="header">
                        <center><h1>Book Issuance History
                            </h1>
                        </center>
                    </header>

                    <!-- Banner -->



                    <!-- Section -->


                    <?php
                    $currentdate = date('Y-m-d');
                    if ($user_name == 'General-admin') {
                        $resultset = $mysqli->query("SELECT * FROM borrowers ");
                    } else {
                        $resultset = $mysqli->query("SELECT * FROM borrowers where location='$location')");
                    }
                    $foundnum = $resultset->num_rows;
                    ?>
                    <table id="matter" class="display wrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Email</th>
                                <th>Book Borrowed</th>
                                <th>Location</th>
                                <th>Date Borrowed</th>
                                <th>Due-Date</th>
                                <th>Status</th>
                              
                            </tr>
                        </thead>
                        <?php
                        if ($user_name == 'General-admin') {

                            echo"<tfoot>
            <tr>
            <th>Borrower</th>
		    <th>Email</th>
			<th>Book Borrowed</th>
			<th>Location</th>
                        <th>Shelf Location </th>
			<th>Due-Date</th>
			<th style='display:none;'>Status</th>
           </tr>
        </tfoot>";
                        }
                        ?>	
                        <tbody>
                            <?php
                            if ($resultset->num_rows != 0) {
                                while ($rows = $resultset->fetch_assoc()) {
                                    $full_name = $rows ['full_name'];
                                    $due_date = $rows ['due_date'];
                                    $title = $rows ['title'];
                                    $mail = $rows ['e_mail'];
                                    $location = $rows ['location'];
                                    $acNum = $rows['accessNum'];
                                    $bkpos = $mysqli->query("select position from entry where accessNum=$acNum");
                                    $bkposr = $bkpos->fetch_array();
                                    $slocation = $rows["date"];
                                    $status = $rows['status'];
                                    if (trim($status) == "") {

                                        $status = "unreturned";
                                    }
                                    ?>
                                    <tr>
                                        <td><p class="name"><?= $full_name ?></p></td>
                                        <td><p class="mail"><?= $mail ?></p></td>
                                        <td><?= $title ?></td>
                                        <td><?= $location ?></td>
                                        <td><?= $slocation ?></td>
                                        <td><?= $due_date ?></td>
                                        <td><?= $status ?></td>
                                      
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
                <center>
                    <?php
                    if ($resultset->num_rows > 0) {
                        if ($user_name != "General-admin") {
                            echo "<button class='allMail' style='background:transparent;box-shadow:inset 0 0 0 2px transparent;outline:0px;'><img src='images/mail.png' style='height:70px;width:70px;'></button><p>Send mail to all</p>";
                        }
                    }
                    ?>

                </center>
            </div>

            <!-- Sidebar -->

            <!-- Menu -->
            <?php
            require 'menu2.php';
            ?>	


            <!-- Section -->

            <!-- Footer -->

        </div>

        <!-- Scripts -->




        <script src="assets/js/main.js"></script>

<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->

        <script type="text/javascript">
                    $(window).load(function () {
                        $(".loader").fadeOut("slow");
                    })
        </script>

    </body>
</html>