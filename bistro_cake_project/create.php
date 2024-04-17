<!-- Header -->
<?php include "header.php" ?>

<h1 class="text-center container mt-5">Add Order</h1>
<div class="container">
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="addr" class="form-label">Address: </label>
            <input type="text" name="addr" class="form-control" placeholder="Street Address" required>
        </div>
        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label for="city" class="form-label">City: </label>
                <input type="text" name="city" class="form-control" placeholder="City" required>
            </div>
            <div class="form-group col-md-6">
                <label for="zip" class="form-label">Zip Code: </label>
                <input type="text" name="zip" class="form-control" placeholder="Postal / Zip Code" required>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="checkbox" id="serve_now" name="serve_now">
            <label for="serve_now">I will serve the cake on the spot</label>
        </div>
        <div class="form-group mb-3">
            <label for="table_num">Table Number: </label>
            <input type="text" name="table_num" id="table_num" placeholder="Table Number" required>
        </div>
        <div class="form-group mb-3">
            <label for="opts" class="mb-3 form-label">Best Option for You: </label>
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="radio" id="wbc" value="Wild Berry Cake" name="opts">
                    <label for="wbc" class="form-label">Wild Berry Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="cvacc" value="Chocolate, Vanilla, and Caramel Cake" name="opts">
                    <label for="cvacc" class="form-label">Chocolate, Vanilla, and Caramel Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="t" value="Tiramisu" name="opts">
                    <label for="t" class="form-label">Tiramisu</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="radio" id="capc" value="Carrot and Pumpkin Cake" name="opts">
                    <label for="capc" class="form-label">Carrot and Pumpkin Cake</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="cwr" value="Cheesecake with Raspberry" name="opts">
                    <label for="cwr" class="form-label">Cheesecake with Raspberry</label>
                </div>
                <div class="col-md-4">
                    <input type="radio" id="ac" value="Amandina Cake" name="opts">
                    <label for="ac" class="form-label">Amandina Cake</label>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="phone_num">Phone Number: </label>
            <input type="tel" id="phone_num" name="phone_num" placeholder="###-###-####" required>
        </div>
        <div class="form-group mb-3">
            <input type="submit" name="create" class="btn btn-primary mt-2" value="Submit">
        </div>
    </form>
</div>

<?php
if (isset($_POST['create']) && !empty($_POST['create'])) {
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

        $query = "INSERT INTO cake(addr, city, zip, serve_now, table_num, cake_opt, phone_num) VALUES('{$addr}', '{$city}', '{$zip}', '{$serve_now}', '{$table_num}', '{$opt}', '{$phone_num}')";
        $add_order = mysqli_query($conn, $query);

        if (!$add_order) {
            echo "something went wrong" . mysqli_error($conn);
        } else {
            header("Location: home.php");
        }


    } else {
        echo "<div class='container text-danger'>Field Inputs Are Not Acceptable</div>";
    }
}
?>

<!-- Back Button -->
<div class="container text-center mt-5">
    <a href="home.php" class="btn btn-warning mt-5">Back To Home</a>
</div>