document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // 1. RICERCA IN TEMPO REALE NELLE CARD/SCHEDE
    // ==========================================
    const searchInput = document.getElementById('searchInput');

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();
            
            // Cerca sia tra gli articoli della Home sia tra le schede Console/Giochi
            const cards = document.querySelectorAll('.card, .console-card, .gen-section');

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // ==========================================
    // 2. MODALE POP-UP PER SCHEDE CONSOLE / GIOCHI
    // ==========================================
    const modal = document.getElementById('infoModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const closeModal = document.querySelector('.close-modal');

    // Assegna il click a tutte le schede console/giochi per aprire il dettaglio
    const consoleCards = document.querySelectorAll('.console-card');
    consoleCards.forEach(card => {
        card.style.cursor = 'pointer';
        card.addEventListener('click', () => {
            if (modal && modalTitle && modalBody) {
                const title = card.querySelector('h3') ? card.querySelector('h3').innerText : 'Dettaglio';
                const year = card.querySelector('.console-year') ? card.querySelector('.console-year').innerText : '';
                const badge = card.querySelector('.console-badge') ? card.querySelector('.console-badge').innerText : '';
                const desc = card.querySelector('p') ? card.querySelector('p').innerText : '';

                modalTitle.innerText = `${title} (${year})`;
                modalBody.innerHTML = `
                    <p style="color: #00ffcc; font-weight: bold; margin-bottom: 10px;">Piattaforma/Tipo: ${badge}</p>
                    <p style="line-height: 1.6; color: #ccc;">${desc}</p>
                `;
                modal.style.display = 'flex';
            }
        });
    });

    // Chiudi modale al click sulla X o fuori dalla finestra
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // ==========================================
    // 3. MENU RESPONSIVE PER DISPOSITIVI MOBILI
    // ==========================================
    const toggleBtn = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (toggleBtn && navLinks) {
        toggleBtn.addEventListener('click', () => {
            navLinks.classList.toggle('nav-active');
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('retroSearchInput');
    const dropdown = document.getElementById('retroDropdown');

    if (searchInput && dropdown) {
        // Mostra il menu a tendina quando clicchi o scrivi nella barra
        searchInput.addEventListener('focus', () => {
            dropdown.style.display = 'block';
        });

        // Filtra i giochi in tempo reale mentre digiti
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase().trim();
            const items = dropdown.querySelectorAll('.dropdown-item');
            dropdown.style.display = 'block';

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(term)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Chiudi il menu se clicchi fuori dalla barra o dal menu
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Gestione del click su un gioco del menu
        dropdown.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const gameName = item.getAttribute('data-game');
                
                // Qui puoi aprire il gioco scelto (es. aprire un modale o reindirizzare)
                alert(`Hai selezionato: ${item.textContent}! Presto potrai giocarci direttamente qui.`);
                dropdown.style.display = 'none';
            });
        });
    }
});