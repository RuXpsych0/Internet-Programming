<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //1.Get the ID of selected admin
            $id=$_GET['id'];

            //2. Create SQL query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the query
            $res=mysqli_query($conn, $sql);

            //Check weather the query is executed or not
            if($res==true)
            {
                //check weather the data is available or not
                $count = mysqli_num_rows($res);
                //check weather we have admin data or not
                if($count==1)
                {
                    //Get the details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $Full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>



        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text"name="full_name" value="<?php echo $Full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                    <input type="text"name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name ="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>


        </form>

    </div>

</div>

<?php 

         //check weather the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Button Clicked";
            //Get all the values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            //Create SQL query to update admin
            $sql="UPDATE tbl_admin SET
            full_name ='$full_name',
            username ='$username' 
            WHERE id='$id'
            ";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Check weather the query executed successfully or not
            if($res==true)
            {
                //Query executed and Admin updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //Failed to update Admin
                $_SESSION['update'] = "<div class='error'>Failed to update Admin. Try Again Later</div>";
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

?>


<?php include('partials/footer.php'); ?>