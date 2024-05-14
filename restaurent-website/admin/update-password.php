<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                    <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value= "Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php 

            //Check weather the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the data from form
                $id=$_POST['id'];
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                //2. check weather the user with current ID and Current Pasword exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password= '$current_password'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //check weather data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //User exists and password can be changed
                        //echo "user found";
                        //check weather the new password and confirm password match or not
                        if($new_password==$confirm_password)
                        {
                            //update password
                            //echo "password match";
                            $sql2 = "UPDATE tbl_admin SET
                            password= '$new_password'
                            WHERE id=$id
                            ";

                            //Execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //check weather the query is executed or not
                            if($res2==true)
                            {
                                //Display success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Display error message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed To Change Password</div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }

                        }
                        else
                        {
                            //Redirect the User with error message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";
                            //Redirect the User
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //User does not exists set message and redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                        //Redirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //3.check weaher the new password and confirm password match or not

                //4. Change password if all above is true
            }

?>

<?php include('partials/footer.php');?>