<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] ==0)
    {
        $filename = str_replace('','_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination))
        {
            $gambar = 'gambar/' . $filename;;
        }
    }

    $sql = 'UPDATE data_barang SET ';
    $sql = "nama = '{$nama}', kategori = '{$kategori}',";
    $sql = "harga_jual = '{$harha_jual}', harga_beli= '{$harga_beli}', stok ='{$stok}'";

    if (!empty($gambar))
    $sql = "WHERE id_barang = '{$id}'";
    $result = mysqli_query($koneksi, $sql);
    
    header('location: index.php');
}

    

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($koneksi,$sql);

if (!$result) die('Error: data tidak tersedia');
$data = mysqli_fetch_array($result);

function is_select($var, $val){
    if($var == $val) return 'selected="selected"';
    return false;
}

?>

<html>
    <head>
        <title>Ubah barang</title>
    </head>

    <body>
        <div class="container">
            <h1>Ubah barang</h1>
            <div class="main">
                <form   method="post"action="ubah.php" enctype="multipart/form-data">
                    <div class="input">
                        <label>Nama barang</label>
                        <input type="text" name="nama" value="<?php echo $data['nama'];?>"/>
                    </div>
                    <div class="input">
                        <label>Kategori</label>
                        <select name="kategori">
                            <option <?php echo is_select('komputer',$data['kategori']);?> value="Komputer">Komputer</option>
                            <option <?php echo is_select('komputer',$data['kategori']); ?> value="Elektronik">Elektronik</option>
                            <option <?php echo is_select('komputer',$data['kategori']); ?> value="Hand phone">Hand phone</option>
                        </select>
                    </div>
                    <div class="input">
                        <label>Harga jual</label>
                        <input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>"/>
                    </div>
                    <div class="input">
                        <label>Harga beli</label>
                        <input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>"/>
                    </div>
                    <div class="input">
                        <label>Stok</label>
                        <input type="text" name="stok" value="<?php echo $data['stok']; ?>"/>
                    </div>
                    <div class="input">
                        <label>File gambar</label>
                        <input type="file" name="file_gambar"/>
                    </div>
                    <div class="submit">
                        <input type="hidden" name="id" value=" <?php echo $data['id_barang']; ?>"/>
                        <input type="submit" name="submit" value="simpan"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>