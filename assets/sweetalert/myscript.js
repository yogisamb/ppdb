const flashData1 = $('.flash-data').data('flashdata1');
const flashData2 = $('.flash-data').data('flashdata2');
if (flashData1) {
  Swal.fire({
    icon: flashData1,
    title: 'Data Sistem',
    text: flashData2,
  })
}