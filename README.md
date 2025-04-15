Kids and Us Website 🌐📚
This is a website designed to introduce English courses for children, allowing users to register for classes and read informative blog posts about learning methods and center activities.

We built this project based on the structure and features of a real-world website to simulate a practical use case.

🔧 Technologies Used
Frontend: HTML, CSS, jQuery, AJAX
Backend: PHP, MySQL
Design: Figma

🚀 How to Run
Clone this repo
Import the SQL file to your MySQL server
Configure the database connection with files: database.sql
Launch with XAMPP/Laragon or your local server

✨ Features
Course introduction with detailed descriptions
Online class registration form
Blog section to share learning tips and center news
Admin dashboard to manage registrations and blog posts
User and admin authentication

🛠️ Additional Setup: Enable GD Library in XAMPP
To use image compression features in PHP, you need to enable the GD Library in your XAMPP environment.

✅ Steps to Enable GD Library:
1. Navigate to your XAMPP directory, typically located at:
C:\xampp

2. Find and open the php.ini file using Notepad or any text editor.
3. Search for the following line in the file (you can use Ctrl + F to find it quickly):

ini
;extension=gd
Remove the semicolon (;) at the beginning of the line to enable it:

ini
extension=gd
Save the php.ini file.

4. Restart Apache from the XAMPP Control Panel.
5. After following these steps, the GD Library will be enabled, and you will be able to use image manipulation functions such as imagecreatefromjpeg(), imagejpeg(), etc., in PHP.

