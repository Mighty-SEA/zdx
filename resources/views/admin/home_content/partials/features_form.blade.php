<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY', 'no-api-key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="space-y-6">
    <!-- Gambar -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Keunggulan</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#FF6000] transition-colors duration-200">
            <input type="file" name="image" id="image" class="hidden" accept="image/*">
            <label for="image" class="cursor-pointer block">
                <div class="space-y-1 text-center">
                    @if($section->image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $section->image_path) }}" alt="Current image" class="mx-auto h-32 object-cover">
                        </div>
                    @endif
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer rounded-md font-medium text-[#FF6000] hover:text-[#FF4000] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#FF6000]">
                            <span>Upload gambar</span>
                            <span class="text-gray-500"> atau drag and drop</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                </div>
            </label>
        </div>
        @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Konten Keunggulan dengan TinyMCE -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
            <i class="fas fa-file-alt text-[#FF6000] mr-2"></i> Konten Keunggulan
        </h3>
        
        <div class="mb-6">
            <label for="content" class="form-label flex items-center">
                Konten <span class="text-red-500 ml-1">*</span>
                <span class="ml-1 group relative">
                    <i class="fas fa-question-circle text-gray-400 text-sm"></i>
                    <div class="hidden group-hover:block absolute left-0 top-full mt-1 w-64 p-2 bg-gray-800 text-white text-xs rounded z-10">
                        Konten lengkap untuk bagian keunggulan
                    </div>
                </span>
            </label>
            <textarea name="content" id="content" class="tinymce">{{ old('content', $section->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Template HTML -->
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
            <div class="mb-3">
                <button type="button" id="showTemplate" class="flex items-center text-[#FF6000] hover:text-[#FF4000] text-sm font-medium">
                    <i class="fas fa-code mr-2"></i> Template HTML
                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                </button>
            </div>
            <div id="templateCode" class="hidden">
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-white text-sm">Contoh Template Keunggulan</span>
                        <button type="button" class="copy-template text-white hover:text-[#FF6000] text-sm">
                            <i class="far fa-copy mr-1"></i> Salin
                        </button>
                    </div>
                    <pre class="text-white text-sm overflow-x-auto whitespace-pre-wrap">
<!-- Feature Item -->
<div class="flex items-start transition-all duration-300 hover:translate-x-2">
    <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>
    <div>
        <h3 class="text-xl font-semibold mb-2 text-gray-800">Layanan 24/7</h3>
        <p class="text-gray-600">Tim dukungan pelanggan kami siap membantu Anda sepanjang waktu.</p>
    </div>
</div></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol CTA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
        </div>
        
        <div>
            <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">URL Tombol</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#FF6000] focus:border-[#FF6000]" 
                id="button_url" name="button_url" value="{{ old('button_url', $section->button_url) }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // TinyMCE Configuration
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.tinymce',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            menu: {
                file: { title: 'File', items: 'newdocument restoredraft | preview | print | deleteallconversations' },
                edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
                view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
                insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
                format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blocks fontfamily fontsize align lineheight | forecolor backcolor | removeformat' },
                tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
                table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' }
            },
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'code',
                'emoticons', 'template', 'paste', 'hr', 'pagebreak', 'quickbars',
                'codesample', 'nonbreaking', 'directionality', 'visualchars', 'textpattern',
                'save', 'advtable', 'autosave', 'importcss', 'toc'
            ],
            external_plugins: {
                'advtable': 'https://cdn.jsdelivr.net/npm/@tinymce/tinymce-plugin-table@latest/dist/plugin.min.js'
            },
            toolbar1: 'undo redo | blocks | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | lineheight',
            toolbar2: 'h1 h2 h3 h4 p | bullist numlist | outdent indent | link unlink image media | table | hr removeformat | subscript superscript | charmap emoticons',
            toolbar3: 'preview code fullscreen | styles | searchreplace | pagebreak template codesample | print help',
            toolbar_mode: 'sliding',
            toolbar_sticky: true,
            toolbar_sticky_offset: 60,
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre; Quote=blockquote',
            formats: {
                h1: { block: 'h1', classes: 'text-4xl font-bold mb-4' },
                h2: { block: 'h2', classes: 'text-3xl font-bold mb-3' },
                h3: { block: 'h3', classes: 'text-2xl font-bold mb-2' },
                h4: { block: 'h4', classes: 'text-xl font-bold mb-2' },
                h5: { block: 'h5', classes: 'text-lg font-bold mb-2' },
                h6: { block: 'h6', classes: 'text-base font-bold mb-2' },
                p: { block: 'p', classes: 'mb-2' },
                blockquote: { block: 'blockquote', classes: 'border-l-4 border-[#FF6000] pl-4 italic my-4 py-2' }
            },
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            quickbars_selection_toolbar: 'bold italic | h1 h2 h3 | blockquote quicklink',
            quickbars_insert_toolbar: 'quickimage quicktable',
            contextmenu: 'link image table',
            powerpaste_word_import: 'clean',
            powerpaste_html_import: 'clean',
            image_advtab: true,
            image_caption: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            images_upload_url: '/upload/tinymce-images',
            images_reuse_filename: true,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            branding: false,
            promotion: false,
            browser_spellcheck: true,
            content_style: `
                body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 14px; line-height: 1.6; }
                .mce-content-body p { margin: 0 0 10px 0; }
                .mce-content-body img { max-width: 100%; height: auto; }
                .mce-content-body table { border-collapse: collapse; width: 100%; }
                .mce-content-body table th, .mce-content-body table td { border: 1px solid #ccc; padding: 8px; }
                .mce-content-body table th { background-color: #f0f0f0; font-weight: bold; }
                .mce-content-body h1 { font-size: 2.25rem; font-weight: bold; margin: 1rem 0; line-height: 1.2; }
                .mce-content-body h2 { font-size: 1.875rem; font-weight: bold; margin: 0.875rem 0; line-height: 1.2; }
                .mce-content-body h3 { font-size: 1.5rem; font-weight: bold; margin: 0.75rem 0; line-height: 1.2; }
                .mce-content-body h4 { font-size: 1.25rem; font-weight: bold; margin: 0.625rem 0; line-height: 1.2; }
                .mce-content-body h5 { font-size: 1.125rem; font-weight: bold; margin: 0.5rem 0; line-height: 1.2; }
                .mce-content-body h6 { font-size: 1rem; font-weight: bold; margin: 0.5rem 0; line-height: 1.2; }
                .mce-content-body a { color: #FF6000; text-decoration: none; }
                .mce-content-body a:hover { text-decoration: underline; }
                .mce-content-body ul, .mce-content-body ol { padding-left: 20px; margin: 10px 0; }
                .mce-content-body blockquote { border-left: 3px solid #FF6000; margin: 10px 0; padding: 10px 20px; background: #fff0e6; }
                .mce-content-body pre { background: #f4f4f4; padding: 10px; border-radius: 5px; }
                .mce-content-body code { background: #f4f4f4; padding: 2px 4px; border-radius: 3px; }
            `,
            style_formats: [
                { title: 'Heading', items: [
                    { title: 'Heading 1', format: 'h1' },
                    { title: 'Heading 2', format: 'h2' },
                    { title: 'Heading 3', format: 'h3' },
                    { title: 'Heading 4', format: 'h4' },
                    { title: 'Heading 5', format: 'h5' },
                    { title: 'Heading 6', format: 'h6' }
                ]},
                { title: 'Inline', items: [
                    { title: 'Bold', format: 'bold' },
                    { title: 'Italic', format: 'italic' },
                    { title: 'Underline', format: 'underline' },
                    { title: 'Strikethrough', format: 'strikethrough' },
                    { title: 'Superscript', format: 'superscript' },
                    { title: 'Subscript', format: 'subscript' },
                    { title: 'Code', format: 'code' }
                ]},
                { title: 'Blocks', items: [
                    { title: 'Paragraph', format: 'p' },
                    { title: 'Blockquote', format: 'blockquote' },
                    { title: 'Div', format: 'div' },
                    { title: 'Pre', format: 'pre' }
                ]},
                { title: 'ZDX Cards', items: [
                    { title: 'Info Card', block: 'div', classes: 'info-card', wrapper: true },
                    { title: 'Success Card', block: 'div', classes: 'success-card', wrapper: true },
                    { title: 'Warning Card', block: 'div', classes: 'warning-card', wrapper: true },
                    { title: 'Error Card', block: 'div', classes: 'error-card', wrapper: true }
                ]}
            ],
            valid_elements: '*[*]',
            extended_valid_elements: '*[*]',
            valid_children: '+body[style]',
            custom_elements: 'svg,path',
            importcss_append: true,
            content_css: [
                'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
            ],
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
                
                // Custom Buttons for headings
                editor.ui.registry.addButton('h1', {
                    text: 'H1',
                    tooltip: 'Heading 1',
                    onAction: function () {
                        editor.execCommand('mceToggleFormat', false, 'h1');
                    }
                });
                
                editor.ui.registry.addButton('h2', {
                    text: 'H2',
                    tooltip: 'Heading 2',
                    onAction: function () {
                        editor.execCommand('mceToggleFormat', false, 'h2');
                    }
                });
                
                editor.ui.registry.addButton('h3', {
                    text: 'H3',
                    tooltip: 'Heading 3',
                    onAction: function () {
                        editor.execCommand('mceToggleFormat', false, 'h3');
                    }
                });
                
                editor.ui.registry.addButton('h4', {
                    text: 'H4',
                    tooltip: 'Heading 4',
                    onAction: function () {
                        editor.execCommand('mceToggleFormat', false, 'h4');
                    }
                });
                
                editor.ui.registry.addButton('p', {
                    text: 'P',
                    tooltip: 'Paragraph',
                    onAction: function () {
                        editor.execCommand('mceToggleFormat', false, 'p');
                    }
                });
                
                // Custom Buttons
                editor.ui.registry.addButton('customInsertButton', {
                    text: 'Fitur Item',
                    tooltip: 'Tambahkan Item Fitur',
                    onAction: function () {
                        editor.insertContent(`
                        <div class="flex items-start transition-all duration-300 hover:translate-x-2">
                            <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Judul Fitur</h3>
                                <p class="text-gray-600">Deskripsi fitur Anda di sini.</p>
                            </div>
                        </div>
                        `);
                    }
                });
                
                // Add to toolbar
                editor.ui.registry.addGroupToolbarButton('insertGroup', {
                    icon: 'add',
                    tooltip: 'Insert',
                    items: 'customInsertButton image media table link'
                });
            },
            file_picker_callback: function(callback, value, meta) {
                // File picker untuk upload gambar
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    
                    input.onchange = function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        
                        reader.onload = function () {
                            // Perlu implementasi upload gambar ke server
                            // Untuk sementara kita gunakan preview saja
                            callback(reader.result, {
                                title: file.name,
                                width: '100%',
                                height: 'auto'
                            });
                        };
                        
                        reader.readAsDataURL(file);
                    };
                    
                    input.click();
                }
            },
            templates: [
                {
                    title: 'Feature Item Template',
                    description: 'Template untuk fitur dengan ikon',
                    content: `
                    <div class="flex items-start transition-all duration-300 hover:translate-x-2">
                        <div class="bg-[#FFF0E6] rounded-lg p-3 mr-5 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800">Judul Fitur</h3>
                            <p class="text-gray-600">Deskripsi fitur Anda di sini.</p>
                        </div>
                    </div>
                    `
                },
                {
                    title: 'Dua Kolom',
                    description: 'Layout dua kolom seimbang',
                    content: `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800">Kolom Pertama</h3>
                            <p class="text-gray-600">Konten kolom pertama di sini.</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800">Kolom Kedua</h3>
                            <p class="text-gray-600">Konten kolom kedua di sini.</p>
                        </div>
                    </div>
                    `
                },
                {
                    title: 'Card Info',
                    description: 'Card informasi dengan border',
                    content: `
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>Tulis informasi penting di sini.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                }
            ]
        });
    }

    // Toggle Template HTML
    const showTemplateBtn = document.getElementById('showTemplate');
    const templateCode = document.getElementById('templateCode');
    
    if (showTemplateBtn && templateCode) {
        showTemplateBtn.addEventListener('click', function() {
            templateCode.classList.toggle('hidden');
            const icon = this.querySelector('.fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
            icon.classList.toggle('fa-chevron-down');
        });
    }

    // Copy Template
    const copyButtons = document.querySelectorAll('.copy-template');
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pre = this.closest('.bg-gray-800').querySelector('pre');
            navigator.clipboard.writeText(pre.textContent).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check mr-1"></i> Tersalin!';
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);
            });
        });
    });
});
</script>
@endpush 