@extends('layouts.app')

@section('title', 'Calculator Project - Inkblade.cloud')

@push('head')
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
@endpush

@push('styles')
<style>
    .calculator-container {
        padding: 80px 20px 40px;
        min-height: calc(100vh - 70px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    }

    .calculator-header {
        margin-bottom: 40px;
    }

    .calculator-title {
        color: #b58900;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        font-family: 'JetBrains Mono', monospace;
        text-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
    }

    .calculator-subtitle {
        color: #93a1a1;
        font-size: 1.1rem;
        font-family: 'JetBrains Mono', monospace;
    }

    .calculator {
        background: #073642;
        border: 2px solid #b58900;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        width: 320px;
        max-width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    .calculator-display {
        background: #002b36;
        border: 1px solid #586e75;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: right;
        font-family: 'JetBrains Mono', monospace;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        overflow: hidden;
    }

    .calculator-expression {
        font-size: 1rem;
        color: #93a1a1;
        min-height: 25px;
        margin-bottom: 5px;
        opacity: 0.8;
    }

    .calculator-result {
        font-size: 1.8rem;
        color: #eee8d5;
        min-height: 35px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .calculator-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .calc-btn {
        background: #586e75;
        border: none;
        border-radius: 10px;
        color: #eee8d5;
        font-size: 1.2rem;
        font-weight: bold;
        font-family: 'JetBrains Mono', monospace;
        padding: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
        min-height: 50px;
        touch-action: manipulation;
        -webkit-tap-highlight-color: transparent;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .calc-btn:hover {
        background: #657b83;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .calc-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .calc-btn.operator {
        background: #b58900;
        color: #002b36;
    }

    .calc-btn.operator:hover {
        background: #cb4b16;
        color: #eee8d5;
    }

    .calc-btn.equals {
        background: #859900;
        color: #002b36;
        grid-column: span 2;
    }

    .calc-btn.equals:hover {
        background: #93a1a1;
        color: #eee8d5;
    }

    .calc-btn.clear {
        background: #dc322f;
        color: #eee8d5;
    }

    .calc-btn.clear:hover {
        background: #cb4b16;
    }

    .calc-btn.zero {
        grid-column: span 2;
    }

    .project-info {
        background: rgba(7, 54, 66, 0.5);
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
        max-width: 400px;
    }

    .project-info h3 {
        color: #b58900;
        font-size: 1.3rem;
        margin-bottom: 15px;
        font-family: 'JetBrains Mono', monospace;
    }

    .project-info p {
        color: #93a1a1;
        margin-bottom: 10px;
        font-family: 'JetBrains Mono', monospace;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 15px;
    }

    .tech-tag {
        background: #b58900;
        color: #002b36;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        font-family: 'JetBrains Mono', monospace;
    }

    .back-link {
        display: inline-block;
        margin-top: 30px;
        color: #93a1a1;
        text-decoration: none;
        font-family: 'JetBrains Mono', monospace;
        padding: 10px 20px;
        border: 1px solid #93a1a1;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        background: #b58900;
        color: #002b36;
        border-color: #b58900;
        transform: translateY(-2px);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .calculator-container {
            padding: 60px 15px 30px;
        }

        .calculator {
            padding: 20px;
            width: 320px;
            max-width: 90vw;
        }

        .calculator-title {
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .calculator-subtitle {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .calculator-display {
            padding: 15px;
            min-height: 80px;
            margin-bottom: 15px;
        }

        .calculator-expression {
            font-size: 0.9rem;
            min-height: 20px;
            margin-bottom: 8px;
        }

        .calculator-result {
            font-size: 1.6rem;
            min-height: 30px;
        }

        .calculator-buttons {
            gap: 12px;
        }

        .calc-btn {
            font-size: 1.1rem;
            padding: 18px 12px;
            min-height: 55px;
            border-radius: 12px;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .calc-btn:active {
            transform: scale(0.95);
            transition: transform 0.1s ease;
        }

        .project-info {
            padding: 15px;
            margin-top: 25px;
        }

        .project-info h3 {
            font-size: 1.2rem;
            margin-bottom: 12px;
        }

        .project-info p {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .tech-tag {
            font-size: 0.8rem;
            padding: 4px 10px;
        }

        .back-link {
            padding: 12px 20px;
            font-size: 0.9rem;
        }
    }

    /* Extra small devices (phones in portrait) */
    @media (max-width: 480px) {
        .calculator-container {
            padding: 50px 10px 25px;
        }

        .calculator {
            padding: 15px;
            width: 280px;
            max-width: 95vw;
        }

        .calculator-title {
            font-size: 1.8rem;
        }

        .calculator-subtitle {
            font-size: 0.9rem;
        }

        .calculator-display {
            padding: 12px;
            min-height: 75px;
        }

        .calculator-expression {
            font-size: 0.8rem;
        }

        .calculator-result {
            font-size: 1.4rem;
        }

        .calculator-buttons {
            gap: 10px;
        }

        .calc-btn {
            font-size: 1rem;
            padding: 16px 10px;
            min-height: 50px;
        }

        .project-info {
            padding: 12px;
            margin-top: 20px;
        }

        .project-info h3 {
            font-size: 1.1rem;
        }

        .tech-stack {
            gap: 8px;
        }
    }

    /* iPhone specific optimizations */
    @media (max-width: 430px) {
        .calculator {
            width: 260px;
            padding: 12px;
        }

        .calc-btn {
            padding: 14px 8px;
            min-height: 48px;
            font-size: 0.95rem;
        }

        .calculator-display {
            padding: 10px;
            min-height: 70px;
        }

        .calculator-result {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1 class="calculator-title">🧮 Calculator</h1>
        <p class="calculator-subtitle">Una calcolatrice web interattiva</p>
    </div>
    
    <div class="calculator">
        <div class="calculator-display">
            <div class="calculator-expression" id="expression"></div>
            <div class="calculator-result" id="result">0</div>
        </div>
        
        <div class="calculator-buttons">
            <button class="calc-btn clear" onclick="clearDisplay()">C</button>
            <button class="calc-btn operator" onclick="deleteLast()">⌫</button>
            <button class="calc-btn operator" onclick="setOperator('/')">/</button>
            <button class="calc-btn operator" onclick="setOperator('*')">×</button>
            
            <button class="calc-btn" onclick="appendToDisplay('7')">7</button>
            <button class="calc-btn" onclick="appendToDisplay('8')">8</button>
            <button class="calc-btn" onclick="appendToDisplay('9')">9</button>
            <button class="calc-btn operator" onclick="setOperator('-')">-</button>
            
            <button class="calc-btn" onclick="appendToDisplay('4')">4</button>
            <button class="calc-btn" onclick="appendToDisplay('5')">5</button>
            <button class="calc-btn" onclick="appendToDisplay('6')">6</button>
            <button class="calc-btn operator" onclick="setOperator('+')">+</button>
            
            <button class="calc-btn" onclick="appendToDisplay('1')">1</button>
            <button class="calc-btn" onclick="appendToDisplay('2')">2</button>
            <button class="calc-btn" onclick="appendToDisplay('3')">3</button>
            <button class="calc-btn operator" onclick="calculateResult()" rowspan="2">=</button>
            
            <button class="calc-btn zero" onclick="appendToDisplay('0')">0</button>
            <button class="calc-btn" onclick="appendToDisplay('.')">.</button>
        </div>
    </div>

    <div class="project-info">
        <h3>📋 Informazioni Progetto</h3>
        <p><strong>Nome:</strong> Calculator</p>
        <p><strong>Descrizione:</strong> Calcolatrice web interattiva con interfaccia moderna</p>
        <p><strong>Stato:</strong> Completato ✅</p>
        <p><strong>Funzionalità:</strong> Operazioni base, design responsive</p>
        
        <div class="tech-stack">
            <span class="tech-tag">HTML5</span>
            <span class="tech-tag">CSS3</span>
            <span class="tech-tag">JavaScript</span>
            <span class="tech-tag">Laravel</span>
        </div>
    </div>

    <a href="{{ route('projects') }}" class="back-link">
        ← Torna ai Progetti
    </a>
</div>

<script>
let currentInput = '0';
let operator = null;
let previousInput = null;
let shouldResetDisplay = false;
let currentExpression = '';

function updateDisplay() {
    const resultDisplay = document.getElementById('result');
    const expressionDisplay = document.getElementById('expression');
    
    resultDisplay.textContent = currentInput;
    expressionDisplay.textContent = currentExpression;
}

function clearDisplay() {
    currentInput = '0';
    operator = null;
    previousInput = null;
    shouldResetDisplay = false;
    currentExpression = '';
    updateDisplay();
}

function deleteLast() {
    if (currentInput.length > 1) {
        currentInput = currentInput.slice(0, -1);
    } else {
        currentInput = '0';
    }
    updateDisplay();
}

function appendToDisplay(value) {
    if (shouldResetDisplay) {
        currentInput = '0';
        shouldResetDisplay = false;
    }

    if (value === '.' && currentInput.includes('.')) {
        return;
    }

    if (currentInput === '0' && value !== '.') {
        currentInput = value;
    } else {
        currentInput += value;
    }

    updateDisplay();
}

function setOperator(op) {
    if (operator && previousInput !== null) {
        calculateResult();
    }
    
    // Update expression
    if (currentExpression === '' || shouldResetDisplay) {
        currentExpression = currentInput + ' ' + op;
    } else {
        currentExpression += ' ' + currentInput + ' ' + op;
    }
    
    operator = op;
    previousInput = currentInput;
    shouldResetDisplay = true;
    updateDisplay();
}

function calculateResult() {
    if (operator && previousInput !== null && currentInput !== null) {
        const prev = parseFloat(previousInput);
        const current = parseFloat(currentInput);
        
        let result;
        
        switch (operator) {
            case '+':
                result = prev + current;
                break;
            case '-':
                result = prev - current;
                break;
            case '*':
                result = prev * current;
                break;
            case '/':
                if (current !== 0) {
                    result = prev / current;
                } else {
                    result = 'Error';
                }
                break;
            default:
                return;
        }
        
        // Update expression to show full calculation
        currentExpression = previousInput + ' ' + operator + ' ' + currentInput + ' =';
        
        currentInput = result.toString();
        operator = null;
        previousInput = null;
        shouldResetDisplay = true;
        updateDisplay();
    }
}

// Keyboard support
document.addEventListener('keydown', function(event) {
    const key = event.key;
    
    if (key >= '0' && key <= '9') {
        appendToDisplay(key);
    } else if (key === '.') {
        appendToDisplay('.');
    } else if (key === '+' || key === '-' || key === '*' || key === '/') {
        setOperator(key);
    } else if (key === 'Enter' || key === '=') {
        calculateResult();
    } else if (key === 'Escape' || key === 'c' || key === 'C') {
        clearDisplay();
    } else if (key === 'Backspace') {
        deleteLast();
    }
});
</script>
@endsection
