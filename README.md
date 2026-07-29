# Student Portal Web Application

## Project Overview
This Student Portal is a full-stack web application developed as a **Capstone Project** for the Backend PHP development course under the **One Million Coders Initiative** in partnership with the **Startocode Learning Platform**. 

The application serves as a complete student admission management system, allowing prospective students to register their details and administrators to manage, filter, and update admission statuses in real-time.

## Key Features

### 1. Interactive Landing Page
- A professional, responsive first-entry page with a split-screen design featuring high-quality educational imagery.
- Clear call-to-action (CTA) buttons for navigation to the registration or administrative areas.

### 2. Comprehensive Registration System
- **Detailed Form:** Captures 13+ data points including personal info, contact details, and academic scores (JAMB).
- **Profile Image Upload:** Integrated file handling for student profile pictures.
- **Dynamic State/LGA Logic:** A custom JavaScript implementation that fetches data from a `JSON` file to populate Local Government Areas based on the selected State of Origin.
- **Submission Feedback:** Real-time success/error messaging upon form submission.

### 3. Administrative Dashboard
- **Record Management:** A centralized table displaying essential student data (Name, Gender, JAMB Score, and Admission Status).
- **Advanced Search & Filtering:** 
    - Search functionality by student name.
    - Filter by Admission Status (Admitted vs. Undecided).
    - Multi-criteria filtering (Combined Gender and JAMB score thresholds).

### 4. Student Profile & Admission Management
- **Detailed View Page:** Individualized pages for every record showing all submitted information and the student’s profile image.
- **Admission Toggle:** Administrators can set or change admission status using a dynamic checkbox.
- **Real-time Synchronization:** Status changes made in the profile view are immediately reflected in the main dashboard.

## Technologies Used
- **Backend:** PHP (Object-Oriented concepts & Procedural logic)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Scripting:** JavaScript (AJAX/Fetch API for JSON handling)
- **Data Format:** JSON (for State and LGA mapping)

## 🔧 Installation & Setup
1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/student-portal.git

2.Database Setup:
  Import the provided SQL schema into your MySQL server (via MySQL Workbench or phpMyAdmin).
  Ensure the database is named student_portal.

3.Configuration:
Open db.php and update the database credentials (host, username, and password) to match your local environment.

4.Folder Permissions:
Ensure the uploads/ directory exists and has write permissions for image storage.

5.Run the Application:
Place the project folder in your local server directory (e.g., www for AMPPS or htdocs for XAMPP).
Navigate to localhost/student_portal/index.php in your browser.

🎓 Acknowledgments
This project was completed as part of the One Million Coders Initiative curriculum. Special thanks to the Startocode Learning Platform for the technical guidance provided throughout the backend PHP course.

Developed by [Jessica Danquah]