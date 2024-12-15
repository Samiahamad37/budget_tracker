<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Budget Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background: #f8f9fa;
        }
        .balance {
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Personal Budget Tracker</h1>
    <form method="POST">
        <label for="type">Transaction Type</label>
        <select id="type" name="type" required>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="E.g., Salary, Rent" required>

        <label for="amount">Amount</label>
        <input type="number" id="amount" name="amount" step="0.01" placeholder="E.g., 500.00" required>

        <button type="submit">Add Transaction</button>
    </form>

    <?php
    // Initialize session to store transactions
    session_start();

    if (!isset($_SESSION['transactions'])) {
        $_SESSION['transactions'] = [];
    }

//     // Handle form submission
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $type = $_POST['type'];
//         $description = htmlspecialchars($_POST['description']);
//         $amount = (float) $_POST['amount'];

//         // Add transaction to session
//         $_SESSION['transactions'][] = [
//             'type' => $type,
//             'description' => $description,
//             'amount' => $amount
//         ];
//     }

//     // Calculate balance and display transactions
//     $balance = 0;
//     echo '<table>';
//     echo '<tr><th>Type</th><th>Description</th><th>Amount</th></tr>';

//     foreach ($_SESSION['transactions'] as $transaction) {
//         $amount = $transaction['amount'];
//         if ($transaction['type'] === 'income') {
//             $balance += $amount;
//         } else {
//             $balance -= $amount;
//         }

//         echo '<tr>';
//         echo '<td>' . ucfirst($transaction['type']) . '</td>';
//         echo '<td>' . $transaction['description'] . '</td>';
//         echo '<td>' . number_format($amount, 2) . '</td>';
//         echo '</tr>';
//     }

//     echo '</table>';

//     echo '<div class="balance">Balance: $' . number_format($balance, 2) . '</div>';
//     ?>
// </div>
// </body>
// </html> -->




















// <?php
// include('db.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
//     $confirm_password=$_POST['confirm_password'];

    
//     if ($password !== $confirm_password) {
//         $error="Password do not match";
//     } else  {
//         // check if email arleady exist
//         $stmt = $conn->prepare("SELECT COUNT(*)FROM users where email =?");
//         $stmt->execute([$email]);
//         $emailExists=$stmt->fetchColumn();

//         if ($emailExists) {
//             $error = "This email or username has arleady Exists!";
//         }else {
//             $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        

//          $sql = "INSERT INTO users (username, email,  password, confirm_password) VALUES (?, ?, ?, ?)";
//          $stmt = $conn->prepare($sql);
//          // $stmt->bind_param("ssss", $username,$email,  $password, $confirm_password);
//          $stmt->bind_param("ssss", $username, $email, $password, $confirm_password);

//           if ($stmt->execute()) {
//               echo "Registration successful!";
//             } else {
//                echo "Error: " . $stmt->error;
//             }

//           $stmt->close();
//           $conn->close();
  
//         }
//     }
// }
 










