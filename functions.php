<?php
// Hayden

// Escape submitted values so they display as text instead of being treated as HTML.
function escapeHtml($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Reject impossible dates because PHP would otherwise normalize February 30.
function isValidDate($value)
{
    if (!is_string($value) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        return false;
    }
    $parts = explode('-', $value);
    return checkdate((int) $parts[1], (int) $parts[2], (int) $parts[0]);
}

// Calculate years, months, and days with procedural date functions.
// date_diff accounts for different month lengths, unlike dividing a total number of days.
function checkBookDates($returnDate, $dueDate)
{
    $return = date_create($returnDate);
    $due = date_create($dueDate);
    $difference = date_diff($return, $due);
    $time = date_interval_format($difference, '%y years, %m months, and %d days');

    // Compare timestamps to decide which message to return to index.php.
    if (strtotime($returnDate) > strtotime($dueDate)) {
        return 'The book is overdue by ' . $time . '.';
    } elseif (strtotime($returnDate) < strtotime($dueDate)) {
        return 'Time remaining until the book is due: ' . $time . '.';
    } else {
        return 'The book is due today.';
    }
}

// Format a valid date to make the result easier to read.
function formatDate($date)
{
    return date_format(date_create($date), 'F j, Y');
}
