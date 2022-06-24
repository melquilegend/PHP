
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Painel de Usuarios</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->

<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>
  <body>
    


<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4"> Arco-íres</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
       
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Bem vindo ao sistema da clinica Arco-íres</h1>
      <p class="fs-5 text-muted">Faça login para usar esta ferramenta de gestão medica incrível e garanta a melhor experiência ao seu paciente.</p>
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Paciente</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Marcar consultas </li>
              <li>Ver datas de consultas marcadas</li>
              <li>Relatorio medico</li>
              <li>Receitas</li>
            </ul>
            <a href="paciente/login.php" class="w-100 btn btn-lg btn-success">Login</a>
            
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Medicos</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Adicionar,editar e remarcar consultas</li>
              <li>Adicionar resultado do panciente</li>
              <li>Adiocar receitas para pacientes</li>
            </ul>
            <a href="medico/login.php" class="w-100 btn btn-lg btn-success">Login</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Administrador</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Gestão de pacientes</li>
              <li>Gestão de médicos</li>
              <li>Relatorio do sistema</li>
              <li>Gestão de todo software</li>
            </ul>
            <a href="admin/login.php" class="w-100 btn btn-lg btn-success">Login</a>
          </div>
        </div>
      </div>
    </div>
  </main>

</div>


    
  </body>
</html>
