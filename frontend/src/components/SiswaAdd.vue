<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tambah Siswa Baru</h5>
        <!-- Form untuk menambah siswa baru -->
        <form @submit.prevent="addSiswa">
          <div class="row">
            <!-- Input untuk Nama Siswa -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Nama</label>
              <input type="text" class="form-control" v-model="siswa.nama" placeholder="Masukkan Nama Siswa" required />
            </div>
            <!-- Input untuk Email Siswa -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" v-model="siswa.email" placeholder="Masukkan Email Siswa" required />
            </div>
          </div>

          <div class="row">
            <!-- Input untuk No. Telepon Siswa -->
            <div class="col-md-6 mb-3">
              <label class="form-label">No. Telepon</label>
              <input type="text" class="form-control" v-model="siswa.no_telepon" placeholder="Masukkan No. Telepon Siswa" required />
            </div>
            <!-- Input untuk Tanggal Lahir Siswa -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" v-model="siswa.tanggal_lahir" required />
            </div>
          </div>

          <div class="row">
            <!-- Input untuk Alamat Siswa -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" v-model="siswa.alamat" placeholder="Masukkan Alamat Siswa" required></textarea>
            </div>
          </div>

          <div class="row">
            <!-- Input untuk Kelas Siswa -->
            <div class="col-md-12 mb-3">
              <label class="form-label">Kelas</label>
              <select class="form-select" v-model="siswa.kelas" required>
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="Reguler">Reguler</option>
                <option value="VIP">VIP</option>
              </select>
            </div>
          </div>

          <!-- Tombol Simpan dan Batalkan -->
          <div class="d-flex flex-row-reverse align-items-center bd-highlight">
            <button type="submit" class="btn btn-success btn-custom mt-0"><i class="fas fa-save"></i> Simpan</button>
            <button type="button" class="btn btn-danger btn-custom" @click="goBack"><i class="fas fa-x"></i> Batalkan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  data() {
    return {
      siswa: {
        nama: '',
        email: '',
        no_telepon: '',
        alamat: '',
        tanggal_lahir: '',
        kelas: ''
      }
    }
  },
  methods: {
    // Fungsi untuk menambahkan siswa baru melalui API
    addSiswa() {
      api
        .post('/siswa', this.siswa)
        .then(() => {
          this.$router.push('/siswa')
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat menambahkan siswa:', error)
        })
    },
    // Fungsi untuk kembali ke halaman sebelumnya
    goBack() {
      this.$router.push('/siswa')
    }
  }
}
</script>
