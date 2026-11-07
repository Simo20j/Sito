const searchInput = document.getElementById('retroSearchInput');
const retroDropdown = document.getElementById('retroDropdown');
const modal = document.getElementById('infoModal');
const modalTitle = document.getElementById('modalTitle');
const modalBody = document.getElementById('modalBody');
const closeModal = document.querySelector('.close-modal');

let gameInterval = null; // Per fermare il gioco quando chiudi la finestra

if (searchInput && retroDropdown) {
    searchInput.addEventListener('focus', () => {
        retroDropdown.classList.add('active');
    });

    searchInput.addEventListener('input', () => {
        retroDropdown.classList.add('active');
        const term = searchInput.value.toLowerCase().trim();
        retroDropdown.querySelectorAll('.dropdown-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(term) ? 'block' : 'none';
        });
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !retroDropdown.contains(e.target)) {
            retroDropdown.classList.remove('active');
        }
    });

    // Quando clicchi su un gioco nel menu a tendina
    retroDropdown.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const gameKey = item.getAttribute('data-game');
            retroDropdown.classList.remove('active');

            if (gameKey === 'snake') {
                avviaSnake();
            } else {
                modalTitle.innerText = item.textContent;
                modalBody.innerHTML = `<p style="color: #ccc; padding: 20px;">Il minigioco ${item.textContent} sarà disponibile a breve su RetroGaming.it!</p>`;
                modal.style.display = 'flex';
            }
        });
    });
}

// Chiusura modale e stop del gioco
if (closeModal) {
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        clearInterval(gameInterval);
    });
}

// ---- IMPLEMENTAZIONE MINIGIOCO SNAKE ----
function avviaSnake() {
    modalTitle.innerText = "🐍 Snake Storico";
    modalBody.innerHTML = `
        <p style="color: #00ffcc; font-size: 14px; margin-bottom: 10px;">Usa le <strong>freccette</strong> della tastiera per muoverti!</p>
        <canvas id="snakeCanvas" width="300" height="300" style="background-color: #111; border: 2px solid #00ffcc; display: block; margin: 0 auto; border-radius: 6px;"></canvas>
        <p style="color: #fff; margin-top: 10px; font-size: 16px;">Punteggio: <span id="score">0</span></p>
    `;
    modal.style.display = 'flex';

    const canvas = document.getElementById('snakeCanvas');
    const ctx = canvas.getContext('2d');
    const box = 20;
    let score = 0;

    let snake = [{ x: 9 * box, y: 10 * box }];
    let food = {
        x: Math.floor(Math.random() * 15) * box,
        y: Math.floor(Math.random() * 15) * box
    };
    let d = "RIGHT";

    document.onkeydown = function(event) {
        if (event.keyCode === 37 && d !== "RIGHT") d = "LEFT";
        else if (event.keyCode === 38 && d !== "DOWN") d = "UP";
        else if (event.keyCode === 39 && d !== "LEFT") d = "RIGHT";
        else if (event.keyCode === 40 && d !== "UP") d = "DOWN";
    };

    function draw() {
        ctx.fillStyle = "#111";
        ctx.fillRect(0, 0, 300, 300);

        for (let i = 0; i < snake.length; i++) {
            ctx.fillStyle = i === 0 ? "#00ffcc" : "#00aa88";
            ctx.fillRect(snake[i].x, snake[i].y, box, box);
        }

        ctx.fillStyle = "#ff0055";
        ctx.fillRect(food.x, food.y, box, box);

        let snakeX = snake[0].x;
        let snakeY = snake[0].y;

        if (d === "LEFT") snakeX -= box;
        if (d === "UP") snakeY -= box;
        if (d === "RIGHT") snakeX += box;
        if (d === "DOWN") snakeY += box;

        if (snakeX === food.x && snakeY === food.y) {
            score++;
            document.getElementById('score').innerText = score;
            food = {
                x: Math.floor(Math.random() * 15) * box,
                y: Math.floor(Math.random() * 15) * box
            };
        } else {
            snake.pop();
        }

        let newHead = { x: snakeX, y: snakeY };

        if (snakeX < 0 || snakeX >= 300 || snakeY < 0 || snakeY >= 300 || collision(newHead, snake)) {
            clearInterval(gameInterval);
            alert("Game Over! Punteggio totale: " + score);
            modal.style.display = 'none';
            return;
        }

        snake.unshift(newHead);
    }

    clearInterval(gameInterval);
    gameInterval = setInterval(draw, 120);
}

function collision(head, array) {
    for (let i = 0; i < array.length; i++) {
        if (head.x === array[i].x && head.y === array[i].y) return true;
    }
    return false;
}
