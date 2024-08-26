<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/DOMS_logo.png" type="image/x-icon">
    <title>Entry Pass</title>
    <link rel="stylesheet" href="entry_pass.css">
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
    <div class="container">
        <h1>ENTRY PASS</h1>
        <img src="../../images/DOMS_logo.png" alt="">

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
                <div class="note-info">
                    <div class="sign">
                        <hr>
                        <h4>Name & Signature</h4>
                    </div>
                </div>
            </div>


            <div class="lower">
                <strong>Noted By:</strong>
                <div class="lower-list">
                    <div class="lower-info">
                        <hr>
                        <h4>Program Chair</h4>
                    </div>
                    <div class="lower-info">
                        <hr>
                        <h4>ITSO Coordinator</h4>
                    </div>
                    <div class="lower-info">
                        <hr>
                        <h4>Discipline Officer</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>