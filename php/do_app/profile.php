<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="top">
        <header>
            <a class="home" href="home.php"><i class="fa-solid fa-left-long"></i></a>
            <h1>Profile<a class="logout" href="php/logout_function.php"><i class="fas fa-sign-out-alt"></i></a></h1>

        </header>
    </div>

    <section>



        <div class="basic-info">
            <h4>Basic Information</h4>

            <label for="id">Student ID:</label>
            <input type="text" name="id" id="" value="Sample ID" readonly>

            <label for="name">Name:</label>
            <input type="text" name="name" id="" value="Sample Name" readonly>

            <label for="course">Course & Section:</label>
            <input type="text" name="course" id="" value="Sample Course & Section" readonly>

            <label for="gender">Gender:</label>
            <input type="text" name="gender" id="" value="Sample Gender" readonly>

            <label for="email">Email:</label>
            <input type="email" name="email" id="" value="Sample Email" readonly>
        </div>

        <div class="image">
            <img src="images/DOMS_logo.png" alt="">
        </div>

        <form class="change-password" action="">
            <h4>Change Password</h4>

            <div class="pass-info">
                <label for="currentpassword">Current Password:</label>
                <div class="password-input">
                    <input type="password" name="currentpassword" id="currentpassword" placeholder="Current Password" />
                    <i class="far fa-eye" id="toggleCurrentPassword"></i>
                </div>

                <label for="newpassword">New Password:</label>
                <div class="password-input">
                    <input type="password" name="newpassword" id="newpassword" placeholder="New Password" />
                    <i class="far fa-eye" id="togglePassword"></i>
                </div>

                <label for="cpassword">Confirm New Password:</label>
                <div class="password-input">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" />
                    <i class="far fa-eye" id="toggleConfirmPassword"></i>
                </div>

                <div class="error">
                    <p>ERROR ERROR</p>
                </div>

                <div class="profile-button-align">
                    <button>Change Password</button>
                </div>
            </div>
        </form>
    </section>
    <div class="bottom">
        <img src="images/DOMS_logo1.png" alt="">
        <div class="name">
            <h3>DISCIPLINE OFFICE</h3>
            <p>Management System</p>
        </div>
    </div>
</body>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('newpassword');
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('cpassword');
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    const toggleCurrentPassword = document.getElementById('toggleCurrentPassword');
    const confirmCurrentPasswordInput = document.getElementById('currentpassword');
    toggleCurrentPassword.addEventListener('click', function() {
        const type = confirmCurrentPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmCurrentPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>