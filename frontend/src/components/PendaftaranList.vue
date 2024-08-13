<template>
  <div class="container">
    <!-- Bagian header dengan judul halaman dan tombol tambah pendaftaran -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-4">Daftar Pendaftaran</h2>
      <button class="btn btn-success" @click="goToTambahPendaftaran">
        <i class="fas fa-plus"></i> Tambah Pendaftaran
      </button>
    </div>

    <!-- Bagian pencarian pendaftaran berdasarkan nama siswa atau kursus -->
    <div class="mb-3">
      <form class="d-flex" id="search-form">
        <!-- Input untuk pencarian -->
        <input 
          v-model="searchQuery" 
          class="form-control me-2" 
          type="search" 
          placeholder="Cari Pendaftaran" 
          aria-label="Search" 
          id="search-input" 
        />
        <button class="btn btn-outline-primary" type="button" @click="filterPendaftaran">
          Cari
        </button>
      </form>
    </div>

    <!-- Bagian filter status pendaftaran -->
    <div class="mb-3">
      <form id="filter-form" class="d-flex align-items-end">
        <!-- Dropdown untuk filter status -->
        <div class="me-2">
          <label for="filter-status" class="form-label">Filter Status</label>
          <select 
            class="form-select" 
            id="filter-status" 
            v-model="selectedStatus" 
            style="width: auto"
          >
            <option value="">Semua Status</option>
            <option value="Sedang Berlangsung">Sedang Berlangsung</option>
            <option value="Selesai">Selesai</option>
          </select>
        </div>
        <button class="btn btn-primary" type="button" @click="filterPendaftaran">
          Terapkan Filter
        </button>
      </form>
    </div>

    <!-- Bagian daftar pendaftaran yang ditampilkan berdasarkan hasil pencarian dan filter -->
    <div class="custom-container">
      <div class="scrollable-content">
        <div class="row mt-2 mb-2 pr-2 pl-2">
          <!-- Menampilkan daftar pendaftaran dalam bentuk kartu -->
          <div 
            class="col-md-6 mb-3 col-lg-4" 
            v-for="pendaftaran in filteredPendaftaranList" 
            :key="pendaftaran.id"
          >
            <div class="card h-100 mb-2">
              <div class="card-body">
                <!-- Nama siswa dan kursus -->
                <h5 class="card-title">
                  {{ pendaftaran.siswa.nama }} - {{ pendaftaran.kursus.nama_kursus }}
                </h5>
                <!-- Tanggal pendaftaran -->
                <p class="card-text">
                  <strong>Tanggal Pendaftaran:</strong> {{ pendaftaran.tanggal_pendaftaran }}
                </p>
                <!-- Label status pendaftaran -->
                <span 
                  class="badge" 
                  :class="pendaftaran.status === 'Sedang Berlangsung' ? 'badge-warning' : 'badge-success'"
                >
                  {{ pendaftaran.status }}
                </span>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <!-- Tombol untuk mengedit pendaftaran -->
                <button class="btn btn-primary btn-sm" @click="editPendaftaran(pendaftaran.id)">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <!-- Tombol untuk menghapus pendaftaran -->
                <button class="btn btn-danger btn-sm" @click="deletePendaftaran(pendaftaran.id)">
                  <i class="fas fa-trash-alt"></i> Hapus
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  data() {
    return {
      pendaftaranList: [], // Menyimpan daftar pendaftaran yang diambil dari server
      searchQuery: '', // Menyimpan query pencarian dari input pengguna
      selectedStatus: '', // Menyimpan status yang dipilih untuk filter
      filteredPendaftaranList: [] // Menyimpan daftar pendaftaran yang telah difilter
    }
  },
  methods: {
    // Mengambil data pendaftaran dari server saat komponen dimuat
    fetchPendaftaran() {
      api
        .get('/pendaftaran')
        .then((response) => {
          this.pendaftaranList = response.data
          this.filteredPendaftaranList = this.pendaftaranList
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat mengambil data pendaftaran:', error)
        })
    },
    // Memfilter daftar pendaftaran berdasarkan input pencarian dan status
    filterPendaftaran() {
      this.filteredPendaftaranList = this.pendaftaranList.filter((pendaftaran) => {
        // Cek apakah nama siswa atau kursus sesuai dengan query pencarian
        const matchesSearch =
          this.searchQuery === '' ||
          pendaftaran.siswa.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          pendaftaran.kursus.nama_kursus.toLowerCase().includes(this.searchQuery.toLowerCase())

        // Cek apakah status sesuai dengan filter yang dipilih
        const matchesStatus =
          this.selectedStatus === '' || pendaftaran.status === this.selectedStatus

        return matchesSearch && matchesStatus
      })
    },
    // Mengedit data pendaftaran berdasarkan ID pendaftaran
    editPendaftaran(id) {
      this.$router.push(`/pendaftaran/edit/${id}`)
    },
    // Menghapus data pendaftaran berdasarkan ID pendaftaran
    deletePendaftaran(id) {
      if (confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')) {
        api
          .delete(`/pendaftaran/${id}`)
          .then(() => {
            this.fetchPendaftaran()
          })
          .catch((error) => {
            console.error('Terjadi kesalahan saat menghapus pendaftaran:', error)
          })
      }
    },
    // Navigasi ke halaman tambah pendaftaran
    goToTambahPendaftaran() {
      this.$router.push('/pendaftaran/add')
    }
  },
  watch: {
    // Watcher untuk searchQuery, akan memanggil filterPendaftaran setiap kali searchQuery berubah
    searchQuery() {
      this.filterPendaftaran()
    },
    // Watcher untuk selectedStatus, akan memanggil filterPendaftaran setiap kali selectedStatus berubah
    selectedStatus() {
      this.filterPendaftaran()
    }
  },
  mounted() {
    // Mengambil data pendaftaran saat komponen pertama kali dimuat
    this.fetchPendaftaran()
  }
}
</script>
