<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS (with Popper) -->
    <style>
        /* Apply linear gradient background to the entire body */
        body {
            padding-top: 10px;
            background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Gradient background */
            color: white; /* Ensure text is visible over the gradient */
        }

        /* Fix navbar position */
        .navbar {
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            background: linear-gradient(45deg, #3c3c3c, #6a7480);/* Semi-transparent background for the navbar */
        }

        /* Add padding-top to body to prevent content from hiding under the navbar */
        body {
            padding-top: 80px; /* Adjusted for the fixed navbar height */
        }
        .navbar-toggler {
            margin-left: auto;
            box-shadow: -10px -10px 10px 10px #3a4452;
            background: linear-gradient(45deg, #3c3c3c, #6a7480);
        }
        .navbar-toggler:hover:active{
            font-size: 20px;
            transform: translate(2px , 1px);
            box-shadow: -10px -10px 10px 10px #3a4452;
            
        }
        
       

        /* Center the title in the navbar */
        .navbar .navbar-title {
            font-size: 30px;
            position: absolute;
            left: 38%;
            top: 25px;
            transform: translateZ(0%);
            color:black; /* Title text color */
            text-shadow: 2px 2px 4px #3a4452;
        }

        /* Adjustments to make sure the search input stays aligned to the right */
        .search-container {
            position: relative;
        }

        .search-input {
            width: 305px;
            float: right;
            margin-bottom: 10px;
            margin-right: 30px;
        }

        /* Ensure subject list section takes full available space */
        #subjectList {
            padding: 20px;
            margin-top: 20px;
        }

        /* Make the navbar links white */
        .navbar-nav .nav-link {
            color: black;
            text-shadow: 2px 2px 4px #3a4452;
        }

        .navbar-nav .nav-link.active {
            color: black; /* Active link color */
            font-size: 25px;
        }
        button{
        background: linear-gradient(45deg, #0a0a0a, #3a4452);
        
      }
      img {
  height: 80px;
  position: relative;
  box-shadow: -10px -10px 10px 10px #3a4452;
  border-radius: 50%;
  
}

.search-input{
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 100%, .7);
            backdrop-filter: blur(16px);
            padding: 10px;
        }
        .search-input::placeholder{
            color:whitesmoke;
        }
        .container{
            border: 1px solid white;
            background-color: hsla(0, 0%, 50%, .01);
            border: 2px solid hsla(0, 0%, 50%, .7);
            backdrop-filter: blur(16px);
            padding-top: 30px;
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
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Navbar Brand (Logo) -->
        <a class="navbar-brand" href="#"><img src="./image/logo.png" alt="logo"></a>
        
        <!-- Subject List Title -->
        <h4 class="navbar-title">Subject List</h4>

        <!-- Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links (Aligned to the right) -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_student.php">Student List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="subject_list.php">Subject List</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="room_list.php">Room List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="search-container">
        <!-- Search form -->
        <input type="text" id="searchInput" class="form-control search-input" placeholder="Search by Subject ID, Code or Name" onkeyup="fetchSubjects()">
    </div>

    <!-- Subject list table -->
    <div id="subjectList" class="mt-3">
        <!-- Subjects will be listed here -->
    </div>
</div>

<script>
    // Function to fetch and display subjects based on the search term
    function fetchSubjects() {
        var searchTerm = $('#searchInput').val(); // Get the search term from input field

        // Make an Axios GET request to fetch subjects from PHP
        axios.get('./fetch_subject.php', {
            params: {
                search: searchTerm // Send the search term as a query parameter
            }
        })
        .then(function(response) {
            // Insert the HTML result into the subjectList div
            $('#subjectList').html(response.data);
        })
        .catch(function(error) {
            console.error('Error fetching subject data:', error);
        });
    }

    // Initially load subjects when the page loads
    $(document).ready(function() {
        fetchSubjects(); // Fetch all subjects when the page loads
    });
</script>

</body>
</html>
