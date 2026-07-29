<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Student Admission Portal</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* "Not too white" background (soft light blue/gray) */
            background: #eef2f3; 
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 90%;
            display: flex;
            min-height: 500px;
        }
        .content-side {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .image-side {
            flex: 1;
            /* Placeholder image of students in a classroom */
            background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            display: none; /* Hidden on small screens */
        }
        @media (min-width: 768px) {
            .image-side { display: block; }
        }
        .btn-custom {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .portal-title {
            color: #2c3e50;
            font-weight: 800;
        }
    </style>
</head>
<body>

    <div class="main-card">
        <!-- Text Side -->
        <div class="content-side">
            <h1 class="portal-title display-5 mb-3">Student Admission Portal</h1>
            <p class="text-muted mb-4">
                Empowering your future starts here. Join thousands of students achieving their dreams. Please fill out the application form to get started.
            </p>
            
            <div class="d-grid gap-2 d-md-block">
                <!-- REQUIREMENT: Link to the form page -->
                <a href="form.php" class="btn btn-primary btn-custom me-md-2 shadow-sm">
                    Start Application
                </a>
                <a href="dashboard.php" class="btn btn-outline-secondary btn-custom">
                    Admin Dashboard
                </a>
            </div>
        </div>

        <!-- Image Side (Students in Classroom) -->
        <div class="image-side"></div>
    </div>

</body>
</html>