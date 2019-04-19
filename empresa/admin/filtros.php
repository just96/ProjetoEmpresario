  <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- Filtragem dos dados da tabela-->
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#minhaTabela').DataTable({
        "language": {
          "lengthMenu": "_MENU_ registos por página",
          "zeroRecords": "Nada encontrado",
          "info": "Página _PAGE_ de _PAGES_",
          "infoEmpty": "Nenhum registo disponível",
          "infoFiltered": "(filtrado de _MAX_ registos no total)"
        }
      });
    });
  </script>
