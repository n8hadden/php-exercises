<!-- Header -->
<?php include "header.php" ?>

<?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM cake WHERE id = {$id}";
        $delete_query = mysqli_query($conn, $query);
        header("Location: home.php");
    }
?>

<!-- Back Button -->
<div class="container text-center mt-5">
    <a href="home.php" class="btn btn-warning mt-5">Back</a>
</div>