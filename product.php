<!DOCTYPE html>
<?php session_start();
if(!isset($_SESSION['user'])){
?>
<script>window.location.replace("Login.php");</script>
<?php
}
if(isset($_GET['logout'])){
  session_destroy();
  ?>
  <script>window.location.replace("Login.php");</script>
  <?php
} //Login เอาถึงบรรทัดนี้แล้วไปเพิ่มปุ่ม LOGOUT บรรทัดที่ 47 ด้วย
if(!($_SESSION['dep_id'] == '100000003')){
  ?>
  <script>window.location.replace("index.php");</script>
  <?php
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="tbs.css">
    <title>สินค้า</title>
  </head>
  <body>
    <div><center><table ><tr><td><h1>ฝ่ายสต็อกสินค้า TbsFilterSupply</h1></td><td><img src="logo.png"></td></tr></table></div>
      <ul>
  <li><a  href="index.php">Home</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">จัดการฐานข้อมูลสต็อกสินค้า ▼</a>
    <div class="dropdown-content">
      <a href="product.php">สินค้า</a>
      <a href="material.php">วัตถุดิบ</a>
      <a href="category_pro.php">ประเภทสินค้า</a>
      <a href="category_mat.php">ประเภทวัตถุดิบ</a>
      <a href="zone.php">โซนจัดเก็บ</a>
      <a href="area.php">พื้นที่</a>
      <a href="shelves.php">ชั้นวาง</a>
      <a href="company.php">บริษัทผู้จำหน่าย</a>

    </div>
    <li><a  href="requisition_pro.php">การเบิกสินค้า</a></li>
    <li><a  href="booking_pro.php">การจองสินค้า</a></li>
    <li><a  href="pr_product.php">การขอสั่งซื้อสินค้า</a></li>
    <li><a  href="PO_PRODUCT.php">การสั่งซื้อสินค้า</a></li>
    <li><a  href="requisition_mat.php">การเบิกวัตถุดิบ</a></li>
    <li><a  href="booking_mat.php">การจองวัตถุดิบ</a></li>
    <li><a  href="pr_material.php">การขอสั่งซื้อวัตถุดิบ</a></li>
    <li><a  href="po_material.php">การสั่งซื้อวัตถุดิบ</a></li>
    <li style="float:right;"><a  href="product.php?logout=true">LOGOUT</a></li>


</ul>
    <center><h1>ตารางจัดการสินค้า</h1><br><br><div>
      <span><form action="insertproduct.php"><input class="buttoninsert" type="image" src="buttoninsert.png" alt="Submit" width="160" height="60"></form> </span>
      <table id="table">

        <tr><th>รหัส</th><th>ชื่อสินค้า</th><th>หน่วย</th><th>จำนวน</th><th>ราคา</th><th>MINIMUM_STOCK</th><th>ชั้นวาง</th>
          <th>โซน</th><th>พื้นที่</th><th>ประเภทสินค้า</th><th>รายละเอียด</th><th>รูปภาพ</th><th>Edit</th><th>Delete</th></tr>

      <?php
      $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 202.44.47.68)(PORT = 1521)))(CONNECT_DATA=(SID=tbsfilter)))";
           $Connect = oci_connect("5906021611023","5906021611023",$db,'AL32UTF8');
        if (!$Connect){
          $err = oci_error();
          echo 'Failed to connect to Oracle';
          trigger_error(htmlentities($err['message'],ENT_QUOTES),E_USER_ERROR);
        }

          $sql = "select * from product order by PRO_ID asc";
          $obj = oci_parse($Connect,$sql);
          oci_execute($obj,OCI_DEFAULT);
            while($Result = oci_fetch_array($obj)){
              $sql1 = 'select SHELVES_NAME from SHELVES where SHELVES_ID='.$Result['SHELVES_ID'];
              $shelve = oci_parse($Connect,$sql1);
              @oci_execute($shelve,OCI_DEFAULT);
              $shelveName = @oci_fetch_array($shelve);
              $sql2 = 'select ZONE_NAME from ZONE where ZONE_ID='.$Result['ZONE_ID'];
              $zone = oci_parse($Connect,$sql2);
              @oci_execute($zone,OCI_DEFAULT);
              $zoneName = @oci_fetch_array($zone);
              $sql2 = 'select AREA_NAME from AREA where AREA_ID='.$Result['AREA_ID'];
              $area = oci_parse($Connect,$sql2);
              @oci_execute($area,OCI_DEFAULT);
              $areaName = @oci_fetch_array($area);
              $sql2 = 'select CATEGORY_NAME from CATEGORY_PRO where CATEGORY_PRO_ID='.$Result['CATEGORY_PRO_ID'];
              $area = oci_parse($Connect,$sql2);
              @oci_execute($area,OCI_DEFAULT);
              $category = @oci_fetch_array($area);
              echo '<tr><td>'.$Result['PRO_ID'].'</td><td>'.$Result['PRO_NAME'].'</td><td>'.$Result['PRO_UNIT'].'</td><td>'.$Result['PRO_AMOUNT'].'</td><td>'
              .$Result['PRO_PRICE'].'</td><td>'.$Result['MINIMUM_STOCK'].'</td><td>'.$shelveName['SHELVES_NAME'].'</td><td>'.$zoneName['ZONE_NAME'].'</td><td>'
              .$areaName['AREA_NAME'].'</td><td>'.$category['CATEGORY_NAME'].'</td><td>'.$Result['PRO_DETAIL'].'</td><td><img src='.$Result['PRO_PICTURE'].' width=50 height=50></td>
              <td><button class="buttonintable" onclick="window.location.href=\'editproduct.php?id='.$Result['PRO_ID'].'\'" >แก้ไข</button></td><td>
              <form method=post><button class="buttonintable" onclick="return confirm(\'ยืนยันการลบข้อมูลสินค้า '.$Result['PRO_NAME'].'\')" formaction="deleteproduct.php?id='.$Result['PRO_ID'].'" >ลบ</button></form></td></tr>';
            }
            oci_close($Connect);
       ?>
       </table>
    </div>
  </body>
</html>
