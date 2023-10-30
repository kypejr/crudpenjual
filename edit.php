<?php
// include database connection file
include_once("../config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
    $id = $_POST['id_menu'];
   
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_penjual = $_POST['id_penjual'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE menu SET nama='$nama', jenis='$jenis', stok='$stok', harga='$harga', id_penjual='$id_penjual' WHERE id_menu = $id");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id_menu'];
 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM menu WHERE id_menu=$id");
 
while($user_data = mysqli_fetch_array($result))
{
    $nama = $user_data['nama'];
    $jenis = $user_data['jenis'];
    $stok = $user_data['stok'];
    $harga = $user_data['harga'];
    $id_penjual = $user_data['id_penjual'];
}
?>
<html>
<head>	
    <title>Edit data Menu</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="update_penjual" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama;?>"></td>
            </tr>
            <tr> 
                <td>jenis</td>
              <td>
              <select name="jenis">
                    <option value="Makanan" <?php if ($jenis == 'Makanan') echo 'selected'; ?>>Makanan</option>
                    <option value="Minuman" <?php if ($jenis == 'Minuman') echo 'selected'; ?>>Minuman</option>
                </select>
              </td>
            </tr>
            <tr> 
                <td>stok</td>
                <td><input type="text" name="stok" value="<?php echo $stok;?>"></td>
            </tr>
            <tr> 
                <td>harga</td>
                <td><input type="text" name="harga" value="<?php echo $harga;?>"></td>
            </tr> 
            <tr>
                <td>penjual</td>
            <td>
                <select name="id_penjual">
                    <?php
                    include_once("../config.php");
                    $penjual_query = mysqli_query($mysqli, "SELECT * FROM penjual ORDER BY id_p DESC");
                    while ($penjual_data = mysqli_fetch_array($penjual_query)) {
                        $penjual_id = $penjual_data['id_p'];
                        $penjual_nama = $penjual_data['nama_penjual'];
                        $selected = ($penjual_id == $id_penjual) ? 'selected' : '';
                        echo "<option value='$penjual_id' $selected>$penjual_nama</option>";
                    }

                ?>

                <td><input type="hidden" name="id_menu" value="<?php echo $id;?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>