<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <div class="container-fluid">
        <!-- Brand link ke halaman utama -->
        <router-link class="navbar-brand d-flex align-items-center" to="/">
          <!-- Gambar logo responsif -->
          <img
            src="/src/assets/logo.png"
            alt="Logo"
            class="img-fluid me-2"
            style="width: 48px; height: 48px"
          />
          <!-- Teks responsif -->
          <h1 class="fs-4">Kursus Digital ChatGPT</h1>
        </router-link>

        <!-- Tombol toggle untuk navigasi bar pada perangkat kecil -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Daftar link navigasi -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <!-- Link ke halaman Siswa dengan class active jika halaman aktif -->
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/siswa') }" to="/siswa"
                >Siswa</router-link
              >
            </li>
            <!-- Link ke halaman Kursus dengan class active jika halaman aktif -->
            <li class="nav-item">
              <router-link class="nav-link" :class="{ active: isActive('/kursus') }" to="/kursus"
                >Kursus</router-link
              >
            </li>
            <!-- Link ke halaman Data Pendaftaran dengan class active jika halaman aktif -->
            <li class="nav-item">
              <router-link
                class="nav-link"
                :class="{ active: isActive('/pendaftaran') }"
                to="/pendaftaran"
                >Data Pendaftaran</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
      <!-- Router view untuk menampilkan konten halaman berdasarkan rute -->
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    /**
     * Memeriksa apakah rute yang diberikan sama dengan rute saat ini.
     * Jika rute sama, fungsi ini mengembalikan true, yang menyebabkan
     * class "active" ditambahkan ke link navigasi terkait.
     *
     * @param {string} route - Rute yang ingin diperiksa
     * @returns {boolean} - true jika rute saat ini sama dengan rute yang diberikan
     */
    isActive(route) {
      return this.$route.path === route
    }
  }
}
</script>

<style scoped>
/* Menentukan tinggi minimum untuk container agar mengambil seluruh tinggi viewport */
.container {
  min-height: 100vh;
}

/* Menambahkan shadow di bawah navbar untuk efek depth */
.navbar {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Gaya untuk elemen brand yang berisi logo dan teks */
.navbar-brand {
  font-weight: bold;
  display: flex;
  align-items: center;
}

/* Mengatur margin dan ukuran font untuk link navigasi */
.navbar-nav .nav-link {
  margin-right: 25px;
  font-size: 1rem;
}

/* Menambahkan background-color hijau pada link yang aktif menggunakan Bootstrap's $green-400 */
.navbar-nav .nav-link.active {
  background-color: #53a653; /* Menggunakan warna hijau dari Bootstrap */
  color: white; /* Mengatur warna teks menjadi putih */
  border-radius: 5px; /* Menambahkan radius pada sudut untuk efek rounded */
}

/* Mengatur padding untuk container-fluid agar lebih proporsional */
.container-fluid {
  padding-left: 15px;
  padding-right: 15px;
}

/* Menambahkan margin top untuk konten utama */
.mt-4 {
  margin-top: 1.5rem;
}

/* Mengatur ukuran logo */
.img-fluid {
  max-width: 100%;
  height: auto;
}
</style>
