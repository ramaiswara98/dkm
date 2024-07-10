<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="py-8 px-4">
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
    <p class="text-2xl">Users</p>
    <div class=" mt-3">
        <button class="bgc-primary textc-secondary px-4 py-2" data-toggle="modal" data-target="#exampleModal" type="button">Tambah Users</button>
    </div>
    <div class=" mt-4">
    <table id="na_datatable" class="table table-bordered table-striped" width="100%">
        <thead>
            <tr class="bgc-primary textc-secondary">
                <th>Nama</th>
                <th>Username</th>
                <!-- <th>Password</th> -->
                <th>Tipe</th>
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
                <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Tambah Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('/auth/register'); ?>">
                    <?= csrf_field(); ?>
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col w-full">
                            <p>Nama</p>
                            <input type="text" name="nama" placeholder="Masukkan Nama User" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Username</p>
                            <input type="text" name="username" placeholder="Masukkan Username" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Password</p>
                            <input type="password" name="password" placeholder="Masukkan Password" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Tipe</p>
                            <select class="w-full" name="tipe">
                                <option selected disabled> -- Pilih Tipe Akun --</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Checker</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2 flex flex-row justify-end gap-2">
                        <button class="bgc-secondary text-white px-4 py-2 cursor-pointer" data-dismiss="modal">Batal</button>
                        <button class="bgc-primary textc-secondary px-4 py-2 cursor-pointer">Tambah User</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white" style="border: none;border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title font-bold text-lg" id="exampleModalLabel">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit-data" style="display: none;">
                <form method="POST" action="<?php echo base_url('/update-users'); ?>">
                    <?= csrf_field(); ?>
                    <div class="flex flex-col gap-2">
                        <input type="hidden" name="id" id="id"/>
                        <div class="flex flex-col w-full">
                            <p>Nama</p>
                            <input id="nama" type="text" name="nama" placeholder="Masukkan Nama User" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Username</p>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username" class="w-full" />
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Password Baru</p>
                            <input type="password" id="password" name="password" placeholder="Masukkan Password" class="w-full" />
                            <p class="text-sm " style="color:#808080">Jika tidak ingin mengubah password, biarkan ini kosong.</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p>Tipe</p>
                            <select class="w-full" name="tipe" id="tipe-akun">
                                <option selected disabled> -- Pilih Tipe Akun --</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Checker</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2 flex flex-row justify-end gap-2">
                        <button class="bgc-secondary text-white px-4 py-2 cursor-pointer" data-dismiss="modal">Batal</button>
                        <button class="bgc-primary textc-secondary px-4 py-2 cursor-pointer">Simpan User</button>
                    </div>
                </form>
                <div id="edit-loading">
                    <p>Loading ...</p>
                </div>
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
    "ajax": "<?= base_url('get-users') ?>",
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
    async function getUserById(id){
        var base = "<?php echo base_url(); ?>";
        var response = await fetch(base + "get-user-by-id/" + id, {
        method: 'GET'
        });

        if(response.ok){
            const data = await response.json();
            var editData = document.getElementById('edit-data');
            var editLoading = document.getElementById('edit-loading');
            var namaI = document.getElementById('nama');
            var usernameI = document.getElementById('username');
            var passwordI = document.getElementById('password');
            var tipe = document.getElementById('tipe-akun');
            var id = document.getElementById('id');
            namaI.value = data.nama;
            usernameI.value = data.username;
            passwordI.value = "";
            tipe.value = data.tipe;
            id.value = data.id;
            editLoading.style.display = "none";
            editData.style.display = "block";

        }else{

        }
    }
</script>

<?= $this->endSection(); ?>