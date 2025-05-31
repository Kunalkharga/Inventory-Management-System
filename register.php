

    
    <link rel="stylesheet" href="libs/css/style.css">
   
    <div class="sign-up">
    <h1>Sign Up</h1>
    <h4>It's free and only takes a minute.</h4>
    <form action="validation.php" method="post" onsubmit="return validateForm()"> <!-- Added onsubmit for validation -->
        <label for="name">Name</label>
        <input type="text" id="name" name="Name" placeholder="Enter your full name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <label for="user-role">Role</label>
        <select id="user-role" name="level" required>
            <!-- <option value="1">Admin</option> -->
            <option value="2">User</option>
            <!-- <option value="3">Special</option> -->
        </select>

        <br><br>
        <input type="submit" value="Sign Up" name="addUser">
    </form>
    <p>By clicking the Sign Up button, you agree to our <br>
        <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
    </p>
</div>
<p class="para2">Already have an account? <a href="index.php">Login here</a></p>

<script>
    function validateForm() {
        const emailField = document.getElementById('email').value;
        const passwordField = document.getElementById('password').value;

        // Email Validation Regex
        const emailPattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        // Password Validation Regex
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Simulated existing emails (for demo purpose)
        const existingEmails = ["test@example.com", "user@example.com"]; // Replace with actual server-side check

        // Validate Email Format
        if (!emailPattern.test(emailField)) {
            alert('Please enter a valid email address.');
            return false; // Prevent form submission
        }

        // Check if Email Already Exists
        if (existingEmails.includes(emailField)) {
            alert('This email is already registered. Please use a different email.');
            return false; // Prevent form submission
        }

        // Validate Password Strength
        if (!passwordPattern.test(passwordField)) {
            alert('Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.');
            return false; // Prevent form submission
        }

        // If all validations pass, allow form submission
        return true;
    }
</script>