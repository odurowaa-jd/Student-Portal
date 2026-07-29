<?php
include 'db.php';

// --- SEARCH & FILTER LOGIC ---
$query = "SELECT * FROM students WHERE 1=1";

// 1. Filter by Name
if (!empty($_GET['search_name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['search_name']);
    $query .= " AND (first_name LIKE '%$name%' OR last_name LIKE '%$name%')";
}

// 2. Filter by Admission Status 
if (!empty($_GET['status_filter'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status_filter']);
    $query .= " AND admission_status = '$status'";
}

// 3. Filter by Gender AND Jamb Score 
if (!empty($_GET['gender_filter']) && !empty($_GET['jamb_min'])) {
    $gender = mysqli_real_escape_string($conn, $_GET['gender_filter']);
    $jamb = mysqli_real_escape_string($conn, $_GET['jamb_min']);
    $query .= " AND gender = '$gender' AND jamb_score >= $jamb";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .dashboard-container { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .filter-section { background: #eef2f3; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .profile-img-sm { width: 40px; height: 40px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

<div class="container-fluid mt-4 px-5">
    <!-- Requirement 3: Links back to other pages -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Student Records Dashboard</h2>
        <div>
            <a href="index.php" class="btn btn-outline-primary">Home Page</a>
            <a href="form.php" class="btn btn-primary">Add New Student</a>
        </div>
    </div>

    <div class="dashboard-container">
        <!-- FILTER FORM (Requirement 5 & 7) -->
        <form method="GET" action="dashboard.php" class="filter-section">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Search by Name</label>
                    <input type="text" name="search_name" class="form-control" placeholder="Type a name..." value="<?php echo $_GET['search_name'] ?? ''; ?>">
                </div>
                
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Admission Status</label>
                    <select name="status_filter" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Admitted" <?php if(isset($_GET['status_filter']) && $_GET['status_filter'] == 'Admitted') echo 'selected'; ?>>Admitted</option>
                        <option value="Undecided" <?php if(isset($_GET['status_filter']) && $_GET['status_filter'] == 'Undecided') echo 'selected'; ?>>Undecided</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold">Gender Filter</label>
                    <select name="gender_filter" class="form-select">
                        <option value="">Any Gender</option>
                        <option value="Male" <?php if(isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if(isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold">Min. JAMB Score</label>
                    <input type="number" name="jamb_min" class="form-control" placeholder="e.g. 200" value="<?php echo $_GET['jamb_min'] ?? ''; ?>">
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-dark w-100">Apply Filters</button>
                    <a href="dashboard.php" class="btn btn-light border">Reset</a>
                </div>
            </div>
            <div class="mt-2 text-muted small">
                * To filter by JAMB, please select a Gender as well (Project Requirement).
            </div>
        </form>

        <!-- RECORDS TABLE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>JAMB Score</th>
                        <th>Admission Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <img src="uploads/<?php echo $row['profile_image']; ?>" class="profile-img-sm border" alt="Profile">
                            </td>
                            <td class="fw-bold">
                                <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                            </td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['jamb_score']; ?></td>
                            <td>
                                <?php if($row['admission_status'] == 'Admitted'): ?>
                                    <span class="badge bg-success">Admitted</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Undecided</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Button linking to individual view page -->
                                <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-info">View Details</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No student records found matching your filters.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>