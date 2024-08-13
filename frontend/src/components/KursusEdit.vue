<template>
  <div class="scrollable-content">
    <h2 class="mb-4">Edit Kursus</h2>
    <!-- Form untuk mengedit kursus yang sudah ada -->
    <form @submit.prevent="updateKursus">
      <!-- Grid layout untuk Nama Kursus dan Deskripsi bersebelahan -->
      <div class="row mb-2">
        <!-- Input untuk Nama Kursus -->
        <div class="col-md-6">
          <label for="namaKursus" class="form-label">Nama Kursus</label>
          <input
            type="text"
            class="form-control"
            id="namaKursus"
            v-model="kursus.nama_kursus"
            required
            placeholder="Masukkan nama kursus"
          />
        </div>
        <!-- Input untuk Deskripsi Kursus -->
        <div class="col-md-6">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea
            class="form-control"
            id="deskripsi"
            v-model="kursus.deskripsi"
            required
            placeholder="Masukkan deskripsi kursus"
          ></textarea>
        </div>
      </div>

      <!-- Grid layout untuk Hari, Jam Mulai, dan Jam Selesai bersebelahan -->
      <div class="row mb-2">
        <!-- Pilihan Hari -->
        <div class="col-md-6">
          <label class="form-label">Hari</label>
          <div>
            <div class="form-check form-check-inline" v-for="hari in hariList" :key="hari">
              <input
                class="form-check-input"
                type="checkbox"
                :id="hari"
                :value="hari"
                v-model="kursus.hari"
              />
              <label class="form-check-label" :for="hari">{{ hari }}</label>
            </div>
          </div>
        </div>
        <!-- Input untuk Jam Mulai -->
        <div class="col-md-3">
          <label for="jamMulai" class="form-label">Jam Mulai</label>
          <input
            type="time"
            class="form-control"
            id="jamMulai"
            v-model="kursus.jam_mulai"
            required
            @change="calculateDuration"
          />
        </div>
        <!-- Input untuk Jam Selesai -->
        <div class="col-md-3">
          <label for="jamSelesai" class="form-label">Jam Selesai</label>
          <input
            type="time"
            class="form-control"
            id="jamSelesai"
            v-model="kursus.jam_selesai"
            required
            @change="calculateDuration"
          />
        </div>
      </div>

      <!-- Input untuk Durasi -->
      <div class="mb-2">
        <label for="durasi" class="form-label">Durasi (jam)</label>
        <input
          type="number"
          class="form-control"
          id="durasi"
          v-model="kursus.durasi"
          readonly
        />
      </div>

      <!-- Input untuk Instruktur -->
      <div class="mb-2">
        <label for="instruktur" class="form-label">Instruktur</label>
        <input
          type="text"
          class="form-control"
          id="instruktur"
          v-model="kursus.instruktur"
          required
          placeholder="Masukkan nama instruktur"
        />
      </div>

      <!-- Tombol Simpan dan Batalkan -->
      <div class="d-flex flex-row-reverse align-items-center bd-highlight">
        <button type="submit" class="btn btn-success btn-custom mt-0">
          <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <button type="button" class="btn btn-danger btn-custom" @click="goBack">
          <i class="fas fa-x"></i> Batalkan
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import api from '../services/api'

export default {
  data() {
    return {
      kursus: {
        nama_kursus: '',
        deskripsi: '',
        hari: [],
        jam_mulai: '',
        jam_selesai: '',
        durasi: '',
        instruktur: ''
      },
      hariList: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] // Daftar hari untuk dipilih
    }
  },
  methods: {
    // Method untuk mengambil data kursus berdasarkan ID
    fetchKursus(id) {
      api
        .get(`/kursus/${id}`)
        .then((response) => {
          this.kursus = response.data;

          // Memastikan format waktu selalu dalam HH:MM:SS
          this.kursus.jam_mulai = this.formatTime(this.kursus.jam_mulai);
          this.kursus.jam_selesai = this.formatTime(this.kursus.jam_selesai);
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat mengambil data kursus:', error);
        })
    },

    // Method untuk memperbarui data kursus
    updateKursus() {
      // Validasi waktu agar jam mulai tidak lebih dari jam selesai
      if (!this.validateTime()) {
        alert('Jam mulai tidak boleh lebih dari jam selesai');
        return;
      }

      // Format waktu ke dalam format HH:MM:SS sebelum dikirim ke server
      this.kursus.jam_mulai = this.formatTime(this.kursus.jam_mulai);
      this.kursus.jam_selesai = this.formatTime(this.kursus.jam_selesai);

      // Mengirim data kursus yang telah diperbarui ke server
      api
        .put(`/kursus/${this.kursus.id}`, this.kursus)
        .then(() => {
          alert('Kursus berhasil diperbarui!');
          this.$router.push('/kursus'); // Navigasi kembali ke halaman daftar kursus setelah berhasil
        })
        .catch((error) => {
          console.error('Terjadi kesalahan saat memperbarui kursus:', error);
        });
    },

    // Method untuk menghitung durasi kursus berdasarkan jam mulai dan jam selesai
    calculateDuration() {
      if (this.kursus.jam_mulai && this.kursus.jam_selesai) {
        const jamMulai = new Date(`1970-01-01T${this.kursus.jam_mulai}:00`);
        const jamSelesai = new Date(`1970-01-01T${this.kursus.jam_selesai}:00`);

        // Jika jam mulai lebih besar atau sama dengan jam selesai, durasi menjadi 0
        if (jamMulai >= jamSelesai) {
          this.kursus.durasi = 0;
          return;
        }

        // Menghitung selisih waktu dalam milidetik dan konversi ke jam
        const diffInMs = jamSelesai - jamMulai;
        const diffInHours = diffInMs / (1000 * 60 * 60);
        this.kursus.durasi = diffInHours;
      }
    },

    // Validasi apakah jam mulai lebih kecil dari jam selesai
    validateTime() {
      const jamMulai = new Date(`1970-01-01T${this.kursus.jam_mulai}:00`);
      const jamSelesai = new Date(`1970-01-01T${this.kursus.jam_selesai}:00`);
      return jamMulai < jamSelesai;
    },

    // Method untuk memformat waktu menjadi format HH:MM:SS
    formatTime(time) {
      if (time.length === 5) { // Jika format HH:MM, tambahkan detik
        return time + ':00';
      }
      return time;
    },

    // Method untuk kembali ke halaman daftar kursus
    goBack() {
      this.$router.push('/kursus');
    }
  },
  mounted() {
    // Mengambil data kursus saat komponen dipasang berdasarkan ID dari route
    const id = this.$route.params.id;
    this.fetchKursus(id);
  }
}
</script>
