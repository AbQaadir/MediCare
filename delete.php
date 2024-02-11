<?php
session_start();
$id = $_POST['product_id'];
$adminEmail = $_SESSION["email"];

$con = mysqli_connect("localhost", "root", "", "medicare");

$query = "SELECT COUNT(*) AS count FROM products WHERE id = '$id'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    
    if ($count == 1) {
        // Execute delete query
        $delete_query = "DELETE FROM products WHERE id = '$id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        if ($delete_result) {
            ?>
            <script>
                alert("Product deleted successfully.");
                window.location.href = 'index.php';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error deleting product: <?php echo mysqli_error($con); ?>");
                window.location.href = 'index.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            
            window.location.href = 'index.php';
        </script>
        <?php
    }
} else {
    ?>
    <script>
        alert("Error executing query: <?php echo mysqli_error($con); ?>");
        window.location.href = 'index.php';
    </script>
    <?php
}

mysqli_close($con);
?>
