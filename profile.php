<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Welcome to Your Profile</h1>
    <table>
        <tr>
            <th>Book Name</th>
            <th>Latest Issue Date</th>
        </tr>
        <tr>
            <td><?php echo isset($_GET['book']) ? htmlspecialchars($_GET['book']) : ''; ?></td>
            <td><?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?></td>
        </tr>
    </table>
</body>
</html>