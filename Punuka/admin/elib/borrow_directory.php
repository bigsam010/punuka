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
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <script src="assets/media/js/jquery.js"></script>
        <script src="assets/media/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->





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
                $('#mata tfoot th').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                });

                // DataTable
                var table = $('#mata').DataTable({
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,
                    columnDefs: [
                        {"targets": [5, 6], "orderable": false, "visible": true, "searchable": false, className: "hide"},
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 1, targets: 7},
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
                table.columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change', function () {
                        if (that.search() !== this.value) {
                            that
                                    .search(this.value)
                                    .draw();
                        }
                    });
                });
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

        $date_arr = explode('-', $currentdate);


        $next_date = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 1, $date_arr[0]));

        $next_date2 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 2, $date_arr[0]));

        $next_date3 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 3, $date_arr[0]));

        $next_date4 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 4, $date_arr[0]));

        $next_date5 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 5, $date_arr[0]));

        $next_date6 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 6, $date_arr[0]));

        $next_date7 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 7, $date_arr[0]));

        $next_date14 = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + 14, $date_arr[0]));
        ?>
        <div class="modal">
            <div class="modal_close close"></div>
            <div class="flashscreen mode">
                <img src="images/i783wQYjrKQ.png" class="close ic">
                <form style="height:auto; width:90%; margin-top:30px; margin-left:25px" method="post" action="renew.php">
                    <center>
                        <input name="title" id="tit" style="display:none;">
                        <input name="user" id="use" style="display:none;">
                        <input name="location" id="loc" style="display:none;">
                        <p>Select the renewal duration</p>
                        <select name="due_date" id="dueDate" style="margin-top:10px;width:85%;margin-left: -21px;" required>
                            <option value="">Due Date</option>
                            <option value="">.......</option>
                            <option value="<?php echo "$next_date"; ?>">1 day</option>
                            <option value="<?php echo "$next_date2"; ?>">2 days</option>
                            <option value="<?php echo "$next_date3"; ?>">3 days</option>
                            <option value="<?php echo "$next_date4"; ?>">4 days</option>
                            <option value="<?php echo "$next_date5"; ?>">5 days</option>
                            <option value="<?php echo "$next_date6"; ?>">6 days</option>
                            <option value="<?php echo "$next_date7"; ?>">1 week</option> 
                            <option value="<?php echo "$next_date14"; ?>">2 weeks</option>
                        </select>
                    </center>
                    <div class="fox tilty" style="margin-top:20px;">
                        <button class="mo ed new">Renew</button>
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
                        <a href="#" class="logo"><strong>Borrowers Directory</strong></a>
                    </header>

                    <!-- Banner -->



                    <!-- Section -->
                    <?php
                    if ($user_name == 'General-admin') {
                        $getquery = $mysqli->query("SELECT * FROM borrowers WHERE status=''");
                    } else {
                        $getquery = $mysqli->query("SELECT * FROM borrowers WHERE status='' AND location='$location'");
                    }
                    ?>
                    <table id="mata" class="display wrap" cellspacing="0" width="100%">  
                        <thead>   
                            <tr>
                                <th>Title</th>
                                <th>Borrowed by</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Location</th>
                                <th style="display:none">Id</th>
                                <th style='display:none;'>Email</th>
                                <th>Return Book</th>
                                <th>Renew Subscription</th>



                            </tr>
                        </thead>
                        <?php
                        if ($user_name == 'General-admin') {
                            echo"<tfoot>
            <tr>
            <th>Title</th>
			<th>Borrowed by</th>
			<th>Date Borrowed</th>
			<th>Due Date</th>
			<th>Location</th>
                        <th style='display:none;'>Id</th>
			<th style='display:none;'>Email</th>
			<th style='display:none;'>Return Book</th>
			<th style='display:none;'>Renew Subscription</th>
            </tr>
        </tfoot>";
                        }
                        ?>	
                        <tbody>
                            <?php
                            if ($getquery->num_rows != 0) {

                                while ($runrows = $getquery->fetch_assoc()) {
                                    $title = $runrows ['title'];
                                    $full_name = $runrows ['full_name'];
                                    $date = $runrows ['date'];
                                    $due_date = $runrows ['due_date'];
                                    $id = $runrows ['id'];
                                    $email = $runrows ['e_mail'];
                                    $location = $runrows ['location'];
                                    $acNum = $runrows['accessNum'];
                                    $bkpos = $mysqli->query("select position from entry where accessNum=$acNum");
                                    $bkposr = $bkpos->fetch_array();
                                    $slocation = $bkposr[0];
                                    ?>


                                    <tr>
                                        <td><p class="title"><?= $title ?></p></td>
                                        <td><p class="fname"><?= $full_name ?></p></td>
                                        <td><?= $date ?></td>
                                        <td><?= $due_date ?></td>
                                        <td class="loca"><?= $location ?> <small style="font-size: 10px">[<?= $slocation ?>]</small></td>
                                        <td style="display:none;"><p class="id"><?= $id ?></p></td>
                                        <td style="display:none;"><p class="email"><?= $email ?></p></td>
                                        <td><button class="btn retn" title="Return Book"><img src="images/blue.png" class="mager"></button></td>
                                        <td><button class="btn renew" title="Renew Subscription"><img src="images/renew.png" class="mager"></button></td>


                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>




                </div>
            </div>

            <!-- Sidebar -->

            <!-- Menu -->
            <?php
            include 'menu2.php';
            ?>	


            <!-- Section -->

            <!-- Footer -->

        </div>

        <!-- Scripts -->

        <script src="assets/js/main.js"></script>
        <script src="dist/sweetalert.min.js"></script>
        <script src="assets/js/javascript.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script type="text/javascript">
            $(window).load(function () {
                $(".loader").fadeOut("slow");
            })

            $(document).ready(function () {
                $(".renew", this).click(function () {
                    $("select#dueDate").val('');
                    $(".modal").fadeIn();
                    $(".flashscreen").show();

                    var title = $(this).closest("tr").find(".title").text();
                    var name = $(this).closest("tr").find(".fname").text();
                    var location = $(this).closest("tr").find(".loca").text();

                    $("input#tit").val(title);
                    $("input#use").val(name);
                    $("input#loc").val(location);

                });
            });
        </script>
    </body>
</html>