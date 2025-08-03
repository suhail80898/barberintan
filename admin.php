<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Pangkas Rambut Berintan</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        .sidebar-link.active {
            background-color: #ca8a04; /* yellow-600 */
            color: white;
            font-weight: 600;
        }
        /* Custom styles for status badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-badge {
          transition: all 0.3s ease;
        }
        .status-Confirmed { background-color: #dcfce7; color: #166534; }
        .status-Completed { background-color: #e0e7ff; color: #3730a3; }
        .status-Pending { background-color: #fef9c3; color: #854d0e; }
        .status-Cancelled { background-color: #fee2e2; color: #991b1b; }

        /* Print styles */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .print-title {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex h-screen bg-slate-100">
        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 bg-slate-800 text-slate-300 flex flex-col no-print">
            <div class="h-16 flex items-center justify-center px-4 bg-slate-900">
                <h1 class="text-xl font-bold text-white">Admin Berintan</h1>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2">
                <a href="#" onclick="showView('dashboard-view')" class="sidebar-link active flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 hover:text-white">
                    <i class="fas fa-tachometer-alt w-6"></i> Dashboard
                </a>
                <a href="#" onclick="showView('booking-view')" class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 hover:text-white">
                    <i class="fas fa-calendar-check w-6"></i> Jadwal Booking
                </a>
                <a href="#" onclick="showView('pelanggan-view')" class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 hover:text-white">
                    <i class="fas fa-users w-6"></i> Data Pelanggan
                </a>
                <a href="#" onclick="showView('layanan-view')" class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 hover:text-white">
                    <i class="fas fa-cut w-6"></i> Kelola Layanan
                </a>
                <!-- <a href="#" onclick="showView('staf-view')" class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-slate-700 hover:text-white">
                    <i class="fas fa-user-tie w-6"></i> Kelola Staf
                </a> -->
            </nav>
            <div class="px-2 py-4">
                 <a href="index.php" class="flex items-center px-4 py-2.5 rounded-lg text-slate-400 hover:bg-red-800 hover:text-white">
                    <i class="fas fa-sign-out-alt w-6"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 no-print">
                <h2 id="view-title" class="text-2xl font-semibold text-slate-800">Dashboard</h2>
                <div class="flex items-center space-x-4">
                <!-- Notifikasi -->
                <div class="relative">
                  <!-- Icon lonceng + badge -->
                  <div id="notif-icon" class="relative cursor-pointer p-2 hover:bg-slate-200 rounded-full" onclick="toggleNotifDropdown()">
                      <i class="fas fa-bell fa-lg text-slate-700"></i>
                      <span id="notif-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full hidden">0</span>
                  </div>

                  <!-- Dropdown Notifikasi -->
                  <div id="notif-dropdown" class="absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-lg shadow-lg hidden z-50">
                      <div class="p-4 border-b border-slate-200 font-semibold text-slate-700">
                          Notifikasi Booking Hari Ini
                      </div>
                      <ul id="notif-list" class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
                          <!-- List akan di-render oleh JS -->
                      </ul>
                  </div>
                </div>

                <!-- Suara Notifikasi -->
                <audio id="notif-sound" src="https://notificationsounds.com/storage/sounds/file-sounds-1151-pristine.mp3" preload="auto"></audio>

                    <div class="flex items-center">
                        <img src="https://placehold.co/40x40/64748b/FFFFFF?text=A" alt="Admin" class="w-8 h-8 rounded-full">
                        <span class="ml-2 font-semibold text-slate-700">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 p-6 overflow-y-auto">
                <!-- Views will be rendered here. They start empty. -->
                <div id="dashboard-view" class="main-view"></div>
                <div id="pelanggan-view" class="main-view hidden"></div>
                <div id="booking-view" class="main-view hidden"></div>
                <div id="layanan-view" class="main-view hidden"></div>
            
            </div>
        </main>
    </div>

    <!-- Modals (Container for dynamic modals) -->
    <div id="modal-container"></div>

<script>

let db = {
    pelanggan: [],
    layanan: [],
    booking: []
};

const idKeys = {
    pelanggan: 'id_pelanggan',
    layanan: 'id_layanan',
    booking: 'id_booking'
};

const formatCurrency = (amount) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);

const formatDate = (dateString) =>
    new Date(dateString).toLocaleString('id-ID', {
        weekday: 'short',
        day: 'numeric',
        month: 'short',
        hour: '2-digit',
        minute: '2-digit'
    });


const getNextId = (table) => {
    const key = idKeys[table];
    return db[table].length > 0 ? Math.max(...db[table].map(item => item[key])) + 1 : 1;
};
const getCurrentView = () => document.querySelector('.sidebar-link.active').getAttribute('onclick').match(/'([^']+)'/)[1];

// --- NAVIGATION & VIEW RENDERING ---
const views = {
    'dashboard-view': renderDashboard,
    'pelanggan-view': renderPelangganView,
    'booking-view': renderBookingView,
    'layanan-view': renderLayananView,
};
const viewTitleEl = document.getElementById('view-title');

function showView(viewId) {
    document.querySelectorAll('.main-view').forEach(v => {
        v.classList.add('hidden');
        v.innerHTML = '';
    });
    
    const targetView = document.getElementById(viewId);
    targetView.classList.remove('hidden');
    
    if (views[viewId]) {
        views[viewId]();
    }

    document.querySelectorAll('.sidebar-link').forEach(link => link.classList.remove('active'));
    const activeLink = document.querySelector(`.sidebar-link[onclick="showView('${viewId}')"]`);
    if (activeLink) {
        activeLink.classList.add('active');
        viewTitleEl.textContent = activeLink.textContent.trim();
    }
}

// --- MODAL & FORM HANDLING ---
const modalContainer = document.getElementById('modal-container');

function openModal(content) {
    modalContainer.innerHTML = content.trim();
}

function closeModal() {
    modalContainer.innerHTML = '';
}

// --- GENERIC RENDER ---
function renderCrudView(config) {
    const { viewId, title, tableId, columns, data, addBtnLabel, onAdd, onEdit, onDelete, itemType } = config;
    const viewEl = document.getElementById(viewId);
    const pk = idKeys[itemType];
    
    let tableHeaders = columns.map(col => `<th class="p-3">${col.header}</th>`).join('');
    let tableRows = data.map(item => `
        <tr class="border-b hover:bg-slate-50">
            ${columns.map(col => `<td class="p-3 ${col.className || ''}">${col.render(item)}</td>`).join('')}
            <td class="p-3 no-print">
                <button onclick="${onEdit}(${item[pk]})" class="text-blue-600 hover:text-blue-800 mr-3" title="Edit"><i class="fas fa-edit"></i></button>
                <button onclick="${onDelete}('${itemType}', ${item[pk]})" class="text-red-600 hover:text-red-800" title="Hapus"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    `).join('');

    viewEl.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex justify-between items-center mb-4 no-print">
                <h3 class="text-lg font-semibold text-slate-800">${title}</h3>
                <div>
                    <button onclick="printReport('${tableId}-container', 'Laporan ${title}')" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg mr-2 hover:bg-slate-300"><i class="fas fa-print mr-2"></i>Cetak</button>
                    <button onclick="${onAdd}()" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600"><i class="fas fa-plus mr-2"></i>${addBtnLabel}</button>
                </div>
            </div>
            <div id="${tableId}-container" class="overflow-x-auto print-area">
                <h3 class="print-title hidden">Laporan ${title}</h3>
                <table id="${tableId}" class="w-full text-left">
                    <thead><tr class="border-b bg-slate-50">${tableHeaders}<th class="p-3 no-print">Aksi</th></tr></thead>
                    <tbody>${tableRows}</tbody>
                </table>
            </div>
        </div>
    `;
}

// --- RENDER VIEW FUNCTIONS ---
function renderDashboard() {
    const viewEl = document.getElementById('dashboard-view');

    const now = new Date();
    const todayStr = now.toISOString().slice(0, 10);
    const thisMonth = now.getMonth();
    const thisYear = now.getFullYear();

    // Total pelanggan
    const totalPelanggan = db.pelanggan.length;

    // Total staf aktif
    // const stafAktif = db.staf.filter(s => s.aktif).length;

    // Booking Hari Ini
    const bookingsTodayData = db.booking.filter(b => {
        if (!b.waktu_booking) return false;
        const waktu = new Date(b.waktu_booking.replace(' ', 'T'));
        return waktu.toISOString().slice(0, 10) === todayStr;
    });

    const bookingsToday = bookingsTodayData.length;
    const confirmedToday = bookingsTodayData.filter(b => b.status === 'Confirmed').length;
    const pendingToday = bookingsTodayData.filter(b => b.status === 'Pending').length;

    // Pendapatan bulan ini
    const revenueThisMonth = db.booking
        .filter(b => {
            const waktu = new Date(b.waktu_booking.replace(' ', 'T'));
            return waktu.getMonth() === thisMonth &&
                   waktu.getFullYear() === thisYear &&
                   b.status === 'Completed';
        })
        .reduce((sum, b) => sum + (parseFloat(b.harga_total) || 0), 0);

    // Jadwal terdekat
    const upcomingBookings = db.booking
        .filter(b => {
            const waktu = new Date(b.waktu_booking.replace(' ', 'T'));
            return waktu >= now && b.status === 'Confirmed';
        })
        .sort((a, b) => new Date(a.waktu_booking.replace(' ', 'T')) - new Date(b.waktu_booking.replace(' ', 'T')))
        .slice(0, 5);

    // Tabel booking terdekat
    const upcomingRows = upcomingBookings.length === 0
        ? '<tr><td colspan="5" class="p-3 text-center text-slate-500">Tidak ada jadwal terdekat.</td></tr>'
        : upcomingBookings.map(b => {
            const pelanggan = db.pelanggan.find(p => p.id_pelanggan === b.id_pelanggan)?.nama_lengkap || 'N/A';
            const layanan = db.layanan.find(l => l.id_layanan === b.id_layanan)?.nama_layanan || 'N/A';
            
            return `
                <tr class="border-b">
                    <td class="p-3">${formatDate(b.waktu_booking)}</td>
                    <td class="p-3 font-medium">${pelanggan}</td>
                    <td class="p-3">${layanan}</td>
                    
                    <td class="p-3"><span class="status-badge status-${b.status}">${b.status}</span></td>
                </tr>
            `;
        }).join('');

        

    // Render ke HTML
    viewEl.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Booking Hari Ini</p>
                    <p class="text-3xl font-bold text-slate-800">${bookingsToday}</p>
                    <p class="text-xs text-slate-500 mt-1">
                        ✅ Confirmed: ${confirmedToday}<br>
                        🕓 Pending: ${pendingToday}
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><i class="fas fa-calendar-day fa-lg"></i></div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-slate-800">${totalPelanggan}</p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full"><i class="fas fa-users fa-lg"></i></div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Pendapatan Bulan Ini</p>
                    <p class="text-3xl font-bold text-slate-800">${formatCurrency(revenueThisMonth)}</p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full"><i class="fas fa-dollar-sign fa-lg"></i></div>
            </div>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Jadwal Terdekat</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead><tr class="border-b bg-slate-50"><th class="p-3">Waktu</th><th class="p-3">Pelanggan</th><th class="p-3">Layanan</th><th class="p-3">Status</th></tr></thead>
                    <tbody>${upcomingRows}</tbody>
                </table>
            </div>
        </div>
    `;
}

// NEW ADDS FITUR IJUTS

let filteredStatus = 'ALL'; // global 

function renderBookingView() {
    const viewEl = document.getElementById('booking-view');

    function renderFiltered() {
        const data = db.booking
            .filter(b => {
                if (filteredStatus === 'ALL') return true;
                return b.status === filteredStatus || (filteredStatus === 'LAPORAN' && ['Completed', 'Cancelled'].includes(b.status));
            })
            .map(b => ({
                ...b,
                pelanggan: db.pelanggan.find(p => p.id_pelanggan === b.id_pelanggan)?.nama_lengkap || 'N/A',
                layanan: db.layanan.find(l => l.id_layanan === b.id_layanan)?.nama_layanan || 'N/A',
            }))
            .sort((a, b) => new Date(b.waktu_booking) - new Date(a.waktu_booking));

        renderCrudView({
            viewId: 'booking-view',
            title: 'Jadwal Booking',
            tableId: 'booking-table',
            itemType: 'booking',
            columns: [
                { header: 'ID', render: item => item.id_booking },
                { header: 'Waktu', render: item => formatDate(item.waktu_booking) },
                { header: 'Pelanggan', render: item => item.pelanggan, className: 'font-medium' },
                { header: 'Layanan', render: item => item.layanan },
                {
                    header: 'Status',
                    render: item => {
                        const statusColors = {
                            'Pending': 'bg-yellow-200 text-yellow-800',
                            'Confirmed': 'bg-green-200 text-green-800',
                            'Completed': 'bg-blue-200 text-blue-800',
                            'Cancelled': 'bg-red-200 text-red-800'
                        };
                        return `<span class="px-2 py-1 rounded text-sm font-medium ${statusColors[item.status] || ''}" data-id="${item.id_booking}" data-status="${item.status}">${item.status}</span>`;
                    }
                },
                {
                    header: `<input type="checkbox" onclick="toggleAllBookingCheckboxes(this)">`,
                    render: item => `<input type="checkbox" class="booking-checkbox" value="${item.id_booking}">`,
                    className: 'text-right'
                }
            ],
            data: data,
            addBtnLabel: 'Tambah Booking',
            onAdd: 'addBooking',
            onEdit: 'editBooking',
            onDelete: 'confirmDelete'
        });

        const titleEl = viewEl.querySelector('.text-lg.font-semibold');
        const filterHTML = `
            <div class="mt-2 mb-4 flex gap-2 no-print">
                <button onclick="setFilter('ALL')" class="filter-btn px-3 py-1 rounded bg-slate-200 text-sm">Semua</button>
                <button onclick="setFilter('Completed')" class="filter-btn px-3 py-1 rounded bg-blue-200 text-sm">Completed</button>
                <button onclick="setFilter('Confirmed')" class="filter-btn px-3 py-1 rounded bg-green-200 text-sm">Confirmed</button>
                <button onclick="setFilter('Pending')" class="filter-btn px-3 py-1 rounded bg-yellow-200 text-sm">Pending</button>
                <button onclick="setFilter('Cancelled')" class="filter-btn px-3 py-1 rounded bg-red-200 text-sm">Cancelled</button>
            </div>
        `;
        titleEl.insertAdjacentHTML('afterend', filterHTML);

        const bulkHTML = `
            <div class="mt-6 flex gap-2 items-center justify-end no-print">
                <select id="bulk-status" class="px-3 py-1 border rounded text-sm">
                    <option value="">-- Pilih Status Baru --</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <button onclick="applyBulkStatus()" class="px-3 py-1 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                    Ubah Status Terpilih
                </button>
                <span id="bulk-loading" class="text-sm text-gray-400 hidden">⏳ Memproses...</span>
            </div>
        `;
        document.getElementById('booking-table').insertAdjacentHTML('afterend', bulkHTML);
    }

    window.setFilter = function (status) {
        filteredStatus = status;
        renderFiltered();
    };

    renderFiltered();
}

function toggleAllBookingCheckboxes(masterCheckbox) {
    document.querySelectorAll('.booking-checkbox').forEach(cb => {
        cb.checked = masterCheckbox.checked;
    });
}

function applyBulkStatus() {
    const newStatus = document.getElementById('bulk-status').value;
    const checkboxes = document.querySelectorAll('.booking-checkbox:checked');
    const ids = Array.from(checkboxes).map(cb => cb.value);

    if (!newStatus) {
        showNotification("⚠️ Pilih status baru dulu");
        return;
    }
    if (ids.length === 0) {
        showNotification("⚠️ Pilih data booking");
        return;
    }

    document.getElementById('bulk-loading').classList.remove('hidden');

    Promise.all(
        ids.map(id => {
            return fetch('Fungsi/create_or_update.php?table=booking', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    id_booking: parseInt(id),
                    status: newStatus
                })
            }).then(() => {
                const item = db.booking.find(b => b.id_booking == id);
                if (item) item.status = newStatus;

                // Langsung update badge DOM
                const badge = document.querySelector(`span[data-id="${id}"]`);
                if (badge) {
                    badge.textContent = newStatus;
                    badge.className = `px-2 py-1 rounded text-sm font-medium ${{
                        'Pending': 'bg-yellow-200 text-yellow-800',
                        'Confirmed': 'bg-green-200 text-green-800',
                        'Completed': 'bg-blue-200 text-blue-800',
                        'Cancelled': 'bg-red-200 text-red-800'
                    }[newStatus]}`;
                }
            });
        })
    )
    .then(() => {
        showNotification("✅ Status berhasil diubah", true);
    })
    .catch(() => showNotification("❌ Terjadi kesalahan"))
    .finally(() => {
        document.getElementById('bulk-loading').classList.add('hidden');
    });
}


let lastBookingCount = 0;

function renderNotification() {
    const notifIcon = document.getElementById('notif-icon');
    const notifBadge = document.getElementById('notif-badge');
    const notifList = document.getElementById('notif-list');
    const notifDropdown = document.getElementById('notif-dropdown');

    const now = new Date();
    const batasAkhir = new Date(); // batas 3 hari ke depan
    batasAkhir.setDate(batasAkhir.getDate() + 3);

    const bookingsUpcoming = db.booking.filter(b => {
        const waktu = new Date(b.waktu_booking.replace(' ', 'T'));
        return waktu >= now &&
               waktu <= batasAkhir &&
               ['Pending', 'Confirmed'].includes(b.status);
    });

    // Tampilkan badge jumlah
    if (bookingsUpcoming.length > 0) {
        notifBadge.classList.remove('hidden');
        notifBadge.textContent = bookingsUpcoming.length;
    } else {
        notifBadge.classList.add('hidden');
    }

    // Tampilkan isi notifikasi
    notifList.innerHTML = bookingsUpcoming.length === 0
        ? '<li class="p-3 text-center text-slate-500">Tidak ada booking baru.</li>'
        : bookingsUpcoming
            .sort((a, b) => new Date(a.waktu_booking) - new Date(b.waktu_booking))
            .map(b => {
                const pelanggan = db.pelanggan.find(p => p.id_pelanggan === b.id_pelanggan)?.nama_lengkap || 'N/A';
                const layanan = db.layanan.find(l => l.id_layanan === b.id_layanan)?.nama_layanan || 'N/A';
                const waktu = new Date(b.waktu_booking.replace(' ', 'T')).toLocaleString('id-ID', {
                    weekday: 'short', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit'
                });

                return `
                    <li class="p-3 hover:bg-slate-50">
                        <div class="font-semibold">${pelanggan}</div>
                        <div class="text-sm text-slate-500">${layanan} • ${waktu} • ${b.status}</div>
                    </li>
                `;
            }).join('');
}


// EVENT KLIK NOTIFIKASI
function setupNotificationToggle() {
    const notifIcon = document.getElementById('notif-icon');
    const notifDropdown = document.getElementById('notif-dropdown');
    notifIcon.addEventListener('click', () => {
        notifDropdown.classList.toggle('hidden');
    });
    document.addEventListener('click', (e) => {
        if (!notifIcon.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
}

function renderPelangganView() {
    renderCrudView({
        viewId: 'pelanggan-view', title: 'Data Pelanggan', tableId: 'pelanggan-table', itemType: 'pelanggan',
        columns: [
            { header: 'ID', render: item => item.id_pelanggan },
            { header: 'Nama Lengkap', render: item => item.nama_lengkap, className: 'font-medium text-slate-800' },
            { header: 'Email', render: item => item.email },
            { header: 'Telepon', render: item => item.nomor_telepon },
        ],
        data: db.pelanggan,
        addBtnLabel: 'Tambah Pelanggan',
        onAdd: 'addPelanggan', onEdit: 'editPelanggan', onDelete: 'confirmDelete'
    });
}

function renderLayananView() {
    renderCrudView({
        viewId: 'layanan-view', title: 'Kelola Layanan', tableId: 'layanan-table', itemType: 'layanan',
        columns: [
            { header: 'ID', render: item => item.id_layanan },
            { header: 'Nama Layanan', render: item => item.nama_layanan, className: 'font-medium' },
            { header: 'Harga', render: item => formatCurrency(item.harga) },
            { header: 'Durasi', render: item => `${item.durasi_menit} menit` },
            { header: 'Status', render: item => item.aktif ? '<span class="text-green-600 font-semibold">Aktif</span>' : '<span class="text-red-600 font-semibold">Non-Aktif</span>' },
        ],
        data: db.layanan,
        addBtnLabel: 'Tambah Layanan',
        onAdd: 'addLayanan', onEdit: 'editLayanan', onDelete: 'confirmDelete'
    });
}

function renderStafView() {
    renderCrudView({
        viewId: 'staf-view', title: 'Kelola Staf', tableId: 'staf-table', itemType: 'staf',
        columns: [
            { header: 'ID', render: item => item.id_staf },
            { header: 'Nama Staf', render: item => item.nama_staf, className: 'font-medium' },
            { header: 'Spesialisasi', render: item => item.spesialisasi },
            { header: 'Status', render: item => item.aktif ? '<span class="text-green-600 font-semibold">Aktif</span>' : '<span class="text-red-600 font-semibold">Non-Aktif</span>' },
        ],
        data: db.staf,
        addBtnLabel: 'Tambah Staf',
        onAdd: 'addStaf', onEdit: 'editStaf', onDelete: 'confirmDelete'
    });
}


// --- MODAL FORM TEMPLATES ---
function getFormModalHTML(config) {
    const { type, title, fields, onSave } = config;
    const formFields = fields.map(f => `
        <div>
            <label for="${f.id}" class="block text-sm font-medium text-slate-700">${f.label}</label>
            ${f.html}
        </div>
    `).join('');

    return `
        <div id="${type}-modal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <form id="${type}-form" onsubmit="event.preventDefault(); ${onSave}('${type}');">
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-semibold">${title}</h3>
                    </div>
                    <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                        <input type="hidden" id="id_pk_field">
                        ${formFields}
                    </div>
                    <div class="p-6 bg-slate-50 flex justify-end space-x-4">
                        <button type="button" onclick="closeModal()" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300">Batal</button>
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    `;
}

// --- ADD/EDIT/SAVE LOGIC ---

// Pelanggan
function addPelanggan() { editPelanggan(); }

function editPelanggan(id) {
    const item = id ? db.pelanggan.find(p => p.id_pelanggan == id) : {};
    if (id && !item) {
        alert("Data pelanggan tidak ditemukan.");
        return;
    }

    openModal(getFormModalHTML({
        type: 'pelanggan',
        title: id ? 'Edit Pelanggan' : 'Tambah Pelanggan',
        onSave: 'saveItem',
        fields: [
            { id: 'nama_lengkap', label: 'Nama Lengkap', html: `<input type="text" id="nama_lengkap" value="${item.nama_lengkap || ''}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'email', label: 'Email', html: `<input type="email" id="email" value="${item.email || ''}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'nomor_telepon', label: 'Nomor Telepon', html: `<input type="tel" id="nomor_telepon" value="${item.nomor_telepon || ''}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
        ]
    }));
    if (id) document.getElementById('id_pk_field').value = id;
}


// Layanan
function addLayanan() { editLayanan(); }

function editLayanan(id) {
    const item = id ? db.layanan.find(l => l.id_layanan == id) : { harga: 0, durasi_menit: 0, aktif: true };
    if (id && !item) {
        alert("Data layanan tidak ditemukan.");
        return;
    }

    openModal(getFormModalHTML({
        type: 'layanan',
        title: id ? 'Edit Layanan' : 'Tambah Layanan',
        onSave: 'saveItem',
        fields: [
            { id: 'nama_layanan', label: 'Nama Layanan', html: `<input type="text" id="nama_layanan" value="${item.nama_layanan || ''}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'deskripsi', label: 'Deskripsi', html: `<textarea id="deskripsi" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md">${item.deskripsi || ''}</textarea>` },
            { id: 'harga', label: 'Harga (Rp)', html: `<input type="number" id="harga" value="${item.harga}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'durasi_menit', label: 'Durasi (menit)', html: `<input type="number" id="durasi_menit" value="${item.durasi_menit}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'aktif', label: 'Status', html: `<select id="aktif" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md"><option value="true" ${item.aktif ? 'selected' : ''}>Aktif</option><option value="false" ${!item.aktif ? 'selected' : ''}>Non-Aktif</option></select>` },
        ]
    }));
    if (id) document.getElementById('id_pk_field').value = id;
}



// Booking
function addBooking() { editBooking(); }

function editBooking(id) {
    const item = id ? db.booking.find(b => b.id_booking == id) : {};
    if (id && !item) {
        alert("Data booking tidak ditemukan.");
        return;
    }

    const createOption = (val, text, selectedVal) => `<option value="${val}" ${val == selectedVal ? 'selected' : ''}>${text}</option>`;
    const pelangganOptions = db.pelanggan.map(p => createOption(p.id_pelanggan, p.nama_lengkap, item.id_pelanggan)).join('');
    const layananOptions = db.layanan.filter(l => l.aktif).map(l => createOption(l.id_layanan, l.nama_layanan, item.id_layanan)).join('');
    const statusOptions = ['Pending', 'Confirmed', 'Completed', 'Cancelled', 'No Show'].map(s => createOption(s, s, item.status)).join('');

    openModal(getFormModalHTML({
        type: 'booking',
        title: id ? 'Edit Booking' : 'Tambah Booking',
        onSave: 'saveItem',
        fields: [
            { id: 'id_pelanggan', label: 'Pelanggan', html: `<select id="id_pelanggan" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>${pelangganOptions}</select>` },
            { id: 'id_layanan', label: 'Layanan', html: `<select id="id_layanan" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>${layananOptions}</select>` },

            { id: 'waktu_booking', label: 'Waktu Booking', html: `<input type="datetime-local" id="waktu_booking" value="${item.waktu_booking || ''}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md" required>` },
            { id: 'status', label: 'Status', html: `<select id="status" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md">${statusOptions}</select>` },
            { id: 'catatan', label: 'Catatan', html: `<textarea id="catatan" rows="2" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md">${item.catatan || ''}</textarea>` },
        ]
    }));
    if (id) document.getElementById('id_pk_field').value = id;
}

function saveItem(type) {
    const form = document.getElementById(`${type}-form`);
    const id = form.querySelector('#id_pk_field').value;
    const pk = idKeys[type];
    let newItemData = {};

    const fields = Array.from(form.elements).filter(el => el.id && el.id !== 'id_pk_field');
    fields.forEach(field => {
        let value = field.type === 'checkbox' ? field.checked : field.value.trim();

        // Konversi string ke tipe asli
        if (value === 'true') value = true;
        if (value === 'false') value = false;

        // Konversi angka jika field numerik
        if (field.id.startsWith('id_') || field.id === 'durasi_menit') {
            value = parseInt(value, 10) || 0;
        } else if (field.id === 'harga') {
            value = parseFloat(value) || 0;
        }

        newItemData[field.id] = value;
    });

    if (id) {
        newItemData[pk] = parseInt(id);
    }

    console.log("📤 Data yang dikirim:", newItemData); 

    fetch(`Fungsi/create_or_update.php?table=${type}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newItemData)
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP ${res.status}: ${res.statusText}`);
        }
        return res.json(); // Pastikan response adalah JSON valid
    })
    .then(result => {
        console.log("📥 Respon dari server:", result); // Debug hasil

        if (result.success) {
            closeModal();
            fetchAllData(); // Muat ulang data
        } else {
            alert('⚠️ Gagal menyimpan data: ' + (result.message || 'Tidak diketahui'));
        }
    })
    .catch(err => {
        console.error('❌ Error saat menyimpan:', err);
        alert('🚫 Terjadi kesalahan saat menyimpan data.\n' + err.message);
    });
}

function fetchAllData() {
    return fetch('Fungsi/get_all_data.php')
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                db = result.data;
                renderNotification();
                showView(getCurrentView()); // agar tampilan otomatis diperbarui
            } else {
                alert('Gagal memuat data: ' + (result.message || 'Tidak diketahui'));
            }
        })
        .catch(err => {
            console.error('❌ Gagal mengambil data:', err);
            alert('Tidak dapat mengambil data dari server.');
        });
}

// --- DELETE & PRINT ---
function confirmDelete(type, id) {
    openModal(`
        <div id="delete-modal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm">
                <div class="p-6 text-center">
                    <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold">Anda yakin?</h3>
                    <p class="text-slate-500 mt-2">Data ${type} dengan ID ${id} akan dihapus permanen.</p>
                </div>
                <div class="p-4 bg-slate-50 flex justify-center space-x-4">
                    <button type="button" onclick="closeModal()" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 w-24">Batal</button>
                    <button type="button" onclick="deleteItem('${type}', ${id})" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 w-24">Ya, Hapus</button>
                </div>
            </div>
        </div>
    `);
}

function deleteItem(type, id) {
    fetch(`Fungsi/delete.php?table=${type}&id=${id}`)
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            return fetch("Fungsi/get_all_data.php")
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        db = res.data;
                        closeModal();
                        showView(getCurrentView());
                    }
                });
        } else {
            alert("Gagal menghapus data.");
        }
    });
}

function printReport(containerId, title) {
    const printTitle = document.querySelector(`#${containerId} .print-title`);
    if (printTitle) {
        printTitle.textContent = title;
        printTitle.classList.remove('hidden');
    }
    window.print();
    if (printTitle) {
        printTitle.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('Fungsi/get_all_data.php')
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                db = result.data;
                showView('dashboard-view');
                renderNotification();
                setupNotificationToggle();
            } else {
                alert('Gagal memuat data dari server: ' + result.message);
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
            alert('Tidak dapat terhubung ke server.');
        });
});
</script>

</body>
</html>
