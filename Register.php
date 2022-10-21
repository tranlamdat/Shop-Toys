<link rel="stylesheet" type="text/css" href="style1.css" />
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js" />
</script>
<script src="js/jquery.dataTables.min.js" />
</script>
<script src="js/dataTables.bootstrap.min.js" />
</script>
<?php
if (isset($_POST['btnRegister'])) {
    $us = $_POST['txtUsername'];
    $pass1 = $_POST['txtPass1'];
    $email = $_POST['txtEmail'];
    $tel = $_POST['txtTel'];

    if (isset($_POST['grpRender'])) {
        $sex = $_POST['grpRender'];
    }

    $day = $_POST['slDay'];
    $month = $_POST['slMonth'];
    $year = $_POST['slYear'];

    $err = "";
    if ($us == "" || $pass1 == "" || $pass2 == "" || $email == "" || !isset($sex)) {
        $err .= "<li> Enter fileds with marks(*), please</li>";
    }
    if (strlen($pass1) <= 5) {
        $err .= "<li>Password must be greater than 5 chars</li>";
    }
    if (strlen( $email) <= 5) {
        $err .= "<li>Enter your email, please</li>";
    }
    if (strlen( $tel) <= 5) {
        $err .= "<li>Enter your telephne, please</li>";
    }
    if ($_POST['slYear'] == "0") {
        $err .= "<li> Choose Years of Birth, please</li>";
    }
    if ($err != "") {
        echo $err;
    } else {
        include_once("connection.php");
        $pass = md5($pass1);
        $sq = "SELECT * FROM user WHERE UserName = '$us' OR Email = '$email'";
        $res = pg_query($Connect, $sq);
        if (pg_num_rows($res) == 0) {
            pg_query($Connect, "INSERT INTO user (Username, Pass, Email, Telephone, Gender, CusDay, CusMonth, CusYear, Roles)
                                    VALUES ('$us', '$pass', '$email', '$tel', '$day', '$month', '$year', 1)");
            echo "You have registered successfully";
        } else {
            echo "Username or email already exists";
        }
    }
}
?>
<div class="container">
    <h2>Member Registration</h2>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
    <div class="form-group">
        <div class="form-group">

            <label for="txtTen" class="col-sm-2 control-label">Username(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" value="" />
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Password(*): </label>
            <div class="col-sm-10">
                <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password" />
            </div>
        </div>

        <div class="form-group">
            <label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email" />
            </div>
        </div>

        <div class="form-group">
            <label for="lblDienThoai" class="col-sm-2 control-label">Telephone(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtTel" id="txtTel" value="" class="form-control" placeholder="Telephone" />
            </div>
        </div>

        <div class="form-group">
            <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*): </label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="grpRender" value="0" id="grpRender" />
                    Male</label>

                <label class="radio-inline"><input type="radio" name="grpRender" value="1" id="grpRender" />

                    Female</label>

            </div>
        </div>

        <div class="form-group">
            <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*): </label>
            <div class="col-sm-10 input-group">
                <span class="input-group-btn">
                    <select name="slDate" id="slDate" class="form-control">
                        <option value="0">Choose Day</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slMonth" id="slMonth" class="form-control">
                        <option value="0">Choose Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }

                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slYear" id="slYear" class="form-control">
                        <option value="0">Choose Year</option>
                        <?php
                        for ($i = 1970; $i <= 2020; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register" />

            </div>
        </div>
    </form>
</div>