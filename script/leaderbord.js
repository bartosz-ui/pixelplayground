document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#leaderboard-table tbody');
    const errorSection = document.querySelector('.error-message');
    const refreshButton = document.getElementById('refreshLeaderboardBtn');
    const statusLabel = document.getElementById('leaderboardStatus');

    if (!tableBody) {
        return;
    }

    async function refreshLeaderboard() {
        try {
            const response = await fetch('leaderbord-data.php', { cache: 'no-store' });
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const json = await response.json();
            if (json.error) {
                throw new Error(json.error);
            }

            tableBody.innerHTML = '';
            json.rows.forEach((row) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escapeHtml(row.player_name)}</td>
                    <td>${escapeHtml(row.connect4_rank)}</td>
                    <td>${escapeHtml(row.connect4_score)}</td>
                    <td>${escapeHtml(row.wordle_rank)}</td>
                    <td>${escapeHtml(row.wordle_score)}</td>
                `;
                tableBody.appendChild(tr);
            });

            if (statusLabel) {
                statusLabel.textContent = `Laatste update: ${new Date().toLocaleTimeString('nl-NL')}`;
            }

            if (errorSection) {
                errorSection.textContent = '';
                errorSection.style.display = 'none';
            }
        } catch (err) {
            if (errorSection) {
                errorSection.textContent = `Fout bij laden van leaderboard: ${err.message}`;
                errorSection.style.display = 'block';
            }
        }
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    refreshLeaderboard();
    const intervalId = setInterval(refreshLeaderboard, 5000);

    if (refreshButton) {
        refreshButton.addEventListener('click', async () => {
            refreshButton.disabled = true;
            refreshButton.textContent = 'Ververs bezig...';
            await refreshLeaderboard();
            refreshButton.textContent = 'Ververs leaderboard';
            refreshButton.disabled = false;
        });
    }
});
