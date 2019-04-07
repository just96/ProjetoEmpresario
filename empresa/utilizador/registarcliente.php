<!DOCTYPE html>
<html lang="en">
<!--Perfil do User-->
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="perfil">
  <meta name="author" content="Tiago Moura">

  <title>Registar Cliente</title>


  <?php require('topfooter.php');?>

</head>
<body>
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
                        <option value="Parafarmácia">Parafarmácia</option>
                        <option value="Ouriversaria">Ouriversaria</option>
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

</body>

</html>