<?php

function handleFormSubmission($conn) {
    if (
        isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        !empty($_POST['username']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password'])
    ) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "<p>Data inserted successfully!</p>";
        } else {
            echo "<p>Error inserting data: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

function getUsers($conn) {
    $sql = "SELECT id, username, email, birthdate, registration_date FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Users:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Birthdate</th><th>Registration Date</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["birthdate"] . "</td>";
            echo "<td>" . $row["registration_date"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }
}

function updateUser($conn, $userId, $newUsername) {
    $sql = "UPDATE users SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newUsername, $userId);

    if ($stmt->execute()) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Error updating user: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

function deleteUser($conn, $userId) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Error deleting user: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>
