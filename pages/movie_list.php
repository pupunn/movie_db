<?php
    if(defined("GELANG") === false)
    {
        die("Anda tidak boleh membuka halaman ini secara langsung");
    }
?>



<?php
    $sql = "SELECT m.*,group_concat(g.nama_genre) as genre 
        FROM `movie_genre` as mg 
        join movie as m on m.id_movie=mg.id_movie
        join genre as g on g.id_genre=mg.id_genre
        where mg.deleted_at is null and m.deleted_at is null
        group by id_movie";

    $result = mysqli_query($koneksi, $sql);

    $is_boleh_create = cek_akses($koneksi, 2, $_SESSION['id_role'], "create");
    $is_boleh_read = cek_akses($koneksi, 2, $_SESSION['id_role'], "read");
    $is_boleh_edit = cek_akses($koneksi, 2, $_SESSION['id_role'], "update");
    $is_boleh_hapus = cek_akses($koneksi, 2, $_SESSION['id_role'], "delete");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">List Movie</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <?php if($is_boleh_create) : ?>
        <a href="?page=movie_create" class="btn btn-sm btn-outline-secondary">Tambah Baru</a>
        <?php endif; ?>
        <?php if($is_boleh_read) : ?>
        <a href="?page=movie_excel" class="btn btn-sm btn-outline-secondary">Export XLSX</a>
        <a href="?page=movie_chart" class="btn btn-sm btn-outline-secondary">Chart</a>
        <a href="?page=movie_pdf" class="btn btn-sm btn-outline-secondary">Export PDF</a>
        <?php endif; ?>
    </div>
</div>


<table class="table table-striped">
    <tr>
        <th width="50px" class="text-center">No.</th>
        <th width="20%">Judul Movie</th>
        <th>Tahun</th>
        <th>Deskripsi</th>
        <th width="20%">Action</th>
    </tr>

    <?php 
        $no = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $no++;
            $btn = array();
            $btn[] = "<a href='?page=movie_word&id_movie=".$row['id_movie']."' class='btn btn-sm btn-primary'>Cetak</a>";
            if($is_boleh_edit == true)
                // $btn[] = "<a href='?page=movie_edit&id_movie=".$row['id_movie']."' class='btn btn-sm btn-primary'>Edit</a>";
                $btn[] = "<a href='#' class='btn btn-sm btn-info'>Edit</a>";
            if($is_boleh_hapus == true)
                // $btn[] = "<a href='?page=movie_delete&id_movie=".$row['id_movie']."' class='btn btn-sm btn-danger'>Hapus</a>";
                $btn[] = "<a href='#' class='btn btn-sm btn-danger'>Hapus</a>";
                
            echo "<tr> 
                <td class='text-center'>".$no."</td>
                <td>".$row['judul_movie']."<br />Genre: <strong>".$row['genre']."</strong></td>
                <td>".$row['tahun']."</td>
                <td>".$row['deskripsi']."</td>
                <td>
                    ".implode(" ",$btn)."
                </td>
            </tr>";
        }
    ?>
</table>