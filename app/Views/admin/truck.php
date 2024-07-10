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
    <p class="text-2xl">Truck</p>
    <div class=" mt-3">
        <button class="bgc-primary textc-secondary px-4 py-2" data-toggle="modal" data-target="#exampleModal" type="button">Tambah Truck</button>
    </div>
    <div class=" mt-4">
    <table id="na_datatable" class="table table-bordered table-striped" width="100%">
        <thead>
            <tr class="bgc-primary textc-secondary">
                <th>No</th>
                <th>Plat</th>
                <th>Supir</th>
                <th>No Handphone</th>
                <th>Garasi</th>
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
                <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Tambah Truck</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url(); ?>tambah-truck" id="tambah-truck">
                    <?= csrf_field(); ?>
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col w-full">
                            <p>Plat Nomor</p>
                            <input type="text" name="plat" placeholder="Masukkan Plat nomor truck" class="w-full" id="plat"/>
                            <p id="err-plat" class=" hidden text-sm text-red-500">Masukkan Plat Nomor Yang Benar, Harus Lebih Dari 3 Karakter</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Nama Supir</p>
                            <input type="text" name="supir" placeholder="Masukkan Nama Supir" class="w-full" id="supir"/>
                            <p id="err-supir" class="hidden text-sm text-red-500">Masukkan Nama Supir Yang Benar, Harus Lebih Dari 3 Karakter</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p>No Hp</p>
                            <input type="text" name="no_hp" placeholder="Masukkan Nomor Handphone" class="w-full" id="no_hp"/>
                            <p id="err-hp" class="hidden text-sm text-red-500">Masukkan Nomor Handphone Yang Benasr, Harus Lebih Dari 10 Karakter</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Garasi</p>
                            <input type="text" name="garasi" placeholder="Masukkan Garasi" class="w-full" id="garasi"/>
                            <p id="err-garasi" class="hidden text-sm text-red-500">Masukkan Garasi Yang Benar, Harus Lebih Dari 3 Karakter</p>

                        </div>
                    </div>
                    <div class="mt-2 flex flex-row justify-end gap-2">
                        <button class="bgc-secondary text-white px-4 py-2 cursor-pointer" data-dismiss="modal">Batal</button>
                        <button class="bgc-primary textc-secondary px-4 py-2 cursor-pointer" type="button" onclick="checkTambah()">Tambah Truck</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white" style="border: none;border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Edit Truck</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="edit-loading">Loading...</p>
                <form method="POST" action="<?php echo base_url(); ?>simpan-truck" id="edit-form" style="display: none;>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="edit-id" placeholder="Masukkan Plat nomor truck" class="w-full" />
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col w-full">
                            <p>Plat Nomor</p>
                            <input type="text" name="plat" id="edit-plat" placeholder="Masukkan Plat nomor truck" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Nama Supir</p>
                            <input type="text" name="supir" id="edit-supir" placeholder="Masukkan Nama Supir" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>No Hp</p>
                            <input type="text" name="no_hp" id="edit-no_hp" placeholder="Masukkan Nomor Handphone" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Garasi</p>
                            <input type="text" name="garasi" id="edit-garasi" placeholder="Masukkan Garasi" class="w-full" />
                        </div>
                    </div>
                    <div class="mt-2 flex flex-row justify-end gap-2">
                        <button class="bgc-secondary text-white px-4 py-2 cursor-pointer" data-dismiss="modal">Batal</button>
                        <button class="bgc-primary textc-secondary px-4 py-2 cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function checkTambah(){
        var platIn = document.getElementById('plat');
        var supirIn = document.getElementById('supir');
        var hpIn = document.getElementById('no_hp');
        var garasiIn = document.getElementById('garasi');
        if(platIn.value.length < 3){
            var errPlat = document.getElementById('err-plat');
            errPlat.style.display = "block";
            platIn.focus();
        }else{
            if(supirIn.value.length < 3){
                var errSupir = document.getElementById('err-supir');
                errSupir.style.display = "block";
                supirIn.focus();
            }else{
                if(hpIn.value.length<10){
                    var errHp = document.getElementById('err-hp');
                    errHp.style.display = "block";
                    hpIn.focus();
                }else{
                    if(garasiIn.value.length < 3){
                        var errGarasi = document.getElementById('err-garasi');
                        errGarasi.style.display = "block";
                        garasiIn.focus();
                    }else{
                        var formTambah= document.getElementById('tambah-truck');
                        formTambah.submit();
                    }
                }
            }
        }
    }
</script>
<script>
    var alerts = document.getElementById('alert')
        setTimeout(function() {
            alerts.style.display = 'none';
        }, 3000); // 3000 milliseconds = 3 seconds
</script>
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
    "ajax": "<?= base_url('get-truck') ?>",
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
    async function getTruck(id){
        console.log(id);
        var base="<?php echo base_url();?>";
        var response = await fetch(base+"get-truck-by-id/"+id,{
            method:'GET'
        });
        if(response.ok){
            const data = await response.json();
            var idElement = document.getElementById('edit-id');
            var platElement = document.getElementById('edit-plat');
            var supirElement = document.getElementById('edit-supir');
            var no_hpElement = document.getElementById('edit-no_hp');
            var garasiElement = document.getElementById('edit-garasi');
            var formElement = document.getElementById('edit-form');
            var loadingElement = document.getElementById('edit-loading');
            idElement.value=data.id;
            platElement.value = data.plat;
            supirElement.value = data.supir;
            no_hpElement.value = data.no_hp;
            garasiElement.value = data.garasi;
            formElement.style.display = 'block';
            loadingElement.style.display = 'none';
        }

    
    }
</script>
<?= $this->endSection(); ?>