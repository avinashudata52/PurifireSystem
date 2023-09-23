<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.php" class="brand-link">
      <img src="img/favicon.png" alt="Water Purifier" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Water Purifier</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    	<div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
		  <?php 
		  $uId=$_SESSION['logId'];
		  include('lib/function.php');
		  $qry="SELECT uname FROM login_tbl WHERE id='$uId'";
		  $st=$conn->prepare($qry);
		  $st->execute();
		  $row=$st->fetch(PDO::FETCH_ASSOC);
		  $usernm=$row['uname'];
		  echo strtoupper($usernm);
		  ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="admin.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="items.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main Item</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="party_entry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Party Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="purchase_customer_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Party Master</p>
                </a>
              </li>
              <!--<li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Firm Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="party_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Party Master</p>
                </a>
              </li>-->
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="purchase_entry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="purchase_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="purchase_remain_amt_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Remaining Amt. Master</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stock_entry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stock_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Master</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sale
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sale_entry.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sale_master.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sale_remain_amt_list.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Remaining Amt. Master</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Receipt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Receipt Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Receipt Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Receipt Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Receipt Register</p>
                </a>
              </li>
            </ul>
          </li>-->
          
          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale Ledger Stmt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Ledger Stmt</p>
                </a>
              </li>
            </ul>
          </li>-->
          
          
           
           <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fas fa-lock nav-icon"></i>
              <p>Logout</p>
            </a>
           </li>
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>