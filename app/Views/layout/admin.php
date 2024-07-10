<!DOCTYPE html>

<head>
    <title>Darma Karya Mandiri - Admin</title>
    <style>
        .dropdown.bootstrap-select .btn.dropdown-toggle {
            background-color: white !important;
            border: 1px solid #000 !important;
             border-radius: 0px;
        }
    </style>
   <style>
    /* Optional: CSS for printing */
    @media print {
        /* Define print-specific styles */
        body {
            margin: auto;
            padding: 80px;
        }
        .printable {
            /* Example styles */
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
        }
    }
</style>
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap.min.css" /> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>public/datatable/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/datatable/jquery.dataTables.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/datatable/select.dataTables.min.css">


    <script src="<?php echo base_url(); ?>public/tailwind.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/home.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

</head>

<body>

    <div>
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="hidden bgc-secondary py-8 px-12 sm:mb-32 w-full h-screen sm:w-96 sm:flex flex-col " id="main-menu">
            <div class="block sm:hidden">
                <p class="text-white text-right cursor-pointer text-xl" onclick="closeMenu()"><i class="fa-solid fa-x"></i></p>
            </div>    
            <div class=" mb-5 flex items-center justify-center">
                    <h1 class="textc-primary text-2xl font-bold">Darma </h1>
                    <h1 class="text-white text-2xl font-bold ml-1"> Karya Mandiri</h1>
                </div>
                <div class="flex flex-col gap-3">
                <?php if($_SESSION['tipe'] == '1' || $_SESSION['tipe'] == '2'){
                        ?>
                    <!-- Truck Menu -->
                    <?php if ($page == "truck") {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer bgc-primary' onclick="window.location.href = '<?php echo base_url('truck')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="textc-secondary text-xl"><i class="fa fa-truck"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="textc-secondary text-2xl "> Truck</p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('truck')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="text-white text-xl"><i class="fa fa-truck"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="text-white text-2xl "> Truck</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Truck Menu -->
                    <!-- Surat Jalan Menu -->
                    <?php if ($page == "surat-jalan") {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer bgc-primary' onclick="window.location.href = '<?php echo base_url('surat-jalan')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="textc-secondary text-xl"><i class="fa fa-envelope"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="textc-secondary text-2xl "> Surat Jalan</p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('surat-jalan')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="text-white text-xl"><i class="fa fa-envelope"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="text-white text-2xl "> Surat Jalan</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Surat Menu -->
                    <!-- Rekap Menu -->
                    <?php if ($page == "rekap") {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer bgc-primary' onclick="window.location.href = '<?php echo base_url('rekap-data')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="textc-secondary text-xl"><i class="fa fa-calendar-days"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="textc-secondary text-2xl "> Rekap</p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('rekap-data')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="text-white text-xl"><i class="fa fa-calendar-days"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="text-white text-2xl "> Rekap</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Rekap Menu -->
                     <?php } ?>
                    <?php if($_SESSION['tipe'] == '1'){
                        ?>
                    <!-- Users Menu -->
                    <?php if ($page == "users") {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer bgc-primary' onclick="window.location.href = '<?php echo base_url('users')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="textc-secondary text-xl"><i class="fa fa-person"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="textc-secondary text-2xl "> Users</p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('users')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="text-white text-xl"><i class="fa fa-person"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="text-white text-2xl "> Users</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Users Menu -->
                     <?php } ?>
                    <?php if($_SESSION['tipe'] == '3'){
                        ?>
                    
                    <!-- Checker Menu -->
                    <?php if ($page == "checker") {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer bgc-primary' onclick="window.location.href = '<?php echo base_url('checker')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="textc-secondary text-xl"><i class="fa fa-check-to-slot"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="textc-secondary text-2xl "> Checker</p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                        <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('checker')?>'">
                            <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                                <p class="text-white text-xl"><i class="fa fa-check-to-slot"></i> </p>
                            </div>
                            <div class=" px-2">
                                <p class="text-white text-2xl "> Checker</p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Chekcer Menu -->
                    <?php }?>
                    <div class='flex flex-row items-center cursor-pointer' onclick="window.location.href = '<?php echo base_url('keluar')?>'">
                        <div class=" rounded-full w-14 h-14 p-2 flex justify-center items-center">
                            <p class="text-white text-xl"><i class="fa fa-power-off"></i> </p>
                        </div>
                        <div class=" px-2">
                            <p class="text-white text-2xl "> Keluar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bgc-alternate w-full">
                <div class="sm:hidden bgc-secondary h-10 flex flex-col justify-center w-24 items-center" id="menu-items" onclick="openMenu()">
                <p class="text-white text-xl"><i class="fa fa-bars"></i> MENU</p>
                </div>
                <?= $this->renderSection('content'); ?>
            </div>
        </div>

    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- <script src="<?php echo base_url(); ?>public/bootstrap.min.js"></script> -->
     <script>
        function openMenu(){
            var mainMenu = document.getElementById('main-menu');
            mainMenu.style.display = "flex";
        }
     </script>
      <script>
        function closeMenu(){
            var mainMenu = document.getElementById('main-menu');
            mainMenu.style.display = "none";
        }
     </script>
  
</body>

</html>