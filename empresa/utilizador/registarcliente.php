<!DOCTYPE html>
<html lang="en">
<!--Perfil do User-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="perfil">
  <meta name="author" content="Tiago Moura">

  <title>Registar Cliente</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/thumbnail-gallery.css" rel="stylesheet">

  <!-- Responsive CSS -->
  <link href="css/responsive.css" rel="stylesheet"> 

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
  <?php require('topfooter.php');?>
  <h1 align="center">Clientes</h1>
  <hr>
  <div class="container" style="margin-top: 70px;margin-right:250px;">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Registo</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="registarcliente.php">
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nome Fiscal*</label> 
                    <div class="col-8">
                      <input id="nome_fiscal" placeholder="Nome Fiscal" class="form-control here" required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Nome Comercial*</label> 
                    <div class="col-8">
                      <input id="nome_comercial" placeholder="Nome Comercial" class="form-control here" type="text" required="required">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="select" class="col-4 col-form-label">Tipo*</label> 
                    <div class="col-8">
                      <select id="tipo" name="tipo" class="custom-select" required="required">
                        <option value="Farmácia">Farmácia</option>
                        <option value="Parafarmácia"">Parafarmácia</option>
                        <option value="Ouriversaria"">Ouriversaria</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Morada*</label> 
                    <div class="col-8">
                      <input id="morada" placeholder="Morada" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Localidade</label> 
                    <div class="col-8">
                      <input id="localidade" placeholder="Localidade" class="form-control here" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Código-Postal</label> 
                    <div class="col-8">
                      <input id="codigo_postal" placeholder="Código Postal" class="form-control here" type="int" maxlength="8">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">NIF*</label> 
                    <div class="col-8">
                      <input id="num_fiscal" placeholder="Número de Identificação Fiscal" class="form-control here" required="required" type="int" maxlength="9">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Telefone*</label> 
                    <div class="col-8">
                      <input id="num_telefone"  placeholder="Número de Telefone" class="form-control here" required="required" type="password">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Email*</label> 
                    <div class="col-8">
                      <input id="email" placeholder="Email" class="form-control here" type="email" required="required">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-4 col-8">
                      <button name="add_user" type="submit" class="btn btn-primary">Adicionar Cliente</button>
                    </div>
                  </div>
                  <hr>
                  <strong>*Campos obrigatórios</strong>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>