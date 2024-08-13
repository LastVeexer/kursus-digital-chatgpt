import { createRouter, createWebHistory } from 'vue-router'

// Import komponen untuk setiap rute
import Home from '../components/Home.vue'
import SiswaList from '../components/SiswaList.vue'
import SiswaAdd from '../components/SiswaAdd.vue'
import SiswaEdit from '../components/SiswaEdit.vue'
import KursusList from '../components/KursusList.vue'
import KursusAdd from '../components/KursusAdd.vue'
import KursusEdit from '../components/KursusEdit.vue'
import PendaftaranList from '../components/PendaftaranList.vue'
import PendaftaranAdd from '../components/PendaftaranAdd.vue'
import PendaftaranEdit from '../components/PendaftaranEdit.vue'

// Definisi rute-rute dalam aplikasi
const routes = [
  { 
    path: '/',  // Rute ke halaman beranda
    component: Home 
  },
  { 
    path: '/siswa',  // Rute ke daftar siswa
    component: SiswaList 
  },
  { 
    path: '/siswa/add',  // Rute untuk menambahkan siswa baru
    component: SiswaAdd 
  },
  { 
    path: '/siswa/edit/:id',  // Rute untuk mengedit data siswa berdasarkan ID
    component: SiswaEdit 
  },
  { 
    path: '/kursus',  // Rute ke daftar kursus
    component: KursusList 
  },
  { 
    path: '/kursus/add',  // Rute untuk menambahkan kursus baru
    component: KursusAdd 
  },
  { 
    path: '/kursus/edit/:id',  // Rute untuk mengedit data kursus berdasarkan ID
    component: KursusEdit 
  },
  { 
    path: '/pendaftaran',  // Rute ke daftar pendaftaran
    component: PendaftaranList 
  },
  { 
    path: '/pendaftaran/add',  // Rute untuk menambahkan pendaftaran baru
    component: PendaftaranAdd 
  },
  { 
    path: '/pendaftaran/edit/:id',  // Rute untuk mengedit data pendaftaran berdasarkan ID
    component: PendaftaranEdit 
  }
]

// Membuat instance router dengan mode history dan rute yang telah didefinisikan
const router = createRouter({
  history: createWebHistory(),  // Menggunakan HTML5 history mode
  routes  // Menggunakan daftar rute yang telah didefinisikan
})

// Mengekspor router agar bisa digunakan di aplikasi utama
export default router
