<?php
$currentdate = date('Y-m-d');

$query = $mysqli->query("SELECT image FROM admin where user_name='$user_name' AND staff_id='$staff_id'");
if ($query->num_rows == 1) {
    while ($roww = $query->fetch_assoc()) {
        $image = $roww["image"];
    }
}
$query = $mysqli->query("SELECT full_name FROM users where staff_id='$staff_id'");
if ($query->num_rows == 1) {
    while ($row = $query->fetch_assoc()) {
        $name = $row["full_name"];
        $pieces = explode(" ", $name);
    }
}
?>
<div id="sidebar">
    <div class="inner">

        <!-- Search -->
        <section id="search" class="alt">

            <img src="images/punuka logo new.png"  width="140" height="95"alt="Logo" align="middle" style="margin-left:30px;"/>

        </section>
        <nav id="menu">
            <header class="major">
                <h2> <img src="images/<?= $image ?>" class="prof"/><p class="kill"><b>Hi <?= $pieces[0] ?></b></p></h2>
            </header>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#" class="you e">E-library <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                    <ul class="you">
                        <li>
                            <a href="#" class="you e">Catalogue <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>

                            <ul class="you cat">
                                <li><a href="excel.php">Excel Import</a></li>
                                <li><a href="manual.php">Manual Entry</a></li>
                                <li><a href="search.php">Search</a></li>
                                <?php
                                if ($user_name != 'General-admin') {
                                    echo"<li><a href='search_by_location.php'>Search By Location</a></li>";
                                }
                                ?> 
                            </ul>
                        </li>
                        <li>
                            <a href="borrow_book.php">Borrow a Book</a>
                        </li>
                        <li>
                            <a href="suggest_books.php">Suggest Books</a>
                        </li>

                        <li>
                            <a href="#" class="you">Book Edit <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                            <ul class="you">
                                <li><a href="view_books2.php">Edit / Archive / Delete</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="#" class="you">User Edit <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>

                            <ul class="you">
                                <li><a href="add_user.php ">Add User</a></li>
                                <li><a href="edit_user.php">Edit / Delete User</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="#" class="you">E-Books <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                    <ul class="you">
                        <li>
                            <a href="#" class="you">Catalogue <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                            <ul class="you">
                                <li><a href="fuploadfile.php">Upload file</a></li>
                                <li><a href="fsearch.php">Search</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="suggest_file.php">Suggest a File</a></li>-->
                    </ul>
                </li>

                <li>
                    <a href="#" class="you">Reports <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>

                    <ul class="you">
                        <li>
                            <a href="#" class="you">E-library Report <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                            <ul class="you">
                                <li><a href="borrow_directory.php">Borrowers Directory</a></li>
                                <li><a href="requests.php">Borrow Requests</a></li>
                                <li><a href="book_issuance.php">Book Issuance</a></li>
                                <li><a href="suggest_book.php">Books Suggested</a></li>
                                <li><a href="booklist.php">Full Book List</a></li>
                                <li><a href="view_users_activity.php">View Users</a></li>
                                <li><a href="overdue_books.php">Overdue borrowed books</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="you">E-Books Report <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                            <ul class="you">
                                <li><a href="fbooklist.php">Full Book List</a></li>
                                <li><a href="fsuggest_book.php">Books Suggested</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#" class="you">User Profile <img id="cola" src="images/colex.png" style="height:11px; width:11px; float:right;"><img id="cola" src="images/colup.png" style="display:none;height:11px; width:11px; float:right;"></a>
                    <ul class="you">
                        <li><a href="change_password.php">Change Password</a></li>
                        <li><a href="profile_pic.php">Change Profile Picture</a></li>
                    </ul>
                </li>
                <?php
                if ($user_name == 'General-admin') {
                    echo '<li><a href="#" onclick="btnResetDb()">Reset Database</a></li>';
                }
                ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <footer id="footer">
            <p class="copyright">&copy; Punuka Attorneys & Solicitors. All rights reserved.</p>
        </footer>

    </div>
</div>
<div class="toggler mamma">
    <label class="tog">☰</label>
</div>
<div class="toggler secguy" style="display:none; left:10px;">
    <label class="tog">☰</label>
</div>
<script>
    $(document).ready(function () {
        $('.toggler').click(function () {

            $('#sidebar').toggle(1000, function () {
                $('.toggler').toggle();
            });

        });
    });

    function btnResetDb() {
        if (confirm("Reset action cannot be revoked. Continue?")) {
            $.ajax({type: 'POST', url: "doreset.php"}).done(function (res) {
                alert("Action completed");
                location.reload();
            });
        }
    }
</script>
