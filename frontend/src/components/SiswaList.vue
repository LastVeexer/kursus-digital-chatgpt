<template>
  <div class="container">
    <!-- Bagian header dengan judul halaman dan tombol tambah siswa -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-4">Daftar Siswa</h2>
      <button class="btn btn-success" @click="goToTambahSiswa"><i class="fas fa-plus"></i> Tambah Siswa</button>
    </div>

    <!-- Bagian pencarian siswa berdasarkan nama -->
    <div class="mb-3">
      <form class="d-flex" id="search-form">
        <input
          v-model="searchQuery"
          class="form-control me-2"
          type="search"
          placeholder="Cari Siswa"
          aria-label="Search"
          id="search-input"
        />
        <!-- Tombol ini masih bisa digunakan untuk pencarian manual, jika diperlukan -->
        <button class="btn btn-outline-primary" type="button" @click="filterSiswa">Cari</button>
      </form>
    </div>

    <!-- Bagian filter kelas siswa -->
    <div class="mb-3">
      <!-- Dropdown Filter -->
      <form id="filter-form" class="d-flex align-items-end">
        <div class="me-2">
          <label for="filter-kelas" class="form-label">Filter Kelas</label>
          <select class="form-select" id="filter-kelas" v-model="selectedKelas" style="width: auto">
            <option value="">Semua Kelas</option>
            <option value="Reguler">Reguler</option>
            <option value="VIP">VIP</option>
          </select>
        </div>
        <button class="btn btn-primary" type="button" @click="filterSiswa">Terapkan Filter</button>
      </form>
    </div>

    <div class="custom-container">
      <div class="scrollable-content">
        <!-- Daftar siswa yang ditampilkan berdasarkan hasil pencarian dan filter -->
        <div class="row mt-2 mb-2 pr-2 pl-2">
          <!-- Menampilkan setiap siswa sebagai kartu individual -->
          <div class="col-md-6 col-lg-4" v-for="siswa in filteredSiswaList" :key="siswa.id">
            <div class="card mb-3">
              <div class="card-body">
                <!-- Menampilkan nama dan email siswa -->
                <h5 class="card-title">{{ siswa.nama }}</h5>
                <p class="card-text">{{ siswa.email }}</p>

                <!-- Menampilkan label kelas (Reguler/VIP) -->
                <p class="card-text">
                  <span v-if="siswa.kelas === 'Reguler'" class="badge bg-secondary">Reguler</span>
                  <span v-else-if="siswa.kelas === 'VIP'" class="badge bg-warning text-dark">VIP</span>
                </p>

                <!-- Tombol untuk mengedit data siswa -->
                <button class="btn btn-primary btn-sm" @click="editSiswa(siswa.id)"><i class="fas fa-edit"></i> Edit</button>
                <!-- Tombol untuk menghapus data siswa -->
                <button class="btn btn-danger btn-sm" @click="deleteSiswa(siswa.id)"><i class="fas fa-trash-alt"></i> Hapus</button>
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
      siswaList: [], // Menyimpan daftar siswa yang diambil dari server
      searchQuery: '', // Menyimpan query pencarian dari input pengguna
      selectedKelas: '', // Menyimpan kelas yang dipilih untuk filter
      filteredSiswaList: [] // Menyimpan daftar siswa yang telah difilter
    }
  },
  methods: {
    // Mengambil data siswa dari server saat komponen dimuat
    fetchSiswa() {
      api
        .get('/siswa')
        .then((response) => {
          this.siswaList = response.data
          this.filteredSiswaList = this.siswaList
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat mengambil data siswa:', error)
        })
    },
    // Memfilter daftar siswa berdasarkan input pencarian dan filter kelas
    filterSiswa() {
      this.filteredSiswaList = this.siswaList.filter((siswa) => {
        const matchesSearch =
          this.searchQuery === '' ||
          siswa.nama.toLowerCase().includes(this.searchQuery.toLowerCase())
        const matchesKelas = this.selectedKelas === '' || siswa.kelas === this.selectedKelas

        return matchesSearch && matchesKelas
      })
    },
    // Mengedit data siswa berdasarkan ID siswa
    editSiswa(id) {
      this.$router.push(`/siswa/edit/${id}`)
    },
    // Menghapus data siswa berdasarkan ID siswa
    deleteSiswa(id) {
      if (confirm('Apakah Anda yakin ingin menghapus siswa ini?')) {
        api
          .delete(`/siswa/${id}`)
          .then(() => {
            this.fetchSiswa()
          })
          .catch((error) => {
            console.error('Terjadi kesalahan saat menghapus siswa:', error)
          })
      }
    },
    // Navigasi ke halaman tambah siswa
    goToTambahSiswa() {
      this.$router.push('/siswa/add')
    }
  },
  watch: {
    // Watcher untuk searchQuery, akan memanggil filterSiswa setiap kali searchQuery berubah
    searchQuery() {
      this.filterSiswa()
    },
    // Watcher untuk selectedKelas, akan memanggil filterSiswa setiap kali selectedKelas berubah
    selectedKelas() {
      this.filterSiswa()
    }
  },
  mounted() {
    // Mengambil data siswa saat komponen pertama kali dimuat
    this.fetchSiswa()
  }
}
</script>
