<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold mb-2">Крестики-нолики</h2>
        <div id="game-status" class="text-lg font-semibold text-primary mb-4">Ваш ход (X)</div>
        <div class="flex justify-center items-center space-x-4 mb-4">
            <div class="text-center">
                <div class="text-sm text-gray-600">Вы (X)</div>
                <div id="player-score" class="text-2xl font-bold text-primary">0</div>
            </div>
            <div class="text-gray-400">VS</div>
            <div class="text-center">
                <div class="text-sm text-gray-600">Компьютер (O)</div>
                <div id="computer-score" class="text-2xl font-bold text-secondary">0</div>
            </div>
        </div>
    </div>

    <!-- Game Board -->
    <div class="max-w-md mx-auto mb-6">
        <div id="game-board" class="grid grid-cols-3 gap-2 bg-gray-800 p-2 rounded-lg">
            @for($i = 0; $i < 9; $i++)
                <div class="cell bg-white aspect-square rounded flex items-center justify-center text-4xl font-bold cursor-pointer hover:bg-gray-100 transition-colors" data-index="{{ $i }}">
                    <span class="cell-content"></span>
                </div>
            @endfor
        </div>
    </div>

    <!-- Controls -->
    <div class="text-center space-x-4">
        <button id="reset-game" class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-6 rounded-button">
            Новая игра
        </button>
        <button id="reset-scores" class="bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-2 px-6 rounded-button">
            Сбросить счет
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const gameContainer = document.getElementById('game-container');
    const gameId = gameContainer.dataset.gameId;
    const ratingPoints = parseInt(gameContainer.dataset.ratingPoints);
    
    let board = ['', '', '', '', '', '', '', '', ''];
    let currentPlayer = 'X';
    let gameActive = true;
    let playerScore = parseInt(localStorage.getItem('ticTacToe_playerScore') || '0');
    let computerScore = parseInt(localStorage.getItem('ticTacToe_computerScore') || '0');
    
    const cells = document.querySelectorAll('.cell');
    const statusDisplay = document.getElementById('game-status');
    const playerScoreDisplay = document.getElementById('player-score');
    const computerScoreDisplay = document.getElementById('computer-score');
    const resetButton = document.getElementById('reset-game');
    const resetScoresButton = document.getElementById('reset-scores');
    
    const winningConditions = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // columns
        [0, 4, 8], [2, 4, 6] // diagonals
    ];
    
    // Update score displays
    function updateScores() {
        playerScoreDisplay.textContent = playerScore;
        computerScoreDisplay.textContent = computerScore;
    }
    
    updateScores();
    
    // Check for winner
    function checkWinner() {
        for (let condition of winningConditions) {
            const [a, b, c] = condition;
            if (board[a] && board[a] === board[b] && board[a] === board[c]) {
                return board[a];
            }
        }
        return board.includes('') ? null : 'Tie';
    }
    
    // Make move
    function makeMove(index, player) {
        if (board[index] !== '' || !gameActive) return false;
        
        board[index] = player;
        cells[index].querySelector('.cell-content').textContent = player;
        cells[index].classList.add(player === 'X' ? 'text-primary' : 'text-secondary');
        cells[index].classList.remove('cursor-pointer', 'hover:bg-gray-100');
        
        return true;
    }
    
    // Computer move (minimax algorithm)
    function computerMove() {
        if (!gameActive) return;
        
        // Simple AI: try to win, then block, then take center, then take corner, else random
        let bestMove = -1;
        
        // Try to win
        for (let i = 0; i < 9; i++) {
            if (board[i] === '') {
                board[i] = 'O';
                if (checkWinner() === 'O') {
                    board[i] = '';
                    bestMove = i;
                    break;
                }
                board[i] = '';
            }
        }
        
        // Block player
        if (bestMove === -1) {
            for (let i = 0; i < 9; i++) {
                if (board[i] === '') {
                    board[i] = 'X';
                    if (checkWinner() === 'X') {
                        board[i] = '';
                        bestMove = i;
                        break;
                    }
                    board[i] = '';
                }
            }
        }
        
        // Take center
        if (bestMove === -1 && board[4] === '') {
            bestMove = 4;
        }
        
        // Take corner
        if (bestMove === -1) {
            const corners = [0, 2, 6, 8];
            const availableCorners = corners.filter(i => board[i] === '');
            if (availableCorners.length > 0) {
                bestMove = availableCorners[Math.floor(Math.random() * availableCorners.length)];
            }
        }
        
        // Random move
        if (bestMove === -1) {
            const available = [];
            for (let i = 0; i < 9; i++) {
                if (board[i] === '') available.push(i);
            }
            if (available.length > 0) {
                bestMove = available[Math.floor(Math.random() * available.length)];
            }
        }
        
        if (bestMove !== -1) {
            setTimeout(() => {
                makeMove(bestMove, 'O');
                handleGameResult();
            }, 500);
        }
    }
    
    // Handle game result
    function handleGameResult() {
        const winner = checkWinner();
        
        if (winner === 'X') {
            statusDisplay.textContent = 'Вы выиграли! 🎉';
            statusDisplay.className = 'text-lg font-semibold text-green-600 mb-4';
            gameActive = false;
            playerScore++;
            updateScores();
            localStorage.setItem('ticTacToe_playerScore', playerScore);
            saveGameResult(true);
        } else if (winner === 'O') {
            statusDisplay.textContent = 'Компьютер выиграл! 😔';
            statusDisplay.className = 'text-lg font-semibold text-red-600 mb-4';
            gameActive = false;
            computerScore++;
            updateScores();
            localStorage.setItem('ticTacToe_computerScore', computerScore);
            saveGameResult(false);
        } else if (winner === 'Tie') {
            statusDisplay.textContent = 'Ничья! 🤝';
            statusDisplay.className = 'text-lg font-semibold text-yellow-600 mb-4';
            gameActive = false;
            saveGameResult(false, true);
        } else {
            statusDisplay.textContent = currentPlayer === 'X' ? 'Ваш ход (X)' : 'Ход компьютера (O)...';
            statusDisplay.className = 'text-lg font-semibold text-primary mb-4';
        }
    }
    
    // Save game result to server
    function saveGameResult(win, tie = false) {
        if (tie) return; // Don't save ties
        
        fetch('/api/games/result', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                game_id: gameId,
                score: win ? 1 : 0,
                rating_points_earned: win ? ratingPoints : 0,
                win: win,
                played_at: new Date().toISOString()
            })
        }).catch(err => console.error('Error saving game result:', err));
    }
    
    // Cell click handler
    cells.forEach((cell, index) => {
        cell.addEventListener('click', function() {
            if (currentPlayer !== 'X' || !gameActive) return;
            
            if (makeMove(index, 'X')) {
                handleGameResult();
                
                if (gameActive) {
                    currentPlayer = 'O';
                    statusDisplay.textContent = 'Ход компьютера (O)...';
                    computerMove();
                    currentPlayer = 'X';
                }
            }
        });
    });
    
    // Reset game
    resetButton.addEventListener('click', function() {
        board = ['', '', '', '', '', '', '', '', ''];
        currentPlayer = 'X';
        gameActive = true;
        
        cells.forEach(cell => {
            cell.querySelector('.cell-content').textContent = '';
            cell.classList.remove('text-primary', 'text-secondary');
            cell.classList.add('cursor-pointer', 'hover:bg-gray-100');
        });
        
        statusDisplay.textContent = 'Ваш ход (X)';
        statusDisplay.className = 'text-lg font-semibold text-primary mb-4';
    });
    
    // Reset scores
    resetScoresButton.addEventListener('click', function() {
        if (confirm('Сбросить счет?')) {
            playerScore = 0;
            computerScore = 0;
            localStorage.removeItem('ticTacToe_playerScore');
            localStorage.removeItem('ticTacToe_computerScore');
            updateScores();
        }
    });
});
</script>

<style>
.cell {
    min-height: 100px;
}
.cell-content {
    user-select: none;
}
</style>




