<?php
// Include the database connection
include 'db.php';

$message = ""; // Variable to hold the success/error message

// Check if the form is submitted
if (isset($_POST['submit_application'])) {
    
    // 1. Handle Profile Image Upload
    $target_dir = "uploads/";
    $image_name = time() . "_" . basename($_FILES["profile_image"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    if(move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        
        // 2. Capture all form data
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $state = $_POST['state_of_origin'];
        $lga = $_POST['lga'];
        $next_of_kin = $_POST['next_of_kin'];
        $jamb_score = $_POST['jamb_score'];

        // 3. SQL Insert Query
        $sql = "INSERT INTO students (profile_image, first_name, middle_name, last_name, email, dob, gender, phone, address, state_of_origin, lga, next_of_kin, jamb_score) 
                VALUES ('$image_name', '$first_name', '$middle_name', '$last_name', '$email', '$dob', '$gender', '$phone', '$address', '$state', '$lga', '$next_of_kin', '$jamb_score')";

        if ($conn->query($sql) === TRUE) {
            // Requirement 4: Message displayed at the top of the form
            $message = "<div class='alert alert-success shadow'>Application submitted successfully! Record has been saved.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Sorry, there was an error uploading your profile image.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Form | Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef2f3; padding-bottom: 50px; }
        .form-container { background: white; border-radius: 15px; padding: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .section-title { border-left: 5px solid #0d6efd; padding-left: 15px; margin-bottom: 25px; color: #0d6efd; font-weight: bold; }
    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Requirement 3: Link back to landing page or dashboard -->
    <div class="d-flex justify-content-between mb-4">
        <a href="index.php" class="btn btn-outline-secondary">← Back to Home</a>
        <a href="dashboard.php" class="btn btn-info text-white">View Records Dashboard</a>
    </div>

    <div class="form-container">
        <!-- Requirement 4: Message displayed at the top -->
        <?php echo $message; ?>

        <h2 class="mb-4 text-center">Student Registration Form</h2>
        <hr>

        <form action="form.php" method="POST" enctype="multipart/form-data">
            
            <!-- Profile Image -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="section-title">Profile Picture</h5>
                    <input type="file" name="profile_image" class="form-control" required>
                </div>
            </div>

            <!-- Names -->
            <h5 class="section-title">Personal Information</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="John" required>
                </div>
                <div class="col-md-4">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" placeholder="Optional">
                </div>
                <div class="col-md-4">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                </div>
                <div class="col-md-6">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                </div>
                <div class="col-md-3">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <!-- Contact & Academic -->
            <h5 class="section-title">Contact & Academic Details</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>JAMB Score</label>
                    <input type="number" name="jamb_score" class="form-control" required>
                </div>
                <div class="col-12">
                    <label>Residential Address</label>
                    <textarea name="address" class="form-control" rows="2" required></textarea>
                </div>
            </div>

            <!-- State/LGA (The JSON Logic) -->
            <h5 class="section-title">Origin Details</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label>State of Origin</label>
                    <select id="state_select" name="state_of_origin" class="form-select" onchange="populateLGA()" required>
                        <option value="">Select State</option>
                        <!-- States will be loaded here by JavaScript -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Local Government Area (LGA)</label>
                    <select id="lga_select" name="lga" class="form-select" required>
                        <option value="">Select State First</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label>Next of Kin Full Name</label>
                    <input type="text" name="next_of_kin" class="form-control" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="submit_application" class="btn btn-primary btn-lg px-5 shadow">Submit Application</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript to handle the JSON State/LGA Logic -->
<script>
    let statesData = [];

    const jsonFile = 'states-localgovts.json'; 

    fetch(jsonFile)
        .then(response => {
            if (!response.ok) {
                throw new Error("Could not find the JSON file");
            }
            return response.json();
        })
        .then(data => {
            
            statesData = data.states; 
            
            const stateDropdown = document.getElementById('state_select');
            
            // Populate the State dropdown
            statesData.forEach(item => {
                let option = document.createElement('option');
                option.value = item.state;
                option.innerHTML = item.state;
                stateDropdown.appendChild(option);
            });
        })
        .catch(err => {
            console.error("Error loading JSON:", err);
        });

    function populateLGA() {
        const stateDropdown = document.getElementById('state_select');
        const lgaDropdown = document.getElementById('lga_select');
        const selectedStateName = stateDropdown.value;

        
        lgaDropdown.innerHTML = '<option value="">Select LGA</option>';

        
        const stateMatch = statesData.find(s => s.state === selectedStateName);

        // Your JSON uses "local" for the list of LGAs
        if (stateMatch && stateMatch.local) {
            stateMatch.local.forEach(lga => {
                let option = document.createElement('option');
                option.value = lga;
                option.innerHTML = lga;
                lgaDropdown.appendChild(option);
            });
        }
    }
</script>

</body>
</html>