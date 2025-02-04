<?php
session_start();
include ('../Databsase/connection.php');
if (!isset($_SESSION['idAdmin'])) {
    header('location: login.php');
}

if (!isset($_GET['id'])) {
    header('location: allStudent.php');
}

$StudentID = $_GET['id'];

// Query to calculate the total fees from the payedstudent table (using the price column)
$queryFees = "SELECT SUM(price) AS TotalFees FROM payedstudent WHERE studentID = $StudentID";
$resultFees = mysqli_query($connection, $queryFees);

$rowFees = mysqli_fetch_assoc($resultFees); //fetch
$totalFees = $rowFees['TotalFees'];

// Query to count the total number of approved instructors
$queryinstructors = "SELECT COUNT(*) AS totalinstructors FROM instructors WHERE status = 'Approved'";
$resultinstructors = mysqli_query($connection, $queryinstructors);

$rowinstructors = mysqli_fetch_assoc($resultinstructors); //fetch
$totalinstructors = $rowinstructors['totalinstructors'];


// Query to count the total number of students
$querystudents = "SELECT COUNT(*) AS totalstudents FROM student";
$resultstudents = mysqli_query($connection, $querystudents);

$rowstudents = mysqli_fetch_assoc($resultstudents); //fetch
$totalstudents = $rowstudents['totalstudents'];


// Query to count the total number of courses
$querycourses = "SELECT COUNT(*) AS totalcourses FROM `payedstudent` WHERE studentID = $StudentID";
$resultcourses = mysqli_query($connection, $querycourses);

$rowcourses = mysqli_fetch_assoc($resultcourses); //fetch
$totalcourses = $rowcourses['totalcourses'];

$SQL = "SELECT * FROM `student` WHERE id = $StudentID";
$RESULT = mysqli_query($connection, $SQL);
$ROW = mysqli_fetch_assoc($RESULT);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/v3_66.png" />

    <title>Admin RaagamaInstitute Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'header.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">RaagamaInstitute</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between my-5">
                        <h1 style="background: #fd746c; background: -webkit-linear-gradient(to bottom, #ff9068, #fd746c); background: linear-gradient(to bottom, #ff9068, #fd746c); padding: 10px; border-radius: 15px; color: white;"
                            class="h3 mb-0 text-800">Student Profile</h1>
                    </div>

                    <div class="row"
                        style="display: flex; flex-direction:row; gap:12px; align-items: center; justify-content: center;">
                        <div class="col-11 my-1" style="height: fit-content;">
                            <div class="row">
                                <div class="col-4"
                                    style="display: flex; padding:25px; align-items: center; justify-content: center;">
                                    <?php
                                    $myImage;
                                    if (empty($ROW['profile_image'])) {
                                        echo '<img style="width:240px; height:240px; object-fit: cover;" class="img-fluid rounded-circle profile_image" src="../images/man3.png" alt="default image" />';
                                    } else {
                                        $decoded_image = base64_decode($ROW['profile_image']);
                                        if ($decoded_image !== false) {
                                            echo '<img style="width:240px; height:240px; object-fit: cover;" class="img-fluid rounded-circle profile_image" src="data:image/jpeg;base64,' . base64_encode($decoded_image) . '" alt="profile image" />';
                                        } else {
                                            echo '<img style="width:240px; height:240px; object-fit: cover;" class="img-fluid rounded-circle profile_image" src="../images/man3.png" alt="default image" />';
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-8">
                                    <div class="card shadow mb-4">
                                        <table class="table" style="align-items: center;">
                                            <thead class="bg-gradient-success">
                                                <tr style="color: white;">
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Student Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <td><?php echo $ROW['firstName'] . " " . $ROW['lastName'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email Address</th>
                                                    <td><?php echo $ROW['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td><?php echo $ROW['Gender'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Contact Number</th>
                                                    <td><?php echo $ROW['phone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td><?php echo $ROW['address'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Parent Name</th>
                                                    <td><?php echo $ROW['Pname'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Parent Contact</th>
                                                    <td><?php echo $ROW['Pphone'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td><?php echo $ROW['country'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>City & Postal Code</th>
                                                    <td><?php echo $ROW['city'] . " | " . $ROW['zipcode'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Fees</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if ($totalFees == null) {
                                                echo 'Rs 0';
                                            } else {
                                                echo 'Rs ' . number_format($totalFees, 2);
                                            } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Approved Insturctors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalinstructors); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Earnings (Monthly) Card Example -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total
                                                Students Attended
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($totalstudents); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Payed Courses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalcourses; ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between my-5">
                        <h1 style="background: #fd746c; background: -webkit-linear-gradient(to bottom, #ff9068, #fd746c); background: linear-gradient(to bottom, #ff9068, #fd746c); padding: 10px; border-radius: 15px; color: white;"
                            class="h3 mb-0 text-800">Student Payments</h1>
                    </div>

                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Course</th>
                                    <th scope="col">Instructor</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $MySql = "SELECT * FROM `payedstudent` WHERE studentID = '$StudentID'";
                                $MyResult = mysqli_query($connection, $MySql);
                                if (mysqli_num_rows($MyResult) > 0) {
                                    while ($MyRow = mysqli_fetch_assoc($MyResult)) {

                                        $courseID = $MyRow["course_id"];
                                        $MySqlCourse = "SELECT * FROM `courses` WHERE id = '$courseID'";
                                        $MyResulltCourse = mysqli_query($connection, $MySqlCourse);
                                        $MyRowCourse = mysqli_fetch_assoc($MyResulltCourse);

                                        $InstructorID = $MyRow["instructor_ID"];
                                        $MySqlInstructor = "SELECT * FROM `instructors` WHERE id = '$InstructorID'";
                                        $MyResulltInstructor = mysqli_query($connection, $MySqlInstructor);
                                        $MyRowInstructor = mysqli_fetch_assoc($MyResulltInstructor);
                                        ?>
                                        <tr>
                                            <th><?php echo $MyRowCourse['course_title'] ?></th>
                                            <td><?php echo $MyRowInstructor['FirstName'] . " " . $MyRowInstructor['LastName'] ?>
                                            </td>
                                            <?php
                                            $packageType = $MyRow['packageType'];

                                            if ($packageType == '1') {
                                                $packageName = 'Individual';
                                            } elseif ($packageType == '2') {
                                                $packageName = 'Group';
                                            } else {
                                                $packageName = 'Master';
                                            }
                                            ?>
                                            <td><?php echo $packageName ?></td>
                                            <td><?php echo $MyRow['price'] ?></td>
                                            <td><?php echo $MyRow['Date'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>