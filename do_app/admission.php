.[=.<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/admission.css">
    <script>
        function formatDate(date) {
            const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            let dayName = days[date.getDay()];
            let monthName = months[date.getMonth()];
            let day = date.getDate();
            let year = date.getFullYear();

            return `${dayName} ${monthName} ${day}, ${year}`;
        }
    </script>

</head>

<body>

    <header>
        <a href="home.php"><i class="fa-solid fa-left-long"></i></a>
        <h2>ADMISSION PASS</h2>
    </header>

    <div class="container">
        <img src="images/DOMS_logo.png" alt="">

        <div class="info">
            <div class="date">
                <div class="input-wrap">
                    <label for="date">Date:</label>
                    <input type="text" name="date">
                </div>
            </div>

            <p class="allow"><strong>Please allow the bearer of this pass to enter the school premises.</strong></p>

            <div class="mid">
                <div class="input-wrap">
                    <label for="name">Name of Student:</label>
                    <input type="text" name="name" value="">
                </div>

                <div class="input-wrap">
                    <label for="course">Course/Year:</label>
                    <input type="text" name="course" value="">
                </div>

                <div class="input-wrap">
                    <label for="student-id">Student No:</label>
                    <input type="text" name="student-id" value="">
                </div>

                <label for="reason">Reason:</label>
                <textarea name="reason" id=""></textarea>
            </div>

        </div>
    </div>
</body>

</html>