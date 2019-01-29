<!DOCTYPE html>
<html>
  <head>
    <style>
    body{
       height:100%; width:75mm; margin-right:auto;
    }
    .tg  {border-collapse:collapse;border-spacing:1;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
    .tg .tg-0lax{text-align:center;vertical-align:center; font-size:14px;font-weight:normal;padding:10px 5px;}
    .tg .tg-0laj{text-align:justify;vertical-align:center; font-size:14px;font-weight:normal;padding:10px 5px;}

    .td_ku {border-width: 1px;border-style: solid;word-break:normal;border-color:black;}
    </style>

  </head>
  <body>
       <p align="center">
        <b>Faktur pembelian <?php echo $sistem -> nama_resto?></b>
        <br><?php echo $sistem -> alamat_resto;?>
        <br><?php echo date_formater($transaksi -> tgl_transaksi);?>
    <table 
      style="width: 100%; " border="0" 
  >
  <tr align="left">
   <td colspan="2"></td>
  </tr>
  <tr align="center">
    <th>Nama Barang</th>
    <th>Harga</th>
  </tr>
  <?php $totbay = 0;?>
  <?php foreach($data_transaksi as $dt):?>
  <?php $totbay = $totbay + ($dt -> harga_menu * $dt -> jumlah_beli);  ?>
  <tr>
    <td><?php echo $dt -> jumlah_beli.' '.$dt -> nama_menu ?></td>
    <td><?php echo "Rp ".number_format(($dt -> harga_menu * $dt -> jumlah_beli),0,".",".") ?></td>
  </tr>

 <?php endforeach; ?>
  <?php 
    function date_formater($date)
    {
      return  date('d-F-Y H:i:s',strtotime($date));
    }
   ?>
   <tr>
     <td></td>
     <td><?php echo "Rp ".number_format(($totbay),0,".",".") ?></td>
   </tr>
   <br>
   <tr>
     <td colspan="2"><p align="center"> Terima kasih, selamat berbelanja kembali<br> Layanan konsumen <?php echo $sistem -> telp_resto; ?> </p></td>
   </tr>
</table>
  <script type="text/javascript">
    window.print();
  </script>
  </body>

</html>