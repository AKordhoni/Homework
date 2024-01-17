<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<?php
include 'dbconn.php';
include 'crud_operations.php';

if (isset($_FILES['userImage'])) {
    $uploadDir = 'C:\xampp\htdocs\homeworkdb';
    $uploadFile = $uploadDir . basename($_FILES['userImage']['name']);

    if (move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadFile)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleFormSubmission($conn);
}

getUsers($conn);
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="registrationForm">
    <label for="button">Button:</label>
    <input type="button" name="button" value="Click me">

    <label for="checkbox">Checkbox:</label>
    <input type="checkbox" name="checkbox" value="1"> Check me

    <label for="color">Color:</label>
    <input type="color" name="color" value="#ff0000">

    <label for="date">Date:</label>
    <input type="date" name="date">

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="example@example.com">

    <label for="file">File:</label>
    <input type="file" name="file">

    <label for="userImage">Upload Image:</label>
    <input type="file" name="userImage" accept="image/*">

    <label for="password">Password:</label>
    <input type="password" name="password">

    <label for="radio">Radio:</label>
    <input type="radio" name="radio" value="option1"> Option 1
    <input type="radio" name="radio" value="option2"> Option 2

    <label for="range">Range:</label>
    <input type="range" name="range" min="0" max="100" value="50">

    <label for="reset">Reset:</label>
    <input type="reset" value="Reset">

    <label for="submit">Submit:</label>
    <input type="submit" value="Submit">

    <label for="tel">Telephone:</label>
    <input type="tel" name="tel" placeholder="123-456-7890">

    <label for="text">Text:</label>
    <input type="text" name="text" placeholder="Enter text">

    <label for="time">Time:</label>
    <input type="time" name="time">

    <label for="textarea">Textarea:</label>
    <textarea name="textarea" rows="4" cols="50" placeholder="Enter text"></textarea>
</form>

</body>
</html>
