<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="py-8 px-4">
    <p class="text-2xl">Checker</p>
    <div class="mt-8">
    <table id="na_datatable" class="table table-bordered table-striped" width="100%">
      <thead>
        <tr class="bgc-primary textc-secondary">
          <th>No Surat</th>
          <th>Plat</th>
          <th>Supir</th>
          <!-- <th>Tujuan</th> -->
          <th>Berangkat</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<!-- Modal Rekap-->
<div class="modal fade" id="rekapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white" style="border: none;border-radius:0px">
      <div class="modal-header">
        <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Surat Jalan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body flex flex-col gap-4">
        <div id="rekap-data" style="display: none;">
          <table class="table table-bordered table-striped">
            <tr>
              <th>No Surat</th>
              <td id="nomor-surat">12345</td>
            </tr>
            <tr>
              <th>No Plat</th>
              <td id="nomor-plat">12345</td>
            </tr>
            <tr>
              <th>Garasi</th>
              <td id="garasi">12345</td>
            </tr>
            <tr>
              <th>Nama Supir</th>
              <td id="nama-supir">12345</td>
            </tr>
            <tr>
              <th>Berat</th>
              <td id="berat">12345</td>
            </tr>
            <tr>
              <th>Berangkat</th>
              <td id="berangkat">12345</td>
            </tr>
            <tr>
              <th>Tujuan</th>
              <td id="tujuan">12345</td>
            </tr>
            <tr>
              <th>Waktu Timbang</th>
              <td id="waktu-timbang">12345</td>
            </tr>
            <tr>
              <th>No Antrian</th>
              <td id="antrian">12345</td>
            </tr>
            <tr>
              <th>Berat Timbangan</th>
              <td id="berat-timbangan">12345</td>
            </tr>
            <tr>
              <th>Status</th>
              <td id="status">12345</td>
            </tr>
          </table>
        </div>
        <div id="rekap-loading">
          <p>Loading ...</p>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Modal Rekap-->
<div class="modal fade" id="checkerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white" style="border: none;border-radius:0px">
      <div class="modal-header">
      <p class="text-2xl font-bold mb-4">FORM CHECKER</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body flex flex-col gap-4">
      <div class="mt-2 w-96">
        <form id="checker-form" method="POST" action="<?php echo base_url('checker-submit');?>">
        <?= csrf_field(); ?>
        <input type="hidden" name="surat_id" value="" id="surat_id"/>
        <!-- <input type="hidden" name="waktu" id="waktu" /> -->
        <div  class="flex flex-col w-full">
        <p>Nomor Antrian</p>
        <input name="antrian" type="text" placeholder="Masukkan Nomor Antrian" id="in-antrian">
        <p class="hidden text-sm text-red-500" id="err-antrian">Masukkan Nomor Antrian</p>
        </div>
        <div  class="flex flex-col w-full mt-4">
        <p>Timbangan (Kg)</p>
        <input name="timbangan" type="number" placeholder="Masukkan Berat Timbangan" id="in-timbangan">
        <p class="hidden text-sm text-red-500" id="err-timbangan">Masukkan Timbangan</p>
        </div>
        <div  class="flex flex-col w-full mt-4">
        <p>Waktu Timbang</p>
        <input name="waktu" type="datetime-local" placeholder="Pilih Waktu" id="in-waktu">
        <p class="hidden text-sm text-red-500" id="err-waktu">Pilih Waktu Timbang</p>
        </div>
        <button class="bgc-primary textc-secondary px-4 py-2 mt-4" type="button" onclick="check()">Simpan</button>
        </form>
    </div>
      </div>

    </div>
  </div>
</div>



<script src="<?php echo base_url() ?>public/datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>public/datatable/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() ?>public/datatable/dataTables.select.min.js"></script>
<script>
  $(document).ready(function() {
    $.fn.DataTable.ext.pager.numbers_length = 10;
  });

  const table = $('#na_datatable').DataTable({
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "pageLength": 10, // new addings
    "ajax": "<?= base_url('get-surat-checker') ?>",
    initComplete: function() {
      $('#na_datatable_filter').css({
        'display': 'flex',
        'justify-content': 'flex-end'
      })

      this.api().columns().every(function() {
        var column = this;
        const dataTableHeader = $(column.header()).text().trim();

      });
    },
  });
</script>
<script>
  var alerts = document.getElementById('alert')
  setTimeout(function() {
    alerts.style.display = 'none';
  }, 3000); // 3000 milliseconds = 3 seconds
</script>
<script>
  async function getRekapDataById(id) {
    var base = "<?php echo base_url(); ?>";
    var response = await fetch(base + "get-rekap-data-by-id/" + id, {
      method: 'GET'
    });
    if (response.ok) {
      const data = await response.json();
      var loadings = document.getElementById('rekap-loading');
      var datas = document.getElementById('rekap-data');
      var nomorSurat = document.getElementById('nomor-surat');
      var garasi = document.getElementById('garasi');
      var nomorPlat = document.getElementById('nomor-plat');
      var namaSupir = document.getElementById('nama-supir');
      var berat = document.getElementById('berat');
      var berangkat = document.getElementById('berangkat');
      var tujuan = document.getElementById('tujuan');
      var waktuTimbang = document.getElementById('waktu-timbang');
      var antrian = document.getElementById('antrian');
      var beratTimbangan = document.getElementById('berat-timbangan');
      var status = document.getElementById('status');

      nomorSurat.innerHTML = data.surat_id;
      nomorPlat.innerHTML = data.plat;
      namaSupir.innerHTML = data.supir;
      berat.innerHTML = data.berat;
      berangkat.innerHTML = formatDates(data.jam_tanggal);
      tujuan.innerHTML = data.tujuan;
      waktuTimbang.innerHTML = formatDates(data.waktu_timbang);
      antrian.innerHTML = data.antrian;
      beratTimbangan.innerHTML = data.timbangan;
      status.innerHTML = checkStatus(data.status);
      garasi.innerHTML = data.garasi;

      loadings.style.display = "none";
      datas.style.display = "block"
      console.log(data);
    } else {
      console.log("some issue apperas")
    }
  }
  function formatDates(dates) {
    if(dates != "None"){
    const dateObj = new Date(dates);
    // Extract date components
    const day = String(dateObj.getDate()).padStart(2, '0');
    const month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const year = dateObj.getFullYear();
    const hours = String(dateObj.getHours()).padStart(2, '0');
    const minutes = String(dateObj.getMinutes()).padStart(2, '0');

    // Format the date
    const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}`;

    return formattedDate; // Output: 05/07/2024 00:56
  }else{
    return "None";
  }

  }

  function checkStatus(status) {
    if (status === "dalam perjalanan") {
      return "<i class='fa-solid fa-circle-dot text-yellow-500'></i> " + status.charAt(0).toUpperCase() + status.slice(1);
    } else {
      return "<i class='fa-solid fa-circle-dot text-green-500'></i> " + status.charAt(0).toUpperCase() + status.slice(1);
    }
  }

  function getId($id){
    var inputId = document.getElementById('surat_id');
    inputId.value = $id;
  }

  function check(){
        var antrianIn = document.getElementById('in-antrian');
        var timbangan = document.getElementById('in-timbangan');
        var waktuIn = document.getElementById('in-waktu')
        if(antrianIn.value.length < 1){
            document.getElementById('err-antrian').style.display = "block";
            antrianIn.focus();
        }else{
            if(timbangan.value.length < 1){
                document.getElementById('err-timbangan').style.display = "block";
                timbangan.focus();
            }else{
                if(waktuIn.value.length < 1){
                    document.getElementById('err-waktu').style.display = "block";
                    timbangan.focus();
                }else{
                    // var waktu = document.getElementById("waktu");
                    // var sekarang = getCurrentFormattedDate();
                    var c_form = document.getElementById('checker-form');
                    // waktu.value = sekarang;
                    c_form.submit();
                }
                
            }
        }
        
    }

    function getCurrentFormattedDate() {
    const now = new Date();

    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(now.getDate()).padStart(2, '0');

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    return `${year}-${month}-${day}T${hours}:${minutes}`;
}
  </script>


<?= $this->endSection(); ?>