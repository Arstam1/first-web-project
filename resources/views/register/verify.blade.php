<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #ffb4b4ad;
    }
    .card {
      border: none;
      border-radius: 20px;
    }
    .otp-input {
      width: 50px;
      height: 50px;
      text-align: center;
      font-size: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    .otp-input:focus {
      outline: none;
      border-color: # royalblue; /* warna border saat fokus */
    }
    @media (max-width: 768px) {
      .otp-card {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 otp-card">
      <h4 class="text-center mb-4">OTP Verification</h4>
      <p> Kami telah mengirimkan kode verifikasi pada email anda</p>
      <form method="POST" action="/verify">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="otp" class="form-label">Enter OTP</label>
          <div class="d-flex justify-content-center gap-2">
            <input type="text" class="otp-input" maxlength="1" name="otp[]" required> <input type="text" class="otp-input" maxlength="1" name="otp[]" required>
            <input type="text" class="otp-input" maxlength="1" name="otp[]" required>
            <input type="text" class="otp-input" maxlength="1" name="otp[]" required>
            <input type="text" class="otp-input" maxlength="1" name="otp[]" required>
            <input type="text" class="otp-input" maxlength="1" name="otp[]" required>
          </div>
        </div>
        <button type="submit" class="btn btn-warning w-100">Confirm</button>
      </form>
    </div>
  </div>
  <script>
    const otpInputs = document.querySelectorAll('.otp-input');
    for (let i = 0; i < otpInputs.length; i++) {
      otpInputs[i].addEventListener('input', function() {
        if (this.value.length === 1) {
          // pindah ke input selanjutnya
          otpInputs[i + 1].focus();
        }
      });
    }
  </script>
</body>
</html>