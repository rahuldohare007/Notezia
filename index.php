<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;

include 'dbconnect.php';

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['snoEdit'])){
    // Update the record
      $sno = $_POST["snoEdit"];
      $title = $_POST["titleEdit"];
      $description = $_POST["descriptionEdit"];

    // Sql query to be executed
    $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
    }
    else{
        echo "We could not update the record successfully";
    }
  }
  else{
    
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Sql query to be executed
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
    
    if($result){ 
        $insert = true;
    }
    else{
        echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
  
  <script
  src="https://code.jquery.com/jquery-3.6.3.js"integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>

  <title>Notezia - Notes taking made easy</title>

</head>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <form action="https://idiscuss-coding-forum7.000webhostapp.com/" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-secondary">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="https://idiscuss-coding-forum7.000webhostapp.com/">Notezia</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="https://idiscuss-coding-forum7.000webhostapp.com/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Contact</a>
      </li>
    </ul>

    <div class="row mx-2"></div>';
    <form class="d-flex" role="search" method="get" action="">
        <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
    </form>
    </div>
</div>
</nav>




  <?php
  if($insert){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> Your note has been inserted successfully  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>
  <?php
  if($delete){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> Your note has been deleted successfully  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>
  <?php
  if($update){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> Your note has been updated successfully  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>
  <div class="container my-4">
    <h2>Add a Note to Notezia</h2>
    <form action="https://idiscuss-coding-forum7.000webhostapp.com/" method="POST">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group mt-2">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Add Note</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
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
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['description'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `https://idiscuss-coding-forum7.000webhostapp.com/?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>
</html>
