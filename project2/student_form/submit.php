<?php
include 'db.php';

$first_name      = mysqli_real_escape_string($conn, $_POST['first_name']);
$last_name       = mysqli_real_escape_string($conn, $_POST['last_name']);
$email           = mysqli_real_escape_string($conn, $_POST['email']);
$mobile          = mysqli_real_escape_string($conn, $_POST['mobile']);
$gender          = mysqli_real_escape_string($conn, $_POST['gender']);
$address         = mysqli_real_escape_string($conn, $_POST['address']);
$city            = mysqli_real_escape_string($conn, $_POST['city']);
$pin_code        = mysqli_real_escape_string($conn, $_POST['pin_code']);
$state           = mysqli_real_escape_string($conn, $_POST['state']);
$country         = mysqli_real_escape_string($conn, $_POST['country']);
$course          = mysqli_real_escape_string($conn, $_POST['course']);
$class10_board   = mysqli_real_escape_string($conn, $_POST['class10_board']);
$class10_percent = mysqli_real_escape_string($conn, $_POST['class10_percent']);
$class10_year    = mysqli_real_escape_string($conn, $_POST['class10_year']);
$class12_board   = mysqli_real_escape_string($conn, $_POST['class12_board']);
$class12_percent = mysqli_real_escape_string($conn, $_POST['class12_percent']);
$class12_year    = mysqli_real_escape_string($conn, $_POST['class12_year']);
$grad_board      = mysqli_real_escape_string($conn, $_POST['grad_board']);
$grad_percent    = mysqli_real_escape_string($conn, $_POST['grad_percent']);
$grad_year       = mysqli_real_escape_string($conn, $_POST['grad_year']);
$masters_board   = mysqli_real_escape_string($conn, $_POST['masters_board']);
$masters_percent = mysqli_real_escape_string($conn, $_POST['masters_percent']);
$masters_year    = mysqli_real_escape_string($conn, $_POST['masters_year']);

$dob = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];

$hobbies = "";
if (!empty($_POST['hobbies'])) {
    $hobbies = implode(", ", $_POST['hobbies']);
}
if (!empty($_POST['other_hobby'])) {
    $hobbies .= ", " . mysqli_real_escape_string($conn, $_POST['other_hobby']);
}

$sql = "INSERT INTO students (
    first_name, last_name, dob, email, mobile, gender,
    address, city, pin_code, state, country, hobbies,
    class10_board, class10_percent, class10_year,
    class12_board, class12_percent, class12_year,
    grad_board, grad_percent, grad_year,
    masters_board, masters_percent, masters_year,
    course_applied
) VALUES (
    '$first_name', '$last_name', '$dob', '$email', '$mobile', '$gender',
    '$address', '$city', '$pin_code', '$state', '$country', '$hobbies',
    '$class10_board', '$class10_percent', '$class10_year',
    '$class12_board', '$class12_percent', '$class12_year',
    '$grad_board', '$grad_percent', '$grad_year',
    '$masters_board', '$masters_percent', '$masters_year',
    '$course'
)";

if (mysqli_query($conn, $sql)) {
    echo "<h2 style='color:green; text-align:center;'>Registration Successful!</h2>";
    echo "<p style='text-align:center;'><a href='index.html'>Go Back</a></p>";
} else {
    echo "<h2 style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</h2>";
}

mysqli_close($conn);
?>