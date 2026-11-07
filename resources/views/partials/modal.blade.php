<!-- STRUTTURA POP-UP MODALE -->
<div id="infoModal" class="modal-overlay">
    <div class="modal-content" @if ($centered ?? false) style="text-align: center; max-width: 450px;" @endif>
        <span class="close-modal">&times;</span>
        <h2 id="modalTitle" style="color: #00ffcc; margin-top: 0;"></h2>
        <div id="modalBody"></div>
    </div>
</div>
