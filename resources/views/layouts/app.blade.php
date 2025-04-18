<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Metadata -->
    @hasSection('meta_tags')
        @yield('meta_tags')
    @else
        @include('partials.meta-tags')
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        /* Tambahan untuk mengatasi masalah navbar fixed */
        main {
            padding-top: 80px; /* Sesuai dengan tinggi navbar */
        }
        
        /* Pengecualian untuk halaman yang memerlukan hero full height */
        .hero-fullheight {
            margin-top: -80px; /* Mengompensasi padding-top dari main */
            padding-top: 0;
        }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased" data-page-identifier="{{ request()->path() === '/' ? 'home' : request()->path() }}">
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    @stack('scripts')
    
    <!-- AOS Animation Init -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>
    
    <!-- Live Edit Script -->
    @auth
        @if(Auth::user()->id == 1)
        <script>
            /**
             * Live Edit Script
             * Script untuk mengaktifkan fitur live edit pada halaman
             */
            document.addEventListener('DOMContentLoaded', function() {
                // Check if edit mode is enabled
                const editModeEnabled = localStorage.getItem('liveEditMode') === 'enabled';
                
                if (editModeEnabled) {
                    initLiveEdit();
                }
                
                function initLiveEdit() {
                    // Add CSS
                    addStyles();
                    
                    // Add edit mode notification
                    showEditModeNotification();
                    
                    // Find all editable elements and add edit buttons
                    scanEditableElements();
                }
                
                function addStyles() {
                    const styles = `
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
                            height: auto;
                            width: auto;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                        }
                        
                        .live-editable:hover .live-edit-button {
                            opacity: 1;
                        }
                        
                        /* Pastikan button tidak mengganggu konten */
                        .live-edit-button i {
                            font-size: 14px;
                            line-height: 1;
                        }
                        
                        /* Fix untuk konten yang mungkin terpengaruh */
                        .live-editable > *:not(.live-edit-button) {
                            position: relative;
                            z-index: 1;
                        }
                        
                        .live-edit-overlay {
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(0, 0, 0, 0.5);
                            z-index: 999;
                            display: none;
                        }
                        
                        .live-edit-editor {
                            position: fixed;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 80%;
                            max-width: 800px;
                            background: white;
                            border-radius: 6px;
                            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
                            z-index: 1000;
                            display: none;
                        }
                        
                        .live-edit-editor-toolbar {
                            display: flex;
                            padding: 10px;
                            background: #f5f5f5;
                            border-bottom: 1px solid #ddd;
                            flex-wrap: wrap;
                            gap: 5px;
                        }
                        
                        .live-edit-editor-toolbar button {
                            background: none;
                            border: 1px solid #ddd;
                            border-radius: 3px;
                            padding: 5px 10px;
                            cursor: pointer;
                        }
                        
                        .live-edit-editor-toolbar button:hover {
                            background: #eee;
                        }
                        
                        .live-edit-editor-content {
                            padding: 20px;
                            min-height: 200px;
                            max-height: 60vh;
                            overflow-y: auto;
                        }
                        
                        .live-edit-editor-actions {
                            display: flex;
                            justify-content: flex-end;
                            padding: 10px;
                            border-top: 1px solid #ddd;
                            gap: 10px;
                        }
                        
                        .btn-save {
                            background: #4CAF50;
                            color: white;
                            border: none;
                            padding: 8px 15px;
                            border-radius: 4px;
                            cursor: pointer;
                        }
                        
                        .btn-cancel {
                            background: #F44336;
                            color: white;
                            border: none;
                            padding: 8px 15px;
                            border-radius: 4px;
                            cursor: pointer;
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
                        
                        /* Enhanced Editor Styles */
                        .toolbar-group {
                            display: flex;
                            margin-right: 10px;
                            border-right: 1px solid #e0e0e0;
                            padding-right: 10px;
                        }
                        .toolbar-group:last-child {
                            border-right: none;
                        }
                        .editor-title {
                            margin: 0;
                            font-size: 18px;
                            font-weight: 600;
                        }
                        .image-editor-content {
                            padding: 20px;
                        }
                        .current-image-preview, .new-image-preview {
                            max-width: 100%;
                            text-align: center;
                            margin-bottom: 15px;
                        }
                        .current-image-preview img, .new-image-preview img {
                            max-width: 100%;
                            max-height: 300px;
                            border: 1px solid #ddd;
                        }
                        .image-upload-label {
                            display: inline-block;
                            background: #f0f0f0;
                            padding: 10px 15px;
                            border-radius: 4px;
                            cursor: pointer;
                            border: 1px solid #ddd;
                        }
                        .image-upload-label:hover {
                            background: #e0e0e0;
                        }
                        .mt-2 {
                            margin-top: 10px;
                        }
                        .mt-4 {
                            margin-top: 20px;
                        }
                        .form-group {
                            margin-bottom: 15px;
                        }
                        .form-control {
                            width: 100%;
                            padding: 8px;
                            border: 1px solid #ddd;
                            border-radius: 4px;
                        }
                        .size-control-buttons {
                            display: flex;
                            gap: 10px;
                            margin-top: 5px;
                        }
                        .size-control-buttons button {
                            background: #f0f0f0;
                            border: 1px solid #ddd;
                            padding: 5px 10px;
                            border-radius: 4px;
                            cursor: pointer;
                        }
                        .size-control-buttons button.active {
                            background: #FF6000;
                            color: white;
                            border-color: #FF6000;
                        }
                        .custom-size-inputs {
                            display: flex;
                            gap: 15px;
                        }
                        .size-input-group {
                            display: flex;
                            align-items: center;
                            gap: 5px;
                        }
                        .size-input-group input {
                            width: 70px;
                            padding: 5px;
                            border: 1px solid #ddd;
                            border-radius: 4px;
                        }
                    `;
                    
                    const styleElement = document.createElement('style');
                    styleElement.textContent = styles;
                    document.head.appendChild(styleElement);
                }
                
                function showEditModeNotification() {
                    const notification = document.createElement('div');
                    notification.className = 'live-edit-notification';
                    notification.innerHTML = 'Mode Edit Aktif';
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 3000);
                }
                
                function scanEditableElements() {
                    console.log('Scanning for editable elements...');
                    // Remove existing edit buttons first
                    document.querySelectorAll('.editable-element-btn').forEach(btn => btn.remove());
                    
                    // Find all elements with data-editable attribute
                    const editableElements = document.querySelectorAll('[data-editable]');
                    console.log(`Found ${editableElements.length} editable elements`);
                    
                    // Add edit button to each editable element
                    editableElements.forEach(element => {
                        const editBtn = document.createElement('button');
                        editBtn.className = 'editable-element-btn';
                        editBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg>';
                        editBtn.style.cssText = 'position: absolute; top: 5px; right: 5px; background: #FF6000; color: white; border: none; border-radius: 4px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000; opacity: 0.7;';
                        editBtn.addEventListener('mouseover', function() {
                            this.style.opacity = '1';
                        });
                        editBtn.addEventListener('mouseout', function() {
                            this.style.opacity = '0.7';
                        });
                        editBtn.addEventListener('click', function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            openEditor(element);
                        });
                        
                        // Make the element position relative if it's not already
                        const position = window.getComputedStyle(element).getPropertyValue('position');
                        if (position === 'static') {
                            element.style.position = 'relative';
                        }
                        
                        element.appendChild(editBtn);
                    });
                }

                function openEditor(element) {
                    console.log('Opening editor for element:', element);
                    
                    // Get section ID
                    const sectionId = element.dataset.section;
                    if (!sectionId) {
                        console.error('No section ID found on element', element);
                        return;
                    }
                    
                    // Get element type (default to 'text' if not specified)
                    const elementType = element.dataset.editable || 'text';
                    
                    // Save original content to restore on cancel
                    const originalContent = element.innerHTML;
                    
                    // Hapus tombol edit dari konten yang akan diedit
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = originalContent;
                    const editButton = tempDiv.querySelector('.editable-element-btn');
                    if (editButton) {
                        editButton.remove();
                    }
                    const contentWithoutButton = tempDiv.innerHTML;
                    
                    console.log('Content to edit:', contentWithoutButton); // Log untuk debugging
                    
                    // Check if content type is an image
                    const isImageContent = elementType === 'image' || 
                                          (element.querySelector('img') && !element.querySelector('p, h1, h2, h3, div:not(.live-edit-button), span, a, ul, ol, li'));
                    
                    // Create overlay
                    const overlay = document.createElement('div');
                    overlay.className = 'live-edit-overlay';
                    document.body.appendChild(overlay);
                    overlay.style.display = 'block';
                    
                    // Create editor
                    const editor = document.createElement('div');
                    editor.className = 'live-edit-editor';
                    
                    if (isImageContent) {
                        // Gambar editor
                        editor.innerHTML = `
                            <div class="live-edit-editor-header">
                                <h3 class="editor-title">Edit Gambar</h3>
                                <button class="editor-close"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="live-edit-editor-content image-editor-content">
                                <div class="current-image-preview">
                                    ${element.querySelector('img') ? `<img src="${element.querySelector('img').src}" alt="Preview">` : '<p>Tidak ada gambar</p>'}
                                </div>
                                <div class="image-upload-section mt-4">
                                    <label for="imageUpload" class="image-upload-label">
                                        <i class="fas fa-upload"></i> Pilih Gambar Baru
                                    </label>
                                    <input type="file" id="imageUpload" accept="image/*" style="display: none;">
                                    <div class="image-preview mt-2" style="display: none;">
                                        <h4>Pratinjau Gambar Baru:</h4>
                                        <div class="new-image-preview"></div>
                                    </div>
                                </div>
                                <div class="image-settings mt-4">
                                    <div class="form-group">
                                        <label for="imageAltText">Teks Alternatif (Alt):</label>
                                        <input type="text" id="imageAltText" class="form-control" 
                                            value="${element.querySelector('img') ? (element.querySelector('img').alt || '') : ''}">
                                    </div>
                                    <div class="image-size-controls mt-2">
                                        <label>Ukuran Gambar:</label>
                                        <div class="size-control-buttons">
                                            <button data-size="small">Kecil</button>
                                            <button data-size="medium" class="active">Sedang</button>
                                            <button data-size="large">Besar</button>
                                            <button data-size="custom">Kustom</button>
                                        </div>
                                        <div class="custom-size-inputs mt-2" style="display: none;">
                                            <div class="size-input-group">
                                                <label for="imageWidth">Lebar:</label>
                                                <input type="number" id="imageWidth" min="10" max="1200">
                                                <span>px</span>
                                            </div>
                                            <div class="size-input-group">
                                                <label for="imageHeight">Tinggi:</label>
                                                <input type="number" id="imageHeight" min="10" max="1200">
                                                <span>px</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="live-edit-editor-actions">
                                <button class="btn-save">Simpan</button>
                                <button class="btn-cancel">Batal</button>
                            </div>
                        `;
                    } else {
                        // Text editor
                        editor.innerHTML = `
                            <div class="live-edit-editor-header">
                                <h3 class="editor-title">Edit Konten</h3>
                                <button class="editor-close"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="live-edit-editor-toolbar">
                                <div class="toolbar-group">
                                    <button data-command="bold" title="Bold"><i class="fas fa-bold"></i></button>
                                    <button data-command="italic" title="Italic"><i class="fas fa-italic"></i></button>
                                    <button data-command="underline" title="Underline"><i class="fas fa-underline"></i></button>
                                    <button data-command="strikeThrough" title="Strike through"><i class="fas fa-strikethrough"></i></button>
                                </div>
                                <div class="toolbar-group">
                                    <button data-command="formatBlock" data-value="p" title="Paragraph"><i class="fas fa-paragraph"></i></button>
                                    <button data-command="formatBlock" data-value="h1" title="Heading 1">H1</button>
                                    <button data-command="formatBlock" data-value="h2" title="Heading 2">H2</button>
                                    <button data-command="formatBlock" data-value="h3" title="Heading 3">H3</button>
                                </div>
                                <div class="toolbar-group">
                                    <button data-command="justifyLeft" title="Align Left"><i class="fas fa-align-left"></i></button>
                                    <button data-command="justifyCenter" title="Align Center"><i class="fas fa-align-center"></i></button>
                                    <button data-command="justifyRight" title="Align Right"><i class="fas fa-align-right"></i></button>
                                </div>
                                <div class="toolbar-group">
                                    <button data-command="insertUnorderedList" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                    <button data-command="insertOrderedList" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                    <button data-command="outdent" title="Decrease indent"><i class="fas fa-outdent"></i></button>
                                    <button data-command="indent" title="Increase indent"><i class="fas fa-indent"></i></button>
                                </div>
                                <div class="toolbar-group">
                                    <button data-command="insertLink" title="Insert Link"><i class="fas fa-link"></i></button>
                                    <button data-command="removeFormat" title="Clear formatting"><i class="fas fa-remove-format"></i></button>
                                    <button data-command="insertImage" title="Insert Image"><i class="fas fa-image"></i></button>
                                    <input type="file" id="imageUpload" style="display: none;" accept="image/*">
                                </div>
                            </div>
                            <div class="live-edit-editor-content" contenteditable="true">${contentWithoutButton}</div>
                            <div class="live-edit-editor-actions">
                                <button class="btn-save">Simpan</button>
                                <button class="btn-cancel">Batal</button>
                            </div>
                        `;
                    }
                    
                    document.body.appendChild(editor);
                    editor.style.display = 'block';
                    
                    // Setup based on editor type
                    if (isImageContent) {
                        // Set up image editor functionality
                        const imageUpload = editor.querySelector('#imageUpload');
                        const newImagePreview = editor.querySelector('.image-preview');
                        const previewContainer = editor.querySelector('.new-image-preview');
                        const sizeButtons = editor.querySelectorAll('.size-control-buttons button');
                        const customSizeInputs = editor.querySelector('.custom-size-inputs');
                        const widthInput = editor.querySelector('#imageWidth');
                        const heightInput = editor.querySelector('#imageHeight');
                        
                        // Get current image dimensions if available
                        if (element.querySelector('img')) {
                            const currentImg = element.querySelector('img');
                            widthInput.value = currentImg.width;
                            heightInput.value = currentImg.height;
                        }
                        
                        // Size button controls
                        sizeButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                // Remove active class from all buttons
                                sizeButtons.forEach(btn => btn.classList.remove('active'));
                                
                                // Add active class to clicked button
                                button.classList.add('active');
                                
                                // Show/hide custom inputs
                                if (button.dataset.size === 'custom') {
                                    customSizeInputs.style.display = 'flex';
                                } else {
                                    customSizeInputs.style.display = 'none';
                                    
                                    // Apply predefined sizes to preview image if exists
                                    const previewImg = previewContainer.querySelector('img');
                                    if (previewImg) {
                                        switch (button.dataset.size) {
                                            case 'small':
                                                previewImg.style.maxWidth = '150px';
                                                break;
                                            case 'medium':
                                                previewImg.style.maxWidth = '300px';
                                                break;
                                            case 'large':
                                                previewImg.style.maxWidth = '500px';
                                                break;
                                        }
                                    }
                                }
                            });
                        });
                        
                        // Image upload handling
                        imageUpload.addEventListener('change', (event) => {
                            const file = event.target.files[0];
                            
                            if (file) {
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    // Show preview section
                                    newImagePreview.style.display = 'block';
                                    
                                    // Create or update image preview
                                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%;">`;
                                    
                                    // Apply selected size
                                    const activeSize = editor.querySelector('.size-control-buttons button.active');
                                    if (activeSize) {
                                        const previewImg = previewContainer.querySelector('img');
                                        switch (activeSize.dataset.size) {
                                            case 'small':
                                                previewImg.style.maxWidth = '150px';
                                                break;
                                            case 'medium':
                                                previewImg.style.maxWidth = '300px';
                                                break;
                                            case 'large':
                                                previewImg.style.maxWidth = '500px';
                                                break;
                                            case 'custom':
                                                if (widthInput.value) {
                                                    previewImg.style.width = `${widthInput.value}px`;
                                                }
                                                if (heightInput.value) {
                                                    previewImg.style.height = `${heightInput.value}px`;
                                                }
                                                break;
                                        }
                                    }
                                };
                                
                                reader.readAsDataURL(file);
                            }
                        });
                        
                        // Custom dimension inputs
                        widthInput.addEventListener('input', updateCustomDimensions);
                        heightInput.addEventListener('input', updateCustomDimensions);
                        
                        function updateCustomDimensions() {
                            const previewImg = previewContainer.querySelector('img');
                            if (previewImg) {
                                if (widthInput.value) {
                                    previewImg.style.width = `${widthInput.value}px`;
                                } else {
                                    previewImg.style.width = 'auto';
                                }
                                
                                if (heightInput.value) {
                                    previewImg.style.height = `${heightInput.value}px`;
                                } else {
                                    previewImg.style.height = 'auto';
                                }
                            }
                        }
                    } else {
                        // Focus on content for text editor
                        const content = editor.querySelector('.live-edit-editor-content');
                        content.focus();
                        
                        // Set up text editor toolbar buttons
                        const toolbarButtons = editor.querySelectorAll('.live-edit-editor-toolbar button[data-command]');
                        toolbarButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                const command = button.dataset.command;
                                const value = button.dataset.value || null;
                                
                                if (command === 'insertLink') {
                                    const url = prompt('Enter the link URL:');
                                    if (url) document.execCommand('createLink', false, url);
                                } else if (command === 'insertImage') {
                                    document.getElementById('imageUpload').click();
                                } else {
                                    document.execCommand(command, false, value);
                                }
                                
                                // Refocus on editor
                                content.focus();
                            });
                        });
                        
                        // Image upload for text editor
                        const imageUpload = editor.querySelector('#imageUpload');
                        imageUpload.addEventListener('change', (event) => {
                            const file = event.target.files[0];
                            
                            if (file) {
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    document.execCommand('insertImage', false, e.target.result);
                                };
                                
                                reader.readAsDataURL(file);
                            }
                        });
                    }
                    
                    // Close button event
                    const closeButton = editor.querySelector('.editor-close');
                    if (closeButton) {
                        closeButton.addEventListener('click', () => {
                            overlay.remove();
                            editor.remove();
                        });
                    }
                    
                    // Cancel button
                    const cancelButton = editor.querySelector('.btn-cancel');
                    cancelButton.addEventListener('click', () => {
                        overlay.remove();
                        editor.remove();
                    });
                    
                    // Overlay click to close
                    overlay.addEventListener('click', (event) => {
                        if (event.target === overlay) {
                            overlay.remove();
                            editor.remove();
                        }
                    });
                    
                    // Save button
                    const saveButton = editor.querySelector('.btn-save');
                    saveButton.addEventListener('click', () => {
                        let newContent = '';
                        
                        if (isImageContent) {
                            // Get image editor values
                            const newImageEl = editor.querySelector('.new-image-preview img');
                            const altText = editor.querySelector('#imageAltText').value;
                            const activeSize = editor.querySelector('.size-control-buttons button.active').dataset.size;
                            
                            if (newImageEl) {
                                // Create new image HTML with selected properties
                                let styleAttr = '';
                                
                                switch (activeSize) {
                                    case 'small':
                                        styleAttr = 'style="max-width: 150px;"';
                                        break;
                                    case 'medium':
                                        styleAttr = 'style="max-width: 300px;"';
                                        break;
                                    case 'large':
                                        styleAttr = 'style="max-width: 500px;"';
                                        break;
                                    case 'custom':
                                        const width = widthInput.value;
                                        const height = heightInput.value;
                                        let styles = [];
                                        
                                        if (width) styles.push(`width: ${width}px`);
                                        if (height) styles.push(`height: ${height}px`);
                                        
                                        if (styles.length > 0) {
                                            styleAttr = `style="${styles.join('; ')}"`;
                                        }
                                        break;
                                }
                                
                                newContent = `<img src="${newImageEl.src}" alt="${altText}" ${styleAttr}>`;
                            } else {
                                // No new image, update existing image properties
                                const currentImg = element.querySelector('img');
                                if (currentImg) {
                                    let styleAttr = '';
                                    
                                    switch (activeSize) {
                                        case 'small':
                                            styleAttr = 'style="max-width: 150px;"';
                                            break;
                                        case 'medium':
                                            styleAttr = 'style="max-width: 300px;"';
                                            break;
                                        case 'large':
                                            styleAttr = 'style="max-width: 500px;"';
                                            break;
                                        case 'custom':
                                            const width = widthInput.value;
                                            const height = heightInput.value;
                                            let styles = [];
                                            
                                            if (width) styles.push(`width: ${width}px`);
                                            if (height) styles.push(`height: ${height}px`);
                                            
                                            if (styles.length > 0) {
                                                styleAttr = `style="${styles.join('; ')}"`;
                                            }
                                            break;
                                    }
                                    
                                    newContent = `<img src="${currentImg.src}" alt="${altText}" ${styleAttr}>`;
                                } else {
                                    showErrorNotification('Tidak ada gambar yang tersedia');
                                    return;
                                }
                            }
                        } else {
                            // Get text editor content
                            const content = editor.querySelector('.live-edit-editor-content');
                            newContent = content.innerHTML;
                        }
                        
                        // Save content to server
                        saveContentToServer(element, newContent, sectionId, elementType);
                        
                        // Close editor
                        overlay.remove();
                        editor.remove();
                    });
                }
                
                function saveContentToServer(element, newContent, sectionId, elementType) {
                    // Clean content from any edit buttons before saving
                    const cleanContent = newContent.replace(/<button class="editable-element-btn".*?<\/button>/g, '');
                    const cleanContentWithoutButtons = cleanContent.replace(/<button.*?<\/button>/g, '');
                    
                    console.log('Saving content for section:', sectionId);
                    console.log('Content:', cleanContentWithoutButtons);
                    console.log('Element type:', elementType);
                    
                    // Check if there are any base64 images that need to be uploaded
                    let contentToSave = cleanContentWithoutButtons;
                    let base64Images = [];
                    
                    // Extract base64 images if any exist
                    if (cleanContentWithoutButtons.includes('data:image')) {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = cleanContentWithoutButtons;
                        
                        const images = tempDiv.querySelectorAll('img[src^="data:image"]');
                        images.forEach((img, index) => {
                            const base64Data = img.src;
                            base64Images.push({
                                base64: base64Data,
                                index: index
                            });
                            
                            // Replace with a placeholder that we'll update after upload
                            img.setAttribute('src', `__IMAGE_PLACEHOLDER_${index}__`);
                            img.setAttribute('data-loading', 'true');
                        });
                        
                        contentToSave = tempDiv.innerHTML;
                    }
                    
                    // Show loading indicator
                    const loadingOverlay = document.createElement('div');
                    loadingOverlay.className = 'live-edit-loading-overlay';
                    loadingOverlay.innerHTML = `
                        <div class="live-edit-loading-spinner"></div>
                        <div class="live-edit-loading-text">Menyimpan perubahan...</div>
                    `;
                    document.body.appendChild(loadingOverlay);
                    
                    // Handle the request based on whether we have base64 images to upload
                    if (base64Images.length > 0) {
                        // First upload the images
                        Promise.all(base64Images.map(imgData => {
                            return fetch('/admin/live-edit/upload-image', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    image: imgData.base64,
                                    section: sectionId
                                })
                            }).then(response => response.json());
                        }))
                        .then(results => {
                            // Replace placeholders with actual image URLs
                            results.forEach((result, index) => {
                                if (result.success && result.url) {
                                    contentToSave = contentToSave.replace(
                                        `__IMAGE_PLACEHOLDER_${index}__`, 
                                        result.url
                                    );
                                }
                            });
                            
                            // Now save the content with the actual image URLs
                            saveContentAfterImageProcessing(element, contentToSave, sectionId, elementType, loadingOverlay);
                        })
                        .catch(error => {
                            console.error('Error uploading images:', error);
                            loadingOverlay.remove();
                            showErrorNotification('Terjadi kesalahan saat mengunggah gambar');
                        });
                    } else {
                        // No images to upload, save directly
                        saveContentAfterImageProcessing(element, contentToSave, sectionId, elementType, loadingOverlay);
                    }
                }
                
                function saveContentAfterImageProcessing(element, contentToSave, sectionId, elementType, loadingOverlay) {
                    // Send content to server
                    fetch('/admin/live-edit/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            section: sectionId,
                            content: contentToSave,
                            type: elementType
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Remove loading overlay
                        loadingOverlay.remove();
                        
                        if (data.success) {
                            console.log('Content saved successfully');
                            
                            // Update element with new content
                            element.innerHTML = contentToSave;
                            
                            // Add edit button back
                            const editBtn = document.createElement('button');
                            editBtn.className = 'editable-element-btn';
                            editBtn.innerHTML = '<i class="fas fa-pencil-alt"></i>';
                            editBtn.addEventListener('click', function(event) {
                                event.preventDefault();
                                event.stopPropagation();
                                openEditor(element);
                            });
                            element.appendChild(editBtn);
                            
                            // Display success notification
                            showSuccessNotification('Konten berhasil disimpan!');
                        } else {
                            console.error('Error saving content:', data.message || 'Unknown error');
                            showErrorNotification(data.message || 'Terjadi kesalahan saat menyimpan');
                        }
                    })
                    .catch(error => {
                        loadingOverlay.remove();
                        console.error('Error saving content:', error);
                        showErrorNotification('Terjadi kesalahan saat menyimpan konten');
                    });
                }
                
                function showSuccessNotification(message) {
                    const notification = document.createElement('div');
                    notification.className = 'live-edit-notification success';
                    notification.innerHTML = `
                        <div class="live-edit-notification-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="live-edit-notification-content">
                            <div class="live-edit-notification-title">Sukses</div>
                            <div class="live-edit-notification-message">${message}</div>
                        </div>
                    `;
                    document.body.appendChild(notification);
                    
                    // Show with animation
                    setTimeout(() => notification.classList.add('show'), 10);
                    
                    // Automatically hide after 3 seconds
                    setTimeout(() => {
                        notification.classList.remove('show');
                        setTimeout(() => notification.remove(), 300);
                    }, 3000);
                }
                
                function showErrorNotification(message) {
                    const notification = document.createElement('div');
                    notification.className = 'live-edit-notification error';
                    notification.innerHTML = `
                        <div class="live-edit-notification-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="live-edit-notification-content">
                            <div class="live-edit-notification-title">Error</div>
                            <div class="live-edit-notification-message">${message}</div>
                        </div>
                    `;
                    document.body.appendChild(notification);
                    
                    // Show with animation
                    setTimeout(() => notification.classList.add('show'), 10);
                    
                    // Automatically hide after 5 seconds
                    setTimeout(() => {
                        notification.classList.remove('show');
                        setTimeout(() => notification.remove(), 300);
                    }, 5000);
                }
            });
        </script>
        @endif
    @endauth
</body>
</html> 