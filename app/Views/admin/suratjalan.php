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
        <form method="POST" action="<?php echo base_url('/tambah-surat-jalan');?>">
        <?= csrf_field(); ?>
            <div class="flex flex-col gap-2">
                <!-- <div class="flex flex-col w-full">
                    <p>Nomor Surat</p>
                    <input type="text" id="id_surat" name="id" placeholder="Nomor Surat" class="w-full" readonly/>
                </div> -->
                <div class="flex flex-col w-full">
                    <p>Truck</p>
                    <select class="selectpicker w-full please" data-live-search="true" data-width="100%" name="truck_id">
                        <option selected disabled> -- Plih Truck --</option>
                        <?php
                        foreach ($truck as $tr) {
                            echo "<option value='{$tr->id}'>{$tr->plat}</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="flex flex-col w-full">
                    <p>Berat (Kg)</p>
                    <input type="number" name="berat" placeholder="Input Berat Truck" class="w-full" />
                </div>
                <div class="flex flex-col w-full">
                    <p>Jam Dan Tanggal</p>
                    <input type="datetime-local" name="jam_tanggal" placeholder="Masukkan Plat nomor truck" class="w-full" />
                </div>
                <div class="flex flex-col w-full">
                    <p>Tujuan Pengiriman</p>
                    <input type="text" name="tujuan" placeholder="Masukkan Tujuan Pengiriman" class="w-full" />
                </div>
            </div>
            <div class="mt-4 flex flex-row">
            <button class="bgc-primary textc-secondary px-4 py-2">Buat Surat Jalan</button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>