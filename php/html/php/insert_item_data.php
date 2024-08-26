<?php 
    include('../../database/database_conn.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = $_POST['student-id'];
        $item_input = $_POST['item-type'];
        $item_found = $_POST['item-found'];
        $description = $_POST['description'];
        $current_date = date('F j, Y', strtotime('now'));

        $item_img = '';

        if (isset($_FILES['item_img']) && $_FILES['item_img']['error'] == 0) {
            $upload_dir = 'item_img/';
            $file_name = basename($_FILES['item_img']['name']);
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, ['jpg', 'jpeg', 'png'])) {
                $item_img = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES['item_img']['tmp_name'], $item_img)) {
                    echo "File uploaded successfully: " . $item_img;
                } else {
                    die("Failed to upload image.");
                }
            } else {
                die("Unsupported file type. Only JPG/JPEG and PNG files are allowed.");
            }
        } else {
            if (isset($_FILES['item_img']['error']) && $_FILES['item_img']['error'] != 0) {
                die("File upload error: " . $_FILES['item_img']['error']);
            }
        }

        $stmt = $conn->prepare("INSERT INTO lost_found_db (student_id_surrender, item_type, loc_found, description, date_surrender, item_img) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }
        
        $stmt->bind_param("ssssss", $student_id, $item_input, $item_found, $description, $current_date,$item_img);

        if ($stmt->execute()) {
            header("Location: ../lost.php");
            exit();
        } else {
            die("Error executing the statement: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../lost.php");
        exit();
    }
?>
