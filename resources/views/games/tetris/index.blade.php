@extends('layouts.app')

@section('title', 'Tetris - Inkblade.cloud')

@push('styles')
<style>
/* Tetris-specific styles */
.tetris-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 30px;
    padding: 40px 20px;
    min-height: calc(100vh - 70px);
    background: #002b36;
    color: #eee8d5;
}

.game-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.game-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #b58900;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    margin-bottom: 10px;
}

.game-board-container {
    position: relative;
    display: inline-block;
}

.game-board {
    border: 3px solid #b58900;
    border-radius: 8px;
    background: #073642;
    box-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
    display: block;
}

.game-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 43, 54, 0.95);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100;
    backdrop-filter: blur(5px);
}

.overlay-content {
    text-align: center;
    padding: 30px;
    color: #eee8d5;
}

.overlay-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #b58900;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.overlay-message {
    font-size: 1.1rem;
    color: #93a1a1;
    margin-bottom: 25px;
    line-height: 1.5;
}

.overlay-btn {
    padding: 15px 30px;
    font-size: 1.1rem;
    background: #b58900;
    color: #002b36;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    font-weight: bold;
}

.overlay-btn:hover {
    background: #cb4b16;
    transform: translateY(-2px);
}

.game-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
    min-width: 200px;
}

.score-panel {
    background: #073642;
    border: 2px solid #586e75;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.score-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #b58900;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.score-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 1rem;
}

.score-label {
    color: #93a1a1;
}

.score-value {
    color: #eee8d5;
    font-weight: bold;
}

.controls-panel {
    background: #073642;
    border: 2px solid #586e75;
    border-radius: 8px;
    padding: 20px;
}

.controls-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #b58900;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.control-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.control-key {
    background: #002b36;
    color: #b58900;
    padding: 2px 8px;
    border-radius: 4px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    border: 1px solid #586e75;
}

.game-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
}

.game-btn {
    padding: 12px 20px;
    background: #b58900;
    color: #002b36;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.game-btn:hover {
    background: #cb4b16;
    transform: translateY(-2px);
}

.game-btn:disabled {
    background: #586e75;
    color: #93a1a1;
    cursor: not-allowed;
    transform: none;
}

.game-btn.secondary {
    background: #073642;
    color: #eee8d5;
    border: 1px solid #586e75;
}

.game-btn.secondary:hover {
    background: #586e75;
    color: #eee8d5;
}

.game-status {
    text-align: center;
    margin-top: 20px;
    padding: 15px;
    border-radius: 8px;
    font-weight: bold;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.status-playing {
    background: rgba(133, 153, 0, 0.2);
    color: #859900;
    border: 1px solid #859900;
}

.status-paused {
    background: rgba(203, 75, 22, 0.2);
    color: #cb4b16;
    border: 1px solid #cb4b16;
}

.status-game-over {
    background: rgba(220, 50, 47, 0.2);
    color: #dc322f;
    border: 1px solid #dc322f;
}

/* Mobile Controls */
.mobile-controls {
    display: none;
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 43, 54, 0.95);
    border: 2px solid #b58900;
    border-radius: 12px;
    padding: 15px;
    gap: 10px;
    z-index: 1000;
    backdrop-filter: blur(10px);
}

.control-row {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.control-btn {
    padding: 10px 15px;
    background: #073642;
    color: #eee8d5;
    border: 2px solid #586e75;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    min-width: 50px;
    min-height: 40px;
}

.control-btn.wide {
    flex: 1;
    max-width: 120px;
}

.control-btn:hover {
    background: #586e75;
    border-color: #b58900;
}

.control-btn:active {
    background: #b58900;
    color: #002b36;
}

/* Responsive design */
@media (max-width: 768px) {
    .tetris-container {
        flex-direction: column;
        align-items: center;
        padding: 20px 10px 100px 10px; /* Extra bottom padding for fixed controls */
        gap: 15px;
    }
    
    .game-info {
        flex-direction: row;
        min-width: auto;
        width: 100%;
        max-width: 400px;
        margin-bottom: 10px;
    }
    
    .score-panel,
    .controls-panel {
        flex: 1;
        min-width: 0;
    }
    
    .game-title {
        font-size: 1.8rem;
        margin-bottom: 5px;
    }
    
    .mobile-controls {
        display: flex;
        flex-direction: column;
    }
    
    .game-board-container {
        margin-bottom: 10px;
    }
    
    .game-board {
        width: 280px;
        height: 560px;
    }
    
    .overlay-content {
        padding: 20px;
    }
    
    .overlay-title {
        font-size: 1.5rem;
    }
    
    .overlay-message {
        font-size: 1rem;
    }
    
    .game-buttons {
        margin-bottom: 0;
    }
}

@media (max-width: 480px) {
    .tetris-container {
        padding: 15px 5px 90px 5px;
    }
    
    .game-info {
        flex-direction: column;
        margin-bottom: 5px;
    }
    
    .game-title {
        font-size: 1.6rem;
    }
    
    .game-board {
        width: 250px;
        height: 500px;
    }
    
    .overlay-content {
        padding: 15px;
    }
    
    .overlay-title {
        font-size: 1.3rem;
    }
    
    .overlay-message {
        font-size: 0.9rem;
    }
    
    .mobile-controls {
        padding: 10px;
        bottom: 10px;
    }
    
    .control-btn {
        padding: 8px 12px;
        min-width: 45px;
        min-height: 35px;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="tetris-container">
    <div class="game-area">
        <h1 class="game-title">Tetris</h1>
        
        <div class="game-board-container">
            <canvas id="gameCanvas" class="game-board" width="300" height="600"></canvas>
            <div id="gameOverlay" class="game-overlay">
                <div class="overlay-content">
                    <h3 id="overlayTitle" class="overlay-title">Start Game</h3>
                    <p id="overlayMessage" class="overlay-message">Click to begin playing Tetris</p>
                    <button id="overlayStartBtn" class="game-btn overlay-btn">Start Game</button>
                </div>
            </div>
        </div>
        
        <div class="game-buttons">
            <button id="startBtn" class="game-btn">Start Game</button>
            <button id="pauseBtn" class="game-btn secondary" disabled>Pause</button>
            <button id="resetBtn" class="game-btn secondary">Reset</button>
        </div>
        
        <!-- Mobile Controls -->
        <div class="mobile-controls">
            <div class="control-row">
                <button id="moveLeftBtn" class="control-btn">←</button>
                <button id="rotateBtn" class="control-btn">↻</button>
                <button id="moveRightBtn" class="control-btn">→</button>
            </div>
            <div class="control-row">
                <button id="softDropBtn" class="control-btn wide">↓</button>
                <button id="hardDropBtn" class="control-btn wide">⬇</button>
            </div>
        </div>
        
        <div id="gameStatus" class="game-status status-playing" style="display: none;">
            Game Over
        </div>
    </div>
    
    <div class="game-info">
        <div class="score-panel">
            <h3 class="score-title">Score</h3>
            <div class="score-item">
                <span class="score-label">Score:</span>
                <span id="score" class="score-value">0</span>
            </div>
            <div class="score-item">
                <span class="score-label">Lines:</span>
                <span id="lines" class="score-value">0</span>
            </div>
            <div class="score-item">
                <span class="score-label">Level:</span>
                <span id="level" class="score-value">1</span>
            </div>
        </div>
        
        <div class="controls-panel">
            <h3 class="controls-title">Controls</h3>
            <div class="control-item">
                <span>Move Left:</span>
                <span class="control-key">← / Button</span>
            </div>
            <div class="control-item">
                <span>Move Right:</span>
                <span class="control-key">→ / Button</span>
            </div>
            <div class="control-item">
                <span>Soft Drop:</span>
                <span class="control-key">↓ / Button</span>
            </div>
            <div class="control-item">
                <span>Hard Drop:</span>
                <span class="control-key">Space / Button</span>
            </div>
            <div class="control-item">
                <span>Rotate:</span>
                <span class="control-key">↑ / Button</span>
            </div>
            <div class="control-item">
                <span>Pause:</span>
                <span class="control-key">P</span>
            </div>
        </div>
    </div>
</div>

<script>
class Tetris {
    constructor() {
        this.canvas = document.getElementById('gameCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.boardWidth = 10;
        this.boardHeight = 20;
        this.blockSize = 30;
        
        this.board = Array(this.boardHeight).fill().map(() => Array(this.boardWidth).fill(0));
        this.currentPiece = null;
        this.nextPiece = null;
        this.score = 0;
        this.lines = 0;
        this.level = 1;
        this.gameRunning = false;
        this.gamePaused = false;
        this.dropTime = 0;
        this.dropInterval = 1000;
        
        // Tetris pieces (tetrominoes)
        this.pieces = [
            // I piece
            [[1,1,1,1]],
            // O piece
            [[1,1],[1,1]],
            // T piece
            [[0,1,0],[1,1,1]],
            // S piece
            [[0,1,1],[1,1,0]],
            // Z piece
            [[1,1,0],[0,1,1]],
            // J piece
            [[1,0,0],[1,1,1]],
            // L piece
            [[0,0,1],[1,1,1]]
        ];
        
        this.colors = [
            '#002b36', // empty
            '#b58900', // I piece
            '#cb4b16', // O piece
            '#dc322f', // T piece
            '#859900', // S piece
            '#268bd2', // Z piece
            '#6c71c4', // J piece
            '#d33682'  // L piece
        ];
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.draw();
    }
    
    setupEventListeners() {
        document.getElementById('startBtn').addEventListener('click', () => this.startGame());
        document.getElementById('pauseBtn').addEventListener('click', () => this.togglePause());
        document.getElementById('resetBtn').addEventListener('click', () => this.resetGame());
        
        // Overlay start button
        document.getElementById('overlayStartBtn').addEventListener('click', () => this.startGame());
        
        // Mobile control buttons
        document.getElementById('moveLeftBtn').addEventListener('click', () => this.handleMobileMove(-1, 0));
        document.getElementById('moveRightBtn').addEventListener('click', () => this.handleMobileMove(1, 0));
        document.getElementById('rotateBtn').addEventListener('click', () => this.handleMobileRotate());
        document.getElementById('softDropBtn').addEventListener('click', () => this.handleMobileSoftDrop());
        document.getElementById('hardDropBtn').addEventListener('click', () => this.handleMobileHardDrop());
        
        document.addEventListener('keydown', (e) => this.handleKeyPress(e));
    }
    
    startGame() {
        this.gameRunning = true;
        this.gamePaused = false;
        this.score = 0;
        this.lines = 0;
        this.level = 1;
        this.dropInterval = 1000;
        
        this.board = Array(this.boardHeight).fill().map(() => Array(this.boardWidth).fill(0));
        this.spawnPiece();
        this.gameLoop();
        
        document.getElementById('startBtn').disabled = true;
        document.getElementById('pauseBtn').disabled = false;
        document.getElementById('gameStatus').style.display = 'none';
        
        this.hideOverlay();
        this.updateScore();
    }
    
    togglePause() {
        this.gamePaused = !this.gamePaused;
        document.getElementById('pauseBtn').textContent = this.gamePaused ? 'Resume' : 'Pause';
        
        if (this.gamePaused) {
            this.showOverlay('Game Paused', 'Click to resume playing', 'Resume Game');
        } else {
            this.hideOverlay();
            this.gameLoop();
        }
    }
    
    resetGame() {
        this.gameRunning = false;
        this.gamePaused = false;
        this.board = Array(this.boardHeight).fill().map(() => Array(this.boardWidth).fill(0));
        this.currentPiece = null;
        this.score = 0;
        this.lines = 0;
        this.level = 1;
        
        document.getElementById('startBtn').disabled = false;
        document.getElementById('pauseBtn').disabled = true;
        document.getElementById('pauseBtn').textContent = 'Pause';
        document.getElementById('gameStatus').style.display = 'none';
        
        this.showOverlay('Start Game', 'Click to begin playing Tetris', 'Start Game');
        this.updateScore();
        this.draw();
    }
    
    spawnPiece() {
        const pieceIndex = Math.floor(Math.random() * this.pieces.length);
        this.currentPiece = {
            shape: this.pieces[pieceIndex],
            x: Math.floor(this.boardWidth / 2) - Math.floor(this.pieces[pieceIndex][0].length / 2),
            y: 0,
            color: pieceIndex + 1
        };
        
        if (this.checkCollision(this.currentPiece, 0, 0)) {
            this.gameOver();
        }
    }
    
    checkCollision(piece, dx, dy, newShape = null) {
        const shape = newShape || piece.shape;
        const newX = piece.x + dx;
        const newY = piece.y + dy;
        
        for (let y = 0; y < shape.length; y++) {
            for (let x = 0; x < shape[y].length; x++) {
                if (shape[y][x]) {
                    const boardX = newX + x;
                    const boardY = newY + y;
                    
                    if (boardX < 0 || boardX >= this.boardWidth || 
                        boardY >= this.boardHeight || 
                        (boardY >= 0 && this.board[boardY][boardX])) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    rotatePiece() {
        if (!this.currentPiece) return;
        
        const rotated = this.rotateMatrix(this.currentPiece.shape);
        
        if (!this.checkCollision(this.currentPiece, 0, 0, rotated)) {
            this.currentPiece.shape = rotated;
        }
    }
    
    rotateMatrix(matrix) {
        const rows = matrix.length;
        const cols = matrix[0].length;
        const rotated = Array(cols).fill().map(() => Array(rows).fill(0));
        
        for (let i = 0; i < rows; i++) {
            for (let j = 0; j < cols; j++) {
                rotated[j][rows - 1 - i] = matrix[i][j];
            }
        }
        
        return rotated;
    }
    
    movePiece(dx, dy) {
        if (!this.currentPiece || this.gamePaused) return;
        
        if (!this.checkCollision(this.currentPiece, dx, dy)) {
            this.currentPiece.x += dx;
            this.currentPiece.y += dy;
            return true;
        }
        return false;
    }
    
    dropPiece() {
        if (!this.movePiece(0, 1)) {
            this.placePiece();
            this.clearLines();
            this.spawnPiece();
        }
    }
    
    hardDrop() {
        while (this.movePiece(0, 1)) {
            this.score += 2; // Bonus points for hard drop
        }
        this.placePiece();
        this.clearLines();
        this.spawnPiece();
        this.updateScore();
    }
    
    placePiece() {
        if (!this.currentPiece) return;
        
        for (let y = 0; y < this.currentPiece.shape.length; y++) {
            for (let x = 0; x < this.currentPiece.shape[y].length; x++) {
                if (this.currentPiece.shape[y][x]) {
                    const boardX = this.currentPiece.x + x;
                    const boardY = this.currentPiece.y + y;
                    
                    if (boardY >= 0) {
                        this.board[boardY][boardX] = this.currentPiece.color;
                    }
                }
            }
        }
    }
    
    clearLines() {
        let linesCleared = 0;
        
        for (let y = this.boardHeight - 1; y >= 0; y--) {
            if (this.board[y].every(cell => cell !== 0)) {
                this.board.splice(y, 1);
                this.board.unshift(Array(this.boardWidth).fill(0));
                linesCleared++;
                y++; // Check the same row again
            }
        }
        
        if (linesCleared > 0) {
            this.lines += linesCleared;
            
            // Scoring system
            const linePoints = [0, 40, 100, 300, 1200];
            this.score += linePoints[linesCleared] * this.level;
            
            // Level up every 10 lines
            const newLevel = Math.floor(this.lines / 10) + 1;
            if (newLevel > this.level) {
                this.level = newLevel;
                this.dropInterval = Math.max(100, 1000 - (this.level - 1) * 50);
            }
            
            this.updateScore();
        }
    }
    
    updateScore() {
        document.getElementById('score').textContent = this.score;
        document.getElementById('lines').textContent = this.lines;
        document.getElementById('level').textContent = this.level;
    }
    
    gameOver() {
        this.gameRunning = false;
        document.getElementById('gameStatus').style.display = 'block';
        document.getElementById('gameStatus').className = 'game-status status-game-over';
        document.getElementById('gameStatus').textContent = 'Game Over!';
        document.getElementById('startBtn').disabled = false;
        document.getElementById('pauseBtn').disabled = true;
        this.showOverlay('Game Over!', 'Click to play again', 'Play Again');
    }
    
    handleKeyPress(e) {
        if (!this.gameRunning) return;
        
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                this.movePiece(-1, 0);
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.movePiece(1, 0);
                break;
            case 'ArrowDown':
                e.preventDefault();
                this.dropPiece();
                this.score += 1; // Bonus point for soft drop
                this.updateScore();
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.rotatePiece();
                break;
            case ' ':
                e.preventDefault();
                this.hardDrop();
                break;
            case 'p':
            case 'P':
                e.preventDefault();
                this.togglePause();
                break;
        }
    }
    
    // Mobile control handlers
    handleMobileMove(dx, dy) {
        if (!this.gameRunning || this.gamePaused) return;
        this.movePiece(dx, dy);
    }
    
    handleMobileRotate() {
        if (!this.gameRunning || this.gamePaused) return;
        this.rotatePiece();
    }
    
    handleMobileSoftDrop() {
        if (!this.gameRunning || this.gamePaused) return;
        this.dropPiece();
        this.score += 1; // Bonus point for soft drop
        this.updateScore();
    }
    
    handleMobileHardDrop() {
        if (!this.gameRunning || this.gamePaused) return;
        this.hardDrop();
    }
    
    // Overlay control methods
    showOverlay(title, message, buttonText) {
        document.getElementById('overlayTitle').textContent = title;
        document.getElementById('overlayMessage').textContent = message;
        document.getElementById('overlayStartBtn').textContent = buttonText;
        document.getElementById('gameOverlay').style.display = 'flex';
    }
    
    hideOverlay() {
        document.getElementById('gameOverlay').style.display = 'none';
    }
    
    draw() {
        // Clear canvas
        this.ctx.fillStyle = '#073642';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
        
        // Draw board
        for (let y = 0; y < this.boardHeight; y++) {
            for (let x = 0; x < this.boardWidth; x++) {
                if (this.board[y][x]) {
                    this.drawBlock(x, y, this.colors[this.board[y][x]]);
                }
            }
        }
        
        // Draw current piece
        if (this.currentPiece) {
            for (let y = 0; y < this.currentPiece.shape.length; y++) {
                for (let x = 0; x < this.currentPiece.shape[y].length; x++) {
                    if (this.currentPiece.shape[y][x]) {
                        const drawX = this.currentPiece.x + x;
                        const drawY = this.currentPiece.y + y;
                        this.drawBlock(drawX, drawY, this.colors[this.currentPiece.color]);
                    }
                }
            }
        }
        
        // Draw grid
        this.ctx.strokeStyle = '#586e75';
        this.ctx.lineWidth = 1;
        for (let x = 0; x <= this.boardWidth; x++) {
            this.ctx.beginPath();
            this.ctx.moveTo(x * this.blockSize, 0);
            this.ctx.lineTo(x * this.blockSize, this.canvas.height);
            this.ctx.stroke();
        }
        for (let y = 0; y <= this.boardHeight; y++) {
            this.ctx.beginPath();
            this.ctx.moveTo(0, y * this.blockSize);
            this.ctx.lineTo(this.canvas.width, y * this.blockSize);
            this.ctx.stroke();
        }
    }
    
    drawBlock(x, y, color) {
        this.ctx.fillStyle = color;
        this.ctx.fillRect(x * this.blockSize + 1, y * this.blockSize + 1, this.blockSize - 2, this.blockSize - 2);
        
        // Add highlight effect
        this.ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
        this.ctx.fillRect(x * this.blockSize + 1, y * this.blockSize + 1, this.blockSize - 2, 3);
    }
    
    gameLoop() {
        if (!this.gameRunning || this.gamePaused) return;
        
        const now = Date.now();
        if (now - this.dropTime > this.dropInterval) {
            this.dropPiece();
            this.dropTime = now;
        }
        
        this.draw();
        
        if (this.gameRunning && !this.gamePaused) {
            requestAnimationFrame(() => this.gameLoop());
        }
    }
}

// Initialize the game when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new Tetris();
});
</script>
@endsection
