<!DOCTYPE html>
<html>
<head>
<title>Audience Code Reviewers</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
$codeReviewers = array(
    'Leo',
    'Ramya',
    'Justin',
    'Arwin',
    'Cristian',
    'Jon',
    'Raul',
);
shuffle($codeReviewers);
echo '<h1>Audience Code Reviewers (randomized)</h1>';
foreach ($codeReviewers as $i => $codeReviewer) {
    if ($i < 3) {
        echo '<p style="color: green">✔ ';
    } else {
        echo '<p style="color: gray">';
    }
    echo $codeReviewer . '</p>';
} ?>
</body>
</html>