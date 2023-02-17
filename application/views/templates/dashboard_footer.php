<footer class="footer text-center text-muted">
  All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<div id="right-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-right">
    <div class="modal-content" style="height: 100vh">
      <div class="modal-header border-0">
        Notifikasi
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <ul class="list-style-none">
          <li>
            <div class="message-center notifications position-relative">
              <!-- Message -->
              <?php
              $notifikasi = $this->sis->getNotif($user['user_role_id']);
              ?>
              <?php if ($notifikasi) : ?>
                <?php foreach ($notifikasi as $notif) : ?>
                  <a href="<?= base_url('notifikasi/index/' . $this->encryptor->enkrip('enkrip', $notif['tb_notifikasi_id'])); ?>" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                    <div class="btn btn-<?= $notif['tb_notifikasi_color']; ?> rounded-circle btn-circle"><i data-feather="<?= $notif['tb_notifikasi_icon']; ?>" class="text-white"></i></div>
                    <div class="w-75 d-inline-block v-middle pl-2">
                      <h6 class="message-title mb-0 mt-1"><?= $notif['tb_notifikasi_title']; ?></h6>
                      <span class="font-12 text-nowrap d-block text-muted"><?= $notif['tb_notifikasi_subtitle']; ?></span>
                      <span class="font-12 text-nowrap d-block text-muted"><?= date('d-m-Y H:i:s', strtotime($notif['tb_notifikasi_date_created'])); ?></span>
                    </div>
                  </a>
                <?php endforeach; ?>
              <?php else : ?>
                <h6 style="color: red; text-align:center;">Tidak Ada Pemberitahuan Baru</h6>
              <?php endif ?>
              <!-- Message -->
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <ul class="list-style-none">
          <li>
            <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
              <strong>Buka Semua Notifikasi</strong>
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?= base_url('assets/dashboard/'); ?>libs/jquery/dist/jquery.min.js"></script>
<!-- sweetalert -->
<script src="<?= base_url('assets/dashboard/'); ?>libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/sweetalert/'); ?>sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/sweetalert/'); ?>myscript.js"></script>
<!-- apps -->
<!-- apps -->
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/app-style-switcher.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/feather.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/c3/c3.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/pages/dashboards/dashboard1.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/sparkline/sparkline.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/dashboard/'); ?>dist/js/pages/datatable/datatable-basic.init.js"></script>
<script>
  $('.border-checkbox').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');
    const idrole = $(this).data('roleenkrip');

    $.ajax({
      url: "<?= base_url('manajemen/ubahakses'); ?>",
      type: 'post',
      data: {
        menuId: menuId,
        roleId: roleId
      },
      success: function() {
        document.location.href = "<?= base_url('manajemen/index/'); ?>" + idrole;
      }
    });

  });
</script>
<script>
  $(document).ready(function() {

    $('#email').keyup(function() {
      var email = $(this).val();
      // console.log(id)
      $.ajax({
        type: "POST",
        url: "<?= base_url('administrasi/getemail'); ?>",
        data: {
          email: email
        },
        dataType: "JSON",
        success: function(response) {
          // console.log(response)
          $('#hasilemail').html(response);
        }
      });
    });
    $("#email").on({
      keydown: function(e) {
        if (e.which === 32)
          return false;
      },
      keyup: function() {
        this.value = this.value.toLowerCase();
      },
      change: function() {
        this.value = this.value.replace(/\s/g, "");
      }
    });
    $('#username').keyup(function() {
      var username = $(this).val();
      // console.log(id)
      $.ajax({
        type: "POST",
        url: "<?= base_url('administrasi/getusername'); ?>",
        data: {
          username: username
        },
        dataType: "JSON",
        success: function(response) {
          // console.log(response)
          $('#hasilusername').html(response);
        }
      });
    });
    $("#username").on({
      keydown: function(e) {
        if (e.which === 32)
          return false;
      },
      keyup: function() {
        this.value = this.value.toLowerCase();
      },
      change: function() {
        this.value = this.value.replace(/\s/g, "");
      }
    });
  });
</script>
<script>
  $("#randompassword").click(function() {
    var id = 'test';
    // console.log(id)
    $.ajax({
      type: "POST",
      url: "<?= base_url('administrasi/random'); ?>",
      data: {
        id: id
      },
      dataType: "JSON",
      success: function(response) {
        console.log(response)
        document.getElementById('password').value = response
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#provinsi').change(function() {
      var id = $(this).val();
      console.log(id)
      $.ajax({
        type: "POST",
        url: "<?= base_url('administrasi/getkotakabupaten'); ?>",
        data: {
          id: id
        },
        dataType: "JSON",
        success: function(response) {
          // console.log(response)
          $('#kotakabupaten').html(response);
        }
      });
    });

    $('#kotakabupaten').change(function() {
      var id = $(this).val();
      // console.log(id)
      $.ajax({
        type: "POST",
        url: "<?= base_url('administrasi/getkecamatan'); ?>",
        data: {
          id: id
        },
        dataType: "JSON",
        success: function(response) {
          // console.log(response)
          $('#kecamatan').html(response);
        }
      });
    });

    $('#kecamatan').change(function() {
      var id = $(this).val();
      // console.log(id)
      $.ajax({
        type: "POST",
        url: "<?= base_url('administrasi/getkelurahan'); ?>",
        data: {
          id: id
        },
        dataType: "JSON",
        success: function(response) {
          // console.log(response)
          $('#kelurahan').html(response);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable();
  });
  $(document).ready(function() {
    $('#example2').DataTable();
  });
  $(document).ready(function() {
    $('#example3').DataTable();
  });
  $(document).ready(function() {
    $('#example4').DataTable();
  });
  $(document).ready(function() {
    $('#example5').DataTable();
  });
  $(document).ready(function() {
    $('#example6').DataTable();
  });
  $(document).ready(function() {
    $('#example7').DataTable();
  });
  $(document).ready(function() {
    $('#example8').DataTable();
  });
  $(document).ready(function() {
    $('#example9').DataTable();
  });
</script>
</body>

</html>