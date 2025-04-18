/**
 * Live Edit Script
 * Script untuk mengaktifkan fitur live edit pada halaman
 */

class LiveEditor {
    constructor() {
        this.editMode = false;
        this.editableElements = [];
        this.currentElement = null;
        this.currentContent = null;
        this.currentType = null;
        this.pageIdentifier = document.body.dataset.pageIdentifier || 'home';
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        this.editorContainer = null;
        this.editorToolbar = null;
        this.editorContent = null;
        this.editorOverlay = null;
        
        this.init();
    }
    
    init() {
        // Cek apakah mode edit diaktifkan dari localStorage
        this.editMode = localStorage.getItem('liveEditMode') === 'enabled';
        
        if (this.editMode) {
            this.initEditMode();
        }
    }
    
    initEditMode() {
        // Tambahkan class ke body
        document.body.classList.add('live-edit-mode');
        
        // Tampilkan notifikasi bahwa mode edit aktif
        this.showEditModeNotification();
        
        // Buat editor container
        this.createEditor();
        
        // Scan semua elemen yang bisa diedit
        this.scanEditableElements();
        
        // Tambahkan event listeners
        this.addEventListeners();
    }
    
    showEditModeNotification() {
        const notification = document.createElement('div');
        notification.className = 'live-edit-notification';
        notification.innerHTML = `
            <div class="live-edit-notification-content">
                <i class="fas fa-edit"></i> Mode Edit Aktif
                <button class="live-edit-notification-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        document.body.appendChild(notification);
        
        // Tambahkan event listener untuk menutup notifikasi
        notification.querySelector('.live-edit-notification-close').addEventListener('click', () => {
            notification.remove();
        });
        
        // Otomatis hilangkan notifikasi setelah 5 detik
        setTimeout(() => {
            notification.classList.add('live-edit-notification-fadeout');
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 5000);
    }
    
    createEditor() {
        // Buat container editor
        this.editorContainer = document.createElement('div');
        this.editorContainer.className = 'live-edit-editor';
        this.editorContainer.style.display = 'none';
        
        // Buat toolbar
        this.editorToolbar = document.createElement('div');
        this.editorToolbar.className = 'live-edit-editor-toolbar';
        this.editorToolbar.innerHTML = `
            <div class="live-edit-editor-toolbar-section">
                <button class="live-edit-editor-btn" data-command="bold">
                    <i class="fas fa-bold"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="italic">
                    <i class="fas fa-italic"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="underline">
                    <i class="fas fa-underline"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="strikeThrough">
                    <i class="fas fa-strikethrough"></i>
                </button>
            </div>
            <div class="live-edit-editor-toolbar-section">
                <button class="live-edit-editor-btn" data-command="justifyLeft">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="justifyCenter">
                    <i class="fas fa-align-center"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="justifyRight">
                    <i class="fas fa-align-right"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="justifyFull">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
            <div class="live-edit-editor-toolbar-section">
                <button class="live-edit-editor-btn" data-command="insertUnorderedList">
                    <i class="fas fa-list-ul"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="insertOrderedList">
                    <i class="fas fa-list-ol"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="createLink">
                    <i class="fas fa-link"></i>
                </button>
                <button class="live-edit-editor-btn" data-command="unlink">
                    <i class="fas fa-unlink"></i>
                </button>
            </div>
            <div class="live-edit-editor-toolbar-actions">
                <button class="live-edit-editor-btn-save">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button class="live-edit-editor-btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        `;
        
        // Buat content editor
        this.editorContent = document.createElement('div');
        this.editorContent.className = 'live-edit-editor-content';
        this.editorContent.contentEditable = true;
        
        // Tambahkan toolbar dan content ke container
        this.editorContainer.appendChild(this.editorToolbar);
        this.editorContainer.appendChild(this.editorContent);
        
        // Buat overlay
        this.editorOverlay = document.createElement('div');
        this.editorOverlay.className = 'live-edit-overlay';
        this.editorOverlay.style.display = 'none';
        
        // Tambahkan editor dan overlay ke document
        document.body.appendChild(this.editorContainer);
        document.body.appendChild(this.editorOverlay);
        
        // Tambahkan event listeners untuk toolbar buttons
        this.addToolbarEventListeners();
    }
    
    addToolbarEventListeners() {
        // Command buttons
        const commandButtons = this.editorToolbar.querySelectorAll('[data-command]');
        commandButtons.forEach(button => {
            button.addEventListener('click', () => {
                const command = button.dataset.command;
                if (command === 'createLink') {
                    const url = prompt('Masukkan URL:');
                    if (url) {
                        document.execCommand(command, false, url);
                    }
                } else {
                    document.execCommand(command, false, null);
                }
                this.editorContent.focus();
            });
        });
        
        // Save button
        const saveButton = this.editorToolbar.querySelector('.live-edit-editor-btn-save');
        saveButton.addEventListener('click', () => {
            this.saveContent();
        });
        
        // Cancel button
        const cancelButton = this.editorToolbar.querySelector('.live-edit-editor-btn-cancel');
        cancelButton.addEventListener('click', () => {
            this.closeEditor();
        });
    }
    
    scanEditableElements() {
        // Cari semua elemen dengan atribut data-editable
        const elements = document.querySelectorAll('[data-editable]');
        elements.forEach(el => {
            this.editableElements.push(el);
            
            // Tambahkan class untuk menandakan elemen bisa diedit
            el.classList.add('live-editable');
            
            // Tambahkan edit button
            const editButton = document.createElement('button');
            editButton.className = 'live-edit-button';
            editButton.innerHTML = '<i class="fas fa-pencil-alt"></i>';
            el.appendChild(editButton);
            
            // Tambahkan event listener
            editButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.openEditor(el);
            });
        });
    }
    
    addEventListeners() {
        // Tambahkan event listener untuk menutup editor saat klik overlay
        this.editorOverlay.addEventListener('click', () => {
            this.closeEditor();
        });
        
        // Tambahkan event listener untuk keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Escape key untuk menutup editor
            if (e.key === 'Escape') {
                this.closeEditor();
            }
            
            // Ctrl + S untuk menyimpan
            if (e.key === 's' && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                if (this.editorContainer.style.display !== 'none') {
                    this.saveContent();
                }
            }
        });
    }
    
    openEditor(element) {
        // Simpan referensi ke elemen yang sedang diedit
        this.currentElement = element;
        this.currentType = element.dataset.editable;
        this.sectionIdentifier = element.dataset.section;
        
        // Simpan konten asli
        this.currentContent = element.innerHTML;
        
        // Tampilkan overlay
        this.editorOverlay.style.display = 'block';
        
        // Isi editor dengan konten elemen
        this.editorContent.innerHTML = this.currentContent;
        
        // Tampilkan editor
        this.editorContainer.style.display = 'block';
        
        // Posisikan editor
        this.positionEditor();
        
        // Focus pada editor
        this.editorContent.focus();
    }
    
    closeEditor() {
        // Sembunyikan editor dan overlay
        this.editorContainer.style.display = 'none';
        this.editorOverlay.style.display = 'none';
        
        // Reset state
        this.currentElement = null;
        this.currentContent = null;
        this.currentType = null;
    }
    
    positionEditor() {
        // Dapatkan posisi elemen yang diedit
        const rect = this.currentElement.getBoundingClientRect();
        
        // Tentukan posisi editor
        // Jika elemen terlalu dekat dengan tepi atas, tampilkan editor di bawah elemen
        if (rect.top < 200) {
            this.editorContainer.style.top = (rect.bottom + window.scrollY + 10) + 'px';
        } else {
            this.editorContainer.style.top = (rect.top + window.scrollY - this.editorContainer.offsetHeight - 10) + 'px';
        }
        
        // Posisi horizontal di tengah elemen
        const left = rect.left + (rect.width / 2) - (this.editorContainer.offsetWidth / 2);
        this.editorContainer.style.left = Math.max(10, left) + 'px';
    }
    
    saveContent() {
        // Dapatkan konten dari editor
        const newContent = this.editorContent.innerHTML;
        
        // Perbarui konten elemen
        this.currentElement.innerHTML = newContent;
        
        // Tambahkan kembali tombol edit
        const editButton = document.createElement('button');
        editButton.className = 'live-edit-button';
        editButton.innerHTML = '<i class="fas fa-pencil-alt"></i>';
        this.currentElement.appendChild(editButton);
        
        // Tambahkan event listener
        editButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.openEditor(this.currentElement);
        });
        
        // Siapkan data untuk dikirim ke server
        const contentData = {
            content: newContent
        };
        
        // Kirim data ke server
        fetch('/api/live-edit/content', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                page: this.pageIdentifier,
                section: this.sectionIdentifier,
                content: contentData,
                content_type: this.currentType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.showSavedNotification();
            } else {
                console.error('Error saving content:', data.message);
                alert('Gagal menyimpan konten. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error saving content:', error);
            alert('Terjadi kesalahan saat menyimpan konten. Silakan coba lagi.');
        });
        
        // Tutup editor
        this.closeEditor();
    }
    
    showSavedNotification() {
        const notification = document.createElement('div');
        notification.className = 'live-edit-saved-notification';
        notification.innerHTML = `
            <div class="live-edit-saved-notification-content">
                <i class="fas fa-check-circle"></i> Konten berhasil disimpan
            </div>
        `;
        document.body.appendChild(notification);
        
        // Otomatis hilangkan notifikasi setelah 3 detik
        setTimeout(() => {
            notification.classList.add('live-edit-saved-notification-fadeout');
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
}

// CSS untuk fitur live edit
const liveEditCSS = `
    .live-edit-mode {
        /* Mode edit aktif */
    }
    
    .live-editable {
        position: relative;
        min-height: 20px;
        transition: outline 0.2s;
    }
    
    .live-editable:hover {
        outline: 2px dashed #FF6000;
    }
    
    .live-edit-button {
        position: absolute;
        top: 0;
        right: 0;
        background: #FF6000;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 8px;
        cursor: pointer;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.2s;
        z-index: 999;
    }
    
    .live-editable:hover .live-edit-button {
        opacity: 1;
    }
    
    .live-edit-editor {
        position: absolute;
        width: 700px;
        max-width: 90vw;
        background: white;
        border-radius: 6px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .live-edit-editor-toolbar {
        display: flex;
        padding: 5px;
        background: #f5f5f5;
        border-bottom: 1px solid #ddd;
        flex-wrap: wrap;
    }
    
    .live-edit-editor-toolbar-section {
        display: flex;
        margin-right: 10px;
        border-right: 1px solid #ddd;
        padding-right: 10px;
    }
    
    .live-edit-editor-toolbar-section:last-child {
        border-right: none;
    }
    
    .live-edit-editor-toolbar-actions {
        margin-left: auto;
    }
    
    .live-edit-editor-btn {
        background: none;
        border: none;
        padding: 5px 8px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 4px;
    }
    
    .live-edit-editor-btn:hover {
        background: #e9e9e9;
    }
    
    .live-edit-editor-btn-save {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin-right: 5px;
    }
    
    .live-edit-editor-btn-save:hover {
        background: #43A047;
    }
    
    .live-edit-editor-btn-cancel {
        background: #F44336;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }
    
    .live-edit-editor-btn-cancel:hover {
        background: #E53935;
    }
    
    .live-edit-editor-content {
        padding: 10px;
        min-height: 150px;
        max-height: 60vh;
        overflow-y: auto;
        outline: none;
        font-family: inherit;
    }
    
    .live-edit-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    
    .live-edit-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #FF6000;
        color: white;
        padding: 12px 15px;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        animation: slideIn 0.3s ease-out;
    }
    
    .live-edit-notification-content {
        display: flex;
        align-items: center;
    }
    
    .live-edit-notification-close {
        margin-left: 15px;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        opacity: 0.8;
    }
    
    .live-edit-notification-close:hover {
        opacity: 1;
    }
    
    .live-edit-notification-fadeout {
        animation: fadeOut 0.5s ease-out forwards;
    }
    
    .live-edit-saved-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #4CAF50;
        color: white;
        padding: 12px 15px;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1001;
        animation: slideIn 0.3s ease-out;
    }
    
    .live-edit-saved-notification-content {
        display: flex;
        align-items: center;
    }
    
    .live-edit-saved-notification-fadeout {
        animation: fadeOut 0.5s ease-out forwards;
    }
    
    @keyframes slideIn {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
`;

// Tambahkan style untuk live edit
const style = document.createElement('style');
style.textContent = liveEditCSS;
document.head.appendChild(style);

// Inisialisasi Live Editor saat DOM sudah siap
document.addEventListener('DOMContentLoaded', () => {
    new LiveEditor();
}); 