  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><i class="fa fa-bolt"></i><strong>MICRO POI TSEL</strong></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="fa fa-home"></i> DASHBOARD <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="index.php">DASHBOARD UTAMA</a></li>
                <li><a href="to_do_list.php">TO DO LIST</a></li>
                <li><a href="sitak.php">SITAC</a></li>
                <li><a href="progress.deployment.php">PROGRESS DEPLOYMENT</a></li>
              </ul>
            </li>
            <li class="dropdown" style="display: <?php 
                if($_SESSION['privilege']!=8) 
                        echo "none";
                else echo "visible";
                    ?>">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="fa fa-pencil"></i>MANAGE USER<span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="detil.user.php">LIST USER</a></li>
                <li><a href="input.user.php">CREATE USER</a></li>
              </ul>
            </li>
            <li class="dropdown">
                <form name="formSearch" method="POST" action="search.php"> 
                  <div class="col-md-10" id="input-search"><input tipe="text" class="form-control input-sm" name="search_data" id="data" placeholder="search"/></div>
                  <div class="col-md-1" id="but-search"><input type="submit" class="btn btn-danger btn-sm" name="submit" value="SEARCH"></div>
                </form>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </div>
<style>
    #but-search{
        margin: 5% 0 0 0;
    }
    #input-search{
        margin: 5% -10% 5% 5%;
    }
</style>