<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
    <style>
        /* Apply linear gradient background to the entire body */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(45deg, #0a0a0a, #3a4452); /* Your gradient */
            color: white; /* Ensure text is visible over the gradient */
        }

        /* Fixed navbar at the top */
        nav {
            font-weight: bold;
          font-size: 20px;
            color: black;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10; /* Ensure it stays above other content */
            background: linear-gradient(45deg, #3c3c3c, #6a7480); /* Add semi-transparent background */
        }

        /* Add space for the fixed navbar */
        .content {
            margin-top: 10px; /* Adjust this value based on the height of your navbar */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        /* Form styling */
        form {
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 50%, .7);
            width: 50%;
            backdrop-filter: blur(16px);
            padding: 10px;
        }

        /* Center the form content */
        .d-flex {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        /* Custom navbar container to center items */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background: linear-gradient(45deg, #3c3c3c, #6a7480);
        }

        /* Navbar Title Styling */
        .navbar-title {
            color: black;
            font-size: 25px;
            text-align: center;
            flex-grow: 1;
            text-shadow: 2px 2px 4px #3a4452;
            font-weight: bold;

        }

        /* Adjustments for navbar links */
        .navbar-nav {
            margin-left: auto;
            margin-right: 0;
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

        /* Custom button styling */
        .btn-danger {
            background-color: #c72c41;
            border-color: #c72c41;
        }
        .btn-danger:hover {
            background-color: #9a2131;
            border-color: #9a2131;
        }

        /* Link styling within buttons */
        .form-group a {
          font-size: 30px;
          text-decoration-color:#0492c2;
             text-decoration: none;
            text-shadow: 2px 2px 4px #3a4452;
            color: #0a1172;
            

        }
        .form-group a:hover {
            text-decoration: underline;
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
#add_stud , #add_room , #add_sub{
    cursor: pointer;
    background: linear-gradient(45deg, #0a0a0a, #3a4452);
    transition: background 0.3s;
    color:#0a1172;
    border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 80%, .7);
            backdrop-filter: blur(16px);
            font-size: 25px;
            font-weight: bold;
}
#add_stud:hover , #add_room:hover , #add_sub:hover{
    
    background: linear-gradient(45deg, #3a4452, #0a0a0a);
    
}
        
    </style>
</head>
<body>

<!-- Navbar fixed at the top -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <!-- Navbar logo -->
    <a class="navbar-brand" href="#"><img src="./image/logo.png" alt="logo"></a>

    <!-- Student Directory Title -->
    <h4 class="navbar-title">Student Directory System</h4>

    <!-- Navbar toggle button for small screens -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list_student.php">Student List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subject_list.php">Subject List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="room_list.php">Room List</a>
        </li>
        <!-- Logout Button -->
        <li class="nav-item">
          <button id="logout-btn" class="btn btn-danger nav-link ms-auto text-end" >Logout</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content area where the form is centered -->
<div class="content">
    <form class="d-flex align-items-center justify-content-center cell-padding-2"> 
        <div class="d-flex flex-column mb-3" align="center" style="width:100%; height:100%;">
            <button id="add_stud" class="form-group p-3 m-3" style="padding-bottom: 10px; width:60%;">
                <a href="add_student.php">Add Student</a>
            </button>
            <button id="add_sub" class="form-group p-3 m-3" style="padding-bottom: 10px; width:60%;">
                <a href="add_subject.php">Add Subject</a>
            </button>
            <button id="add_room" class="form-group p-3 m-3" style="padding-bottom: 10px; width:60%;">
                <a href="add_room.php">Add Room</a>
            </button>
        </div>
    </form>
</div>

<script>
   $(document).ready(function() {
    // Custom event logging for navbar toggling
    $('.navbar-toggler').on('click', function() {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        console.log(isExpanded ? 'Navbar collapsed' : 'Navbar expanded');
    });

    // Logout functionality with SweetAlert2
    $('#logout-btn').on('click', function () {
        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to log out!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with logout
                axios.post('logout.php') // Assuming logout.php handles the logout process
                    .then(function () {
                        console.log("Logout successful!");
                        Swal.fire(
                            'Logged out!',
                            'You have successfully logged out.',
                            'success'
                        ).then(() => {
                            console.log("Redirecting to login page...");
                            window.location.href = 'index.php'; // Redirect to login page
                        });
                    })
                    .catch(function (error) {
                        console.error("Error during logout:", error);
                        Swal.fire(
                            'Error!',
                            'Failed to logout. Please try again.',
                            'error'
                        );
                    });
            } else {
                Swal.fire(
                    'Cancelled',
                    'You are still logged in.',
                    'info'
                );
            }
        });
    });
});

</script>

</body>
</html>
