<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Login</h1>
</div>

<?php 
    if(isset($_GET['err']))
    {
        $err = $_GET['err'];
        if($err == 1)
        {
            echo "<div class='alert alert-danger'>Username atau password Anda salah</div>";
        }
        elseif($err == 2)
        {
            echo "<div class='alert alert-danger'>Anda harus login sebelum mengakses halaman tersebut!</div>";
        }
    }
    if(isset($_GET['msg']))
    {
        $msg = $_GET['msg'];
        if($msg == 1)
        {
            echo "<div class='alert alert-success'>Logout berhasil! Good bye!</div>";
        }
    }
?>


<form action="?page=login_proses" method="POST">
    <div class="row mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="col-3">
            <input type="text" name="username" placeholder="input your username"class="form-control"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="col-3">
            <input type="password" name="password" class="form-control"/>
        </div>
    </div>
    <input type="submit" class="btn btn-primary" value="login">
</form>