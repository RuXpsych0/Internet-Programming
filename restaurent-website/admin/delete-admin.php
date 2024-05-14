<?php 

    //include constants.php file here
    include('../config/constants.php');

    //1. get the IF of admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL query to Delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check weather the query executed successfully or not
    if($res==true)
    {
        //query executed successfylly and admin deleted
        //echo "Admin Deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage admin page
        header('location:'.SITEURL. 'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later</div>";
        header('location:'.SITEURL. 'admin/manage-admin.php');
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>