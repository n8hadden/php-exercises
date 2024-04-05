<!-- Header -->
<?php include "header.php" ?>

<div class="container">
    <?php
    $query = "SELECT * FROM student";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $student_id = $row['id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
        echo "<p>$student_id</p>";
        echo "<p>$fname</p>";
        echo "<p>$lname</p>";
        echo "<p>$email</p>";
    }
    ?>
</div>

<!-- Footer -->
<?php include "footer.php" ?>