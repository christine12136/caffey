<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Prossecing form data when form is submitted
if($_SERVER["REQUEST_METHOD"]== "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err "Please enter a valid number.";
    } else{
        $name = $input_name;
    }

    // Validate addreess
    $input_adress = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }

    // Validate salry
    $input_salary = $trim($_POST['salary']);
    if (empty($input_salary)){
        $salary_err = "Please enter a salary amount.";
    } elseif (!ctype_digit($input_salary)){
        $salary_err = "Please enter a posiitve integer value.";
    } else(
        $salary = $input_salary;
    )
     
    // Check input errors before inseritng in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an innsert statement
        $sql = "INSERT INTO employess (name, address, salary) VALUES (?, ?, ?,)";

        if($stmt = $mysqli->prepare($sql)){
            // Blind variables to the prepared statement ass parameters
            $stmt->blind_param("sss", $param_name, $param_address, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            //AAttempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("Location: index.php");
                exit();
            } else{
                echo "Oops! something wnet wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
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
                    <h2 class="mt-5">CREATE RECORD</h2>
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
       