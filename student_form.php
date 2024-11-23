
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.all.min.js"></script>
    <style>
/* Apply the linear gradient background to the body */
body {
    background: linear-gradient(45deg, #0a0a0a, #3a4452);
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

.btn-danger {
            background-color: #c72c41;
            border-color: #c72c41;
        }
        .btn-danger:hover {
            background-color: #9a2131;
            border-color: #9a2131;
        }
/* Container styling */
.container {
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 50%, .7);
            backdrop-filter: blur(16px);
            padding-top:20px;
          
}

/* Profile Card Styling */
.profile-card {
            border: 1px solid white;
            background-color: hsla(0, 0%, 100%, .01);
            border: 2px solid hsla(0, 0%, 80%, .7);
            backdrop-filter: blur(16px);
            padding: 20px;
            margin: 10px;
}


/* Navbar Styling */
.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    font-weight: bold;
    
}

/* Navbar Title Styling */
.navbar-title {
    color: black;
    font-size: 30px;
    left: 20%;
    top:30px;
    text-align: center;
    flex-grow: 1;
    text-shadow: 2px 2px 4px #3a4452;
    position: absolute;
    font-weight: bold;
}

/* Adjustments for navbar links */
.navbar-nav {
    margin-left: auto;
    margin-right: 0;
    color: black;
    
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

/* Fixed navbar at the top */
nav {
   
    font-size: 18px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 10; /* Ensure it stays above other content */
    background: linear-gradient(45deg, #3c3c3c, #6a7480);
}

/* Profile Picture Container */

.image-container {
    position: relative;
    display: inline-block;
}

#profile-picture {
    width: 60px; /* Set width of the profile image */
    height: 160px; /* Set height of the profile image */
    border-radius: 50%;
    
}

/* File Input Styling */
.file-input {
    position: absolute;
    bottom: 0; /* Position the input at the bottom of the image */
    left: 0;
    transform: translateX(0%); /* Center the input horizontally */
    width: 60%; /* Adjust the width of the input */
    opacity: 0; /* Hide the input box */
    cursor: pointer; /* Makes it appear clickable */
}


.navbar-nav .nav-link.active {
            color: black; /* Active link color */
            font-size: 25px;
        }

        #profile-upload{
           position: relative;
            padding-left: 0px;
            margin-bottom: 10px;
            float: right;
            background: linear-gradient(45deg, #0a0a0a, #3a4452);
            color: #1f456e;
        }

        .profile-picture {
    position: relative;
    display: flex;
    flex-direction: column;  /* Stack children vertically */
    align-items: center;     /* Center content horizontally */
    justify-content: center; /* Center content vertically */
    text-align: center;      /* Center text */
}

/* Adjust Profile Picture */
.profile-picture img {
    width: 50%;
    border-radius: 50%;
    margin-bottom: 10px; /* Space between the image and input */
}

/* File Input Styling */
.file-input {
    opacity: 0; /* Make it invisible */
    position: absolute;
    z-index: -1; /* Send it behind other elements */
}

/* Style the label to act as the file input */
.file-input-label {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(45deg, #0a0a0a, #3a4452);
    color: #1338be;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background 0.3s;
    font-weight: bold;
}

/* Add hover effect */
.file-input-label:hover {
    background: linear-gradient(45deg, #3a4452, #0a0a0a);
}
/* Center the Save Changes button */
#save-changes-btn {
    border: none;
    margin-top: 20px;
    display: block;
    width: 30%; /* Optional: Adjust button width */
    margin-left: auto;
    margin-right: auto; /* Center the button */
    cursor: pointer;
    background: linear-gradient(45deg, #0a0a0a, #3a4452);
    transition: background 0.3s;
    color:#1338be;
    font-weight: bold;
    font-size: 20px;
}
#save-changes-btn:hover{
    background: linear-gradient(45deg, #3a4452, #0a0a0a);
}

/* Adjust button for better alignment */
button {
    position: relative;
    margin-top: 10px;
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

      h4{
        color: #1338be;
      }
      .img1 {
  height: 80px;
  position: relative;
  box-shadow: -10px -10px 10px 10px #3a4452;
  border-radius: 50%;
      }

    </style>
</head>
<body>
<!-- Navbar fixed at the top -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid navbar-container">
    <!-- Navbar logo -->
    <a class="navbar-brand" href="#"><img src="image/logo.png" alt="logo" class="img1"></a>

    <!-- Student Directory Title -->
    <h4 class="navbar-title">WELCOME!</h4>

    <!-- Navbar toggle button for small screens -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="student_form.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="list_student_f.php">Student List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subject_list_f.php">Subject List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="room_list_f.php">Room List</a>
        </li>
        <li class="nav-item">
          <button id="logout-btn" class="btn btn-danger nav-link text-end ms-auto">Logout</button>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">
    <div class="profile-card">
        <div class="profile-picture mb-0 text-end">
            <img id="profile-picture" src="./image/default.png" alt="Profile Picture" style="border-radius:50px 50px; width:25%; float:left;" >
            <div style="position: relative; display: inline-block;">
    <input type="file" id="profile-upload" class="file-input" />
    <label for="profile-upload" class="file-input-label">Choose File</label>
</div> 
        <!-- Add this button below the profile picture and student table -->
<button id="save-changes-btn" class="btn btn-success mt-3">Save Changes</button>

            
        </div>
     
        <!-- Student Info Table -->
        <table class="table table-bordered mt-4 transparent-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="student-name">N/A</td>
                    <td id="student-age">N/A</td>
                    <td id="student-contact">N/A</td>
                    <td id="student-birth-date">N/A</td>
                </tr>
            </tbody>
        </table>

        <!-- Subjects Table -->
        <h4 class="mt-4">Subjects and Schedules</h4>
        <table class="table table-bordered mt-2 transparent-table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Time</th>
                    <th>Day</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody id="subject-rows">
                <tr>
                    <td colspan="4">No subjects available</td>
                </tr>
            </tbody>
        </table>
    </div>

    
</div>


<script>
   $(document).ready(function () {
    // Function for toggling elements
    function toggleElement(triggerSelector, targetSelector, activeClass = 'active') {
        $(triggerSelector).on('click', function () {
            $(targetSelector).toggleClass(activeClass);
        });
    }

    // Example usage for a navbar toggler
    toggleElement('.navbar-toggler', '#navbarSupportedContent', 'show');

    // Fetch existing student profile data
    axios.get('get_student_info.php')
        .then(function (response) {
            if (response.data.status === 'success') {
                const data = response.data.data;

                // Populate student details
                $('#student-name').text(data['Student_Name'] || 'N/A');
                $('#student-age').text(data['std_age'] || 'N/A');
                $('#student-contact').text(data['std_contact_num'] || 'N/A');
                $('#student-birth-date').text(data['std_birth_date'] || 'N/A');

                // Populate profile picture
                const profilePicture = data['std_filename']
                    ? `image/${data['std_filename']}`
                    : './image/default.png';
                $('#profile-picture').attr('src', profilePicture);

                // Populate subjects table
                const subjects = data['Subjects'] || [];
                const subjectRows = subjects.map(subject => `
                    <tr>
                        <td>${subject['Subject_Code'] || 'N/A'}</td>
                        <td>${subject['Time'] || 'N/A'}</td>
                        <td>${subject['Day_Schedule'] || 'N/A'}</td>
                        <td>${subject['Room'] || 'N/A'}</td>
                    </tr>
                `).join('');

                $('#subject-rows').html(subjectRows || '<tr><td colspan="4">No subjects available</td></tr>');
            } else {
                Swal.fire('Error', response.data.message || 'Failed to fetch student profile.', 'error');
            }
        })
        .catch(function (error) {
            console.error('Error fetching profile:', error);
            Swal.fire('Error', 'An error occurred while fetching the profile.', 'error');
        });

    // Save profile changes
    $('#save-changes-btn').on('click', function () {
        const stdName = $('#student-name').text();
        const stdAge = $('#student-age').text();
        const stdContact = $('#student-contact').text();
        const stdBirthDate = $('#student-birth-date').text();
        const profileFile = $('#profile-upload').prop('files')[0]; // Get the selected file

        // Validate input fields
        if (!stdName || !stdAge || !stdContact || !stdBirthDate) {
            alert('Please fill in all fields before saving.');
            return;
        }

        // Check if the file is provided for profile picture
        if (!profileFile) {
            alert('Please upload a profile picture before saving.');
            return;
        }

        // Create a FormData object to handle file and text data
        const formData = new FormData();
        formData.append('Student_Name', stdName);
        formData.append('std_age', stdAge);
        formData.append('std_contact_num', stdContact);
        formData.append('std_birth_date', stdBirthDate);
        formData.append('profile-picture', profileFile); // Correct field name here

        // Sending data to the back-end
        axios.post('update_picture.php', formData)
            .then(function (response) {
                if (response.data.status === 'success') {
                    alert('Profile updated successfully!');
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-picture').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(profileFile);
                } else {
                    alert(response.data.message || 'Failed to save changes.');
                }
            })
            .catch(function (error) {
                console.error('Error saving changes:', error);
                alert('An error occurred while saving changes.');
            });
    });

    // Logout functionality with SweetAlert2
    $('#logout-btn').on('click', function () {
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
                axios.post('logout.php')
                    .then(function () {
                        Swal.fire(
                            'Logged out!',
                            'You have successfully logged out.',
                            'success'
                        ).then(() => {
                            window.location.href = 'index.php';
                        });
                    })
                    .catch(function (error) {
                        console.error('Error during logout:', error);
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
