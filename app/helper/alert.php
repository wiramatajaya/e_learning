


<?php if(isset($_SESSION['alert'])){ 
    var_dump($_SESSION['alert']['pesan']);?>

<div id="alert" class="alert w-full flex h-screen justify-center absolute top-20 z-50  ">
    <div class="w-[40%] flex items-center  relative text-sm  h-[10rem]  bg-emerald-600 rounded-xl shadow-md transition-all scale-90" role="alert" id="alert">
    <div class="h-[8rem] rounded-lg w-full bg-slate-900 absolute top-0 p-4">
        <span class="font-medium">Berhasil!</span> Aksi Anda telah diproses dengan sukses.
    </div>
    </div>
</div>
  <?php unset($_SESSION['alert']); ?>

<?php }; ?>


<script>
    function closeAlert() {
    const alert = document.getElementById('alert');
   
}

    window.onload = function() {
    const alert = document.getElementById('alert');
    if (alert) {
        setTimeout(closeAlert, 3000);
    }
}
</script>