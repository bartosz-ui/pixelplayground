
const knownBadges = [
    { id: 'wordle_first_win', title: 'Wordle Beginner', desc: 'Win je eerste Wordle', icon: '🏅' },
    { id: 'wordle_speedster', title: 'Speedster', desc: 'Raad een woord binnen 3 pogingen', icon: '⚡' },
    { id: 'connect4_first_win', title: 'Eerste Zege', desc: 'Win je eerste Connect 4', icon: '🥇' }
];

function getOrAskPlayerName(prefix) {
    const key = `player_name_${prefix}`;
    let name = localStorage.getItem(key);
    if (!name) {
        name = prompt('Voer je naam in voor scores en badges:') || 'Anoniem';
        localStorage.setItem(key, name);
    }
    return name;
}

function awardAchievement(playerName, id, meta = {}) {
    const key = `achievements_${playerName}`;
    const raw = localStorage.getItem(key);
    const list = raw ? JSON.parse(raw) : {};
    if (list[id]) return false;
    list[id] = { unlocked: true, date: new Date().toISOString(), ...meta };
    localStorage.setItem(key, JSON.stringify(list));
    showBadgeNotification(id);
    return true;
}

function getAchievements(playerName) {
    const raw = localStorage.getItem(`achievements_${playerName}`);
    return raw ? JSON.parse(raw) : {};
}

function renderBadges(containerSelector, playerName, filter = null) {
    const container = document.querySelector(containerSelector);
    if (!container) return;
    const achieved = getAchievements(playerName);
    const filtered = filter ? knownBadges.filter(b => b.id.startsWith(filter)) : knownBadges;
    container.innerHTML = filtered.map(b => {
        const unlocked = !!achieved[b.id];
        return `<div class="badge ${unlocked ? 'unlocked' : 'locked'}" title="${b.desc}">
            <div class="badge-icon">${b.icon}</div>
            <div class="badge-title">${b.title}</div>
        </div>`;
    }).join('');
}

function showBadgeNotification(id) {
    const badge = knownBadges.find(b => b.id === id);
    const el = document.createElement('div');
    el.className = 'badge-notice';
    el.innerHTML = `<div class="notice-inner">${badge ? badge.icon : '🏅'} ${badge ? badge.title : id} ontgrendeld!</div>`;
    document.body.appendChild(el);
    setTimeout(() => { el.classList.add('visible'); }, 20);
    setTimeout(() => { el.classList.remove('visible'); setTimeout(()=>el.remove(),300); }, 3000);
}
