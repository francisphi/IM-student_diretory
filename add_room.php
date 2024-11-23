<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
    <style>
/* Body Styling */
/* Body Styling */
body {
    padding: 0; /* Removed the padding-top */
    height: 100vh; /* Full viewport height */
    margin: 0; /* Remove default margin */
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Gradient background */
    color: white; /* Text color */
}

/* Navbar Styling */
.navbar {
    font-size: 18px; /* Font size for navbar */
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

/* Navbar Title Styling */
.navbar-title {
    position: absolute;
    left: 20%;
    transform: translateX(-50%);
    top: 35px;
    color: black; /* Navbar title color */
    text-shadow: 2px 2px 4px #3a4452; /* Shadow effect */
    font-weight: bold;
    font-size: 25px; /* Title font size */
}

/* Form Container Styling */
.subject-form {
    width: 100%; /* Make sure the form takes up available width */
    max-width: 600px; /* Set a max-width */
    padding: 20px;
    background-color: hsla(0, 0%, 100%, .01); /* Transparent with blur */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
    border: 2px solid hsla(0, 0%, 80%, .7); /* Border styling */
    backdrop-filter: blur(16px); /* Glassmorphic blur effect */
    color: white; /* Text color inside the form */
}

/* Label Styling */
.subject-form label {
    font-weight: bold;
    margin-bottom: 10px;
    color: #1338be; /* Label text color */
    font-size: 18px; /* Font size consistency */
}

/* Input Styling */
.subject-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid hsla(0, 0%, 100%, .7); /* Transparent border */
    background-color: hsla(0, 0%, 50%, .01); /* Transparent background */
    color: white; /* White text for input fields */
    border-radius: 4px;
    font-size: 16px;
}

/* Placeholder Text Styling */
.subject-form input::placeholder {
    color: whitesmoke; /* Placeholder text color */
}

/* Button Styling */
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

/* Button Hover Effect */
.subject-form button:hover {
    background: linear-gradient(45deg, #3a4452, #0a0a0a); /* Inverted gradient */
    color: #1338be; /* Button text color on hover */
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


    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="#"><img src="image/logo.png" alt="logo" class="img1"></a>
        
        <h4 class="navbar-title">Add Room</h4>

        <!-- Navbar Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
                <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="list_student.php">Student List</a></li>
                <li class="nav-item"><a class="nav-link" href="subject_list.php">Subject List</a></li>
                <li class="nav-item"><a class="nav-link" href="room_list.php">Room List</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Form Container -->
<div class="form-container">
    <form id="roomForm" class="subject-form">
        <div class="mb-3">
            <label for="roomName" class="form-label ">Room Name</label>
            <input type="text" class="form-control" id="roomName" name="roomName" placeholder="Add room name" required>
        </div>
        <button type="button" class="btn btn-primary w-100" onclick="saveRoom()">Save Room</button>
    </form>
</div>

<script>
   function saveRoom() {
    const roomName = $('#roomName').val();

    // Validate input
    if (!roomName) {
        // Show error if the room name is empty
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Room name is required!',
        });
        return;
    }

    // Send POST request using Axios
    axios.post('./save_room.php', 
        { r_name: roomName }, 
        { headers: { 'Content-Type': 'application/json' } } // Setting the content type to JSON
    )
    .then(function(response) {
        // Show success message if room is added successfully
        Swal.fire({
            icon: 'success',
            title: 'Room Added!',
            text: 'The room has been successfully added.',
        });

        // Reset the form after successful submission
        $('#roomForm')[0].reset();
    })
    .catch(function(error) {
        // Show error message if the request fails
        Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: 'Failed to save room. Please try again.',
        });
        console.error('Error:', error);
    });
}

</script>


</body>
</html>
