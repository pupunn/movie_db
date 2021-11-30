<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $data   = [
        'nama_genre' => clean_data($_POST['nama_genre']),
    ];

    save_data($koneksi, "genre", $data);

    #redirect
    redirect("?page=genre_list");

?>

