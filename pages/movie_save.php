<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }

    $now = date("Y-m-d H:i:s");
    $data   = [
        'judul_movie' => clean_data($_POST['judul_movie']),
        'tahun' => clean_data($_POST['tahun']),
        'deskripsi' => clean_data($_POST['deskripsi']),
        'created_at' => $now,
        'updated_at' => $now
    ];
    
    //array genre
    $genre = $_POST['genre'];

    save_data($koneksi, "movie", $data);
    $id_movie = get_last_id($koneksi);

    //add to movie genre
    foreach ($genre as $id_genre) {
        $data = [
            'id_movie' => $id_movie,
            'id_genre' => $id_genre,
            'created_at' => $now,
            'updated_at' => $now
        ];
        save_data($koneksi,"movie_genre", $data);
    }

    #redirect
    redirect("?page=movie_list");

?>

