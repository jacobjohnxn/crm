<?php
include('connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit();
    }
    
    $stmt = $conn->prepare("SELECT * FROM user WHERE uemail = ?");
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['upassword'])) {
            $_SESSION['urole'] = $row['urole'];
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['email'] = $email;

            $role = (int)$row['urole'];
            if ($role === 1) {
                header("Location: /crm/components/adminhome.php");
                exit();
            } elseif ($role === 2) {
                header("Location: /crm/components/home1.php");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        } else {
            echo "Login failed. Invalid email or password.";
        }
    } else {
        echo "Login failed. Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="">
      <div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
        <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
          <div>
            <h2 class="text-6xl  font-extrabold  text-purple-800">
              H-crm
            </h2>
            <p class="text-xl mt-6 text-gray-800">manage customers easily</p>
          </div>

          <form method="post" class="max-w-md md:ml-auto w-full">
            <h3 class="text-gray-800 text-3xl font-extrabold mb-8">
              Sign in
            </h3>

            <div class="space-y-4">
              <div>
                <input type="email" name="email" autocomplete="email" required class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent" placeholder="Email address" />
              </div>
              <div>
                <input type="password" name="password" id="password" autocomplete="current-password" required class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent" placeholder="Password" />
              </div>
              <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                  <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>
                <div class="text-sm">
                  <a href="jajvascript:void(0);" class="text-blue-600 hover:text-blue-500 font-semibold">
                    Forgot your password?
                  </a>
                </div>
              </div>
            </div>

            <div class="!mt-8">
              <button name="login" type="sumbit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-purple-600 hover:bg-purple-700 focus:outline-none">
                Log in
              </button>
            </div>
            
           
          </form>
        </div>
      </div>
    </div>

    </body>
</html>