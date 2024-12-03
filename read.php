<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(ytrim($_GET["id"]))){
    // Inlcude config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt = $mysqli ->prepare($sql)){
        // Blind variables to the preapred statement as paramters
        $stmt->blind_param("i", $param_id);

        // Set paramters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                /* Fetch result rows as an associative array. Since thr result set contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);


                // Retrieve individual field value
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    $stmt->close();

    //Close connection
    $mysqli->close();
} else{
    // URL doesn't contain valid id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CREATE RECORD</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .wraper{
                width: 600px;
                margin: 0 auto;
            }
        </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class= "row">
                <div class="col-md-12">
                    <h2 class="mt-5">VIEW RECORD</h2>
                    <p>Please fill this form and submit to add employee record to the databese.</p>
                    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                    <span class ="invalid-feedback"><?php echo $name_err;?></span>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                                    <span class ="invalid-feedback"><?php echo $address_err;?></span>
                                </div>  
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                                    <span class ="invalid-feedback"><?php echo $salary_err;?></span>
                                </div>  
                                <input type="submit" class="btn-primary" value="Submit">
                                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
                </div>
            </div>
        </div>
     </div>
</body>
</html>
       
