<?php
require "db.php";

$id = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM peopple WHERE id = :id");
$stmt->execute([":id"=> $id]);
$person = $stmt->fetch(PDO::FETCH_OBJ);

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $errors = [];
    if(empty($name)){
        $errors[] = "Name is required";
    }
    if(empty($email)){
        $errors[] = "Email is required";
    }
    if(empty($errors)):
        $stmt = $con->prepare('UPDATE peopple SET name=:name, email=:email WHERE id=:id');
        if ($stmt->execute([':name' => $name, ':email' => $email, ':id' => $id])) {
            header("Location: index.php");
        }
    endif;

    
}

include "header.php" ?>


<div class="container">
    <div class="card mt-5">
        <div class="card-header">
           <h2>Update Person</h2>
        </div>
        <div class="card-body">

         <?php if(!empty($errors)):
            foreach($errors as $error): ?>

            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach;
             endif; ?>
             
           <form method="post">
              <div class="form-group">
                 <label for="name">Name</label>
                 <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
              </div>
              <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
              </div>
              <button type="submit" class="btn btn-info">Edit</button>
           </form>
           
        </div>
    </div>
</div>

<?php include "footer.php" ?>