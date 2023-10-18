 <?php

$insert = false;
$update = false;
$delete = false;
$conn = new mysqli("sql201.infinityfree.com", "if0_35246635", "Vb9bGaZVgYn6", "if0_35246635_crud");
// $conn = new mysqli("localhost", "root", "", "crud");
if(!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = '$sno'";
  $result= mysqli_query($conn,$sql); 
} 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoedit'])){
    // Update the Record
    $sno = $_POST['snoedit'];
    $title = $_POST['titleedit'];
    $desc = $_POST['descedit'];
    $sql = "UPDATE `crud`.`notes` SET `title` = '$title' , `description` = '$desc'WHERE `notes`.`sno` = '$sno'";
    $result= mysqli_query($conn,$sql); 
    if($result){
      $update= true;
    }
    
  }
  else{
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $sql = "INSERT INTO `crud`.`notes` (`title`, `description`) VALUES ('$title', '$desc')";
    $result= mysqli_query($conn,$sql); 
    if($result){
        // echo "Record Insert Succesfully";
        $insert = true;
    }
    else{
        echo "Record Was not inserted Because of this erroe -- >". mysqli_error(); 
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

    <title>PHP CRUD </title>
   
  </head>
  
  <body>
    <!-- Button Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmodal">
  Edit modal
</button> -->

<!-- EditModal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="if0_35246635_crud" method="POST">
        <input type="hidden" name="snoedit" id="snoedit">
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" name="titleedit" id="titleedit" >
  </div>

  <div class="form-group">
    <label for="desc">Note Description</label>
    <textarea class="form-control" id="descedit" name="descedit" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Update Note</button>
</form>
      </div>
      <div class="modal-footer d-block">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="log.png" alt="" height="28px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact us</a>
      </li>
     
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php
if($insert){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Succesfully Inserted</strong> Your Note Inserted Successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}
?> 
<?php
if($update){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Succesfully Inserted</strong> Your Note update Successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}
?> 
<?php
if($delete){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Succesfully Inserted</strong> Your Note Has Been Deleted Successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
}
?> 
<div class="container my-3">
    <h3>Add a Note</h3>
<form action="if0_35246635_crud" method="POST">
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" name="title" id="title" >
  </div>

  <div class="form-group">
    <label for="desc">Note Description</label>
    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary" >Add Note</button>
</form>
</div>
<div class="container">
   
    ""
    <table class="table my-3" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Titile</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $sql = "SELECT * FROM `notes`";
    $sno = 0;
    $result = mysqli_query($conn,$sql);
    
    while($row= mysqli_fetch_array($result)){
        $sno = $sno + 1;
        echo "
        <tr>
      <th scope='row'>" . $sno . "</th>
      <td>" .$row['title']. "</td>
      <td>" .$row['description']. "</td>
      <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
    </tr>";
        
        
    }
    ?>
    
    
    
  </tbody>
</table>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} )
    </script>
     <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ", );
            tr= e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText; 
            desc = tr.getElementsByTagName("td")[1].innerText; 
            console.log(title, desc); 
            titleedit.value = title;
            descedit.value = desc;
            snoedit.value = e.target.id;
            console.log(e.target.id) 
            $('#editmodal').modal('toggle');

  })
})

            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
            console.log("delete  ", );
            sno = e.target.id.substr(1,); // sucstr js me hamare 1st character chod kr baki sab character le leti hai 
           if(confirm("Press a button!")){
            console.log("yes")
            window.location = `crud.php?delete=${sno}`;
            // create a form and use post request to submit a form
           }
           else{
            console.log("No"); 
           }
            

  })
})
        
    </script> 
  </body>
</html>