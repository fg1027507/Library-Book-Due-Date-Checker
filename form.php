<?php // Hayden ?>
<form method="post" action="index.php">
    <label for="returnDate">Return Date:</label>
    <input type="date" id="returnDate" name="returnDate" required
        min="0001-01-01" max="9999-12-31"
        value="<?php echo escapeHtml($returnDate); ?>">

    <label for="dueDate">Due Date:</label>
    <input type="date" id="dueDate" name="dueDate" required
        min="0001-01-01" max="9999-12-31"
        value="<?php echo escapeHtml($dueDate); ?>">

    <button type="submit">Check Dates</button>
</form>
