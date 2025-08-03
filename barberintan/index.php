<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pangkas Rambut Berintan - Potongan Presisi, Gaya Abadi</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .hero-bg {
            background-image: url('assets/images/bground.jpg');
        }
        .modal-open { overflow: hidden; }
        .calendar-day:hover:not(.disabled) { background-color: #facc15; color: #1f2937; }
        .calendar-day.selected, .time-slot.selected { background-color: #facc15; color: #1f2937; font-weight: bold; }
        .calendar-day.disabled, .time-slot.disabled { color: #4b5563; cursor: not-allowed; }
        .time-slot:hover:not(.disabled) { background-color: #facc15; color: #1f2937; }
        @keyframes fade-in-right { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
        @keyframes fade-out { from { opacity: 1; } to { opacity: 0; } }
        .animate-fade-in-right { animation: fade-in-right 0.5s ease-out forwards; }
        .animate-fade-out { animation: fade-out 0.5s ease-in forwards; }
    </style>
</head>
<body class="bg-gray-900 text-gray-200">

    <!-- Main Website Content -->
    <div id="main-content">
        <!-- Header / Navigation -->
        <header class="bg-gray-900/80 backdrop-blur-sm sticky top-0 z-40 border-b border-gray-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="#home" class="text-2xl font-bold text-white font-display">
                    Berintan<span class="text-yellow-400">.</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex md:items-center md:space-x-8">
                    <a href="#layanan" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300">Layanan</a>
                    <a href="#galeri" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300">Galeri</a>
                    <a href="#lokasi" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300">Lokasi</a>

                    <!-- Auth Desktop -->
                    <div id="auth-section-desktop" class="flex items-center space-x-4">
                    <button onclick="openAuthModal()" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300">Login/Register</button>
                    </div>

                    <button onclick="openBooking()" class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-semibold px-4 py-2 rounded-md transition-colors duration-300">
                    Booking Sekarang
                    </button>
                </nav>

                <!-- Mobile Navigation -->
                <div class="md:hidden flex items-center space-x-4">
                    <div id="auth-section-mobile">
                    <!-- Akan diisi oleh updateAuthUI() -->
                    </div>
                    <button onclick="openBooking()" class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-semibold px-3 py-2 rounded-md transition-colors duration-300 text-sm">
                    Booking
                    </button>
                </div>
                </div>
            </div>
        </header>


        <main>
            <!-- Hero Section -->
            <section id="home" class="relative h-screen flex items-center justify-center text-center hero-bg bg-cover bg-center">
                <div class="absolute inset-0 bg-black/60"></div>
                <div class="relative z-10 px-4">
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white uppercase tracking-wider">Potongan <span class="font-display text-yellow-400 italic">Presisi</span>, Gaya Abadi</h1>
                    <p class="mt-4 max-w-2xl mx-auto text-lg md:text-xl text-gray-300">Pengalaman pangkas rambut premium di Bandung yang mengutamakan detail dan kualitas untuk gaya Anda.</p>
                    <div class="mt-8">
                        <button onclick="openBooking()" class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-bold text-lg px-8 py-4 rounded-md transition-transform duration-300 inline-block transform hover:scale-105">Booking Jadwal Anda</button>
                    </div>
                </div>
            </section>
            <!-- Sections for Layanan, Galeri, Lokasi -->
            <section id="layanan" class="py-20 bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">Layanan Kami</h2>
                        <p class="mt-2 text-lg text-gray-400">Kualitas dan kepuasan adalah prioritas kami.</p>
                    </div>
                    <div id="layanan-list-main" class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <!-- Services will be dynamically injected here -->
                    </div>
                </div>
            </section>
            <section id="galeri" class="py-20 bg-gray-800">
                 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">Galeri Gaya</h2>
                        <p class="mt-2 text-lg text-gray-400">Inspirasi gaya dari para pelanggan kami.</p>
                    </div>
                    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <img src="assets/images/1.jpeg" alt="Contoh Gaya Rambut 1" class="rounded-lg w-full h-full object-cover aspect-square hover:opacity-80 transition-opacity duration-300 cursor-pointer">
                        <img src="assets/images/2.jpeg" alt="Contoh Gaya Rambut 2" class="rounded-lg w-full h-full object-cover aspect-square hover:opacity-80 transition-opacity duration-300 cursor-pointer">
                        <img src="assets/images/3.jpeg" alt="Contoh Gaya Rambut 3" class="rounded-lg w-full h-full object-cover aspect-square hover:opacity-80 transition-opacity duration-300 cursor-pointer">
                        <img src="assets/images/4.jpeg" alt="Contoh Gaya Rambut 4" class="rounded-lg w-full h-full object-cover aspect-square hover:opacity-80 transition-opacity duration-300 cursor-pointer">
                    </div>
                </div>
            </section>
            <section id="lokasi" class="py-20 bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">Temukan Kami</h2>
                        <p class="mt-2 text-lg text-gray-400">Kunjungi kami untuk pengalaman terbaik.</p>
                    </div>
                    <div class="mt-12 grid md:grid-cols-2 gap-8 items-center">
                        <div class="w-full h-80 md:h-full rounded-lg overflow-hidden border-2 border-gray-700">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.3836737054257!2d108.5323918!3d-6.722950699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee3ab93f8c993%3A0x3c7d185eb9e3a7a8!2sPangkas%20Rambut%20Berintan!5e0!3m2!1sid!2sid!4v1752650443957!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div id="kontak" class="bg-gray-800 p-8 rounded-lg border border-gray-700">
                            <h3 class="text-2xl font-bold text-white">Pangkas Rambut Berintan</h3>
                            <p class="mt-4 text-gray-300"><b>Jl. Cideng Jaya Cideng, Kertawinangun</b>, Kec. Kedawung,<br>Kabupaten Cirebon, Jawa Barat</p>
                            <div class="mt-6"><h4 class="text-lg font-semibold text-white">Jam Buka:</h4><p class="text-gray-300">Senin - Minggu: 09:00 - 21:00</p></div>
                            <div class="mt-6"><h4 class="text-lg font-semibold text-white">Booking via WhatsApp:</h4><a href="https://wa.me/089518887402" target="_blank" class="text-yellow-400 hover:text-yellow-300 text-lg transition-colors duration-300">+62 89518887402</a></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 border-t border-gray-700">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-gray-400">
                <p>&copy; 2025 Pangkas Rambut Berintan.</p>
            </div>
        </footer>
    </div>

    <!-- Modals & Notifications Container -->
    <div id="modal-container"></div>
    <div id="notification-container" class="fixed top-5 right-5 z-[100] w-full max-w-xs"></div>

<script>
    let layananList = [];

    const timeSlots = ["10:00", "11:00", "12:00", "14:00", "15:00", "16:00", "17:00", "19:00", "20:00"];


    let bookingState = {};
    let authState = {
        currentUser: null 
    };
    let calendarDate = new Date();
    
    // --- DOM ELEMENTS ---
    const modalContainer = document.getElementById('modal-container');

    // --- UTILITY & NOTIFICATION FUNCTIONS ---
    const formatCurrency = (amount) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);

    function showNotification(message, isSuccess = false) {
        const notificationContainer = document.getElementById('notification-container');
        const notifId = `notif-${Date.now()}`;
        const bgColor = isSuccess ? 'bg-green-500' : 'bg-yellow-500';
        const icon = isSuccess ? '<i class="fas fa-check-circle mr-2"></i>' : '<i class="fas fa-exclamation-circle mr-2"></i>';

        const notificationHTML = `
            <div id="${notifId}" class="flex items-center px-4 py-3 mb-2 rounded-lg text-white ${bgColor} shadow-lg animate-fade-in-right text-sm">
                ${icon}
                <p>${message}</p>
            </div>
        `;
        
        notificationContainer.insertAdjacentHTML('beforeend', notificationHTML);

        setTimeout(() => {
            const notifEl = document.getElementById(notifId);
            if (notifEl) {
                notifEl.classList.add('animate-fade-out');
                notifEl.addEventListener('animationend', () => notifEl.remove());
            }
        }, 3000);
    }

    // --- AUTHENTICATION LOGIC ---
    function openAuthModal() {
        const authModalHTML = `
            <div id="auth-modal" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
                <div class="bg-gray-800 rounded-lg shadow-2xl w-full max-w-md relative">
                    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white text-2xl">&times;</button>
                    <div class="flex border-b border-gray-700">
                        <button id="login-tab-btn" onclick="switchAuthTab('login')" class="w-1/2 p-4 font-semibold text-white border-b-2 border-yellow-400">Login</button>
                        <button id="register-tab-btn" onclick="switchAuthTab('register')" class="w-1/2 p-4 font-semibold text-gray-500 border-b-2 border-transparent">Register</button>
                    </div>
                    <div class="p-8">
                        <!-- Login Form -->
                        <form id="login-form" onsubmit="handleLogin(event)">
                            <div class="space-y-4">
                                <input type="email" name="email" placeholder="Email" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white focus:ring-yellow-400 focus:border-yellow-400" required>
                                <input type="password" name="password" placeholder="Password" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white focus:ring-yellow-400 focus:border-yellow-400" required>
                            </div>
                            <button type="submit" class="w-full mt-6 bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-bold py-3 px-4 rounded-md transition-colors duration-300">Login</button>
                        </form>
                        <!-- Register Form -->
                        <form id="register-form" class="hidden" onsubmit="handleRegister(event)">
                            <div class="space-y-4">
                                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white" required>
                                <input type="email" name="email" placeholder="Email" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white" required>
                                <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white" required>
                                <input type="password" name="password" placeholder="Password" class="w-full bg-gray-700 border-gray-600 rounded-md p-3 text-white" required>
                            </div>
                            <button type="submit" class="w-full mt-6 bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-bold py-3 px-4 rounded-md">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        `;
        modalContainer.innerHTML = authModalHTML;
        document.body.classList.add('modal-open');
    }

    function switchAuthTab(tab) {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const loginTabBtn = document.getElementById('login-tab-btn');
        const registerTabBtn = document.getElementById('register-tab-btn');

        if (tab === 'login') {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginTabBtn.classList.add('text-white', 'border-yellow-400');
            loginTabBtn.classList.remove('text-gray-500', 'border-transparent');
            registerTabBtn.classList.add('text-gray-500', 'border-transparent');
            registerTabBtn.classList.remove('text-white', 'border-yellow-400');
        } else {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            registerTabBtn.classList.add('text-white', 'border-yellow-400');
            registerTabBtn.classList.remove('text-gray-500', 'border-transparent');
            loginTabBtn.classList.add('text-gray-500', 'border-transparent');
            loginTabBtn.classList.remove('text-white', 'border-yellow-400');
        }
    }

    function handleLogin(event) {
        event.preventDefault();

        const formData = {
            email: event.target.email.value,
            password: event.target.password.value
        };

        fetch("Fungsi/login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
        console.log("DATA LOGIN:", data);
        if (data.success) {
            if (data.role === 'admin') {
                window.location.href = "admin.php";
            } else {
authState.currentUser = data.user;
localStorage.setItem("currentUser", JSON.stringify(data.user));
updateAuthUI();
closeModal();
showNotification(`Selamat datang kembali, ${data.user.nama_lengkap}`, true);

            }
        } else {
                showNotification(data.message);
            }
        })
        .catch(err => {
            console.error("Login error:", err);
            showNotification("Terjadi kesalahan saat login.");
        });
    }

    function startBookingPolling() {
    let notifiedBookingIds = new Set();

    setInterval(() => {
        if (!authState.currentUser) return;

        fetch("Fungsi/get_all_data.php")
            .then(res => res.json())
            .then(res => {
                const bookings = res.data.booking.filter(b => 
                    b.id_pelanggan == authState.currentUser.id_pelanggan && 
                    b.status === 'Approved' && 
                    !notifiedBookingIds.has(b.id_booking)
                );

                bookings.forEach(b => {
                    showNotification(`Booking untuk ${b.waktu_booking} telah disetujui!`, true);
                    notifiedBookingIds.add(b.id_booking);
                });
            });
    }, 10000); // cek setiap 10 detik
}


    function renderBookingHistory() {
    fetch("Fungsi/get_all_data.php")
        .then(res => res.json())
        .then(res => {
            if (!res.success) {
                showNotification("Gagal memuat data booking.");
                return;
            }

            const bookings = res.data.booking.filter(b => b.id_pelanggan == authState.currentUser.id_pelanggan);
            let html = `<div class="space-y-4">`;

            if (bookings.length === 0) {
                html += `<p class="text-gray-300">Belum ada riwayat booking.</p>`;
            } else {
                bookings.forEach(b => {
                    const waktu = new Date(b.waktu_booking);
                    const bisaCancel = b.status === 'Pending' && (waktu - new Date() > 3600000);
                    const formatted = waktu.toLocaleString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit' });

                    html += `
                        <div class="p-4 border rounded bg-gray-800">
                            <p><strong>Layanan:</strong> ${b.nama_layanan || 'Lihat admin'}</p>
                            <p><strong>Waktu:</strong> ${formatted}</p>
                            <p><strong>Status:</strong> ${b.status}</p>
                            ${bisaCancel ? `<button onclick="cancelBooking(${b.id_booking})" class="mt-2 bg-red-500 hover:bg-red-400 px-3 py-1 rounded text-white text-sm">Batal</button>` : ''}
                        </div>`;
                });
            }

            html += `</div>`;
            modalContainer.innerHTML = `
                <div class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
                    <div class="w-full max-w-lg bg-gray-800 rounded-lg p-6 relative">
                        <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
                        <h3 class="text-xl font-bold text-white mb-4">Riwayat Booking</h3>
                        ${html}
                    </div>
                </div>`;
        });
}

function cancelBooking(id_booking, byAdmin = false) {
    fetch("Fungsi/cancel_booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_booking, by_admin: byAdmin })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showNotification("✅ Booking berhasil dibatalkan", true);
            
            // Tutup modal jika sedang terbuka
            if (typeof closeModal === "function") {
                closeModal();
            }

            // Refresh riwayat jika fungsi tersedia
            if (typeof openRiwayat === "function") {
                openRiwayat(); // ini akan tampilkan ulang riwayat dengan data terbaru
            }

            // Jika ada variabel frontend lokal (misal db.booking), kamu bisa update langsung:
            if (typeof db !== "undefined" && db.booking) {
                const item = db.booking.find(b => b.id_booking == id_booking);
                if (item) item.status = "Cancelled";
            }

        } else {
            // Tampilkan pesan error dari server
            showNotification("❌ " + data.message);
        }
    })
    .catch(err => {
        console.error("Gagal membatalkan booking:", err);
        showNotification("❌ Terjadi kesalahan saat membatalkan booking.");
    });
}



    function handleRegister(event) {
        event.preventDefault();

        const formData = {
            nama_lengkap: event.target.nama_lengkap.value,
            email: event.target.email.value,
            nomor_telepon: event.target.nomor_telepon.value,
            password: event.target.password.value
        };

        fetch("Fungsi/register.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showNotification('Registrasi berhasil!', true);
                authState.currentUser = {
                    id_pelanggan: data.id_pelanggan,
                    ...formData
                };
                updateAuthUI();
                closeModal();
            } else {
                showNotification(data.message);
            }
        });
    }

    
function handleLogout() {
    authState.currentUser = null;
    localStorage.removeItem("currentUser"); 
    updateAuthUI();
    showNotification('Anda telah berhasil logout.', true);
}

function updateAuthUI() {
    const authDesktop = document.getElementById('auth-section-desktop');
    const authMobile = document.getElementById('auth-section-mobile');

    if (authState.currentUser) {
        const userName = authState.currentUser.nama_lengkap.split(' ')[0];

        // Desktop login state
        authDesktop.innerHTML = `
            <span class="text-white">Hi, ${userName}</span>
            <div class="relative">
                <button onclick="openRiwayat()" class="text-gray-300 hover:text-yellow-400" title="Riwayat">
                    <i class="fas fa-clock-rotate-left"></i>
                </button>
                <span id="booking-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full hidden">!</span>
            </div>
            <button onclick="handleLogout()" class="text-gray-300 hover:text-yellow-400" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
        `;

        // Mobile login state
        authMobile.innerHTML = `
            <div class="relative">
                <button onclick="openRiwayat()" class="text-gray-300 hover:text-yellow-400" title="Riwayat">
                    <i class="fas fa-clock-rotate-left"></i>
                </button>
                <span id="booking-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full hidden">!</span>
            </div>
            <button onclick="handleLogout()" class="text-gray-300 hover:text-yellow-400" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
        `;
    } else {
        authDesktop.innerHTML = `<button onclick="openAuthModal()" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300">Login/Register</button>`;
        authMobile.innerHTML = `<button onclick="openAuthModal()" class="text-gray-300 hover:text-yellow-400 transition-colors duration-300" title="Login/Register"><i class="fas fa-user"></i></button>`;
    }
}


function startBookingPolling() {
    if (!authState.currentUser) return;

    setInterval(() => {
        fetch(`Fungsi/get_all_data.php`)
            .then(res => res.json())
            .then(data => {
                const latest = data.booking.filter(b => b.id_pelanggan == authState.currentUser.id_pelanggan);
                const stored = JSON.parse(localStorage.getItem('lastBookingStatus') || '[]');

                let hasChange = false;

                latest.forEach(newItem => {
                    const oldItem = stored.find(b => b.id_booking == newItem.id_booking);
                    if (oldItem && oldItem.status !== newItem.status) {
                        hasChange = true;
                    }
                });

                if (hasChange) {
                    document.querySelectorAll('#booking-badge').forEach(b => b.classList.remove('hidden'));
                    showNotification('📢 Status booking Anda telah diperbarui oleh admin');
                }

                localStorage.setItem('lastBookingStatus', JSON.stringify(latest));
            });
    }, 15000); // setiap 15 detik
}

function checkBookingStatusChanges(bookingList) {
    const seenStatuses = getSeenStatuses();
    let hasChange = false;

    for (const b of bookingList) {
        if (seenStatuses[b.id_booking] && seenStatuses[b.id_booking] !== b.status) {
            hasChange = true;
            break;
        }
    }

    const riwayatBtnIcons = document.querySelectorAll('[title="Riwayat"] i');

    riwayatBtnIcons.forEach(icon => {
        const existing = icon.querySelector('.status-indicator');
        if (hasChange) {
            if (!existing) {
                const dot = document.createElement('span');
                dot.className = "status-indicator absolute -top-1 -right-1 bg-red-500 rounded-full w-2.5 h-2.5";
                icon.style.position = "relative";
                icon.appendChild(dot);
            }
        } else if (existing) {
            existing.remove();
        }
    });
}

function checkBookingBadge(allBooking) {
    if (!authState.currentUser) return;

    const userId = authState.currentUser.id_pelanggan;
    const storedStatus = JSON.parse(localStorage.getItem(`bookingStatus_${userId}`) || '{}');
    let hasChanged = false;

    for (const b of allBooking) {
        if (b.id_pelanggan == userId) {
            if (storedStatus[b.id_booking] && storedStatus[b.id_booking] !== b.status) {
                hasChanged = true;
                break;
            }
        }
    }

    // Tampilkan atau sembunyikan badge
    const badgeEl = document.getElementById('booking-badge');
    if (badgeEl) {
        badgeEl.classList.toggle('hidden', !hasChanged);
    }
}

function fetchBookedTimes(tanggal) {
    return fetch(`Fungsi/get_booked_times.php?tanggal=${tanggal}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) return data.booked_times;
            return [];
        })
        .catch(err => {
            console.error("Gagal memuat waktu booking:", err);
            return [];
        });
}

    function closeModal() {
        modalContainer.innerHTML = '';
        document.body.classList.remove('modal-open');
    }

    function openBooking() {
        if (!authState.currentUser) {
            openAuthModal();
            showNotification('Anda harus login untuk membuat booking.');
            return;
        }
    
        if (layananList.length === 0) {
            showNotification('Data layanan belum siap. Silakan tunggu beberapa detik.');
            return;
        }

        bookingState = { currentStep: 1, layanan: null, date: null, time: null };
        const bookingModalHTML = `
            <div id="booking-modal" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
                <div class="w-full max-w-5xl h-[90vh] bg-gray-800 rounded-lg flex flex-col md:flex-row shadow-2xl">
                    <div id="booking-main-content" class="w-full md:w-2/3 p-6 md:p-8 flex flex-col overflow-y-auto"></div>
                    <div class="w-full md:w-1/3 bg-gray-900 p-6 md:p-8 flex flex-col rounded-r-lg">
                        <div class="flex items-center justify-between mb-6 border-b border-gray-700 pb-4">
                            <h3 class="text-xl font-bold text-white">Ringkasan</h3>
                            <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl font-bold">&times;</button>
                        </div>
                        <div id="summary-content" class="space-y-4 text-gray-300"></div>
                        <div class="mt-auto border-t border-gray-700 pt-4">
                            <div class="flex justify-between items-center font-bold text-lg text-white">
                                <span>Total</span>
                                <span id="summary-total-price">Rp 0</span>
                            </div>
                            <p class="text-xs text-white-500 mt-4">Pembayaran akan dilakukan di lokasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        modalContainer.innerHTML = bookingModalHTML;
        document.body.classList.add('modal-open');
        renderBookingStep();
    }

function openRiwayat() {
    if (!authState.currentUser) {
        openAuthModal();
        showNotification("Login dulu untuk melihat riwayat booking.");
        return;
    }

    // Hilangkan badge merah di ikon setelah dibuka
    document.querySelectorAll('#booking-badge').forEach(b => b.classList.add('hidden'));

    fetch("Fungsi/get_all_data.php")
        .then(res => res.json())
        .then(data => {
            const allBooking = data.data.booking;
            const userId = authState.currentUser.id_pelanggan;
            const riwayat = allBooking
                .filter(b => b.id_pelanggan == userId)
                .sort((a, b) => new Date(b.waktu_booking) - new Date(a.waktu_booking));

            // Simpan status terakhir ke localStorage agar badge tidak muncul lagi
            const statusMap = {};
            riwayat.forEach(b => {
                statusMap[b.id_booking] = b.status;
            });
            localStorage.setItem(`bookingStatus_${userId}`, JSON.stringify(statusMap));

            // HTML isi modal
            const riwayatHTML = riwayat.map(b => {
                const waktu = new Date(b.waktu_booking);
                const tanggal = waktu.toLocaleDateString('id-ID', {
                    weekday: 'long', day: 'numeric', month: 'long'
                });
                const jam = waktu.toTimeString().substring(0, 5);
                const status = b.status;

                const now = new Date();
                const canCancel = ['Pending', 'Confirmed'].includes(status) && (waktu.getTime() - now.getTime()) > 3600000;

                return `
                    <div class="p-4 border rounded-lg bg-gray-700 mb-3">
                        <p><b>Tanggal:</b> ${tanggal}, ${jam}</p>
                        <p><b>Status:</b> ${status}</p>
                        ${canCancel ? `<button onclick="cancelBooking(${b.id_booking})" class="mt-2 text-sm bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white">Batalkan</button>` : ""}
                    </div>
                `;
            }).join('');

            modalContainer.innerHTML = `
                <div class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
                    <div class="w-full max-w-2xl h-[80vh] bg-gray-800 rounded-lg shadow-2xl overflow-y-auto p-6 relative">
                        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white text-2xl">&times;</button>
                        <h2 class="text-2xl font-bold text-white mb-6">Riwayat Booking Anda</h2>
                        ${riwayat.length ? riwayatHTML : '<p class="text-gray-300">Belum ada booking.</p>'}
                    </div>
                </div>
            `;
            document.body.classList.add("modal-open");
        })
        .catch(() => {
            showNotification("Gagal memuat riwayat booking.");
        });
}


    function cancelBooking(id_booking) {
    if (!confirm("Apakah Anda yakin ingin membatalkan booking ini?")) return;

    fetch("Fungsi/cancel_booking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_booking })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showNotification("Booking berhasil dibatalkan.", true);
            openRiwayat(); // refresh
        } else {
            showNotification("Gagal membatalkan booking: " + data.message);
        }
    })
    .catch(err => {
        console.error("Error cancel:", err);
        showNotification("Terjadi kesalahan.");
    });
}

    function renderBookingStep() {
        const mainContent = document.getElementById('booking-main-content');
        if (!mainContent) return;
        let content = '';
        switch (bookingState.currentStep) {
            case 1: content = getServiceStepHTML(); break;
            case 2: content = getDateTimeStepHTML(); break;
            case 4: content = getConfirmationStepHTML(); break;
        }
        mainContent.innerHTML = content;
        if (bookingState.currentStep === 2) {
    renderCalendar();

            if (bookingState.date) {
                fetchBookedTimes(bookingState.date).then(bookedTimes => {
                    console.log("BOOKED TIMES FROM SERVER:", bookedTimes);
                    console.log("ALL TIMES:", timeSlots);

                    const container = document.getElementById("time-slots-container");
                    if (!container) return;
                
                    const today = new Date().toISOString().slice(0, 10); // format YYYY-MM-DD
const now = new Date();

const slots = timeSlots.map(time => {
    let disabled = bookedTimes.includes(time);

    // Jika tanggal booking adalah hari ini, dan jam sudah lewat → disabled
    if (bookingState.date === today) {
        const [hours, minutes] = time.split(':');
        const slotTime = new Date(`${bookingState.date}T${hours}:${minutes}`);
        if (slotTime <= now) disabled = true;
    }

    const classes = `time-slot cursor-pointer p-2 rounded-md border text-center 
        ${bookingState.time === time ? 'selected' : ''} 
        ${disabled ? 'disabled border-gray-700 bg-gray-700 text-gray-500 cursor-not-allowed' : 'border-gray-600 hover:bg-yellow-400 hover:text-gray-900'}`;

    const onclick = disabled ? '' : `onclick="selectTime('${time}')"`;
    return `<div class="${classes}" ${onclick}>${time}</div>`;
}).join('');

                
                    container.querySelector('.grid').innerHTML = slots;
                });
            }
        }

    }

    function getServiceStepHTML() {
    const serviceItems = layananList
        .filter(s => s.aktif == 1 || s.aktif == "1")
        .map(layanan => `
            <div id="service-${layanan.id_layanan}" onclick="selectService(${layanan.id_layanan})" class="flex justify-between items-center p-4 bg-gray-700 rounded-lg border-2 ${bookingState.layanan?.id_layanan == layanan.id_layanan ? 'border-yellow-400 bg-gray-600' : 'border-transparent'} cursor-pointer hover:border-yellow-400 transition-all duration-200">
                <div>
                    <h4 class="font-bold text-white">${layanan.nama_layanan}</h4>
                    <p class="text-sm text-gray-400">${layanan.durasi_menit} menit</p>
                </div>
                <span class="font-bold text-lg text-white">${formatCurrency(layanan.harga)}</span>
            </div>`).join('');

        return `
            <div class="flex flex-col h-full">
                <h2 class="text-2xl font-bold text-white mb-6">Pilih Layanan</h2>
                <div class="space-y-4">${serviceItems}</div>
                <div class="mt-auto pt-6">
                    <button onclick="goToStep(2)" class="w-full bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-bold py-3 px-4 rounded-md disabled:bg-gray-600 disabled:cursor-not-allowed" ${!bookingState.layanan ? 'disabled' : ''}>Lanjutkan</button>
                </div>
            </div>`;
    }

    function getDateTimeStepHTML() {
        const slotItems = timeSlots.map(time => `
            <div onclick="selectTime('${time}')" class="time-slot cursor-pointer p-2 rounded-md border ${bookingState.time === time ? 'selected' : 'border-gray-600'} text-center">${time}</div>
        `).join('');

        return `
            <div class="flex flex-col h-full">
                <div>
                    <button onclick="goToStep(1)" class="text-yellow-400 hover:text-yellow-300 mb-4"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Layanan</button>
                    <h2 class="text-2xl font-bold text-white mb-2">Pilih Tanggal & Waktu</h2>
                    <p class="text-gray-400 mb-6">Timezone: Asia/Jakarta</p>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <div class="flex items-center justify-between mb-4">
                            <button onclick="changeMonth(-1)" class="px-3 py-1 rounded-md bg-gray-700 hover:bg-gray-600"><i class="fas fa-chevron-left"></i></button>
                            <h3 id="month-year" class="text-lg font-semibold text-white"></h3>
                            <button onclick="changeMonth(1)" class="px-3 py-1 rounded-md bg-gray-700 hover:bg-gray-600"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div id="calendar-grid" class="grid grid-cols-7 gap-1 text-center"></div>
                    </div>
                    <div id="time-slots-container" class="mt-6 ${!bookingState.date ? 'hidden' : ''}">
                        <h3 class="text-lg font-semibold text-white mb-4">Pilih Waktu Tersedia</h3>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">${slotItems}</div>
                    </div>
                </div>
                <div class="mt-auto pt-6">
                    <button onclick="handleDateTimeContinue()" class="w-full bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-bold py-3 px-4 rounded-md disabled:bg-gray-600 disabled:cursor-not-allowed" ${!bookingState.date || !bookingState.time ? 'disabled' : ''}>Konfirmasi & Booking</button>
                </div>
            </div>`;
    }

    
    function getConfirmationStepHTML() {
        const customerName = bookingState.customer?.nama_lengkap || 'Pelanggan';
        return `
            <div class="text-center flex flex-col justify-center items-center h-full">
                <div class="w-24 h-24 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-5xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-white mb-4">Booking Berhasil!</h2>
                <p class="text-gray-300 max-w-md mx-auto">Terima kasih, ${customerName}! Detail pemesanan telah kami simpan. Kami tunggu kedatangan Anda.</p>
                <button onclick="closeModal()" class="mt-8 bg-yellow-400 text-gray-900 hover:bg-yellow-300 font-semibold px-6 py-3 rounded-md">Selesai</button>
            </div>`;
    }

    function goToStep(step) {
        bookingState.currentStep = step;
        renderBookingStep();
        updateSummary();
    }
    
    function handleDateTimeContinue() {
        bookingState.customer = authState.currentUser;

        const bookingData = {
            id_pelanggan: authState.currentUser.id_pelanggan,
            id_layanan: bookingState.layanan.id_layanan,
            waktu_booking: `${bookingState.date}T${bookingState.time}`,
            harga_total: bookingState.layanan.harga,
            catatan: ''
        };

        fetch("Fungsi/create_booking.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(bookingData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                goToStep(4);
            } else {
                showNotification("Booking gagal: " + data.message);
            }
        })
        .catch(err => {
            console.error("Error saat booking:", err);
            showNotification("Terjadi kesalahan saat booking.");
        });
    }

    function selectService(layananId) {
        bookingState.layanan = layananList.find(l => l.id_layanan == layananId);
        renderBookingStep();
        updateSummary();
    }
    
    function changeMonth(change) {
        calendarDate.setMonth(calendarDate.getMonth() + change);
        renderCalendar();
    }

    function renderCalendar() {
        const calendarGrid = document.getElementById('calendar-grid');
        const monthYearEl = document.getElementById('month-year');
        if (!calendarGrid || !monthYearEl) return;

        const month = calendarDate.getMonth();
        const year = calendarDate.getFullYear();
        monthYearEl.textContent = `${calendarDate.toLocaleString('id-ID', { month: 'long' })} ${year}`;
        calendarGrid.innerHTML = '';

        const dayHeaders = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        dayHeaders.forEach(day => calendarGrid.innerHTML += `<div class="font-semibold text-xs text-gray-400">${day}</div>`);
        
        const firstDay = new Date(year, month, 1).getDay();
        for (let i = 0; i < firstDay; i++) calendarGrid.innerHTML += '<div></div>';
        
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        today.setHours(0,0,0,0);

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDate = new Date(year, month, day);
            let classes = 'calendar-day p-2 rounded-full';
            let clickHandler = `onclick="selectDate('${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}')"`;

            if (dayDate < today) {
                classes += ' disabled';
                clickHandler = '';
            } else {
                classes += ' cursor-pointer';
            }

            if (bookingState.date && dayDate.toDateString() === new Date(bookingState.date).toDateString()) {
                classes += ' selected';
            }
            calendarGrid.innerHTML += `<div class="${classes}" ${clickHandler}>${day}</div>`;
        }
    }

    function selectDate(dateString) {
        bookingState.date = dateString;
        bookingState.time = null;
        renderBookingStep();
        updateSummary();
    }

    function selectTime(time) {
        bookingState.time = time;
        renderBookingStep();
        updateSummary();
    }
    
    function updateSummary() {
        const summaryContent = document.getElementById('summary-content');
        const summaryTotalPrice = document.getElementById('summary-total-price');
        if (!summaryContent || !summaryTotalPrice) return;

        let content = '';
        let total = 0;

        if (bookingState.layanan) {
            content += `
                <div>
                    <p class="font-semibold text-white">Layanan:</p>
                    <div class="flex justify-between items-center mt-1">
                        <span>${bookingState.layanan.nama_layanan}</span>
                        <span class="font-bold">${formatCurrency(bookingState.layanan.harga)}</span>
                    </div>
                    <p class="text-sm text-gray-300 mt-1">${bookingState.layanan.deskripsi || ''}</p>
                </div>`;
            total = bookingState.layanan.harga;
        }
        if (bookingState.date && bookingState.time) {
            const dateObj = new Date(bookingState.date);
            const formattedDate = dateObj.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long' });
            content += `
                <div>
                    <p class="font-semibold text-white">Jadwal:</p>
                    <p class="mt-1">${formattedDate}, ${bookingState.time}</p>
                </div>`;
        }
        summaryContent.innerHTML = content;
        summaryTotalPrice.textContent = formatCurrency(total);
    }

    function renderMainPageServices() {
        fetch("Fungsi/get_layanan.php")
            .then(res => res.json())
            .then(data => {
                layananList = data; 
                const layananContainer = document.getElementById('layanan-list-main');
                layananContainer.innerHTML = data.map(layanan => `
                    <div class="bg-gray-800 rounded-lg p-8 border border-gray-700 transform hover:-translate-y-2 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-white">${layanan.nama_layanan}</h3>
                        <p class="mt-2 text-gray-400">${layanan.deskripsi}</p>
                        <p class="mt-4 text-2xl font-bold text-yellow-400">${formatCurrency(layanan.harga)}</p>
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error("Gagal memuat layanan:", error);
                showNotification("Gagal memuat data layanan.");
            });
    }

    // Initial UI update on page load
document.addEventListener('DOMContentLoaded', () => {
    const storedUser = localStorage.getItem("currentUser");
    if (storedUser) {
        authState.currentUser = JSON.parse(storedUser);
    }
    updateAuthUI();
    renderMainPageServices();
    startBookingPolling();
});

</script>
</body>
</html>
