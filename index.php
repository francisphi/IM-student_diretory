<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 
    <link rel="stylesheet" href="css/login.css">
    <title>Login form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <img class="logo" src="./image/logo.png" alt="">
    <img  class="logo1" src="./image/logo.png" alt="">



    <div class="login"> 
    <h2>Student Directory System</h2>
        <form class="login__form" id="loginForm">
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
                <div class="login__box">
                    <input type="text" placeholder="Username" required class="login__input" id="email" autocomplete="email">
                </div>

                <div class="login__box">
                    <input type="password" placeholder="Password" required class="login__input" id="password">
                    <span class="password-toggle" onclick="PasswordVisibility()">
                        <i class="fas fa-eye-slash"></i>
                    </span>  
                </div>
            </div>

            
            <button type="submit" class="login__button">Login</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Handle form submission using Axios
            $('#loginForm').on('submit', function (event) {
                event.preventDefault();

                const login = $('#email').val();
                const password = $('#password').val();

                // Prepare data to send via Axios
                const data = {
                    std_id: login,  // Send the email as std_id
                    password: password
                };

                // Debugging: Check the data being sent
                console.log('Sending data:', data);

                // Make POST request with Axios
                axios.post('login_check.php', data)
                    .then(response => {
                        // Check if response is successful
                        if (response.data.status === 'success') {
                            // Successful login
                            if (response.data.role === 'admin') {
                                // Redirect to admin's home page
                                Swal.fire({
                                    title: "Login Successful!",
                                    text: "Welcome, Admin.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = "home.php"; // Admin redirect
                                });
                            } else if (response.data.role === 'student') {
                                // Redirect to student's profile page
                                Swal.fire({
                                    title: "Login Successful!",
                                    text: "Welcome back, Student.",
                                    icon: "success"
                                }).then(() => {
                                    window.location.href = "student_form.php"; // Student redirect
                                });
                            }
                        } else {
                            // Failed login
                            Swal.fire({
                                title: "Error!",
                                text: response.data.message,
                                icon: "error"
                            });
                        }
                    })
                    .catch(error => {
                        // Handle any errors from the request
                        console.error('Error:', error);
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong. Please try again later.",
                            icon: "error"
                        });
                    });
            });
        });

        // Toggle password visibility
        function PasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const passwordToggle = document.querySelector(".password-toggle i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passwordInput.type = "password";
                passwordToggle.classList.replace("fa-eye", "fa-eye-slash");
            }
        }
    </script>
</body>
</html>
