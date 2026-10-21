<?php
// Initialize variables
$num1 = $num2 = $result = $error = '';
$operator = '+';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1     = $_POST['num1'] ?? '';
    $num2     = $_POST['num2'] ?? '';
    $operator = $_POST['operator'] ?? '+';

    // Validate inputs
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = 'Please enter valid numbers.';
    } else {
        $num1 = (float) $num1;
        $num2 = (float) $num2;

        // Perform calculation
        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    $error = 'Error: Cannot divide by zero.';
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = 'Invalid operator.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1e1e2f;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calc {
            background: #2a2a40;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.5);
            width: 320px;
        }
        h2 {
            text-align: center;
            margin-top: 0;
            color: #4fc3f7;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #444;
            background: #1e1e2f;
            color: #fff;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            background: #4fc3f7;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.2s;
        }
        button:hover {
            background: #29b6f6;
        }
        .result {
            margin-top: 15px;
            padding: 12px;
            background: #1b5e20;
            text-align: center;
            border-radius: 6px;
            font-size: 18px;
        }
        .error {
            margin-top: 15px;
            padding: 12px;
            background: #b71c1c;
            text-align: center;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <form class="calc" method="POST" action="">
        <h2>PHP Calculator</h2>

        <input type="text" name="num1" placeholder="Enter first number"
               value="<?php echo htmlspecialchars($num1); ?>" required>

        <select name="operator">
            <option value="+" <?php if ($operator === '+') echo 'selected'; ?>>+ Add</option>
            <option value="-" <?php if ($operator === '-') echo 'selected'; ?>>− Subtract</option>
            <option value="*" <?php if ($operator === '*') echo 'selected'; ?>>× Multiply</option>
            <option value="/" <?php if ($operator === '/') echo 'selected'; ?>>÷ Divide</option>
        </select>

        <input type="text" name="num2" placeholder="Enter second number"
               value="<?php echo htmlspecialchars($num2); ?>" required>

        <button type="submit">Calculate</button>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php elseif ($result !== '' && $result !== null): ?>
            <div class="result">
                Result: <strong><?php echo $result; ?></strong>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>