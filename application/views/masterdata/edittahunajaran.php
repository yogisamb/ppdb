<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?= $submenu ?></h4>
          <hr>
          <form action="<?= base_url('masterdata/edittahunajaran/' . $this->encryptor->enkrip('enkrip', $tahunajaran['tb_tahun_id'])); ?>" method="POST">
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Title Tahun Ajaran</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title" value="<?= $tahunajaran['tb_tahun_title']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Mulai Masa PPDB</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="awal" name="awal" value="<?= date('Y-m-d', strtotime($tahunajaran['tb_tahun_awal'])); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Akhir Masa PPDB</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="akhir" name="akhir" value="<?= date('Y-m-d', strtotime($tahunajaran['tb_tahun_akhir'])); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan Tahun Ajaran</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->