<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.
  $fnameErr= $lnameErr = $emailErr = $userErr = "";
  $fname = $lname = $email = $user = "";
  $errors = array();
  $form = "";

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

  if (is_post_request()) {
    // Confirm that POST values are present before accessing them.
    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    if (is_blank($_POST["fname"])) {
        $fnameErr = "Frist Name is required";
    } else {
        $fname = h($_POST["fname"]);
        if(!has_length($fname,array(2,255))){
            $fnameErr = "First name should be more than 2 chars and less than 255 chars";
        }
    }
    if(!is_blank($fnameErr)){
      array_push($errors,h($fnameErr));
    }

    if (is_blank($_POST["lname"])) {
        $lnameErr = "Last Name is required";
    } else {
        $lname = h($_POST["lname"]);
        if(!has_length($lname,array(2,255))){
            $lnameErr = "Last name should be more than 2 chars and less than 255 chars";
        }
    }
    if(!is_blank($lnameErr)){
      array_push($errors,h($lnameErr));
    }

    if (is_blank($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = h($_POST["email"]);
        if(!has_length($lname,array(1,255)) || !has_valid_email_format($email)) {
            $emailErr = "Invalid email format or email length is more than 255 chars";
        }
    }
    if(!is_blank($emailErr)){
      array_push($errors,h($emailErr));
    }

    if (is_blank($_POST["user"])) {
        $userErr = "Username is required";
    } else {
        $user = h($_POST["user"]);
        if(!has_length($user,array(8,255))){
            $userErr = "Username should be more than 8 chars and less than 255 chars";
        }
    }
    if(!is_blank($userErr)){
      array_push($errors,h($userErr));
    }

    // if there were no errors, submit data to database
    if(empty($errors)){
      // Write SQL INSERT statement
      $date = date("Y-m-d H:i:s");
      $sql = "INSERT INTO users (ID,first_name, last_name, email, username, created_at) 
             VALUES(NULL,'$fname','$lname','$email','$user','$date')";
      
      // For INSERT statments, $result is just true/false
      $result = db_query($db, $sql);
      if($result) {
        // TODO redirect user to success page
        redirect_to("registration_success.php");
        db_close($db);
      } else {
        // The SQL INSERT statement failed.
        // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        exit;
      }
    }
  }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>
  
  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    if (is_post_request()){
      $form = display_errors($errors);
      echo $form;
    }
  ?>

  <!-- TODO: HTML form goes here -->
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    First Name: <input type="text" name="fname" value="<?php echo $fname;?>">
    <span class="error">* </span>
    <br><br>
    Last Name: <input type="text" name="lname" value="<?php echo $lname;?>">
    <span class="error">* </span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* </span>
    <br><br>
    Username: <input type="text" name="user" value="<?php echo $user;?>">
    <span class="error">* </span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
