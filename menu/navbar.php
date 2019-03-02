<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0;     background-color: #fbb654">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="color: #333;" href="menu.php">Todo Info</a>
    </div>
    <!-- /.navbar-header -->


    <ul class="nav navbar-top-links navbar-right">
   
        
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #333;">
                <i class="fa fa-user fa-fw"></i>  <strong><?php echo $_SESSION['nick_usu'] ?></strong> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>               
                <li class="divider"></li>
                <li><a href="/TodoInfo/index.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesion</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #333;">
                <i class="fa fa-question-circle"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="/TodoInfo/ayuda.pdf" target="_blank">
                        <div>
                            <i class="fa fa-book"></i> Manual de ayuda
                            
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <?php require 'menu/toolbar.ctp'; ?>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
