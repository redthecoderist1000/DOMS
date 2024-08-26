<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/DOMS_logo.png" type="image/x-icon">
    <title>Entry Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/entry-pass.css">
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
        <h2>ENTRY PASS</h2>
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
                <p>I <span><input type="text" value="Sample Name"></span> agree and promise to <strong>follow the ID Replacement process,</strong> this pass is valid until <span>June 26, 2024</span>.</p>
                <em>Kindly surrender this entry pass once you have completed the process.</em>
            </div>

            <div class="note">
                <p>Note: <strong>VALIDITY OF THIS SLIP IS UNTIL THE MENTIONED DATE ONLY.</strong></p>
            </div>

        </div>
    </div>
</body>

</html>