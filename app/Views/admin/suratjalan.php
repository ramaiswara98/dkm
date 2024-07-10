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
    <p class="text-2xl">Surat Jalan</p>
    <div class="mt-3">
        <form method="POST" action="<?php echo base_url('/tambah-surat-jalan');?>" id="surat-form">
        <?= csrf_field(); ?>
            <div class="flex flex-col gap-2">
                <!-- <div class="flex flex-col w-full">
                    <p>Nomor Surat</p>
                    <input type="text" id="id_surat" name="id" placeholder="Nomor Surat" class="w-full" readonly/>
                </div> -->
                <div class="flex flex-col w-full">
                    <p>Truck</p>
                    <select class="selectpicker w-full please" data-live-search="true" data-width="100%" name="truck_id" id="truck">
                        <option selected disabled value="none"> -- Plih Truck --</option>
                        <?php
                        foreach ($truck as $tr) {
                            echo "<option value='{$tr->id}'>{$tr->plat}</option>";
                        }
                        ?>

                    </select>
                    <p class="hidden text-sm text-red-500" id="err-truck">Pilih Truck Terlebih Dahulu</p>
                </div>
                <div class="flex flex-col w-full">
                    <p>Berat (Kg)</p>
                    <input type="number" name="berat" placeholder="Input Berat Truck" class="w-full" id="berat"/>
                    <p class="hidden text-sm text-red-500" id="err-berat">Masukkan berat muatan</p>
                </div>
                <div class="flex flex-col w-full">
                    <p>Jam Dan Tanggal</p>
                    <input type="datetime-local" name="jam_tanggal" placeholder="Masukkan Plat nomor truck" class="w-full" id="jam_tanggal"/>
                    <p class="hidden text-sm text-red-500" id="err-jam-tanggal">Pilih Jam Dan Tanggal Keberangkatan</p>
                </div>
                <div class="flex flex-col w-full">
                    <p>Tujuan Pengiriman</p>
                    <input type="text" name="tujuan" placeholder="Masukkan Tujuan Pengiriman" class="w-full" id="tujuan"/>
                    <p class="hidden text-sm text-red-500" id="err-tujuan">Masukkan Tujuan Terlebih Dahulu</p>
                </div>
            </div>
            <div class="mt-4 flex flex-row">
            <button class="bgc-primary textc-secondary px-4 py-2" type="button" onclick="validateForm()">Buat Surat Jalan</button>
            </div>
        </form>

    </div>
</div>
<script>
    function validateForm() {
        var truckIn = document.getElementById('truck');
        var beratIn = document.getElementById('berat');
        var jamIn = document.getElementById('jam_tanggal');
        var tujuanIn = document.getElementById('tujuan');

        if(truckIn.value == "none"){
            document.getElementById('err-truck').style.display = "block";
            truckIn.focus();
        }else{
            if(beratIn.value.length < 1){
                document.getElementById('err-berat').style.display = "block";
                beratIn.focus();
            }else{
                if(jamIn.value.length < 1){
                    document.getElementById('err-jam-tanggal').style.display = "block";
                    jamIn.focus();
                }else{
                    if(tujuanIn.value.length < 3){
                        document.getElementById('err-tujuan').style.display = "block";
                        tujuanIn.focus;
                    }else{
                        document.getElementById('surat-form').submit();
                    }
                }
            }
        }
    }
</script>

<?= $this->endSection(); ?>