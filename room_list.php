<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS (with Popper) -->
    <style>
        /* Apply linear gradient background to the entire body */
        body {
            padding-top: 50px;
            background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Gradient background */
            color: white; /* Ensure text is visible over the gradient */
        }

        /* Navbar adjustments */
        .navbar {
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            background: linear-gradient(45deg, #3c3c3c, #6a7480); /* Semi-transparent navbar */
        }

        .navbar .navbar-title {
            font-size: 30px;
            position: absolute;
            left:38%;
            top: 25px;
            transform: translateZ(0%);
            color: black; /* Title color */
            text-shadow: 2px 2px 4px #3a4452;
        }
        .navbar-toggler {
            margin-left: auto;
            box-shadow: -10px -10px 10px 10px #3a4452;
            background: linear-gradient(45deg, #3c3c3c, #6a7480);
        }
        .navbar-toggler:hover{
            font-size: 20px;
            transform: translate(2px , 1px);
            box-shadow: -10px -10px 10px 10px #3a4452;
            
        }

        /* Search container */
        .search-container {
           position: relative;
        
        }

        .search-input::placeholder{
            color:whitesmoke;
        }
        .search-input {
            width: 100%;
            max-width: 250px;
            float: right;
            margin-bottom: 10px;
            margin-right: 30px;
        }
        .search-input{
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 100%, .7);
            backdrop-filter: blur(16px);
            padding: 10px;
        }

        /* Room List Section */
        #roomList {
            padding: 20px;
            margin: 10px;
        }

        /* Table styling */
        .table {
            text-align: center;
            width: 100%;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        /* Navbar links styling */
        .navbar-nav .nav-link {
            color: black;
            text-shadow: 2px 2px 4px #3a4452;
        }

        .navbar-nav .nav-link.active {
            color: black;
            font-size: 25px; /* Active link color */
        }
        .container{
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 50%, .7);
            backdrop-filter: blur(16px);
            padding-top: 60px;
        }
        .transparent-table {
  background-color: rgba(255, 255, 255, 0.1); /* Lightly transparent background */
  border-collapse: none; /* Ensures clean borders */
  color: #fff; /* White text for visibility on dark backgrounds */
}

.transparent-table th, 
.transparent-table td {
  border: 1px solid rgba(255, 255, 255, 0.2); /* Subtle border for clarity */
  padding: 8px; /* Space witf456eells */
}

.transparent-table th {
    color: #1f456e;
    background-color: rgba(0, 0, 0, 0.5); /* Slightly darker background for headers */
}

.transparent-table td{
    background-color: #3a4452;
    color: wheat;
}

.table-bordered {
    border: 1px solid white;
   
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 100%, .7);
}
img {
  height: 80px;
  position: relative;
  box-shadow: -10px -10px 10px 10px #3a4452;
  border-radius: 50%;
  
}
button{
        background: linear-gradient(45deg, #0a0a0a, #3a4452);
        
      }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="#"><img src="./image/logo.png" alt=""> </a>
        
        <!-- Room List Title -->
        <h4 class="navbar-title">Room List</h4>

        <!-- Navbar Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="list_student.php">Student List</a></li>
                <li class="nav-item"><a class="nav-link" href="subject_list.php">Subject List</a></li>
                <li class="nav-item"><a class="nav-link active" href="room_list.php">Room List</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="search-container">
        <!-- Search Bar -->
        <input type="text" id="searchInput" class="form-control search-input" placeholder="Search by Room ID or Name" onkeyup="fetchRooms()">
    </div>

    <!-- Room List -->
    <div id="roomList">
        <!-- Dynamic content from PHP will be inserted here -->
    </div>
</div>

<script>
    // Function to fetch and display rooms dynamically
    function fetchRooms() {
        const searchTerm = $('#searchInput').val(); // Get search term from input

        // Axios GET request
        axios.get('./fetch_room.php', {
            params: { search: searchTerm }
        })
        .then(response => {
            // Insert the PHP response (HTML table) into the #roomList container
            $('#roomList').html(response.data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            $('#roomList').html('<div class="alert alert-danger">Failed to load rooms.</div>');
        });
    }

    // On page load, fetch all rooms
    $(document).ready(function() {
        fetchRooms();
    });
</script>

</body>
</html>
