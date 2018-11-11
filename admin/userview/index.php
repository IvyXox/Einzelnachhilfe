<?php
session_start();
if(isset($_SESSION['id'])) {
  if( $_SESSION['role'] == "admin"){
    $vorname = $_SESSION['vorname'];
    $name = $_SESSION['name'];
    $userId = (int)$_SESSION['id'];
  }else{
    header('Location: ../dashboard.php?access=denied');
    exit;
  }
} else {
  header('Location: ../login.php?login=error');
  exit;
}
include_once("../php/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Libs -->
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Style -->
  <link rel="stylesheet" href="css/main-style.css">

  <title>Admin panel</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../verify/">Verifizierung</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Users</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Welcome, <?php echo htmlentities($vorname . " " . $name); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../php/script_logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <section class="header" id="header">
    <div class="container text-white">
      <h1><i class="fa fa-cog" aria-hidden="true"></i> Users</h1>
    </div>
  </section>
  <!-- End Header -->

  <!-- Breadcrumb -->
  <nav class="breadcrumb-header" aria-label="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
      </ol>
    </div>
  </nav>
  <!-- Breadcrumb -->

  <!-- Main -->
  <section class="main" id="main">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <!-- Sidebar -->
          <ul class="list-group">
            <li class="list-group-item active"><a href="../dashboard.php">Dashboard</a></li>
            <li class="list-group-item"><a href="../verify/">Verifizierung</a></li>
            <li class="list-group-item"><a href="../userview/">Users</a></li>
            <li class="list-group-item"><a href="">Profil</a></li>
          </ul>
        </div>
        <div class="col-lg-9 col-md-8">
          <!-- Main Panel -->
          <div class="card">
            <div class="card-header">
              Users
            </div>
            <div class="card-body">

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Vorname</th>
                    <th scope="col">Name</th>
                    <th scope="col">Stufe</th>
                    <th scope="col">Fach</th>
                    <th scope="col">Verifiziert</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once("../php/connection.php");

                  $sql = "SELECT * FROM users ORDER BY id ";

                  if ($result = mysqli_query($dbCon,$sql)) {
                    //Display all Users
                    while ($row = mysqli_fetch_array($result)) {
                      ?>
                      <tr>
                        <th scope="row"><?php echo htmlentities($row['id']); ?></th>
                        <td><?php echo htmlentities($row['vorname']); ?></td>
                        <td><?php echo htmlentities($row['name']); ?></td>
                        <td><?php echo htmlentities($row['stufe']); ?></td>
                        <td><?php echo htmlentities($row['fach']); ?></td>
                        <?php if($row['verified']==1){ ?>

                          <td>Ja</td>
                        <?php }else{ ?>
                          <td>Nein</td>
                        <?php } ?>
                        <td><button type="button" class="btn btn-success btn-sm" name="button">Edit</button></td>
                        <td><button type="button" class="btn btn-danger btn-sm" name="button">Delete</button></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Main -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="../../js/bootstrap.js"></script>
</body>
</html>
