<?php include('partials/menu.php');?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //checking weather the session is set or not
            {
                echo $_SESSION['add']; //Displaying Session message if set
                unset($_SESSION['add']); //Removing Session message
            }
        ?>

        <form action="" method="POST">

        <table class="tabl-30"> 
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name">
            </td>
               

</tr> 
<tr> 
    <td>Username:</td>
    <td>
        <input type="text" name="username" placeholder="Your Username">
    </td>
</tr> 
<tr>
    <td>Password:</td>
    <td> 
        <input type="password" name="password" placeholder="Your Password">
</td>
</tr> 
<tr> 
    <td colspan="2">  
        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">


</td>
</tr>
</table>
        </form>

    </div>
</div>

<?php include('partials/footer.php');?>

<?php 
    //Process the value from Form and Save it in Database
    //Check weather the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo "Button clicked";

        //1.Get the Data from Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = ($_POST['password']); // Password encription with MD5

        //2.sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

       //3. Executing query and saving Data into Database
       $res = mysqli_query($conn, $sql) or die(mysqli_error());

       //4. Check weather the (query is Executed) data is inserted or not and display appropiate message
       if($res==TRUE)
       {
            //Data Inserted
            //echo "Data Inserted";
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //Redirect page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');

       }
       else
       {
            //Failed to Insert Data
            //echo "Failed to Insert Data";
            //Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //Redirect page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
       }

    }
    
?>