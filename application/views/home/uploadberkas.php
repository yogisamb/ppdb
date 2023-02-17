<section class="my-5 container containers">
  <h2 class="text-center mb-4">Upload Daftar Ulang</h2>
  <form action="<?= base_url('welcome/uploadsemuaberkas/'); ?>" method="post" enctype="multipart/form-data">

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">Upload Files Kartu Keluarga</label>
        <div class="row">
          <div class="col-10">
            <input type="file" id="kk" name="kk" class="form-control">
          </div>
          <div class="col-2">
            <a href="#">Download File</a>
          </div>
        </div>
        <?= form_error('kk', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">Upload Files Akta Kelahiran</label>
        <div class="row">
          <div class="col-10">
            <input type="file" id="akta" name="akta" class="form-control">
          </div>
          <div class="col-2">
            <a href="#">Download File</a>
          </div>
        </div>
        <?= form_error('akta', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">Upload Files Ijazah TK</label>
        <div class="row">
          <div class="col-10">
            <input type="file" id="ijazah" name="ijazah" class="form-control">
          </div>
          <div class="col-2">
            <a href="#">Download File</a>
          </div>
        </div>
        <?= form_error('ijazah', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary btn-md text-white">Upload</button>
      </div>
    </div>
  </form>
</section>