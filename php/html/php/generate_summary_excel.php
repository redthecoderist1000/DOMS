<?php
include("../../database/database_conn.php");

$query = "SELECT * FROM lost_found_db";
$result = mysqli_query($conn, $query);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=lost_found_report.csv');
$output = fopen('php://output', 'w');

fputcsv($output, array('Status', 'Item Type', 'Location Found', 'Date Surrendered/Claimed', 'Description'));

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $status = $row['status'];
        $item_type = $row['item_type'];
        $loc_found = $row['loc_found'];
        $date_surrender = $row['date_surrender'];
        $date_claim = $row['date_claim'];
        $description = $row['description'];

        $date = $status == "surrender" ? $date_surrender : $date_claim;

        fputcsv($output, array($status, $item_type, $loc_found, $date, $description));
    }
}

fclose($output);
exit();
