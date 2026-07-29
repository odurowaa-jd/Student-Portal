<?php
include 'db.php';

// Check if an ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// --- UPDATE LOGIC ---
if (isset($_POST['update_status'])) {
    
    $new_status = isset($_POST['admission_status_cb']) ? 'Admitted' : 'Undecided';
    
    $update_sql = "UPDATE students SET admission_status = '$new_status' WHERE id = '$id'";
    if ($conn->query($update_sql)) {
        $update_msg = "<div class='alert alert-success'>Admission status updated successfully!</div>";
    } else {
        $update_msg = "<div class='alert alert-danger'>Error updating status: " . $conn->error . "</div>";
    }
}

// --- FETCH STUDENT DETAILS  ---
$sql = "SELECT * FROM students WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    die("Student record not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student Details | <?php echo $student['first_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; padding-top: 50px; padding-bottom: 50px; }
        .detail-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .detail-header { background: #0d6efd; color: white; padding: 20px; }
        .profile-main-img { width: 100%; max-width: 250px; border-radius: 15px; border: 5px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .info-label { font-weight: bold; color: #6c757d; text-transform: uppercase; font-size: 0.8rem; }
        .info-value { font-size: 1.1rem; color: #212529; margin-bottom: 15px; }
        .status-box { background: #f8f9fa; border-radius: 10px; padding: 20px; border: 1px solid #dee2e6; }
    </style>
</head>
<body>

<div class="container">
    <!--  Link back -->
    <div class="mb-4">
        <a href="dashboard.php" class="btn btn-outline-dark">← Back to Dashboard</a>
    </div>

    <?php if(isset($update_msg)) echo $update_msg; ?>

    <div class="detail-card">
        <div class="detail-header">
            <h3 class="mb-0">Detailed Student Profile</h3>
        </div>
        
        <div class="card-body p-5">
            <div class="row">
                <!-- Requirement 8: Profile Image -->
                <div class="col-md-4 text-center mb-4">
                    <img src="uploads/<?php echo $student['profile_image']; ?>" class="profile-main-img" alt="Student Photo">
                    
                    <div class="mt-4 status-box">
                        <h5>Admission Control</h5>
                        <hr>
                        <!-- Requirement 9: Checkbox to set status -->
                        <form method="POST">
                            <div class="form-check form-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" name="admission_status_cb" id="statusCheck" 
                                    <?php echo ($student['admission_status'] == 'Admitted') ? 'checked' : ''; ?>>
                                <label class="form-check-label fw-bold" for="statusCheck">
                                    <?php echo $student['admission_status']; ?>
                                </label>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="update_status" class="btn btn-primary btn-sm">Update Status</button>
                            </div>
                        </form>
                        <p class="small text-muted mt-2">Check to Admit, uncheck to set as Undecided.</p>
                    </div>
                </div>

                <!--  All detailed information -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Full Name</div>
                            <div class="info-value"><?php echo $student['first_name'] . " " . $student['middle_name'] . " " . $student['last_name']; ?></div>
                            
                            <div class="info-label">Email Address</div>
                            <div class="info-value"><?php echo $student['email']; ?></div>
                            
                            <div class="info-label">Phone Number</div>
                            <div class="info-value"><?php echo $student['phone']; ?></div>
                            
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value"><?php echo date('F j, Y', strtotime($student['dob'])); ?></div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-label">Gender</div>
                            <div class="info-value"><?php echo $student['gender']; ?></div>

                            <div class="info-label">JAMB Score</div>
                            <div class="info-value"><span class="badge bg-primary fs-6"><?php echo $student['jamb_score']; ?></span></div>
                            
                            <div class="info-label">State of Origin</div>
                            <div class="info-value"><?php echo $student['state_of_origin']; ?></div>

                            <div class="info-label">Local Govt (LGA)</div>
                            <div class="info-value"><?php echo $student['lga']; ?></div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="info-label">Residential Address</div>
                            <div class="info-value"><?php echo $student['address']; ?></div>
                        </div>

                        <div class="col-12">
                            <div class="info-label">Next of Kin</div>
                            <div class="info-value"><?php echo $student['next_of_kin']; ?></div>
                        </div>
                        
                        <div class="col-12">
                            <div class="info-label">Registration Date</div>
                            <div class="info-value text-muted small"><?php echo $student['created_at']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>