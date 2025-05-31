<?php
$errors = array();

/*--------------------------------------------------------------*/
/* Function for Remove escapes special characters in a string for use in an SQL statement
/*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con, $str);
  return $escape;
}

/*--------------------------------------------------------------*/
/* Function for Remove HTML characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  // Ensure $str is a string before applying nl2br and htmlspecialchars
  if (is_string($str)) {
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  }
  return $str;
}

/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-', " ", $str);
  $val = ucfirst($val);
  return $val;
}

/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if (empty($val)) {
      $errors[] = $field . " can't be blank."; // Store multiple errors
    }
  }
  return $errors; // Return the errors array
}

/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo display_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg = ''){
   $output = "";
   // Make sure msg is a string before applying functions like nl2br or remove_junk
   if (is_array($msg)) {
       $msg = implode('<br>', $msg); // Convert array to string if it's an array
   }
   $msg = remove_junk($msg); 
   if (!empty($msg)) {
      $output .= "<div class=\"alert alert-danger\">";
      $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
      $output .= remove_junk(first_character($msg));
      $output .= "</div>";
   }
   return $output;
}

/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}

/*--------------------------------------------------------------*/
/* Function for finding total selling price, buying price, and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
   }
   $profit = $sum - $sub;
   return array($sum, $profit);
}

/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if ($str) {
         return date('F j, Y, g:i:s a', strtotime($str));
     } else {
         return null;
     }
}

/*--------------------------------------------------------------*/
/* Function for making date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}

/*--------------------------------------------------------------*/
/* Function for Counting unique IDs
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}

/*--------------------------------------------------------------*/
/* Function for Creating a random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str = '';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for ($x = 0; $x < $length; $x++) {
    $str .= $cha[mt_rand(0, strlen($cha) - 1)]; // Fix random index range
  }
  return $str;
}

?>
