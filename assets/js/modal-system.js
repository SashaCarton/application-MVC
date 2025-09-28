class ModalSystem {
    constructor() {
        this.createModalHTML();
        this.bindEvents();
    }

    createModalHTML() {
        const modalHTML = `
            <div id="customModal" class="modal-overlay" style="display: none;">
                <div class="modal-container">
                    <div class="modal-header">
                        <h3 id="modalTitle" class="modal-title"></h3>
                        <button class="modal-close" id="modalClose">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="modalIcon" class="modal-icon"></div>
                        <p id="modalMessage" class="modal-message"></p>
                    </div>
                    <div class="modal-footer">
                        <button id="modalCancel" class="modal-btn modal-btn-secondary">Annuler</button>
                        <button id="modalConfirm" class="modal-btn modal-btn-primary">Confirmer</button>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        this.addModalStyles();
    }

    addModalStyles() {
        const styles = `
            <style id="modalStyles">
                .modal-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.8);
                    backdrop-filter: blur(5px);
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .modal-overlay.show {
                    opacity: 1;
                }

                .modal-container {
                    background: #1a1a1a;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    max-width: 500px;
                    width: 90%;
                    max-height: 80vh;
                    transform: scale(0.7);
                    transition: transform 0.3s ease;
                    font-family: 'Inter', sans-serif;
                }

                .modal-overlay.show .modal-container {
                    transform: scale(1);
                }

                .modal-header {
                    padding: 25px 30px 20px;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .modal-title {
                    color: #fff;
                    font-size: 20px;
                    font-weight: 600;
                    margin: 0;
                    letter-spacing: 1px;
                }

                .modal-close {
                    background: none;
                    border: none;
                    color: #ccc;
                    font-size: 28px;
                    cursor: pointer;
                    padding: 0;
                    width: 30px;
                    height: 30px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: color 0.3s ease;
                }

                .modal-close:hover {
                    color: #fff;
                }

                .modal-body {
                    padding: 30px;
                    text-align: center;
                }

                .modal-icon {
                    font-size: 3rem;
                    margin-bottom: 20px;
                }

                .modal-icon.confirm { color: #f59e0b; }
                .modal-icon.success { color: #22c55e; }
                .modal-icon.error { color: #ef4444; }
                .modal-icon.info { color: #3b82f6; }
                .modal-icon.warning { color: #f59e0b; }

                .modal-message {
                    color: #ccc;
                    font-size: 16px;
                    line-height: 1.6;
                    margin: 0;
                }

                .modal-footer {
                    padding: 20px 30px 30px;
                    display: flex;
                    gap: 15px;
                    justify-content: flex-end;
                }

                .modal-btn {
                    padding: 12px 25px;
                    border: none;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-size: 13px;
                    min-width: 100px;
                }

                .modal-btn-primary {
                    background: #22c55e;
                    color: #000;
                }

                .modal-btn-primary:hover {
                    background: #16a34a;
                }

                .modal-btn-secondary {
                    background: transparent;
                    color: #ccc;
                    border: 1px solid #666;
                }

                .modal-btn-secondary:hover {
                    background: #666;
                    color: #fff;
                }

                .modal-btn-danger {
                    background: #ef4444;
                    color: #fff;
                }

                .modal-btn-danger:hover {
                    background: #dc2626;
                }

                /* Animations */
                @keyframes modalFadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }

                @keyframes modalSlideIn {
                    from { transform: scale(0.7) translateY(-50px); }
                    to { transform: scale(1) translateY(0); }
                }
            </style>
        `;

        document.head.insertAdjacentHTML('beforeend', styles);
    }

    bindEvents() {
        const modal = document.getElementById('customModal');
        const closeBtn = document.getElementById('modalClose');
        const cancelBtn = document.getElementById('modalCancel');
        const confirmBtn = document.getElementById('modalConfirm');

        // Fermer avec le X
        closeBtn.addEventListener('click', () => this.hideModal());

        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.style.display !== 'none') {
                this.hideModal();
            }
        });

        // Fermer en cliquant à l'extérieur
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                this.hideModal();
            }
        });

        // Boutons
        cancelBtn.addEventListener('click', () => {
            if (this.onCancel) this.onCancel();
            this.hideModal();
        });

        confirmBtn.addEventListener('click', () => {
            if (this.onConfirm) this.onConfirm();
            this.hideModal();
        });
    }

    showModal(title, message, type = 'confirm', onConfirm = null, onCancel = null) {
        const modal = document.getElementById('customModal');
        const titleEl = document.getElementById('modalTitle');
        const messageEl = document.getElementById('modalMessage');
        const iconEl = document.getElementById('modalIcon');
        const confirmBtn = document.getElementById('modalConfirm');
        const cancelBtn = document.getElementById('modalCancel');

        // Stocker les callbacks
        this.onConfirm = onConfirm;
        this.onCancel = onCancel;

        // Définir le contenu
        titleEl.textContent = title;
        messageEl.textContent = message;

        // Définir l'icône selon le type
        const icons = {
            confirm: '⚠️',
            success: '✅',
            error: '❌',
            info: 'ℹ️',
            warning: '⚠️',
            delete: '🗑️'
        };

        iconEl.textContent = icons[type] || icons.confirm;
        iconEl.className = `modal-icon ${type}`;

        // Configurer les boutons selon le type
        if (type === 'alert') {
            cancelBtn.style.display = 'none';
            confirmBtn.textContent = 'OK';
            confirmBtn.className = 'modal-btn modal-btn-primary';
        } else if (type === 'delete') {
            cancelBtn.style.display = 'inline-block';
            confirmBtn.textContent = 'Supprimer';
            confirmBtn.className = 'modal-btn modal-btn-danger';
            cancelBtn.textContent = 'Annuler';
        } else {
            cancelBtn.style.display = 'inline-block';
            confirmBtn.textContent = 'Confirmer';
            confirmBtn.className = 'modal-btn modal-btn-primary';
            cancelBtn.textContent = 'Annuler';
        }

        // Afficher la modale
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('show'), 10);

        // Focus sur le bouton approprié
        setTimeout(() => {
            if (type === 'alert') {
                confirmBtn.focus();
            } else {
                cancelBtn.focus();
            }
        }, 300);
    }

    hideModal() {
        const modal = document.getElementById('customModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Méthodes de convenance
    showConfirm(title, message, onConfirm, onCancel) {
        this.showModal(title, message, 'confirm', onConfirm, onCancel);
    }

    showAlert(title, message, onClose) {
        this.showModal(title, message, 'alert', onClose);
    }

    showDelete(title, message, onConfirm, onCancel) {
        this.showModal(title, message, 'delete', onConfirm, onCancel);
    }
}

// Initialiser le système de modale quand le DOM est prêt
let modalSystem;
document.addEventListener('DOMContentLoaded', function () {
    modalSystem = new ModalSystem();
});

// Fonctions globales pour faciliter l'usage
window.showConfirm = function (title, message, onConfirm, onCancel) {
    if (!modalSystem) modalSystem = new ModalSystem();
    modalSystem.showConfirm(title, message, onConfirm, onCancel);
};

window.showAlert = function (title, message, onClose) {
    if (!modalSystem) modalSystem = new ModalSystem();
    modalSystem.showAlert(title, message, onClose);
};

window.showDelete = function (title, message, onConfirm, onCancel) {
    if (!modalSystem) modalSystem = new ModalSystem();
    modalSystem.showDelete(title, message, onConfirm, onCancel);
};