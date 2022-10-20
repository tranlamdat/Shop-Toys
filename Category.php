   <?php 
        if(isset($_SESSION["admin"]))
        {
            if($_SESSION["admin"]!=1)
            {
                 echo "<script>alert('You are not administrator')</script>";
                 echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
            else{
    ?>
        
   <!-- Bootstrap -->
    <script>
        function deleteConfirm() {
            if (confirm("Are you sure to delete")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <?php
    include_once("connection.php");
    if (isset($_GET["function"]) == "del") {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            pg_query($Connect, "DELETE FROM Category WHERE CategoryID = '$id'");
        }
    }
    ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <form name="frm" method="post" action="">
        <h1>Product Category</h1>
        <p>
            <img src="images/add.png" alt="Add new" width="16" height="16" border="0" /> <a href="?page=add_category"> Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>

            <tbody>
                <?php
                include_once("connection.php");
                $No = 1;
                $result = pg_query($Connect, "SELECT * FROM Category");
                while ($row = pg_fetch_array($result)) {

                ?>


                    <tr>

                        <td class="cotCheckBox"><?php echo $No; ?></td>
                        <td><?php echo $row["CategoryName"]; ?></td>
                        <td><?php echo $row["Description"]; ?></td>
                        <td style='text-align:center'>
                            <a href="?page=update_category&&id=<?php echo $row["CategoryID"]; ?>"><img src='images/edit.png' border='0' />
                        </td>
                        <td style='text-align:center'>
                            <a href="?page=category&&function=del&&id=<?php echo $row["CategoryID"]; ?>" onclick="return deleteConfirm()">
                                <img src='images/delete.png' border='0' />
                            </a>
                        </td>
                    </tr>
                <?php
                    $No++;
                }
                ?>

            </tbody>
        </table>


        <!--Nut them moi nut xoa tat ca->
        <div class="row" style="background-color:#FFF"><!--Nut chuc nang-->
        <div class="col-md-12">

        </div>
        </div>
        <!--Nut chuc nang-->
    </form>
    <?php
            }
        }
        else
        {
            echo "<script>alert('You are not administrator')</script>";
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        }
    ?>