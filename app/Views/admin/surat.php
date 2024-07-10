<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<div class="py-8 px-4">
    <p class="text-2xl">Print Surat Jalan</p>
    <div class="flex flex-col justify-center items-center">
    <div class="mb-4">
        <button class="bgc-primary textc-secondary px-4 py-2 printable" onclick="printDiv('surat-jalan')">Print Surat</button>
    </div>
    <div class="bg-white p-4" style="width: 500px;" id="surat-jalan">
        <div class="flex flex-col justify-center items-center">
            <p class="text-3xl font-bold underline">Surat Jalan</p>
            
        </div>
        <div class=" mt-4">
             <p>No: <span class="font-bold"><?=$surat->surat_id ?></span></p>
            <p>Berangkat : <span class="font-bold"><?php $date_obj = new DateTime($surat->jam_tanggal); echo $date_obj->format('d-m-Y  H:i')?></span></p>
        </div>
        <div class="mt-4">
            <table class ="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th>Nomor Kendaraan</th>
                        <th>Supir</th>
                        <th>Berat(Kg)</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $surat->plat;?></td>
                        <td><?= $surat->supir;?></td>
                        <td><?= $surat->berat;?></td>
                        <td><?= $surat->tujuan;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
    <button class="bgc-primary textc-secondary px-4 py-2" onclick="buatBaru()">Buat Surat Jalan Baru</button>
    <button class="bgc-primary textc-secondary px-4 py-2" onclick="rekap()">Lihat Rekap Data</button>
    </div>
    </div>
</div>
<script>
    function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    }

    function buatBaru(){
        window.location.href = "<?= base_url('/surat-jalan')?>"
    }
    function rekap(){
        window.location.href = "<?= base_url('/rekap-data')?>"
    }
</script>
<?= $this->endSection(); ?>