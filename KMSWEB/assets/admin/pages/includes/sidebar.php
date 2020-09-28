<style>
.user-panel img{
  width: 6.4rem;
  height: auto;
}
.img-thumbnails{
    box-shadow: 0 1px 2px rgba(0,0,0,.075);
    max-width: 100%;
}
.sidebar-footer {
  position:fixed;
  bottom:0px;
}
</style>

<?php 
$link = $_SERVER['REQUEST_URI'];
$link_array = explode('/',$link);
$name = $link_array[count($link_array) - 2];
?>
<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-th-large"></i>
        </a>
      </li>
    </ul>
</nav>
<?php 
include('../../connect.php');
$sql9="select * from members where mem_id = '".$_SESSION['mem_id']."'";
$res9=mysqli_query($conn,$sql9);
$row9=mysqli_fetch_array($res9);
?>
  <!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 5px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <center><img src="..\..\..\..\assets\image\LOGOKMS.PNG" alt="KMS LOGO" width="140" height="70"></center>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <center>
		  <a  class="d-block h5"><?php echo "ยินดีต้อนรับ  คุณ" ?></a>
          <a  class="d-block h6"><?php echo $_SESSION['mem_fname']?></a>
          <a  class="d-block h7">  Status: <?php if($_SESSION['mem_status']=="admin"){ 
        echo "ผู้ดูแลระบบ";
          }
          ?></a>
          <a  class="d-block h6"><i class="fas fa-circle text-success"></i>  Online</a>
          </center>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../dashboard" class="nav-link <?php echo $name == 'dashboard' ? 'active': '' ?>">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>ภาพรวมระบบ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../members" class="nav-link <?php echo $name == 'members' ? 'active': '' ?>">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>จัดการผู้ใช้ระบบ</p>
            </a>
		  </li>	
          <li class="nav-item">
            <a href="../comp" class="nav-link <?php echo $name == 'comp' ? 'active': '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>ข้อมูลบริษัท</p>
            </a>
		  </li>
          <li class="nav-item">
            <a href="../stores" class="nav-link <?php echo $name == 'stores' ? 'active': '' ?>">
              <i class="fas fa-store nav-icon"></i>
              <p>ข้อมูลสินค้า</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../news" class="nav-link <?php echo $name == 'news' ? 'active': '' ?>">
              <i class="fa fa-newspaper nav-icon"></i>
              <p>ข่าวประชาสัมพันธ์</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../payment" class="nav-link <?php echo $name == 'payment' ? 'active': '' ?>">
            <i class="far fa-credit-card nav-icon"></i>
              <p> รายการสั่งซื้อ</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="../logs" class="nav-link <?php echo $name == 'logs' ? 'active': '' ?>">
              <i class="fas fa-chalkboard-teacher nav-icon"></i>
              <p>User Logs</p>
            </a>
          </li>


<!--           <li class="nav-item">
            <a href="../pr_approve" class="nav-link <?php echo $name == 'pr_approve' ? 'active': '' ?>">
              <i class="fas fa-clipboard-check nav-icon"></i>
              <p>อนุมัติคำสั่งซื้อ</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../download_doc" class="nav-link <?php echo $name == 'download_doc' ? 'active': '' ?>">
            <i class="fa fa-arrow-circle-down nav-icon"></i>
              <p>ดาวน์โหลดเอกสาร</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../sale_report" class="nav-link <?php echo $name == 'sale_report' ? 'active': '' ?>">
            <i class="fas fa-bars nav-icon"></i>
              <p>รายงาน</p>
            </a>
          </li>



          <li class="nav-item">
            <a href="../po_detail" class="nav-link <?php echo $name == 'po_detail' ? 'active': '' ?>">
            <i class="fa fa-bell nav-icon"></i>
              <p>คำสั่งซื้อ</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="../upload_doc" class="nav-link <?php echo $name == 'upload_doc' ? 'active': '' ?>">
            <i class="fa fa-arrow-circle-up nav-icon"></i>
              <p>อัพโหลดเอกสาร</p>
            </a>
          </li> -->
  





            
          <!-- dropdown -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-cog fa-lg"></i>
              <p>
                ตารางอื่นๆ
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../orders" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>ตารางคำสั่งซื้อ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../order_detail" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>รายละเอียดคำสั่งซื้อ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../product_tag" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>หมวดสินค้า</p>
                </a>
              </li>
            </ul>



          </li>

          <!-- <li class="nav-header dropdown">Account Settings</li> -->
<div class="sidebar-footer"><li class="nav-item">
          <a href="../dashboard/logout.php" class="nav-link">
              <!-- <i class="fas fa-sign-out-alt"></i> -->
              <p>ออกจากระบบ</p>
            </a>
          </li>
</div>

          <!-- dropdown -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>


    <!-- /.sidebar -->
</aside>

<script>
  setTimeout(function(){
	  $('.main-sidebar').css('min-height','573px');
  },2000)
</script>
