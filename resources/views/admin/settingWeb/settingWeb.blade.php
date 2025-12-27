@extends('layouts.masterDashboard')

@section('judul', 'Setting Web')
@section('sub-judul', 'Konfigurasi Real-time SIGAP')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.css">
<style>
    /* === TOAST NOTIFICATION === */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        background: white;
        border-radius: 12px;
        padding: 15px 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        border-left: 4px solid #4e73df;
        display: none;
        animation: slideIn 0.3s ease;
        max-width: 350px;
    }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    .toast-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .toast-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #4e73df, #3a56c7);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }
    
    .toast-message h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }
    
    .toast-message p {
        margin: 3px 0 0 0;
        font-size: 12px;
        color: #64748b;
    }
    
    /* === CARD DESIGN === */
    .card-setting {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    
    .card-setting:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }
    
    .card-header-setting {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #334155;
        text-transform: uppercase;
    }
    
    .card-title i {
        color: #4e73df;
        font-size: 16px;
    }
    
    /* === QUICK ICON CONTROLS === */
    .icon-controls-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }
    
    .icon-control-item {
        text-align: center;
        padding: 20px 10px;
        background: #f8fafc;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .icon-control-item:hover {
        background: white;
        border-color: #4e73df;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(78, 115, 223, 0.15);
    }
    
    .icon-control-item.active {
        background: linear-gradient(135deg, #f0f4ff, #e6edff);
        border-color: #4e73df;
    }
    
    .control-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #4e73df, #3a56c7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        color: white;
        font-size: 20px;
    }
    
    .control-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    
    .control-status {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }
    
    .status-active {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }
    
    /* === MODERN SWITCH === */
    .modern-switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 26px;
    }
    
    .modern-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .modern-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #cbd5e1, #94a3b8);
        transition: .4s;
        border-radius: 34px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .modern-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    input:checked + .modern-slider {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    
    input:checked + .modern-slider:before {
        transform: translateX(26px);
    }
    
    /* === MENU ITEM WITH DELETE === */
    .menu-item {
        background: white;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .menu-item:hover {
        border-color: #e2e8f0;
        background: #f8fafc;
    }
    
    .menu-item-drag {
        cursor: move;
        flex-grow: 1;
    }
    
    .menu-item-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #4e73df, #3a56c7);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 15px;
        font-size: 16px;
    }
    
    .menu-item-content {
        flex-grow: 1;
    }
    
    .menu-item-title {
        font-weight: 600;
        color: #334155;
        margin-bottom: 4px;
    }
    
    .menu-item-type {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
        background: #f0f9ff;
        color: #0369a1;
        display: inline-block;
    }
    
    .menu-item-delete {
        background: #fee2e2;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        color: #dc2626;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
    }
    
    .menu-item-delete:hover {
        background: #fca5a5;
        color: white;
    }
    
    /* === FORM CONTROLS === */
    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s;
        background: white;
    }
    
    .form-control-modern:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        outline: none;
    }
    
    .file-upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .file-upload-area:hover {
        border-color: #4e73df;
        background: #f0f4ff;
    }
    
    .file-upload-label {
        color: #4e73df;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
    }
    
    .file-hint {
        font-size: 12px;
        color: #64748b;
    }
    
    /* === MAP PREVIEW === */
    .map-preview {
        height: 180px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        position: relative;
    }
    
    .map-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        flex-direction: column;
        color: #94a3b8;
    }
    
    .map-placeholder i {
        font-size: 32px;
        margin-bottom: 10px;
        opacity: 0.5;
    }
    
</style>
@endpush

@section('content')
<!-- Toast Notification -->
<div class="toast-notification" id="toast-notification">
    <div class="toast-content">
        <div class="toast-icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="toast-message">
            <h6 id="toast-title">Perubahan Disimpan</h6>
            <p id="toast-message">Pengaturan berhasil diperbarui</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card-setting mb-4">
            <div class="card-header-setting">
                <h4 class="card-title"><i class="fa fa-sliders"></i> Kontrol Cepat</h4>
                <span class="badge bg-primary">Auto Save</span>
            </div>
            <div class="icon-controls-grid">
                @php
                    $quickControls = [
                        'maintenance_mode' => ['icon' => 'fa-wrench', 'label' => 'Maintenance', 'active' => 'Mode Perbaikan', 'inactive' => 'Mode Normal', 'color' => '#f59e0b'],
                        'status_ppdb' => ['icon' => 'fa-door-open', 'label' => 'PPDB', 'active' => 'Dibuka', 'inactive' => 'Ditutup', 'color' => '#10b981'],
                        'ppdb_auto_close' => ['icon' => 'fa-clock-o', 'label' => 'Auto Close', 'active' => 'Aktif', 'inactive' => 'Nonaktif', 'color' => '#3b82f6'],
                    ];
                @endphp
                @foreach ($quickControls as $key => $control)
                    @php
                        $isActive = setting($key) == 'true' || setting($key) == 'buka';
                    @endphp
                    <div class="icon-control-item {{ $isActive ? 'active' : '' }}" onclick="toggleSetting('{{ $key }}')">
                        <div class="control-icon" style="background: {{ $control['color'] }};">
                            <i class="fa {{ $control['icon'] }}"></i>
                        </div>
                        <span class="control-label">{{ $control['label'] }}</span>
                        <label class="modern-switch" onclick="event.stopPropagation();">
                            <input type="checkbox" class="js-api-switch" name="{{ $key }}" {{ $isActive ? 'checked' : '' }}>
                            <span class="modern-slider"></span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="card-setting">
            <div class="card-header-setting">
                <h4 class="card-title">
                    <i class="fa fa-sitemap"></i>
                    Menu Nav
                </h4>
                <button class="btn btn-primary btn-sm" onclick="addMenu()" style="border-radius: 8px; padding: 6px 15px;">
                    <i class="fa fa-plus"></i> 
                </button>
            </div>
            
            <div class="alert alert-info" style="border-radius: 10px; background: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1;">
                <i class="fa fa-info-circle"></i> Drag untuk mengurutkan, klik ikon samping untuk menghapus
            </div>
            
            <div id="menu-container">
                @php $menus = json_decode(setting('menu_ppdb', '[]'), true); @endphp
                @foreach($menus as $index => $menu)
                <div class="menu-item dd-item" 
                     data-type="{{ $menu['type'] }}" 
                     data-title="{{ $menu['title'] }}" 
                     data-icon="{{ $menu['icon'] }}" 
                     data-url="{{ $menu['url'] ?? '' }}" 
                     data-content="{{ $menu['content'] ?? '' }}">
                    
                    <div class="menu-item-drag">
                        <div style="display: flex; align-items: center;">
                            <div class="menu-item-icon">
                                <i class="fa {{ $menu['icon'] }}"></i>
                            </div>
                            <div class="menu-item-content">
                                <div class="menu-item-title">{{ $menu['title'] }}</div>
                                <span class="menu-item-type">{{ strtoupper($menu['type']) }}</span>
                                @if($menu['type'] == 'link' && $menu['url'])
                                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                                    <i class="fa fa-link"></i> {{ $menu['url'] }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <button class="menu-item-delete" onclick="deleteMenu(this, {{ $index }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-setting mb-4">
            <div class="card-header-setting">
                <h4 class="card-title"><i class="fa fa-id-card"></i> Identitas Sistem</h4>
            </div>
            <div class="p-3">
                <div class="form-group mb-2">
                    <label class="small">Nama Sistem (SIGAP)</label>
                    <input type="text" name="nama_sistem" class="form-control js-api-input" value="{{ setting('nama_sistem') }}">
                </div>
                <div class="form-group mb-2">
                    <label class="small">Nama Lembaga</label>
                    <input type="text" name="nama_lembaga" class="form-control js-api-input" value="{{ setting('nama_lembaga') }}">
                </div>
                <div class="form-group mb-2">
                    <label class="small">Alamat Lembaga</label>
                    <textarea name="alamat_lembaga" class="form-control js-api-input" rows="2">{{ setting('alamat_lembaga') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="small">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control js-api-input">
                            <option value="2025/2026" {{ setting('tahun_ajaran') == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="small">Versi</label>
                        <input type="text" class="form-control" value="{{ setting('versi_app') }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-setting">
            <div class="card-header-setting">
                <h4 class="card-title"><i class="fa fa-map-marker"></i> Lokasi Maps</h4>
            </div>
            <div class="p-3">
                <textarea name="lokasi_map" class="form-control js-api-input" rows="3">{{ setting('lokasi_map') }}</textarea>
                <div class="map-preview mt-2" style="height: 150px; overflow: hidden; border-radius: 8px;">
                    {!! setting('lokasi_map') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-setting mb-4">
            <div class="card-header-setting">
                <h4 class="card-title"><i class="fa fa-share-alt"></i> Kontak & Sosmed</h4>
            </div>
            <div class="p-3">
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fa fa-whatsapp"></i></span>
                    <input type="text" name="kontak_whatsapp" class="form-control js-api-input" value="{{ setting('kontak_whatsapp') }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="email" class="form-control js-api-input" value="{{ setting('email') }}">
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <input type="text" name="instagram" class="form-control form-control-sm js-api-input" value="{{ setting('instagram') }}" placeholder="Instagram">
                    </div>
                    <div class="col-6 mb-2">
                        <input type="text" name="facebook" class="form-control form-control-sm js-api-input" value="{{ setting('facebook') }}" placeholder="Facebook">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-setting">
            <div class="card-header-setting" style="background: #f8fafc;">
                <h4 class="card-title"><i class="fa fa-credit-card"></i> Pembayaran (Midtrans)</h4>
            </div>
            <div class="p-3">
                <div class="form-group mb-2">
                    <label class="small">Biaya Pendaftaran (Rp)</label>
                    <input type="number" name="biaya_pendaftaran" class="form-control js-api-input" value="{{ setting('biaya_pendaftaran') }}">
                </div>
                <div class="form-group mb-2">
                    <label class="small">Client Key</label>
                    <input type="text" name="client_key" class="form-control form-control-sm js-api-input" value="{{ setting('client_key') }}">
                </div>
                <div class="form-group">
                    <label class="small">Server Key</label>
                    <input type="password" name="server_key" class="form-control form-control-sm js-api-input" value="{{ setting('server_key') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Sortable for menu items
    const menuContainer = document.getElementById('menu-container');
    const sortable = new Sortable(menuContainer, {
        animation: 150,
        onEnd: function() {
            saveMenuOrder();
        }
    });

    // Debounce for text inputs
    let typingTimer;
    $('.js-api-input').on('input', function() {
        clearTimeout(typingTimer);
        const key = $(this).attr('name');
        const value = $(this).val();
        
        typingTimer = setTimeout(() => {
            saveSetting(key, value, 'Input');
        }, 800);
    });

    // Switch toggle with icon click support
    $('.js-api-switch').on('change', function(e) {
        e.stopPropagation();
        const key = $(this).attr('name');
        const isChecked = $(this).is(':checked');
        const value = key === 'status_ppdb' 
            ? (isChecked ? 'buka' : 'tutup') 
            : (isChecked ? 'true' : 'false');
        
        saveSetting(key, value, 'Switch');
        
        // Update icon control status
        const iconItem = $(`.icon-control-item[data-key="${key}"]`);
        const statusSpan = iconItem.find('.control-status');
        
        if(isChecked) {
            iconItem.addClass('active');
            statusSpan.removeClass('status-inactive').addClass('status-active');
            
            if(key === 'status_ppdb') {
                statusSpan.text('Dibuka');
            } else if(key === 'maintenance_mode') {
                statusSpan.text('Mode Perbaikan');
            } else {
                statusSpan.text('Aktif');
            }
        } else {
            iconItem.removeClass('active');
            statusSpan.removeClass('status-active').addClass('status-inactive');
            
            if(key === 'status_ppdb') {
                statusSpan.text('Ditutup');
            } else if(key === 'maintenance_mode') {
                statusSpan.text('Mode Normal');
            } else {
                statusSpan.text('Nonaktif');
            }
        }
    });

    // File upload
    $('.js-api-file').on('change', function() {
        const key = $(this).data('key');
        const file = $(this)[0].files[0];
        
        if(!file) return;
        
        // Validate file
        if(file.size > 2 * 1024 * 1024) {
            showToast('Error', 'File terlalu besar. Maksimal 2MB', 'error');
            return;
        }
        
        if(!file.type.match('image.*')) {
            showToast('Error', 'Hanya file gambar yang diperbolehkan', 'error');
            return;
        }
        
        const formData = new FormData();
        formData.append('setting_key', key);
        formData.append('setting_value', file);
        
        saveSetting(formData, null, 'File', key);
    });
});

// Function to toggle setting via icon click
function toggleSetting(key) {
    const checkbox = $(`.js-api-switch[name="${key}"]`);
    const isChecked = checkbox.is(':checked');
    checkbox.prop('checked', !isChecked).trigger('change');
}

// Save menu order
function saveMenuOrder() {
    const menuItems = [];
    $('#menu-container .menu-item').each(function() {
        menuItems.push({
            type: $(this).data('type'),
            title: $(this).data('title'),
            icon: $(this).data('icon'),
            url: $(this).data('url'),
            content: $(this).data('content')
        });
    });
    
    saveSetting('menu_ppdb', JSON.stringify(menuItems), 'Menu');
}

// Delete menu item
function deleteMenu(button, index) {
    Swal.fire({
        title: 'Hapus Menu?',
        text: "Menu akan dihapus dari navigasi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $(button).closest('.menu-item').remove();
            saveMenuOrder();
            showToast('Berhasil', 'Menu berhasil dihapus', 'success');
        }
    });
}

// Add new menu
async function addMenu() {
    const { value: formValues } = await Swal.fire({
    title: '<span style="font-size: 18px; font-weight: 700;">Pengaturan Menu</span>',
    html: `
        <div class="text-start mt-3" style="font-family: 'Inter', sans-serif;">
            <div class="mb-3">
                <label class="form-label fw-bold mb-1" style="font-size: 13px; color: #64748b;">TIPE MENU</label>
                <select id="menu-type" class="form-select form-control-modern">
                    <option value="link">🔗 Link / URL Eksternal</option>
                    <option value="accordion">📂 Accordion (Konten Statis/FAQ)</option>
                </select>
            </div>
            
            <div class="row g-2">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold mb-1" style="font-size: 13px; color: #64748b;">JUDUL MENU</label>
                    <input id="menu-title" class="form-control" placeholder="Contoh: Brosur PPDB">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold mb-1" style="font-size: 13px; color: #64748b;">IKON</label>
                    <input id="menu-icon" class="form-control" placeholder="fa-file-pdf">
                </div>
            </div>
            
            <div id="link-field">
                <label class="form-label fw-bold mb-1" style="font-size: 13px; color: #64748b;">URL TUJUAN</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fa fa-link" style="font-size: 12px;"></i></span>
                    <input id="menu-url" class="form-control" placeholder="https://google.com atau nama-route">
                </div>
            </div>
            
            <div id="accordion-field" style="display: none;">
                <label class="form-label fw-bold mb-1" style="font-size: 13px; color: #64748b;">KONTEN ACCORDION</label>
                <textarea id="menu-content" class="form-control" rows="4" placeholder="Tulis informasi yang ingin ditampilkan saat menu diklik..."></textarea>
            </div>
        </div>
    `,
    showCancelButton: true,
    confirmButtonText: 'Simpan Menu',
    cancelButtonText: 'Batal',
    confirmButtonColor: '#3b82f6',
    customClass: {
        container: 'my-swal-container',
        popup: 'my-swal-popup rounded-4',
    },
    preConfirm: () => {
        const title = $('#menu-title').val();
        if (!title) {
            Swal.showValidationMessage('Judul menu tidak boleh kosong');
            return false;
        }
        return {
            type: $('#menu-type').val(),
            title: title,
            icon: $('#menu-icon').val() || 'fa-link',
            url: $('#menu-url').val(),
            content: $('#menu-content').val()
        };
    },
    didOpen: () => {
        // Toggle field saat tipe diubah
        $('#menu-type').on('change', function() {
            if ($(this).val() === 'link') {
                $('#link-field').fadeIn(200);
                $('#accordion-field').hide();
            } else {
                $('#link-field').hide();
                $('#accordion-field').fadeIn(200);
            }
        });
    }
});
    
    if(formValues) {
        const menuItem = $(`
            <div class="menu-item dd-item" 
                 data-type="${formValues.type}" 
                 data-title="${formValues.title}" 
                 data-icon="${formValues.icon}" 
                 data-url="${formValues.url}" 
                 data-content="${formValues.content}">
                
                <div class="menu-item-drag">
                    <div style="display: flex; align-items: center;">
                        <div class="menu-item-icon">
                            <i class="fa ${formValues.icon}"></i>
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-title">${formValues.title}</div>
                            <span class="menu-item-type">${formValues.type.toUpperCase()}</span>
                            ${formValues.type === 'link' && formValues.url ? 
                                `<div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                                    <i class="fa fa-link"></i> ${formValues.url}
                                </div>` : ''}
                        </div>
                    </div>
                </div>
                
                <button class="menu-item-delete" onclick="deleteMenu(this)">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        `);
        
        $('#menu-container').append(menuItem);
        saveMenuOrder();
        showToast('Berhasil', 'Menu berhasil ditambahkan', 'success');
    }
}

// Save setting with toast notification
function saveSetting(data, value, type, key = null) {
    const formData = new FormData();
    let ajaxData;
    let settingKey;
    
    if(data instanceof FormData) {
        // File upload
        ajaxData = data;
        settingKey = key;
    } else {
        // Regular input
        formData.append('setting_key', data);
        formData.append('setting_value', value);
        ajaxData = formData;
        settingKey = data;
    }
    
    showToast('Menyimpan...', 'Sedang menyimpan perubahan', 'loading');
    
    $.ajax({
                url: "/api/setting-web/ajax-update",
        type: "POST",
        data: ajaxData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(settingKey === 'lokasi_map') {
                const mapPreview = $('#map-preview');
                if(value && value.includes('iframe')) {
                    mapPreview.html(value);
                } else {
                    mapPreview.html(`
                        <div class="map-placeholder">
                            <i class="fa fa-map"></i>
                            <span>Belum ada peta</span>
                        </div>
                    `);
                }
            }
            
            if(settingKey === 'logo_lembaga') {
                $('#prev-logo_lembaga').attr('src', response.new_value + '?t=' + new Date().getTime());
            }
            
            setTimeout(() => {
                showToast('Berhasil', 'Pengaturan berhasil disimpan', 'success');
            }, 300);
        },
        error: function() {
            showToast('Error', 'Gagal menyimpan perubahan', 'error');
        }
    });
}

// Show toast notification
function showToast(title, message, type = 'success') {
    const toast = $('#toast-notification');
    const toastIcon = toast.find('.toast-icon i');
    const toastTitle = $('#toast-title');
    const toastMessage = $('#toast-message');
    
    // Set colors based on type
    if(type === 'success') {
        toast.css('border-left-color', '#10b981');
        toastIcon.removeClass().addClass('fa fa-check');
        toastIcon.parent().css('background', 'linear-gradient(135deg, #10b981, #059669)');
    } else if(type === 'error') {
        toast.css('border-left-color', '#ef4444');
        toastIcon.removeClass().addClass('fa fa-times');
        toastIcon.parent().css('background', 'linear-gradient(135deg, #ef4444, #dc2626)');
    } else if(type === 'loading') {
        toast.css('border-left-color', '#3b82f6');
        toastIcon.removeClass().addClass('fa fa-spinner fa-spin');
        toastIcon.parent().css('background', 'linear-gradient(135deg, #3b82f6, #2563eb)');
    }
    
    toastTitle.text(title);
    toastMessage.text(message);
    
    toast.fadeIn(300);
    
    // Auto hide after 3 seconds (except for loading)
    if(type !== 'loading') {
        setTimeout(() => {
            toast.fadeOut(300);
        }, 3000);
    }
}
</script>
@endpush