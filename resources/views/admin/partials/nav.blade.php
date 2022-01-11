    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">Navegacion</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{request()->is('admin')? 'active': ''}}" ><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> <span>Inicio</span></a></li>
               
        
        
        <li class="treeview {{request()->is('empleados*', 'puestos*','destinos_pedidos*','tipos_localidad*','localidades*','unidades_medida*','categorias_insumos*','insumos*', 'productos*', 'categorias_menus*', 'recetas*', 'cajas*')? 'active': ''}}">
          <a href="#"><i class="fa fa-book"></i> <span>Catalogos Generales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="{{request()->is('destinos')? 'active': ''}}"><a href="{{route('destinos.index')}}"> 
              <i class="fa fa-eye"></i>Destinos</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('empleados')? 'active': ''}}"><a href="{{route('empleados.index')}}"> 
              <i class="fa fa-eye"></i>Empleados/Pilotos</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('empresas')? 'active': ''}}"><a href="{{route('empresas.index')}}"> 
              <i class="fa fa-eye"></i>Empresas</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('oficinas')? 'active': ''}}"><a href="{{route('oficinas.index')}}"> 
              <i class="fa fa-eye"></i>Oficinas</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('vehiculos')? 'active': ''}}"><a href="{{route('vehiculos.index')}}"> 
              <i class="fa fa-eye"></i>Vehículos</a>
            </li>  
          </ul>

        </li>

        <li class="treeview {{request()->is('empleados*', 'puestos*','destinos_pedidos*','tipos_localidad*','localidades*','unidades_medida*','categorias_insumos*','insumos*', 'productos*', 'categorias_menus*', 'recetas*', 'cajas*')? 'active': ''}}">
          <a href="#"><i class="fa fa-book"></i> <span>Control de Guias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.index')}}"> 
              <i class="fa fa-eye"></i>Crear Guías</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('envios')? 'active': ''}}"><a href="{{route('envios.index')}}"> 
              <i class="fa fa-eye"></i>Crear Envío de Guías</a>
            </li>  
          </ul>

          <!-- <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Enviar Guías a Oficina</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Recibir Guías</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Enviar Guías a Departamento</a>
            </li>  
          </ul> -->

        </li>



        <li class="treeview {{request()->is('users*')? 'active': ''}}">
          <a href="#"><i class="fa fa-users"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li class="{{request()->is('reportes')? 'active': ''}}"><a href="{{route('guias.rpt_guias')}}"> 
              <i class="fa fa-eye" ></i>Guías por Fecha</a>
            </li>  
          </ul>

          

          <!-- <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Guías por Tipo de Cobro</a>
            </li>  
          </ul>   
          
          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Guías por Vehículo y Fecha</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Listado de Guías por Destino</a>
            </li>  
          </ul>

          <ul class="treeview-menu">
            <li class="{{request()->is('guias')? 'active': ''}}"><a href="{{route('guias.gestion')}}"> 
              <i class="fa fa-eye"></i>Total Recibido por Fecha</a>
            </li>  
          </ul> -->

        </li>



        @role('Super-Administrador|Administrador')
        <li class="treeview {{request()->is('users*')? 'active': ''}}">
          <a href="#"><i class="fa fa-users"></i> <span>Gestion Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{request()->is('users')? 'active': ''}}"><a href="{{route('users.index')}}"> 
              <i class="fa fa-eye"></i>Usuarios</a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#modalResetPassword"><i class="fa fa-lock-open"></i>Cambiar contraseña</a>             
            </li>

          </ul>          
        </li>
        @endrole

        @role('Super-Administrador')

        <li class="treeview {{request()->is('negocio*')? 'active': ''}}">
            <a href="#"><i class="fa fa-building"></i> <span>Mi Negocio</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
  
            <ul class="treeview-menu">
              <li class="{{request()->routeIs('negocio.edit')? 'active': ''}}"><a href="{{route('negocio.edit', 1)}}"> 
                <i class="fa fa-edit"></i>Editar Mi Negocio</a>
              </li>  
            </ul>
        </li>
        @endrole
        
        
    </ul>

    <!-- /.sidebar-menu -->