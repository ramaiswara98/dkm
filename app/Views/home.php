<!DOCTYPE html>
<head>
    <title>Darma Karya Mandiri</title>
    <!-- <link rel="stylesheet"  href="<?php echo base_url();?>public/bootstrap.min.css"/> -->
    <!-- <script src="<?php echo base_url();?>public/bootstrap.min.js"></script> -->
    <script src="<?php echo base_url();?>public/tailwind.js"></script>
    <link rel="stylesheet"  href="<?php echo base_url();?>public/home.css"/>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body>
    <div class="container">
    <div class="flex flex-col sm:flex-row sm:justify-around items-center h-screen">
        <div class="col">
            <img src="<?php echo base_url();?>public/images/truck.jpeg" width="300px"/>
            <div class=" mb-5 flex items-center justify-center">
                    <h1 class="textc-primary text-2xl font-bold">Darma </h1>
                    <h1 class="textc-secondary text-2xl font-bold ml-1"> Karya Mandiri</h1>
                </div>
        </div>
        <div class="col">
            <div class=" w-80 sm:w-96 bg-white p-8 flex flex-col justify-center items-center">
                <h1 class="font-bold text-2xl">Masuk</h1>
                <form class="w-full mt-3" method="POST" action="<?php echo base_url('/auth/login');?>" >
                <?= csrf_field(); ?>
                <div class="flex flex-col gap-4 ">
                <div>
                <p class=" text-sm">Username</p>
                <input type="text" placeholder="Masukkan username" class="input-form w-full" name="username"/>
                </div>
                <div>
                <p class=" text-sm">Password</p>
                <input type="password" placeholder="Masukkan Password" class="input-form w-full" name="password"/>
                </div>
                <button class="py-2 px-4 bgc-primary text-secondary rounded-lg font-bold">Masuk</button>
                </div>
                <?php
        if ($session->getFlashdata('error') != '') {
        ?>
            <div class="pt-2 px-4" id="alert">
            <div class="alert alert-danger bg-red-500 p-2 rounded-md text-white text-center" role="alert">
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
            <div class="alert alert-success bg-green-500 p-2 rounded-md text-white text-center" role="alert">
                <?= $session->getFlashdata('success') ?>
            </div>
        </div>
        <?php
        }
        ?>     
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>