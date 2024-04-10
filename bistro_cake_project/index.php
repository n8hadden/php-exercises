<!-- Header -->
<?php include "header.php" ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Current Orders</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Address</th>
                <th scope="col">City</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Serve Now</th>
                <th scope="col">Table Number</th>
                <th scope="col">Cake Option</th>
                <th scope="col">Phone Number</th>
                <th scope="col" colspan="2" class="text-center">Update and Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                    $query = "SELECT * FROM cake";
                    $view_orders = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($view_orders)) {
                        $id = $row['id'];
                        $addr = $row['addr'];
                        $city = $row['city'];
                        $zip = $row['zip'];
                        $serve_now = $row['serve_now'];
                        $table_num = $row['table_num'];
                        $cake_opt = $row['cake_opt'];
                        $phone_num = $row['phone_num'];
                        echo "<tr >";
                        echo " <th scope='row'>{$id}</th>";
                        echo " <td> {$addr}</td>";
                        echo " <td> {$city}</td>";
                        echo " <td> {$zip}</td>";
                        echo " <td> {$serve_now}</td>";
                        echo " <td> {$table_num}</td>";
                        echo " <td> {$cake_opt}</td>";
                        echo " <td> {$phone_num}</td>";
                        // echo " <td class='text-center'> <a href='view.php?&id={$id}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a></td>";
                        echo " <td class='text-center'> <a href='edit.php?edit&id={$id}' class='btn btn-secondary'> <i class='bi bi-pencil'></i> EDIT</a></td>";
                        echo " <td class='text-center'> <a href='delete.php?&delete&id={$id}' class='btn btn-danger'> <i class='bi bi-trash'></i> DELETE </a></td>";
                        echo " </tr>";
                    }
                ?>
            </tr>
        </tbody>
    </table>
    <a href="create.php" class="btn btn-primary mt-2"> Create New Order </a> 
</div>
