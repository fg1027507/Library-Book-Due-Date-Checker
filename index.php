<?php
// Hayden
require_once __DIR__ . '/functions.php';

// UTC keeps date-only calculations independent of daylight saving transitions.
date_default_timezone_set('UTC');
$returnDate = '';
$dueDate = '';
$error = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $returnDate = is_string($_POST['returnDate'] ?? null) ? trim($_POST['returnDate']) : '';
    $dueDate = is_string($_POST['dueDate'] ?? null) ? trim($_POST['dueDate']) : '';
    if (isValidDate($returnDate) && isValidDate($dueDate)) {
        $result = checkBookDates($returnDate, $dueDate);
    } else {
        $error = 'Please enter a valid return date and due date.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Date Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8eef5;
            color: #222;
            margin: 0;
            padding: 20px;
        }
        main {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background-color: white;
            border: 1px solid #b9c7d6;
            border-radius: 8px;
        }
        h1 { color: #284e75; font-size: 28px; }
        p { line-height: 1.5; }
        label { display: block; margin-top: 20px; font-weight: bold; }
        input {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #888;
            border-radius: 4px;
            font: inherit;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #284e75;
            color: white;
            border: none;
            border-radius: 4px;
            font: inherit;
            cursor: pointer;
        }
        button:hover { background-color: #19344f; }
        .result { margin-top: 25px; padding: 15px; background-color: #edf3f9; }
        .result h2 { margin-top: 0; font-size: 22px; }
        .error { color: #a12525; }
    </style>
</head>
<body>
    <main>
        <h1>Library Book Date Checker</h1>
        <p>Enter the return date and due date to see whether the book is overdue, how much time remains, or whether it is due today.</p>

        <?php if ($error !== ''): ?>
            <p class="error" role="alert"><?php echo escapeHtml($error); ?></p>
        <?php endif; ?>

        <?php include 'form.php'; ?>

        <?php if ($result !== null): ?>
            <div class="result" role="status">
                <h2>Result</h2>
                <p><strong>Return Date:</strong> <?php echo formatDate($returnDate); ?></p>
                <p><strong>Due Date:</strong> <?php echo formatDate($dueDate); ?></p>
                <p><?php echo escapeHtml($result); ?></p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
