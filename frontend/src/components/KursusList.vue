<template>
  <div class="container">
    <!-- Bagian header dengan judul halaman dan tombol tambah kursus -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-4">Daftar Kursus</h2>
      <button class="btn btn-success" @click="goToTambahKursus">
        <i class="fas fa-plus"></i> Tambah Kursus
      </button>
    </div>

    <!-- Bagian pencarian kursus berdasarkan nama atau deskripsi -->
    <div class="mb-3">
      <form class="d-flex" id="search-form">
        <input v-model="searchQuery" class="form-control me-2" type="search" placeholder="Cari Kursus"
          aria-label="Search" id="search-input" />
        <button class="btn btn-outline-primary" type="button" @click="filterKursus">
          Cari
        </button>
      </form>
    </div>

    <!-- Bagian filter hari dan jam -->
    <div class="mb-3">
      <form id="filter-form" class="d-flex align-items-end">
        <div class="me-2">
          <label for="filter-hari" class="form-label">Filter Hari</label>
          <select class="form-select" id="filter-hari" v-model="selectedHari" style="width: auto">
            <option value="">Semua Hari</option>
            <option v-for="hari in hariList" :key="hari" :value="hari">{{ hari }}</option>
          </select>
        </div>
        <div class="me-2">
          <label for="filter-jam" class="form-label">Filter Jam</label>
          <select class="form-select" id="filter-jam" v-model="selectedJam" style="width: auto">
            <option value="">Semua Jam</option>
            <option v-for="jam in jamList" :key="jam" :value="jam">{{ jam }}</option>
          </select>
        </div>
        <button class="btn btn-primary" type="button" @click="filterKursus">
          Terapkan Filter
        </button>
      </form>
    </div>

    <div class="custom-container">
      <div class="scrollable-content">
        <!-- Daftar kursus yang ditampilkan berdasarkan hasil pencarian dan filter -->
        <div class="row mt-2 mb-2 pr-2 pl-2">
          <!-- Menampilkan daftar kursus -->
          <div class="col-md-6 mb-3 col-lg-4" v-for="kursus in filteredKursusList" :key="kursus.id">
            <div class="card h-100 mb-2">
              <div class="card-body">
                <!-- Nama kursus dan deskripsi -->
                <h5 class="card-title">
                  {{ kursus.nama_kursus }}
                </h5>
                <p class="card-text">
                  {{ kursus.deskripsi }}
                </p>
                <!-- Menampilkan hari dan jam kursus -->
                <p class="card-text">
                  <strong>Hari:</strong> {{ kursus.hari.join(', ') }} <br />
                  <strong>Jam:</strong> {{ kursus.jam_mulai }} - {{ kursus.jam_selesai }}
                </p>
                <!-- Label durasi kursus -->
                <span class="badge badge-success">
                  Durasi: {{ kursus.durasi }} jam
                </span>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <!-- Tombol untuk mengedit dan menghapus kursus -->
                <button class="btn btn-primary btn-sm" @click="editKursus(kursus.id)">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteKursus(kursus.id)">
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
      kursusList: [], // Menyimpan daftar kursus yang diambil dari server
      searchQuery: '', // Menyimpan query pencarian dari input pengguna
      selectedHari: '', // Menyimpan hari yang dipilih untuk filter
      selectedJam: '', // Menyimpan jam yang dipilih untuk filter
      filteredKursusList: [] // Menyimpan daftar kursus yang telah difilter
    }
  },
  methods: {
    // Mengambil data kursus dari server saat komponen dimuat
    fetchKursus() {
      api
        .get('/kursus')
        .then((response) => {
          this.kursusList = response.data
          this.filteredKursusList = this.kursusList
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat mengambil data kursus:', error)
        })
    },
    // Memfilter daftar kursus berdasarkan input pencarian, hari, dan jam
    filterKursus() {
      this.filteredKursusList = this.kursusList.filter((kursus) => {
        const matchesSearch =
          this.searchQuery === '' ||
          kursus.nama_kursus.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          kursus.deskripsi.toLowerCase().includes(this.searchQuery.toLowerCase())

        const matchesHari =
          this.selectedHari === '' || kursus.hari.includes(this.selectedHari)

        const matchesJam =
          this.selectedJam === '' ||
          kursus.jam_mulai === this.selectedJam ||
          kursus.jam_selesai === this.selectedJam

        return matchesSearch && matchesHari && matchesJam
      })
    },
    // Mengedit data kursus berdasarkan ID kursus
    editKursus(id) {
      this.$router.push(`/kursus/edit/${id}`)
    },
    // Menghapus data kursus berdasarkan ID kursus
    deleteKursus(id) {
      if (confirm('Apakah Anda yakin ingin menghapus kursus ini?')) {
        api
          .delete(`/kursus/${id}`)
          .then(() => {
            this.fetchKursus()
          })
          .catch((error) => {
            console.error('Terjadi kesalahan saat menghapus kursus:', error)
          })
      }
    },
    // Navigasi ke halaman tambah kursus
    goToTambahKursus() {
      this.$router.push('/kursus/add')
    }
  },
  watch: {
    // Watcher untuk searchQuery, akan memanggil filterKursus setiap kali searchQuery berubah
    searchQuery() {
      this.filterKursus()
    },
    // Watcher untuk selectedHari, akan memanggil filterKursus setiap kali selectedHari berubah
    selectedHari() {
      this.filterKursus()
    },
    // Watcher untuk selectedJam, akan memanggil filterKursus setiap kali selectedJam berubah
    selectedJam() {
      this.filterKursus()
    }
  },
  mounted() {
    // Mengambil data kursus saat komponen pertama kali dimuat
    this.fetchKursus()
  },
  computed: {
    hariList() {
      return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
    },
    jamList() {
      return [
        '08:00:00',
        '09:00:00',
        '10:00:00',
        '11:00:00',
        '12:00:00',
        '13:00:00',
        '14:00:00',
        '15:00:00',
        '16:00:00'
      ]
    }
  }
}
</script>
