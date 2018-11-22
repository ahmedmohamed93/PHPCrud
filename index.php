<?php
require "db.php" ;

$stmt = $con->prepare("SELECT * FROM peopple");
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_OBJ);

include "header.php";?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
           <h3>All People</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
               <tr>
                    <td>#ID</td> 
                    <td>Name</td>
                    <td>Email</td>
                    <td>Action</td>              
               </tr>

               <?php if(!empty($people)){
                   foreach($people as $person): ?>

               <tr>
                    <td><?= $person->id ?></td> 
                    <td><?= $person->name ?></td>
                    <td><?= $person->email ?></td>
                    <td>
                       <a href="edit.php?id=<?= $person->id; ?>" class="btn btn-primary">Edit</a>
                       <a onclick="return confirm('Are you sure you want to delete this entry?')"
                           href="delete.php?id=<?= $person->id; ?>" class="btn btn-danger">Delete</a>
                    </td>               
               </tr>

              <?php
                     endforeach;
                    }else{
                        echo "No Records To Show";
                    } ?>
            
            </table>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>