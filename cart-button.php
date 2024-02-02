<li>

    <a href="cart-new.php">
        <div onclick="handleToggleItemClick();" class="icon-cart"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.6" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
            </svg>
            <!-- itrem count -->
            <?php

            if (isset($_SESSION["email"])) {
                $email = $_SESSION["email"];

                $con = mysqli_connect("localhost", "root", "", "medicare");
                $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
                         UNION
                         SELECT user_id FROM superadmin WHERE email ='$email'  
                         UNION
                         SELECT user_id FROM admin WHERE email ='$email'
                         
                         ";
                $result = mysqli_query($con, $sql5);
                $row1 = mysqli_fetch_assoc($result);
                $userId = $row1['user_id'];

                $con = mysqli_connect("localhost", "root", "", "medicare");

                $sql8 = "SELECT product_id FROM cart WHERE user_id ='$userId' ";

                $result8 = mysqli_query($con, $sql8);





                function getData()
                {
                    $con = mysqli_connect("localhost", "root", "", "medicare");

                    $sql = "SELECT * FROM products";

                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        return $result;
                    }
                }



                $result = getData();

                $idArray = array();

                while ($row8 = mysqli_fetch_assoc($result8)) {
                    $idArray[] = $row8['product_id'];
                }

                $counts = 0;
                if (isset($_SESSION['add_cart']) || (!empty($idArray))) {



                    $result = getData();



                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($idArray as $id) {
                            if ($row['id'] == $id) {

                                $con = mysqli_connect("localhost", "root", "", "medicare");

                                $sql7 = "SELECT qty  FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";

                                $result7 = mysqli_query($con, $sql7);

                                $row7 = mysqli_fetch_assoc($result7);


                                $counts = $counts + (int) $row7['qty'];
                            }
                        }
                    }
                }
                // $count = count($_SESSION['cart']);
                echo "<div>$counts</div>";
            } else {

                echo "<div>0</div>";
            }





            ?>
        </div>
    </a>
</li>