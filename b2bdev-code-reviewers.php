<!DOCTYPE html>
<html>
<head>
<title>B2BDEV Code Reviewers</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
$codeReviewers = array(
    'Chris',
    'JuanJG',
    'JuanB',
    'Emmanuel',
    'Alvaro',
    'Anthony',
    'Guilherme',
    'Jon',
    'Joao',
    'Bruno',
    'Jeremy',
    'Aidan',
);
shuffle($codeReviewers);
echo '<h1>B2BDEV Code Reviewers (randomized)</h1>';
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