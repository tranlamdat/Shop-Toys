<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
    <?php
	include_once("connection.php");
	function bind_Category_List($conn, $selectValue)
	{
		$sqlstring = "SELECT Cat_ID, Cat_Name from category";
		$result = mysqli_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
					<option value='0'>Choose category</option>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			if ($row['Cat_ID'] == $selectValue) {
				echo "<option value='" . $row['Cat_ID'] . "' selected>" . $row['Cat_Name'] . "</option>";
			} else {
				echo "<option value='" . $row['Cat_ID'] . "'>" . $row['Cat_Name'] . "</option>";
			}
		}
		echo "</select>";
	}
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$sqlstring = "SELECT Product_Name, Price, SmallDesc, DetailDesc, ProDate, Pro_qty, Pro_image, Cat_ID
						FROM product WHERE Product_ID = '$id'";
		$result = mysqli_query($conn, $sqlstring);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$proname = $row["Product_Name"];
		$short = $row["SmallDesc"];
		$detail = $row["DetailDesc"];
		$price = $row["Price"];
		$qty = $row["Pro_qty"];
		$pic = $row["Pro_image"];
		$category = $row["Cat_ID"];
	?>
    	<div class="container">
    		<h2>Updating Product</h2>

    		<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
    			<div class="form-group">
    				<label for="txtTen" class="col-sm-2 control-label">Product ID(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" readonly value='<?php echo $id; ?>' />
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proname; ?>' />
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="" class="col-sm-2 control-label">Product category(*): </label>
    				<div class="col-sm-10">
    					<?php
						bind_Category_List($conn, $category);
						?>
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>' />
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="lblShort" class="col-sm-2 control-label">Short description(*): </label>
    				<div class="col-sm-10">
    					<input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='<?php echo $short ?>' />
    				</div>
    			</div>

    			
    		

    			<div class="form-group">
    				<label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
    				<div class="col-sm-10">
    					<input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty ?>" />
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="sphinhanh" class="col-sm-2 control-label">Image(*): </label>
    				<div class="col-sm-10">
    					<img src='images/<?php echo $pic; ?>' border='0' width="50" height="50" />
    					<input type="file" name="txtImage" id="txtImage" class="form-control" value="" />
    				</div>
    			</div>

    			<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
    					<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
    					<input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=product_management'" />

    				</div>
    			</div>
    		</form>
    	</div>

    <?php
	} else {
		echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
	}
	?>
    <?php
	if (isset($_POST["btnUpdate"])) {
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$short = $_POST["txtShort"];
		$price = $_POST["txtPrice"];
		$qty = $_POST["txtQty"];
		$pic = $_FILES["txtImage"];
		$category = $_POST["CategoryList"];
		$err = "";

		if (trim($id) == "") {
			$err .= "<li>Enter product ID, please</li>";
		}
		if (trim($proname) == "") {
			$err .= "<li>Enter product Name, please</li>";
		}
		if ($category == "0") {
			$err .= "<li>Choose product category, please</li>";
		}
		if (!is_numeric($price)) {
			$err .= "<li>Product price must be number</li>";
		}
		if (!is_numeric($qty)) {
			$err .= "<li>Product quantity must be number</li>";
		} else {
			if ($pic['name'] != "") {
				if ($pic["type"] == "image/jpg" || $pic["type"] == "image/jpeg" || $pic["type"] == "image/png" || $pic["type"] == "image/gif") {
					if ($pic["size"] < 614400) {
						$sq = "SELECT * FROM product WHERE Product_ID = '$id' or Product_Name = '$proname'";
						$result = mysqli_query($conn, $sq);
						if (mysqli_num_rows($result) == 0) {
							copy($pic['tmp_name'], "img/" . $pic['name']);
							$filePic = $pic['name'];
							$sqlstring = "UPDATE product SET 
							Product_Name ='$proname', Price='$price', SmallDesc='$short', 
							DetailDesc='$detail', Pro_qty='$qty',
							Pro_image='$filePic', Cat_ID='$category',
							ProDate='".date('Y-m-d H:i:s')."' WHERE Product_ID='$id'";
							mysqli_query($conn, $sqlstring);
							echo '<meta http-equiv="refresh" content = "0; URL=?page=product_management"/>';
						} else {
							echo "<li>Duplicate product ID or Name</li>";
						}
					} else {
						echo "Size of image too big";
					}
				} else {
					echo "Image format is not correct";
				}
			} else {
				$sq = "SELECT * FROM product WHERE Product_ID != '$id' and Product_Name = '$proname'";
				$result = mysqli_query($conn, $sq);
				if (mysqli_num_rows($result) == 0) {
					// copy($pic['tmp_name'], "img/" . $pic['name']);
					$filePic = $pic['name'];
					$sqlstring = "UPDATE product SET Product_Name ='$proname', 
					Price='$price', SmallDesc='$short', DetailDesc='$detail', 
					Pro_qty='$qty', Cat_ID='$category',
					ProDate='".date('Y-m-d H:i:s')."' WHERE Product_ID='$id'";
					mysqli_query($conn, $sqlstring);
					echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
				} else {
					echo "<li>Duplicate category ID or Name</li>";
				}
			}
		}
	}
	?>