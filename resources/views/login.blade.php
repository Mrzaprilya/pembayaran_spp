<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login SPPay</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        maroonDark: '#5C0D0D',
        goldStrong: '#FFC700',
        grayStrong: '#374151'
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif']
      }
    }
  }
}
</script>
</head>

<body class="min-h-screen flex items-center justify-center font-poppins bg-gray-50">

<div class="w-full max-w-2xl flex flex-col md:flex-row bg-white rounded-2xl shadow-xl overflow-hidden">

  <!-- LEFT -->
  <div class="md:w-1/2 flex items-center justify-center bg-gradient-to-tr from-maroonDark via-goldStrong to-maroonDark p-6">
    <div class="text-white text-center">
      <h1 class="text-3xl font-extrabold mb-2">Welcome Back!</h1>
      <p class="text-sm opacity-90">Secure SPP Payment System</p>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="md:w-1/2 p-6 flex flex-col justify-center">

    <h2 class="text-xl font-bold text-maroonDark mb-1">Login</h2>
    <p class="text-grayStrong text-sm mb-4">Please login to your account</p>

    
    <!-- ROLE SWITCH -->
    <div class="relative flex bg-gray-200 rounded-lg p-1 mb-4">
      <span id="slider"
        class="absolute top-1 left-1 w-1/2 h-[calc(100%-8px)] bg-goldStrong rounded-md transition-all duration-300">
      </span>

      <button type="button" onclick="setRole('petugas')" id="btnPetugas"
        class="relative w-1/2 py-2 text-sm font-semibold text-black z-10">
        Petugas
      </button>

      <button type="button" onclick="setRole('siswa')" id="btnSiswa"
        class="relative w-1/2 py-2 text-sm font-semibold text-grayStrong z-10">
        Siswa
      </button>
    </div>

    <!-- FORM -->
    <form action="{{ route('doLogin') }}" method="POST" onsubmit="return validateForm()" class="space-y-4">
      @csrf
      <input type="hidden" name="role" id="role" value="petugas">

      <!-- LOGIN -->
      <div>
        <label id="labelLogin" class="block text-sm font-medium text-grayStrong mb-1">
          Username
        </label>
        <input type="text" name="login" id="loginInput"
          class="w-full border border-grayStrong rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-goldStrong focus:outline-none @error('login') border-red-500 @enderror"
          placeholder="Masukkan username">
        <p id="loginError" class="text-xs text-red-600 mt-1 hidden">
          * Username / Nama wajib diisi
        </p>
        @error('login')
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- PASSWORD -->
      <div>
        <label id="labelPassword" class="block text-sm font-medium text-grayStrong mb-1">
          Password
        </label>
        <input type="password" name="password" id="passwordInput"
          class="w-full border border-grayStrong rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-goldStrong focus:outline-none @error('password') border-red-500 @enderror"
          placeholder="Masukkan password">
        <p id="passwordError" class="text-xs text-red-600 mt-1 hidden">
          * Password / NISN wajib diisi
        </p>
        @error('password')
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- BUTTON -->
      <button type="submit"
        class="w-full py-2 rounded-lg bg-maroonDark text-goldStrong font-bold hover:bg-goldStrong hover:text-maroonDark transition">
        Login
      </button>

      <a href="{{ route('welcome') }}"
        class="block text-center text-sm font-semibold border border-grayStrong rounded-lg py-2 text-grayStrong hover:bg-gray-100">
        Kembali
      </a>
    </form>

    <p class="text-xs text-grayStrong text-center mt-4">
      © 2026 SPPay
    </p>

  </div>
</div>

<script>
function setRole(role) {
  document.getElementById('role').value = role
  const slider = document.getElementById('slider')
  const btnPetugas = document.getElementById('btnPetugas')
  const btnSiswa = document.getElementById('btnSiswa')
  const labelLogin = document.getElementById('labelLogin')
  const labelPassword = document.getElementById('labelPassword')
  const loginInput = document.getElementById('loginInput')
  const passwordInput = document.getElementById('passwordInput')

  if (role === 'siswa') {
    slider.style.left = '50%'
    btnSiswa.classList.add('text-black')
    btnPetugas.classList.remove('text-black')
    btnPetugas.classList.add('text-grayStrong')

    labelLogin.innerText = 'Nama Siswa'
    loginInput.placeholder = 'Masukkan nama siswa'
    labelPassword.innerText = 'NISN'
    passwordInput.placeholder = 'Masukkan NISN'
  } else {
    slider.style.left = '0'
    btnPetugas.classList.add('text-black')
    btnSiswa.classList.remove('text-black')
    btnSiswa.classList.add('text-grayStrong')

    labelLogin.innerText = 'Username'
    loginInput.placeholder = 'Masukkan username'
    labelPassword.innerText = 'Password'
    passwordInput.placeholder = 'Masukkan password'
  }
}

function validateForm() {
  let valid = true
  const login = document.getElementById('loginInput')
  const password = document.getElementById('passwordInput')

  if (login.value.trim() === '') {
    document.getElementById('loginError').classList.remove('hidden')
    valid = false
  } else {
    document.getElementById('loginError').classList.add('hidden')
  }

  if (password.value.trim() === '') {
    document.getElementById('passwordError').classList.remove('hidden')
    valid = false
  } else {
    document.getElementById('passwordError').classList.add('hidden')
  }

  return valid
}
</script>

</body>
</html>
