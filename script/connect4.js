// Connect 4 Game Logic

class Connect4Game {
    constructor(mode = 'pvp') {
        this.ROWS = 6;
        this.COLS = 7;
        this.board = [];
        this.currentPlayer = 1; // 1 for red, 2 for yellow
        this.gameMode = mode; // 'pvp' or 'pve'
        this.gameOver = false;
        this.winner = null;
        this.player1Wins = localStorage.getItem('connect4_player1_wins') || 0;
        this.player2Wins = localStorage.getItem('connect4_player2_wins') || 0;
        
        this.initBoard();
        this.render();
    }

    initBoard() {
        this.board = Array(this.ROWS).fill(null).map(() => Array(this.COLS).fill(0));
    }

    dropPiece(col) {
        if (this.gameOver) return false;
        if (col < 0 || col >= this.COLS) return false;

        // Find the lowest empty row in this column
        for (let row = this.ROWS - 1; row >= 0; row--) {
            if (this.board[row][col] === 0) {
                this.board[row][col] = this.currentPlayer;
                
                // Check for win
                if (this.checkWin(row, col)) {
                    this.gameOver = true;
                    this.winner = this.currentPlayer;
                    this.updateWins();
                    return true;
                }

                // Check for draw
                if (this.isBoardFull()) {
                    this.gameOver = true;
                    this.winner = 0; // Draw
                    return true;
                }

                // Switch player
                this.currentPlayer = this.currentPlayer === 1 ? 2 : 1;
                return true;
            }
        }
        return false;
    }

    checkWin(row, col) {
        const player = this.board[row][col];
        
        // Check horizontal
        if (this.countDirection(row, col, 0, 1, player) + 
            this.countDirection(row, col, 0, -1, player) >= 3) {
            return true;
        }
        
        // Check vertical
        if (this.countDirection(row, col, 1, 0, player) + 
            this.countDirection(row, col, -1, 0, player) >= 3) {
            return true;
        }
        
        // Check diagonal (top-left to bottom-right)
        if (this.countDirection(row, col, 1, 1, player) + 
            this.countDirection(row, col, -1, -1, player) >= 3) {
            return true;
        }
        
        // Check diagonal (top-right to bottom-left)
        if (this.countDirection(row, col, 1, -1, player) + 
            this.countDirection(row, col, -1, 1, player) >= 3) {
            return true;
        }
        
        return false;
    }

    countDirection(row, col, dRow, dCol, player) {
        let count = 0;
        let r = row + dRow;
        let c = col + dCol;
        
        while (r >= 0 && r < this.ROWS && c >= 0 && c < this.COLS && this.board[r][c] === player) {
            count++;
            r += dRow;
            c += dCol;
        }
        
        return count;
    }

    isBoardFull() {
        return this.board[0].every(cell => cell !== 0);
    }

    updateWins() {
        if (this.winner === 1) {
            this.player1Wins++;
            localStorage.setItem('connect4_player1_wins', this.player1Wins);
        } else if (this.winner === 2) {
            this.player2Wins++;
            localStorage.setItem('connect4_player2_wins', this.player2Wins);
        }
    }

    getAIMove() {
        // Minimax algorithm with depth limit
        const depth = 5;
        let bestScore = -Infinity;
        let bestCol = 0;

        for (let col = 0; col < this.COLS; col++) {
            if (this.isColumnFull(col)) continue;

            // Make move
            const row = this.getLowestRow(col);
            this.board[row][col] = 2;

            const score = this.minimax(depth - 1, -Infinity, Infinity, false);

            // Undo move
            this.board[row][col] = 0;

            if (score > bestScore) {
                bestScore = score;
                bestCol = col;
            }
        }

        return bestCol;
    }

    minimax(depth, alpha, beta, isMaximizing) {
        // Terminal states
        if (depth === 0 || this.gameOver) {
            return this.evaluateBoard();
        }

        if (isMaximizing) {
            let maxScore = -Infinity;
            for (let col = 0; col < this.COLS; col++) {
                if (this.isColumnFull(col)) continue;

                const row = this.getLowestRow(col);
                this.board[row][col] = 2;

                // Check if this move wins
                if (this.checkWin(row, col)) {
                    this.board[row][col] = 0;
                    return 10000;
                }

                const score = this.minimax(depth - 1, alpha, beta, false);
                this.board[row][col] = 0;

                maxScore = Math.max(score, maxScore);
                alpha = Math.max(alpha, score);
                if (beta <= alpha) break;
            }
            return maxScore;
        } else {
            let minScore = Infinity;
            for (let col = 0; col < this.COLS; col++) {
                if (this.isColumnFull(col)) continue;

                const row = this.getLowestRow(col);
                this.board[row][col] = 1;

                // Check if opponent wins
                if (this.checkWin(row, col)) {
                    this.board[row][col] = 0;
                    return -10000;
                }

                const score = this.minimax(depth - 1, alpha, beta, true);
                this.board[row][col] = 0;

                minScore = Math.min(score, minScore);
                beta = Math.min(beta, score);
                if (beta <= alpha) break;
            }
            return minScore;
        }
    }

    evaluateBoard() {
        let score = 0;

        // Count potential threats and opportunities
        for (let row = 0; row < this.ROWS; row++) {
            for (let col = 0; col < this.COLS; col++) {
                score += this.evaluatePosition(row, col, 1, -1); // Opponent pieces
                score += this.evaluatePosition(row, col, 2, 1);  // AI pieces
            }
        }

        return score;
    }

    evaluatePosition(row, col, player, multiplier) {
        if (this.board[row][col] !== player) return 0;

        let score = 0;

        // Directions: horizontal, vertical, diagonal1, diagonal2
        const directions = [[0, 1], [1, 0], [1, 1], [1, -1]];

        directions.forEach(([dRow, dCol]) => {
            let count = 1 + 
                this.countDirection(row, col, dRow, dCol, player) +
                this.countDirection(row, col, -dRow, -dCol, player);

            if (count >= 2) score += Math.pow(count, 2) * multiplier;
        });

        return score;
    }

    getLowestRow(col) {
        for (let row = this.ROWS - 1; row >= 0; row--) {
            if (this.board[row][col] === 0) return row;
        }
        return -1;
    }

    isColumnFull(col) {
        return this.board[0][col] !== 0;
    }

    render() {
        const boardElement = document.getElementById('gameBoard');
        boardElement.innerHTML = '';

        for (let row = 0; row < this.ROWS; row++) {
            for (let col = 0; col < this.COLS; col++) {
                const cell = document.createElement('button');
                cell.className = 'board-cell';
                cell.dataset.col = col;
                cell.onclick = () => playerMove(col);

                if (this.isColumnFull(col)) {
                    cell.classList.add('disabled');
                }

                const piece = document.createElement('div');
                piece.className = 'piece';
                
                if (this.board[row][col] === 1) {
                    piece.classList.add('red');
                } else if (this.board[row][col] === 2) {
                    piece.classList.add('yellow');
                } else {
                    piece.classList.add('empty');
                }

                cell.appendChild(piece);
                boardElement.appendChild(cell);
            }
        }

        this.updateStatus();
        this.updateScores();
    }

    updateStatus() {
        const statusElement = document.getElementById('gameStatus');
        const statusText = document.getElementById('statusText');

        if (this.gameOver) {
            statusElement.style.display = 'block';
            if (this.winner === 0) {
                statusText.textContent = '🤝 Gelijkspel! Het bord is vol.';
            } else if (this.winner === 1) {
                statusText.textContent = '🎉 Speler 1 (Rood) wint!';
            } else if (this.winner === 2) {
                if (this.gameMode === 'pve') {
                    statusText.textContent = '🤖 AI (Geel) wint!';
                } else {
                    statusText.textContent = '🎉 Speler 2 (Geel) wint!';
                }
            }
        } else {
            statusElement.style.display = 'none';
            const player = this.currentPlayer === 1 ? 'Speler 1 (Rood)' : 
                          (this.gameMode === 'pve' ? 'AI (Geel)' : 'Speler 2 (Geel)');
        }
    }

    updateScores() {
        document.getElementById('player1Score').textContent = `Winsten: ${this.player1Wins}`;
        
        if (this.gameMode === 'pve') {
            document.getElementById('player2Title').textContent = 'AI (Geel)';
            document.getElementById('player2Score').textContent = `Winsten: ${this.player2Wins}`;
        } else {
            document.getElementById('player2Title').textContent = 'Speler 2 (Geel)';
            document.getElementById('player2Score').textContent = `Winsten: ${this.player2Wins}`;
        }
    }

    reset() {
        this.initBoard();
        this.currentPlayer = 1;
        this.gameOver = false;
        this.winner = null;
        this.render();
    }
}

// Global game instance
let game = null;

function startNewGame(mode) {
    game = new Connect4Game(mode);
}

function playerMove(col) {
    if (!game || game.gameOver) return;

    if (game.dropPiece(col)) {
        game.render();

        // AI move if playing against AI
        if (game.gameMode === 'pve' && game.currentPlayer === 2 && !game.gameOver) {
            setTimeout(() => {
                const aiCol = game.getAIMove();
                game.dropPiece(aiCol);
                game.render();
            }, 500);
        }
    }
}

function resetGame() {
    if (game) {
        game.reset();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Show game controls if no game started
    const gameStatus = document.getElementById('gameStatus');
    if (gameStatus) {
        gameStatus.style.display = 'none';
    }
});
