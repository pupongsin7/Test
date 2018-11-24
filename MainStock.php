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
    <title>ฝ่ายสต็อกสินค้า</title>
  </head>
  <body>
    <div><center><table><tr><td><h1>ฝ่ายสต็อกสินค้า TbsFilterSupply</h1></td><td><img src="logo.png"></td></tr></table></div>
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
    <li style="float:right;"><a  href="MainStock.php?logout=true">LOGOUT</a></li>


</ul>

  </body>
</html>
