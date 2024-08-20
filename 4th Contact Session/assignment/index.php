<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h2>Simple Calculator</h2>
    <div class="calculator">
        <div class="display" id="display">0</div>
        <div class="buttons">
            <button class="clear" onclick="clearDisplay()">C</button>
            <button onclick="appendOperator('/')">/</button>
            <button onclick="appendOperator('*')">*</button>
            <button onclick="appendOperator('+')">+</button>
            <button onclick="appendNumber('1')">1</button>
            <button onclick="appendNumber('2')">2</button>
            <button onclick="appendNumber('3')">3</button>
            <button onclick="appendOperator('-')">-</button>
            <button onclick="appendNumber('4')">4</button>
            <button onclick="appendNumber('5')">5</button>
            <button onclick="appendNumber('6')">6</button>
            <button onclick="appendNumber('.')">.</button>
            <button onclick="appendNumber('7')">7</button>
            <button onclick="appendNumber('8')">8</button>
            <button onclick="appendNumber('9')">9</button>
            <button class="equal" onclick="calculate()">=</button>
            <button onclick="appendNumber('0')">0</button>
            <button onclick="appendNumber('00')">00</button>
        </div>
    </div>

    <script>
        let display = document.getElementById('display');
        let currentInput = '0';

        function appendNumber(number) {
            if (currentInput === '0') {
                currentInput = number;
            } else {
                currentInput += number;
            }
            display.textContent = currentInput;
        }

        function appendOperator(operator) {
            currentInput += operator;
            display.textContent = currentInput;
        }

        function clearDisplay() {
            currentInput = '0';
            display.textContent = currentInput;
        }

        function calculate() {
            try {
                currentInput = eval(currentInput).toString();
                display.textContent = currentInput;
            } catch (error) {
                display.textContent = 'Error';
            }
        }
    </script>
</body>

</html>