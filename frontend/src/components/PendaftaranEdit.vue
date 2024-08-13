<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Pendaftaran</h5>
        <!-- Form untuk mengedit pendaftaran -->
        <form @submit.prevent="updatePendaftaran">
          <div class="row">
            <!-- Input untuk Siswa -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Siswa</label>
              <select class="form-select" v-model="pendaftaran.siswa_id" required>
                <option v-for="siswa in siswaList" :key="siswa.id" :value="siswa.id">
                  {{ siswa.nama }}
                </option>
              </select>
            </div>
            <!-- Input untuk Kursus -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Kursus</label>
              <select class="form-select" v-model="pendaftaran.kursus_id" required>
                <option v-for="kursus in kursusList" :key="kursus.id" :value="kursus.id">
                  {{ kursus.nama_kursus }}
                </option>
              </select>
            </div>
          </div>
          <div class="row">
            <!-- Input untuk Tanggal Pendaftaran -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Tanggal Pendaftaran</label>
              <input
                type="date"
                class="form-control"
                v-model="pendaftaran.tanggal_pendaftaran"
                required
              />
            </div>
            <!-- Input untuk Status Pendaftaran -->
            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <select class="form-select" v-model="pendaftaran.status" required>
                <option value="sedang berlangsung">Sedang Berlangsung</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>
          </div>
          <!-- Tombol Simpan dan Batalkan -->
          <div class="d-flex flex-row-reverse align-items-center bd-highlight">
            <button type="submit" class="btn btn-success btn-custom mt-0">
              <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <button type="button" class="btn btn-danger btn-custom" @click="goBack">
              <i class="fas fa-times"></i> Batalkan
            </button>
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
      pendaftaran: {
        siswa_id: '',
        kursus_id: '',
        tanggal_pendaftaran: '',
        status: ''
      },
      siswaList: [], // Menyimpan daftar siswa untuk dipilih
      kursusList: [] // Menyimpan daftar kursus untuk dipilih
    }
  },
  methods: {
    // Mengambil data pendaftaran berdasarkan ID
    fetchPendaftaran(id) {
      api.get(`/pendaftaran/${id}`)
        .then(response => {
          this.pendaftaran = response.data;
        })
        .catch(error => {
          console.error('Terjadi kesalahan saat mengambil data pendaftaran:', error);
        });
    },
    // Mengambil daftar siswa dari API
    fetchSiswa() {
      api.get('/siswa')
        .then(response => {
          this.siswaList = response.data;
        })
        .catch(error => {
          console.error('Terjadi kesalahan saat mengambil data siswa:', error);
        });
    },
    // Mengambil daftar kursus dari API
    fetchKursus() {
      api.get('/kursus')
        .then(response => {
          this.kursusList = response.data;
        })
        .catch(error => {
          console.error('Terjadi kesalahan saat mengambil data kursus:', error);
        });
    },
    // Mengupdate data pendaftaran melalui API
    updatePendaftaran() {
      api.put(`/pendaftaran/${this.pendaftaran.id}`, this.pendaftaran)
        .then(() => {
          this.$router.push('/pendaftaran');
        })
        .catch(error => {
          console.error('Terjadi kesalahan saat memperbarui pendaftaran:', error);
        });
    },
    // Kembali ke halaman sebelumnya
    goBack() {
      this.$router.push('/pendaftaran');
    }
  },
  mounted() {
    // Mengambil data pendaftaran, siswa, dan kursus saat komponen dipasang
    const id = this.$route.params.id;
    this.fetchPendaftaran(id);
    this.fetchSiswa();
    this.fetchKursus();
  }
}
</script>
