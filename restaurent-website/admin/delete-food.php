<?php //echo "delete food page";

    //Include Constants File
    include('../config/constants.php');



    if(isset($_GET['id']) && isset($_GET['image_name']) )
    {
        //process to delete
        //echo "process to delete";

        //1.get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.remove the image if available
        //check whether the image is available or not and delete only if available
        //4.redirect to manage food with message

        if($image_name != "")
        {
            //image is available. so, remove it
            $path = "../images/food/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['upload'] = "<div class='error'>Failed to remove Category Image File.</div>";
                //redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process
                die();
            }


        }
        //3.delete food from database
        //sql query to delete data from databasw
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from database or not
        if($res==true)
        {
            //Food detected message and redirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            //Fail to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //redirect to manage food page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-food.php');

    }

?>