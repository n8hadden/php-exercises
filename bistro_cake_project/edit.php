<!-- Header -->
<?php include "header.php" ?>

<?php 
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    }

    $query = "SELECT * FROM cake WHERE id = {$id}";
    $view_order = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($view_order)) {
        $addr = $row['addr'];
        $city = $row['city'];
        $zip = $row['zip'];

        if ($row['serve_now'] == "True") {
            $serve_now = "checked";
        } else if ($row['serve_now'] == "False") {
            $serve_now = "";
        }

        $table_num = $row['table_num'];
        $opt = $row['cake_opt'];
        $phone_num = $row['phone_num'];

        // For cake options
        $wbc = $cvacc = $t = $capc = $cwr = $ac = "";
        if ($opt = "Wild Berry Cake") {
            $wbc = "checked";
        } else if ($opt = "Chocolate, Vanilla, and Caramel Cake") {
            $cvacc = "checked";
        } else if ($opt = "Tiramisu") {
            $t = "checked";
        } else if ($opt = "Carrot and Pumpkin Cake") {
            $capc = "checked";
        } else if ($opt = "Cheesecake with Raspberry") {
            $cwr = "checked";
        } else if ($opt = "Amandina Cake") {
            $ac = "checked";
        }
    }
?>

<h1 class="text-center container mt-5">Edit Order</h1>
<div class="container">
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="addr" class="form-label">Address: </label>
            <input type="text" name="addr" class="form-control" value="<?php echo $addr ?>" required>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="city" class="form-label">City: </label>
                <input type="text" name="city" class="form-control" value="<?php echo $city ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="zip" class="form-label">Zip Code: </label>
                <input type="text" name="zip" class="form-control" value="<?php echo $zip ?>" required>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="checkbox" id="serve_now" name="serve_now" <?php echo $serve_now ?>>
            <label for="serve_now">I will serve the cake on the spot</label>
        </div>
        <div class="form-group mb-3">
            <label for="table_num">Table Number: </label>
            <input type="text" name="table_num" id="table_num" value="<?php echo $table_num ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="opts" class="mb-3 form-label">Best Option for You: </label>
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="radio" id="wbc" value="Wild Berry Cake" name="opts" <?php echo $wbc ?>>
                    <label for="wbc" class="form-label">Wild Berry Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="cvacc" value="Chocolate, Vanilla, and Caramel Cake" name="opts" <?php echo $cvacc ?>>
                    <label for="cvacc" class="form-label">Chocolate, Vanilla, and Caramel Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="t" value="Tiramisu" name="opts" <?php echo $t ?>>
                    <label for="t" class="form-label">Tiramisu</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="radio" id="capc" value="Carrot and Pumpkin Cake" name="opts" <?php echo $capc ?>>
                    <label for="capc" class="form-label">Carrot and Pumpkin Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="cwr" value="Cheesecake with Raspberry" name="opts" <?php echo $cwr ?>>
                    <label for="cwr" class="form-label">Cheesecake with Raspberry</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="ac" value="Amandina Cake" name="opts" <?php echo $ac ?>>
                    <label for="ac" class="form-label">Amandina Cake</label>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="phone_num">Phone Number: </label>
            <input type="tel" id="phone_num" name="phone_num" value="<?php echo $phone_num ?>" required>
        </div>
        <div class="form-group mb-3">
            <input type="submit" name="edit" class="btn btn-primary mt-2" value="Submit">
        </div>
    </form>
</div>


<?php 

    if(isset($_POST['edit'])) {
       $addr = $_POST['addr'];
       $city = $_POST['city'];
       $zip = $_POST['zip'];
       $table_num = $_POST['table_num'];
       $opt = $_POST['opts'];
       $phone_num = $_POST['phone_num'];

       if (isset($_POST['serve_now']) && $_POST['serve_now'] == 'on') {
           // If the checkbox is checked, set $serve_now to "true"
           $serve_now = "True";
       } else {
           // If the checkbox is not checked, set $serve_now to "false"
           $serve_now = "False";
       }

       $addressRegex = '/^\d+\s+([a-zA-Z]+\s*)+,\s*\w+\s*,\s*\w+\s*\d*$/';
       // 123 Main St, Springfield, IL 6270

       $cityRegex = '/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/';
       // Springfield

       $zipCodeRegex = '/^\d{5}(?:-\d{4})?$/';
       // 62701

       $phone_numRegex = '/[0-9]{3}-[0-9]{3}-[0-9]{4}$/';
    if (
        preg_match($addressRegex, $addr) &&
        preg_match($cityRegex, $city) &&
        preg_match($zipCodeRegex, $zip) &&
        filter_var($table_num, FILTER_VALIDATE_INT) && 
        preg_match($phone_numRegex, $phone_num)
    ) {
        $query = "UPDATE cake SET addr = '{$addr}', city = '{$city}', zip = '{$zip}', serve_now = '{$serve_now}', table_num = '{$table_num}', cake_opt = '{$opt}', phone_num = '{$phone_num}' WHERE id = $id";
        $update_order = mysqli_query($conn, $query);
        header("Location: index.php");
    } else {
        echo "<div class='container text-danger'>Field Inputs Are Not Acceptable</div>";
    }
}


?>

<!-- Back Button -->
<div class="container text-center mt-5">
    <a href="index.php" class="btn btn-warning mt-5">Back To Home</a>
</div>