<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
$insert = false;
$update = false;
$delete = false;
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Sorry we failed to connect" . mysqli_connect_error());
} else {
  echo "";
}
// echo $_GET['update'];
// echo $_POST['snoEdit'];

#echo $_SERVER["REQUEST_METHOD"];
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
 // echo $sno;
  $delete=true;
  $sql= "DELETE FROM `notes` WHERE `sno` = $sno";
  
//$result = mysqli_query($conn,$sql);
//echo var_dump($result);
$result = mysqli_query($conn,$sql); 

}
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $title = $_POST['titleEdit'];
    $descrip = $_POST['descripEdit'];
    $sql = "UPDATE `notes` SET `title` = '$title',descrip='$descrip' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update=true;
    }
  } else {
    $title = $_POST["title"];
    $descrip = $_POST["descrip"];


    $sql = "INSERT INTO `notes` ( `title`, `descrip`) VALUES ( '$title', '$descrip')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $insert = true;
    } else {
      echo "Not successfully submiited" . mysqli_error($conn);
    }
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

  <title>Todo Project</title>

</head>

<body>
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  edit modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Notes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">

            </div>
            <div class="form-group">

              <label for="exampleFormControlTextarea1">Notes Description</label>
              <textarea class="form-control" id="descripEdit" name="descripEdit" rows="3"></textarea>
            </div>

            <!-- <button type="submit" class="btn btn-primary">Update notes note</button>
         
          ... -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex ">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert) {

    echo "<div class='alert alert-warning alert-success alert-dismissible fade show' role='alert'>
<strong>Success</strong> Your notes has been inserted succesfully
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  if ($update) {

    echo "<div class='alert alert-warning alert-success alert-dismissible fade show' role='alert'>
<strong>Success</strong> Your notes has been updated succesfully
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  if ($delete) {

    echo "<div class='alert alert-warning alert-success alert-dismissible fade show' role='alert'>
<strong>Success</strong> Your notes has been deleted succesfully
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }

  ?>
  <div class="container my-4">
    <h2>Add a note</h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

      </div>
      <div class="form-group">

        <label for="exampleFormControlTextarea1">Notes Description</label>
        <textarea class="form-control" id="descrip" name="descrip" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
  </div>
  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>" . $sno . "</th>
          <td>" . $row['title'] . "</td>
          <td>" . $row['descrip'] . "</td>
     <td><button class='delete btn btn-sm btn-primary' id=" . $row['sno'] . ">Delete</button>
 <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button></td>
     </tr> ";

        }
        ?>


      </tbody>
    </table>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

  <script>let table = new DataTable('#myTable');</script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        descripEdit.value = description;
        titleEdit.value = title;
        snoEdit.value = e.target.id
        console.log(e.target.id)

        $(document).on("click", ".edit", function () {
          var myModal = new bootstrap.Modal(document.getElementById("editModal"));
          myModal.show();
        });
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        sno = e.target.id
        //  console.log(e.target.id) 
        if (confirm("Press a button")) {
          console.log("yes")
          window.location = `index.php?delete=${sno}`;
          // user post request to submit a form
        }
        else {
          console.log("no")
        }
      })
    })
  </script>
</body>

</html>