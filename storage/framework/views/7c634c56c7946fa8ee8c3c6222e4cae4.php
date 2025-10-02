<?php $__env->startSection('title', 'Tic-Tac-Toe - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Tic-Tac-Toe specific styles */
.tictactoe-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 40px;
    padding: 40px 20px;
    min-height: calc(100vh - 70px);
    background: #002b36;
    color: #eee8d5;
}

.game-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
}

.game-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #b58900;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    margin-bottom: 10px;
}

.game-board {
    display: grid;
    grid-template-columns: repeat(3, 100px);
    grid-template-rows: repeat(3, 100px);
    gap: 5px;
    background: #073642;
    padding: 10px;
    border-radius: 12px;
    border: 3px solid #b58900;
    box-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
}

.cell {
    background: #002b36;
    border: 2px solid #586e75;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    user-select: none;
}

.cell:hover {
    background: #073642;
    border-color: #b58900;
    transform: scale(1.05);
}

.cell.occupied {
    cursor: not-allowed;
}

.cell.occupied:hover {
    transform: none;
}

.cell.x {
    color: #dc322f;
    border-color: #dc322f;
}

.cell.o {
    color: #268bd2;
    border-color: #268bd2;
}

.game-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
    min-width: 250px;
}

.score-panel {
    background: #073642;
    border: 2px solid #586e75;
    border-radius: 8px;
    padding: 25px;
    text-align: center;
}

.score-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #b58900;
    margin-bottom: 20px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.score-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.player-score {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
}

.player-name {
    font-size: 1rem;
    color: #93a1a1;
    margin-bottom: 5px;
}

.player-name.active {
    color: #b58900;
    font-weight: bold;
}

.score-value {
    font-size: 1.5rem;
    font-weight: bold;
    color: #eee8d5;
}

.current-player {
    text-align: center;
    padding: 15px;
    background: rgba(181, 137, 0, 0.1);
    border: 1px solid #b58900;
    border-radius: 8px;
    margin-top: 15px;
}

.current-player-text {
    color: #b58900;
    font-weight: bold;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.game-controls {
    background: #073642;
    border: 2px solid #586e75;
    border-radius: 8px;
    padding: 25px;
}

.controls-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #b58900;
    margin-bottom: 20px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.game-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
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
    padding: 20px;
    border-radius: 8px;
    font-weight: bold;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    font-size: 1.1rem;
}

.status-playing {
    background: rgba(133, 153, 0, 0.2);
    color: #859900;
    border: 1px solid #859900;
}

.status-winner {
    background: rgba(181, 137, 0, 0.2);
    color: #b58900;
    border: 1px solid #b58900;
}

.status-draw {
    background: rgba(38, 139, 210, 0.2);
    color: #268bd2;
    border: 1px solid #268bd2;
}

.game-mode {
    margin-bottom: 20px;
}

.mode-buttons {
    display: flex;
    gap: 10px;
}

.mode-btn {
    flex: 1;
    padding: 10px;
    background: #073642;
    color: #93a1a1;
    border: 1px solid #586e75;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    font-size: 0.9rem;
}

.mode-btn.active {
    background: #b58900;
    color: #002b36;
    border-color: #b58900;
}

.mode-btn:hover {
    background: #586e75;
    color: #eee8d5;
}

.mode-btn.active:hover {
    background: #cb4b16;
}

/* Responsive design */
@media (max-width: 768px) {
    .tictactoe-container {
        flex-direction: column;
        align-items: center;
        padding: 20px 10px;
        gap: 30px;
    }
    
    .game-board {
        grid-template-columns: repeat(3, 80px);
        grid-template-rows: repeat(3, 80px);
    }
    
    .cell {
        font-size: 2rem;
    }
    
    .game-info {
        flex-direction: row;
        min-width: auto;
        width: 100%;
        max-width: 500px;
    }
    
    .score-panel,
    .game-controls {
        flex: 1;
        min-width: 0;
    }
    
    .game-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .game-info {
        flex-direction: column;
    }
    
    .game-board {
        grid-template-columns: repeat(3, 70px);
        grid-template-rows: repeat(3, 70px);
    }
    
    .cell {
        font-size: 1.8rem;
    }
    
    .game-title {
        font-size: 1.8rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="tictactoe-container">
    <div class="game-area">
        <h1 class="game-title">Tic-Tac-Toe</h1>
        
        <div id="gameBoard" class="game-board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>
        
        <div id="gameStatus" class="game-status status-playing">
            Player X's Turn
        </div>
    </div>
    
    <div class="game-info">
        <div class="score-panel">
            <h3 class="score-title">Score</h3>
            
            <div class="score-stats">
                <div class="player-score">
                    <div id="playerXName" class="player-name active">Player X</div>
                    <div id="playerXScore" class="score-value">0</div>
                </div>
                <div class="player-score">
                    <div class="player-name">Draws </div>
                    <div id="drawScore" class="score-value">0</div>
                </div>
                <div class="player-score">
                    <div id="playerOName" class="player-name">Player O</div>
                    <div id="playerOScore" class="score-value">0</div>
                </div>
            </div>
            
            <div id="currentPlayer" class="current-player">
                <div class="current-player-text">Player X's Turn</div>
            </div>
        </div>
        
        <div class="game-controls">
            <h3 class="controls-title">Game Controls</h3>
            
            <div class="game-mode">
                <div class="mode-buttons">
                    <button id="pvpMode" class="mode-btn active">2 Players</button>
                    <button id="pveMode" class="mode-btn">vs AI</button>
                </div>
            </div>
            
            <div class="game-buttons">
                <button id="newGameBtn" class="game-btn">New Game</button>
                <button id="resetScoreBtn" class="game-btn secondary">Reset Score</button>
            </div>
        </div>
    </div>
</div>

<script>
class TicTacToe {
    constructor() {
        this.board = Array(9).fill('');
        this.currentPlayer = 'X';
        this.gameActive = true;
        this.gameMode = 'pvp'; // 'pvp' or 'pve'
        this.scores = { X: 0, O: 0, draw: 0 };
        
        this.winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
            [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
            [0, 4, 8], [2, 4, 6] // Diagonals
        ];
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.updateDisplay();
    }
    
    setupEventListeners() {
        // Cell clicks
        document.querySelectorAll('.cell').forEach((cell, index) => {
            cell.addEventListener('click', () => this.handleCellClick(index));
        });
        
        // Control buttons
        document.getElementById('newGameBtn').addEventListener('click', () => this.newGame());
        document.getElementById('resetScoreBtn').addEventListener('click', () => this.resetScore());
        
        // Mode buttons
        document.getElementById('pvpMode').addEventListener('click', () => this.setMode('pvp'));
        document.getElementById('pveMode').addEventListener('click', () => this.setMode('pve'));
    }
    
    setMode(mode) {
        this.gameMode = mode;
        
        // Update mode buttons
        document.getElementById('pvpMode').classList.toggle('active', mode === 'pvp');
        document.getElementById('pveMode').classList.toggle('active', mode === 'pve');
        
        // Update player names
        const playerOName = document.getElementById('playerOName');
        if (mode === 'pve') {
            playerOName.textContent = 'AI';
        } else {
            playerOName.textContent = 'Player O';
        }
        
        this.newGame();
    }
    
    handleCellClick(index) {
        if (!this.gameActive || this.board[index] !== '') {
            return;
        }
        
        this.makeMove(index);
        
        // If it's PvE mode and game is still active, make AI move
        if (this.gameMode === 'pve' && this.gameActive) {
            setTimeout(() => this.makeAIMove(), 500);
        }
    }
    
    makeMove(index) {
        this.board[index] = this.currentPlayer;
        this.updateBoard();
        
        if (this.checkWinner()) {
            this.endGame(`${this.currentPlayer === 'X' ? 'Player X' : (this.gameMode === 'pve' ? 'AI' : 'Player O')} Wins!`);
            this.scores[this.currentPlayer]++;
        } else if (this.board.every(cell => cell !== '')) {
            this.endGame("It's a Draw!");
            this.scores.draw++;
        } else {
            this.currentPlayer = this.currentPlayer === 'X' ? 'O' : 'X';
        }
        
        this.updateDisplay();
    }
    
    makeAIMove() {
        if (!this.gameActive) return;
        
        let bestMove = this.getBestMove();
        if (bestMove !== -1) {
            this.makeMove(bestMove);
        }
    }
    
    getBestMove() {
        // Simple AI: Try to win, then block, then take center, then take corners, then take edges
        
        // Check for winning move
        for (let i = 0; i < 9; i++) {
            if (this.board[i] === '') {
                this.board[i] = 'O';
                if (this.checkWinner()) {
                    this.board[i] = '';
                    return i;
                }
                this.board[i] = '';
            }
        }
        
        // Check for blocking move
        for (let i = 0; i < 9; i++) {
            if (this.board[i] === '') {
                this.board[i] = 'X';
                if (this.checkWinner()) {
                    this.board[i] = '';
                    return i;
                }
                this.board[i] = '';
            }
        }
        
        // Take center if available
        if (this.board[4] === '') {
            return 4;
        }
        
        // Take corners
        const corners = [0, 2, 6, 8];
        for (let corner of corners) {
            if (this.board[corner] === '') {
                return corner;
            }
        }
        
        // Take edges
        const edges = [1, 3, 5, 7];
        for (let edge of edges) {
            if (this.board[edge] === '') {
                return edge;
            }
        }
        
        return -1;
    }
    
    checkWinner() {
        return this.winningCombinations.some(combination => {
            const [a, b, c] = combination;
            return this.board[a] && this.board[a] === this.board[b] && this.board[a] === this.board[c];
        });
    }
    
    endGame(message) {
        this.gameActive = false;
        document.getElementById('gameStatus').textContent = message;
        document.getElementById('gameStatus').className = 'game-status status-winner';
        
        // Highlight winning combination
        this.highlightWinner();
        
        // Auto-restart after 2 seconds
        setTimeout(() => {
            this.newGame();
        }, 2000);
    }
    
    highlightWinner() {
        const winningCombination = this.winningCombinations.find(combination => {
            const [a, b, c] = combination;
            return this.board[a] && this.board[a] === this.board[b] && this.board[a] === this.board[c];
        });
        
        if (winningCombination) {
            winningCombination.forEach(index => {
                document.querySelector(`[data-index="${index}"]`).style.background = 'rgba(181, 137, 0, 0.3)';
            });
        }
    }
    
    newGame() {
        this.board = Array(9).fill('');
        this.currentPlayer = 'X';
        this.gameActive = true;
        
        this.updateBoard();
        this.updateDisplay();
        
        document.getElementById('gameStatus').textContent = "Player X's Turn";
        document.getElementById('gameStatus').className = 'game-status status-playing';
    }
    
    resetScore() {
        this.scores = { X: 0, O: 0, draw: 0 };
        this.updateScore();
        this.newGame();
    }
    
    updateBoard() {
        document.querySelectorAll('.cell').forEach((cell, index) => {
            cell.textContent = this.board[index];
            cell.className = 'cell';
            
            if (this.board[index] !== '') {
                cell.classList.add('occupied');
                cell.classList.add(this.board[index].toLowerCase());
            }
        });
    }
    
    updateDisplay() {
        // Update current player display
        const currentPlayerText = this.gameActive ? 
            `Player ${this.currentPlayer}'s Turn` : 
            document.getElementById('gameStatus').textContent;
        
        document.getElementById('currentPlayer').querySelector('.current-player-text').textContent = currentPlayerText;
        
        // Update active player highlighting
        document.getElementById('playerXName').classList.toggle('active', this.currentPlayer === 'X' && this.gameActive);
        document.getElementById('playerOName').classList.toggle('active', this.currentPlayer === 'O' && this.gameActive);
        
        this.updateScore();
    }
    
    updateScore() {
        document.getElementById('playerXScore').textContent = this.scores.X;
        document.getElementById('playerOScore').textContent = this.scores.O;
        document.getElementById('drawScore').textContent = this.scores.draw;
    }
}

// Initialize the game when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new TicTacToe();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/games/tic-tac-toe/index.blade.php ENDPATH**/ ?>