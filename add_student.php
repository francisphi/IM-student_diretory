<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
     .navbar-nav .nav-link {
            color: black;
            text-shadow: 2px 2px 4px #3a4452;
        }

        .navbar-nav .nav-link.active {
            font-size: 25px;
            color: solid black; /* Active link color */
        }
body {
    
    margin: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Apply gradient to the body */
    color: white; /* Consistent text color */
}

.student_form {
    position:relative;
    width: 100%;
    max-width: 500px;
    padding: 20px;
    background-color: hsla(0, 0%, 100%, .01); /* Transparent background with blur */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
    border: 2px solid hsla(0, 0%, 80%, .7); /* Border style similar to buttons */
    backdrop-filter: blur(16px); /* Blur for glassmorphic effect */
    color: white; /* Match text color */
    margin-top: 110px; /* Add space below the navbar */
}

.student_form label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #1338be; /* Label text color */
    font-size: 18px; /* Responsive font size */
}

.student_form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid hsla(0, 0%, 100%, .7); /* Similar border styling */
    background-color: hsla(0, 0%, 50%, .01); /* Transparent input background */
    color: white; /* White text for input fields */
    border-radius: 4px;
    font-size: 16px; /* Match input font size */
}

.student_form input::placeholder {
    color: whitesmoke; /* Placeholder text color */
}

.student_form button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Button gradient */
    color: #1338be; /* Button text color */
    border: none;
    border-radius: 4px;
    font-size: 25px; /* Adjusted button font size */
    transition: background 0.3s, transform 0.2s;
    font-weight: bold;
}

.student_form button:hover {
    background: linear-gradient(45deg, #3a4452, #0a0a0a); /* Hover gradient */
    transform: scale(1.05); /* Subtle hover effect */
}

/* Navbar styles */
.navbar {
    font-size: 18px; /* Adjusted font size */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg, #3c3c3c, #6a7480); /* Navbar gradient */
    padding: 10px;
}

.navbar-title {
    position: absolute;
    left: 20%;
    transform: translateX(-50%);
    top: 30px;
    color: black;
    font-weight: bold;
    font-size: 30px; /* Adjust title font size */
    text-shadow: 2px 2px 4px #3a4452; /* Add shadow for depth */
}

.img1 {
  height: 80px;
  position: relative;
  box-shadow: -10px -10px 10px 10px #3a4452;
  border-radius: 50%;
}

/* Responsive Design Adjustments */
@media (max-width: 768px) {
    .student_form {
        width: 90%;
        margin-top: 60px;
        padding: 15px;
    }

    .student_form label {
        font-size: 16px;
    }

    .student_form input {
        font-size: 14px;
    }

    .student_form button {
        font-size: 18px;
    }

    .navbar-title {
        font-size: 20px;
    }

    .img1 {
        height: 50px;
    }
}

@media (max-width: 576px) {
    .student_form {
        width: 100%;
        padding: 10px;
    }

    .student_form button {
        font-size: 16px;
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
        <h4 class="navbar-title">Add Student</h4>

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
                    <a class="nav-link" href="#">Room List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Student Form -->
<form id="studentForm" class="student_form">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" required>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" required>
    <label for="mname" >Middle Name</label>
    <input type="text" name="mname" id="mname" placeholder="Optional">
    <label for="age">Age</label>
    <input type="number" name="age" id="age" required>
    <label for="contact_num">Contact Number</label>
    <input type="number" name="contact_num" id="contact_num" required>
    <label for="birth_date">Birth Date</label>
    <input type="date" name="birth_date" id="birth_date" required>
    <button type="submit" id="submit">Submit</button>
</form>

<script>
$(document).ready(function() {
    // Handle form submission
    $('#studentForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('fname', $('#fname').val());
        formData.append('lname', $('#lname').val());
        formData.append('mname', $('#mname').val());
        formData.append('age', $('#age').val());
        formData.append('contact_num', $('#contact_num').val());
        formData.append('birth_date', $('#birth_date').val());

        axios.post('./save_student.php', formData)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Student Added',
                    text: 'The student has been added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => location.reload());
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the student data.'
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
