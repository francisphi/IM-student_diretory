<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
  body {
    padding-top: 100px;
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Gradient for the body */
    color: white; /* Consistent text color */
}

.subject-form {
    width: 100%;
    max-width: 600px;
    padding: 20px;
    background-color: hsla(0, 0%, 100%, .01); /* Transparent with blur */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
    border: 2px solid hsla(0, 0%, 80%, .7); /* Similar border styling */
    backdrop-filter: blur(16px); /* Glassmorphic blur effect */
    margin-bottom: 70px;
    color: white; /* Text color inside the form */
}

.subject-form label {
    font-weight: bold;
    margin-bottom: 10px;
    color: #1338be; /* Label text color */
    font-size: 18px; /* Font size consistency */
}

.subject-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid hsla(0, 0%, 100%, .7); /* Transparent border */
    background-color: hsla(0, 0%, 50%, .01); /* Input transparent background */
    color: white; /* White text for input fields */
    border-radius: 4px;
    font-size: 16px;
}

.subject-form input::placeholder {
    color: whitesmoke; /* Placeholder text color */
}

.subject-form button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Gradient for button */
    color: #1338be; /* Button text color */
    border: none;
    border-radius: 4px;
    font-size: 18px; /* Adjusted font size */
    font-weight: bold; /* Make text bold */
    transition: background 0.3s, transform 0.2s; /* Smooth hover effect */
}

.subject-form button:hover {
    background: linear-gradient(45deg, #3a4452, #0a0a0a); /* Inverted gradient */
    transform: scale(1.05); /* Subtle hover scaling */
}

/* Navbar styles */
.navbar {
    font-size: 18px; /* Adjust font size */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 10;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg, #3c3c3c, #6a7480); /* Navbar gradient */
    padding: 10px;
}

.navbar-title {
    position: absolute;
    left: 20%;
    transform: translateX(-50%);
    top: 35px;
    color: black;
    text-shadow: 2px 2px 4px #3a4452; /* Add depth */
    font-weight: bold;
    font-size: 25px;
}
.img1 {
  height: 80px;
  position: relative;
  box-shadow: -10px -10px 10px 10px #3a4452;
  border-radius: 50%;
}
.navbar-nav .nav-link {
            color: black;
            text-shadow: 2px 2px 4px #3a4452;
        }

        .navbar-nav .nav-link.active {
            font-size: 25px;
            color: solid black; /* Active link color */
        }


/* Responsive Design Adjustments */
@media (max-width: 768px) {
    .subject-form {
        width: 90%;
        padding: 15px;
    }

    .subject-form label {
        font-size: 16px;
    }

    .subject-form input {
        font-size: 14px;
    }

    .subject-form button {
        font-size: 16px;
    }

    .navbar-title {
        font-size: 20px;
    }
    
}
@media (max-width: 576px) {
    .subject-form {
        width: 100%;
        padding: 10px;
    }

    .subject-form button {
        font-size: 14px;
    }

    .navbar-title {
        font-size: 18px;
    }
    .img1 {
        height: 40px;
    }
}

</style>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="image/logo.png" alt="logo" class="img1"></a>
        <h4 class="navbar-title">Add Subject</h4>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="list_student.php">Student List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="subject_list.php">Subject List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="room_list.php">Room List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <form id="subjectForm" class="subject-form">
        <label for="s_code">Subject Code</label>
        <input type="text" id="s_code" name="s_code" placeholder="Add Subject Code" required>

        <label for="s_name">Subject Name</label>
        <input type="text" id="s_name" name="s_name" placeholder="Add Subject Name" required>

        <button type="submit">Add Subject</button>
    </form>

    <script>
    $(document).ready(function() {
    // Event listener for form submission
    $('#subjectForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the default way

        // Get the input values
        const subjectCode = $('#s_code').val().trim();
        const subjectName = $('#s_name').val().trim();

        // Validate input fields
        if (!subjectCode || !subjectName) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Subject Code and Subject Name are required.',
            });
            return; // Prevent sending empty data
        }

        // Prepare the data to be sent
        const data = {
            s_code: subjectCode,
            s_name: subjectName
        };

        // Send the data using Axios
        axios.post('./save_subject.php', data)
            .then(function(response) {
                // Check if the response contains an error message
                if (response.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.data.error,
                    });
                } else {
                    // Display success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Subject Saved',
                        text: 'The subject has been saved successfully!',
                        showConfirmButton: false,
                        timer: 1500 // Auto-close after 1.5 seconds
                    });

                    // Clear the form fields
                    $('#s_code').val('');
                    $('#s_name').val('');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);

                // Display error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the subject.',
                });
            });
    });

    // Navbar toggler logging
    $('.navbar-toggler').on('click', function() {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        console.log(isExpanded ? 'Navbar expanded' : 'Navbar collapsed');
    });
});

    </script>

<!-- Bootstrap JavaScript and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
