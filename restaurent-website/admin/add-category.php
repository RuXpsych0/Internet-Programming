<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);

            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);

            }

        ?>

        <br><br>

        <!-- Add category form starts -->
        <form action=""method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
             
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text"name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio"name="featured" value="Yes"> Yes
                        <input type="radio"name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio"name="active" value="Yes"> Yes
                    <input type="radio"name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit"name="submit" value="Add Category" class="btn-secondary"> 
                    </td>
                </tr>

            </table>
        </form>
        <!-- Add category form ends -->

        <?php 
        
            //Checked wheather the sbmit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the value from Category form
                $title = $_POST['title'];

                //for Radio input, we need to check wheather the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set the default value
                    $featured = "NO";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "NO";
                }

                //check wheather the image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);

                //die();//break the code here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the image
                    //To upload image we need image name, source path, destination path
                    $image_name = $_FILES['image']['name'];

                    //upload image only if image is selected
                    if($image_name != "")
                    {

                        //Auto rename our image
                        //Get the extension of our image (jpg, png, gif, etc) e.g. "food1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "food_category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check wheather the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't upload the image and set the image_name value as blank
                    $image_name="";
                }

                //2. Create SQL Query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute the query and save in dataase
                $res = mysqli_query($conn, $sql);

                //4. check wheather the query executed or not and data added or not
                if($res==true)
                {
                    //Query executed and category added
                    $_SESSION['add']= "<div class='success'>Category Added Successfully.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to add category
                    $_SESSION['add']= "<div class='error'>Failed to Add Category.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>