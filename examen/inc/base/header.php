<?php 
    if(!isset($page_base)){
        $page_base = './';
    }
?>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#138a3a
">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navdropMain" aria-controls="navdropMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navdropMain">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo $page_base ?>">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $page_base ?>dashboard/usuario/">Clientes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $page_base ?>dashboard/factura/">Facturas</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>