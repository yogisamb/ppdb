<main class="login">
  <section class="py-4">
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card card_login shadow-lg">
            <form method="POST" class="card-body p-5" action="<?= base_url('auth'); ?>">
              <h4 class="mb-12 text-center">Masuk Akun PSB</h4>
              <p class="mb-30 fs-7 text-center">
                Masukkan email dan password yang terdaftar untuk melanjutkan
                akses panelmu
              </p>
              <div class="form-outline mb-3">
                <label class="form-label form_label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form_control" required />
              </div>
              <div class="form-outline mb-4">
                <label class="form-label form_label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control form_control" />
              </div>
              <button class="d-flex btn btn-primary btn_rounded_sm w-100 justify-content-center" type="submit">
                Masuk
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>