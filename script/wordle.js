class WordleGame {
    constructor() {
        this.ROWS = 6;
        this.COLS = 5;
        this.words = [
            'APPLE','BRAVE','CRANE','SLATE','CRAZY','PLANT','GHOST','LIGHT','NURSE','TABLE','HOUSE','WATER','GREEN','BREAD','MONEY'
        ];
        this.keyboardRows = ['QWERTYUIOP','ASDFGHJKL','ZXCVBNM'];
        this.resetStats();
        this.init();
    }

    resetStats() {
        const raw = localStorage.getItem('wordle_stats');
        this.stats = raw ? JSON.parse(raw) : {played:0,win:0};
    }

    saveStats() {
        localStorage.setItem('wordle_stats', JSON.stringify(this.stats));
        this.renderStats();
    }

    init() {
        this.createBoard();
        this.createKeyboard();
        this.bindControls();
        this.newGame();
    }

    createBoard() {
        const board = document.getElementById('gameBoard');
        board.innerHTML = '';
        for (let r = 0; r < this.ROWS; r++) {
            const row = document.createElement('article');
            row.className = 'guess-row';
            for (let c = 0; c < this.COLS; c++) {
                const cell = document.createElement('article');
                cell.className = 'guess-cell';
                row.appendChild(cell);
            }
            board.appendChild(row);
        }
    }

    createKeyboard() {
        const kb = document.getElementById('keyboard');
        kb.innerHTML = '';
        this.keyboardRows.forEach(row => {
            const rowEl = document.createElement('article');
            rowEl.className = 'kb-row';
            for (const ch of row) {
                const key = document.createElement('button');
                key.className = 'kb-key';
                key.textContent = ch;
                key.onclick = () => this.handleKey(ch);
                rowEl.appendChild(key);
            }
            kb.appendChild(rowEl);
        });
        const actionRow = document.createElement('article');
        actionRow.className = 'kb-row';
        const enter = document.createElement('button');
        enter.className = 'kb-key wide';
        enter.textContent = 'ENTER';
        enter.onclick = () => this.handleKey('ENTER');
        const back = document.createElement('button');
        back.className = 'kb-key wide';
        back.textContent = 'BACK';
        back.onclick = () => this.handleKey('BACK');
        actionRow.appendChild(enter);
        actionRow.appendChild(back);
        kb.appendChild(actionRow);
    }

    bindControls() {
        document.getElementById('newGameBtn').onclick = () => this.newGame();
        document.getElementById('resetBtn').onclick = () => this.newGame();
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') this.handleKey('ENTER');
            else if (e.key === 'Backspace') this.handleKey('BACK');
            else if (/^[a-zA-Z]$/.test(e.key)) this.handleKey(e.key.toUpperCase());
        });
    }

    newGame() {
        this.target = this.words[Math.floor(Math.random()*this.words.length)];
        this.grid = Array.from({length:this.ROWS}, () => Array(this.COLS).fill(''));
        this.row = 0; this.col = 0; this.solved = false; this.gameOver = false;
        document.getElementById('gameStatus').style.display = 'none';
        this.updateBoard(); this.renderKeyboard(); this.renderStats();
    }

    handleKey(key) {
        if (this.gameOver) return;
        if (key === 'ENTER') return this.submitGuess();
        if (key === 'BACK') return this.deleteLetter();
        if (key.length === 1 && /[A-Z]/.test(key)) this.insertLetter(key);
    }

    insertLetter(ch) {
        if (this.col < this.COLS) {
            this.grid[this.row][this.col] = ch;
            this.col++;
            this.updateBoard();
        }
    }

    deleteLetter() {
        if (this.col > 0) {
            this.col--;
            this.grid[this.row][this.col] = '';
            this.updateBoard();
        }
    }

    submitGuess() {
        if (this.col !== this.COLS) return;
        const guess = this.grid[this.row].join('');
        if (!this.words.includes(guess)) {
            this.flashMessage('Onbekend woord');
            return;
        }
        const result = this.checkGuess(guess);
        this.applyResultToRow(this.row, result);
        if (guess === this.target) {
            this.solved = true; this.gameOver = true; this.stats.played++; this.stats.win++; this.saveStats();
            this.showStatus('Gefeliciteerd! Je hebt het woord geraden.');
            return;
        }
        this.row++;
        this.col = 0;
        if (this.row >= this.ROWS) {
            this.gameOver = true; this.stats.played++; this.saveStats();
            this.showStatus('Helaas, je hebt het niet geraden. Woord: ' + this.target);
        }
    }

    checkGuess(guess) {
        const res = Array(this.COLS).fill('absent');
        const targetArr = this.target.split('');
        // First pass: correct
        for (let i=0;i<this.COLS;i++){
            if (guess[i] === targetArr[i]) { res[i]='correct'; targetArr[i]=null; }
        }
        // Second pass: present
        for (let i=0;i<this.COLS;i++){
            if (res[i]==='correct') continue;
            const idx = targetArr.indexOf(guess[i]);
            if (idx !== -1) { res[i]='present'; targetArr[idx]=null; }
        }
        return res;
    }

    applyResultToRow(row, result) {
        const board = document.getElementById('gameBoard');
        const rowEl = board.children[row];
        for (let c=0;c<this.COLS;c++){
            const cell = rowEl.children[c];
            cell.classList.add(result[c]);
        }
        this.renderKeyboard();
    }

    updateBoard() {
        const board = document.getElementById('gameBoard');
        for (let r=0;r<this.ROWS;r++){
            const rowEl = board.children[r];
            for (let c=0;c<this.COLS;c++){
                const cell = rowEl.children[c];
                cell.textContent = this.grid[r][c] || '';
                cell.classList.toggle('filled', !!this.grid[r][c]);
            }
        }
    }

    renderKeyboard() {
        const kb = document.getElementById('keyboard');
        const keys = kb.querySelectorAll('.kb-key');
        const colorMap = {};
        // derive best known coloring from past rows
        for (let r=0;r<this.ROWS;r++){
            const rowEl = document.getElementById('gameBoard').children[r];
            if (!rowEl) break;
            for (let c=0;c<this.COLS;c++){
                const ch = rowEl.children[c].textContent;
                if (!ch) continue;
                if (rowEl.children[c].classList.contains('correct')) colorMap[ch]='correct';
                else if (rowEl.children[c].classList.contains('present') && colorMap[ch]!=='correct') colorMap[ch]='present';
                else if (rowEl.children[c].classList.contains('absent') && !colorMap[ch]) colorMap[ch]='absent';
            }
        }
        keys.forEach(k=>{
            const txt = k.textContent;
            k.classList.remove('correct','present','absent');
            if (colorMap[txt]) k.classList.add(colorMap[txt]);
        });
    }

    flashMessage(msg){
        this.showStatus(msg);
        setTimeout(()=>{ if(!this.gameOver) document.getElementById('gameStatus').style.display='none'; },800);
    }

    showStatus(msg){
        const s = document.getElementById('gameStatus');
        const t = document.getElementById('statusText');
        s.style.display = 'block'; t.textContent = msg;
    }

    renderStats(){
        const el = document.getElementById('statsText');
        el.textContent = `Gespeeld: ${this.stats.played} — Gewonnen: ${this.stats.win}`;
    }
}

document.addEventListener('DOMContentLoaded', ()=>{
    window.wordle = new WordleGame();
});
