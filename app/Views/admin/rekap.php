<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<?php
if ($session->getFlashdata('error') != '') {
?>
  <div class="pt-2 px-4" id="alert">
    <div class="alert alert-danger" role="alert">
      <?= $session->getFlashdata('error') ?>
    </div>
  </div>
<?php
}
?>
<?php
if ($session->getFlashdata('success') != '') {
?>
  <div class="pt-2 px-4" id="alert">
    <div class="alert alert-success" role="alert">
      <?= $session->getFlashdata('success') ?>
    </div>
  </div>
<?php
}
?>
<div class="py-8 px-4">
  <p class="text-2xl">Rekap Data</p>
  <div class="mt-8">
    <button class="bgc-primary textc-secondary px-4 py-2 mb-4" type="button" data-toggle="modal" data-target="#exampleModal">Export Data Ke Excel</button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-white" style="border: none;border-radius:0px">
      <div class="modal-header">
        <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Export Data Ke Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body flex flex-col gap-4">
        <p>Pilih Data</p>
        <select id="select-data" onchange="dataselect()">
          <option value="all">Semua</option>
          <option value="berangkat">Range Tanggal Berangkat</option>
          <option value="timbang">Range Tanggal Timbang</option>
        </select>
        <div id="range-input" class="flex flex-col gap-4" style="display: none;">
          <div class="w-full">
            <p>Dari :</p>
            <input type="date" name="dari" id="dari" class="w-full" />
          </div>
          <div class="w-full">
            <p>Sampai :</p>
            <input type="date" name="sampai" id="sampai" class="w-full" />
          </div>
        </div>
        <button class="bgc-primary textc-secondary px-4 py-2 mb-4" type="button" onclick="getRekapData()" id="exp-btn">Export Data Ke Excel</button>
      </div>

    </div>
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
    "ajax": "<?= base_url('get-surat') ?>",
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
  function downloadExcel(list) {
    // Sample data
    const data = [
      ["Nomor Surat", "Plat", "Supir", "No Hp", "Garasi", "Berat", "Tujuan", "Berangkat", "Waktu Timbang", "Nomor Antrian", "Berat Timbangan", "Status"]
    ];
    if (list.length > 0) {
      list.map((item, index) => {
        const it = [item.surat_id, item.plat, item.supir, item.no_hp, item.garasi, item.berat, item.tujuan, item.jam_tanggal, item.waktu_timbang, item.antrian, item.timbangan, item.status]
        data.push(it);
      })
    }

    // Create a new workbook
    const workbook = XLSX.utils.book_new();

    // Convert data to a worksheet
    const worksheet = XLSX.utils.aoa_to_sheet(data);

    // Append worksheet to workbook
    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

    // Export to Excel
    XLSX.writeFile(workbook, "data.xlsx");
    const btn = document.getElementById('exp-btn');
    btn.disabled = false;
    btn.innerHTML = "Export Data Ke Excel";
  }

  function dataselect() {
    var select = document.getElementById('select-data');
    var range = document.getElementById('range-input');
    if (select.value != 'all') {
      range.style.display = 'flex';
    } else {
      range.style.display = 'none';
    }
  }

  function getRekapData() {
    const btn = document.getElementById('exp-btn');
    btn.disabled = true;
    btn.innerHTML = "Mengexport Data ...";
    const url = "<?php echo base_url('get-rekap-data-api'); ?>";
    const data_select = document.getElementById('select-data').value;
    let data;
    if (data_select != 'all') {
      const dari = document.getElementById('dari').value;
      const sampai = document.getElementById('sampai').value;
      data = {
        data_select,
        dari,
        sampai
      };
    } else {
      data = {
        data_select,
        dari: null,
        sampai: null
      };
    }

    fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        downloadExcel(data);
        console.log('Success:', data);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
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
</script>
<?= $this->endSection(); ?>