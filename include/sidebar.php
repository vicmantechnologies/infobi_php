<style>
  .ops-side{
    width: 201px; 

  }
  @media (min-width: 414px) {
      
   }
</style>

<script>
  function mostrar() {
      // document.getElementById("left-sidebar").style.width = "300px";
      // document.getElementById("left-sidebar").style.marginLeft = "300px";
      console.log(document.getElementById("left-sidebar").style)
      document.getElementById("left-sidebar").style.display = "none";
      document.getElementById("left-sidebar").style.display = "inline";
  }

  function menuLateral() {
      if (document.getElementById("left-sidebar").style.display == 'none') {
        document.getElementById("left-sidebar").style.display = "inline";
      } else {
        document.getElementById("left-sidebar").style.display = "none";
      }
  }
  
  function ocultar() {
      // document.getElementById("left-sidebar").style.width = "0";
      // document.getElementById("left-sidebar").style.marginLeft = "0";
      document.getElementById("left-sidebar").style.display = "inline";
      document.getElementById("left-sidebar").style.display = "none";
  }
  
  </script>
<aside class="left-sidebar" id= "left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav id="sidebarnav" class="sidebar-nav">
                <ul class=" nav-tabs barra " >
                    <!-- <li class="active ops-side "><a class="nav-title" data-toggle="tab" href="#home">Home <i class="fa fa-home"></i></a></li> -->
                    <li class="active ops-side "><a class="nav-title" data-toggle="tab" href="#home"><i class="fa fa-home"></i> <span>Home</span></a></li>
                    <li class="dropdown ">
                        <a class="dropdown-toggle nav-title" data-toggle="dropdown" href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <?php foreach($resultado as $r): ?>
                            <li><a style="color: black" class="nav-title" data-toggle="tab" href="#<?php echo str_replace(" ","_", $r["nombre_iframe"]); ?>"><i class="fa fa-file"></i><?php echo $r["nombre_iframe"]; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php  if($_SESSION["perfil"] == 1):  ?>
                    <li><a class="nav-title " data-toggle="tab" href="#usuarios" onclick="GetUsers()"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
                    <?php  endif; ?>                    
                </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
</aside>
