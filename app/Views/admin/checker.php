<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="py-8 px-4">
    <p class="text-2xl">Checker</p>
    <div class="mt-4">
        <form method="POST" action="<?php echo base_url('checker') ?>" id="surat-form">
        <?= csrf_field(); ?>
        <p>Nomor Surat Jalan</p>
        <input name="surat-jalan" type="text" inputmode="numeric" placeholder="Masukkan Nomor Surat Jalan" id="surat-id">
        <button class="bgc-primary textc-secondary px-4 py-2" type="button" onclick="validate_form()">Cari</button>
        <p class="text-red-500 text-sm" id="surat-error" style="display: none;">Tolong Masukkan Nomor Surat Dengan Format Yang Benar</p>
        <?php if($surat == "TIDAK" && $surat != NULL){
            echo "<p class='text-red-500 text-sm'>Nomor Surat Jalan Tidak Terdaftar Di Database </p>";
        }?>
        </form>
    </div>
    <?php if($surat != NULL && $surat != "TIDAK"){
        ?>
    
    <div class="flex flex-col justify-center items-center gap-4 w-full">
    <div class="mt-4 w-full">
    <table class="table table-bordered table-striped" width="100%">
        <thead>
            <tr class=" bgc-primary textc-secondary">
                <th>Nomor Surat</th>
                <th>Plat</th>
                <th>Supir</th>
                <th>Berangkat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $surat->surat_id;?></td>
                <td><?= $surat->plat;?></td>
                <td><?= $surat->supir;?></td>
                <td><?= $surat->jam_tanggal;?></td>
                <td><?php if($surat->status == "dalam perjalanan"){
            echo "<i class='fa-solid fa-circle-dot text-yellow-500'></i> ".ucwords($surat->status);
        }else{
            echo "<i class='fa-solid fa-circle-dot text-green-500'></i> ".ucwords($surat->status);
        }?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="mt-8 w-96">
        <p class="text-2xl font-bold mb-4">FORM CHECKER</p>
        <form id="checker-form" method="POST" action="<?php echo base_url('checker-submit');?>">
        <?= csrf_field(); ?>
        <input type="hidden" name="surat_id" value="<?= $surat->surat_id;?>"/>
        <input type="hidden" name="waktu" id="waktu" />
        <div  class="flex flex-col w-full">
        <p>Nomor Antrian</p>
        <input name="antrian" type="text" placeholder="Masukkan Nomor Antrian" id="antrian">
        <p class="hidden text-sm text-red-500" id="err-antrian">Masukkan Nomor Antrian</p>
        </div>
        <div  class="flex flex-col w-full mt-4">
        <p>Timbangan (Kg)</p>
        <input name="timbangan" type="number" placeholder="Masukkan Berat Timbangan" id="timbangan">
        <p class="hidden text-sm text-red-500" id="err-timbangan">Masukkan Timbangan</p>
        </div>
        <button class="bgc-primary textc-secondary px-4 py-2 mt-4" type="button" onclick="check()">Simpan</button>
        </form>
    </div>
    </div>
    <?php }?>
</div>
<script>
    function validate_form(){
        var surat = document.getElementById('surat-id').value;
        var form = document.getElementById('surat-form');
        var aler = document.getElementById('surat-error');
        const numberRegex = /^[0-9]+$/;
        if(surat.length > 3 && numberRegex.test(surat)){
            form.submit();
        }else{
            aler.style.display = 'block';
            //alert("Tolong Masukkan Nomor Surat Yang Benar");
        }

    }

    function check(){
        var antrianIn = document.getElementById('antrian');
        var timbangan = document.getElementById('timbangan');
        if(antrianIn.value.length < 1){
            document.getElementById('err-antrian').style.display = "block";
            antrianIn.focus();
        }else{
            if(timbangan.value.length < 1){
                document.getElementById('err-timbangan').style.display = "block";
                timbangan.focus();
            }else{
                var waktu = document.getElementById("waktu");
                var sekarang = getCurrentFormattedDate();
                var c_form = document.getElementById('checker-form');
                waktu.value = sekarang;
                c_form.submit();
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