<?php
require "db.php";

$message = "";
if(isset($_POST['name']) && isset($_POST['email'])){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $errors =[];
    if(empty($name)){
        $errors[] = "Name is required";
    }
    if(empty($email)){
        $errors[] = "Email is required";
    }
    if(empty($errors)):
        $stmt  = $con->prepare("INSERT INTO peopple(name, email) VALUES(:name, :email)");
        if($stmt->execute([':name' => $name, ':email' => $email])){
            $message = "Person Inserted Successfully";
        }
    endif;
}else{
    $error = "Both Name and Email are required";
}


include "header.php"; ?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
           <h2>Create a Person</h2>
        </div>
        <div class="card-body">

        <?php if(!empty($message)){?>
           <div class="alert alert-success"><?= $message ?></div>
        <?php } ?>

        <?php if(!empty($errors)):
            foreach($errors as $error): ?>

            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach;
             endif; ?>
        
           <form method="post">
              <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" name="email" id="email" class="form-control">
              </div>
              <button type="submit" class="btn btn-info">Create a Person</button>
           </form>
           
        </div>
    </div>
</div>

<?php include "footer.php";?>