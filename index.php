<!DOCTYPE html>
<?php
session_start();
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
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="tbs.css">
    <title>ระบบฐานข้อมูล TbsFilterSupply</title>
  </head>
  <body>
    <div><center><table><tr><td><h1>ระบบฐานข้อมูล TbsFilterSupply</h1></td><td><img src="logo.png"></td></tr></table></div>
      <ul>
  <li><a class="active" href="index.php">Home</a></li>
  
  <li style="float:right;"><a  href="index.php?logout=true">LOGOUT</a></li>
      </ul>
      <br><br>
      <center>
          <button class="selectGroup" onclick="window.location.href=''" >ฝ่ายการขาย</button><br><br>
          <button class="selectGroup" onclick="window.location.href='MainStock.php'">ฝ่ายคลังสินค้า</button><br><br>
          <button class="selectGroup" onclick="window.location.href='main_producing.php'">ฝ่ายการผลิต</button><br><br>


      </center>
  </body>
</html>
