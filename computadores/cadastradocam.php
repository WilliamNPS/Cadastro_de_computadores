<?php

session_start();
include_once('banco/conexao.php');
   if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
   {
       unset($_SESSION['login']);
       unset($_SESSION['senha']);
       header('Location: index.php');
   }

   //Codigo pra registrar os dados 
   $sql ="SELECT * FROM dti ORDER BY id DESC";
   $result = $conexao -> query ($sql);
//////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo/cadastrado.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro CAM</title>
</head>
<body>
<?php
include_once("menu.php");

?>

<div class="pesquisar" >
        <input type="search" class="barra"   placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()"  class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>

  <?php
   //buscar pesquisa 
   if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
         $sql = "SELECT * FROM dti WHERE id LIKE '%$data%' or tombo LIKE '%$data%' or setor LIKE '%$data%'or responsavel LIKE '%$data%' ORDER BY id DESC";
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Registro Encotrado !</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    else
    {

      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Registro não Encotrado !</strong> 
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";

    $sql = "SELECT * FROM dti ORDER BY id DESC";
    }

    $result = $conexao->query($sql);



?>
<table class="table text-white table-bg" >
            <thead >
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Secretária/Setor </th>
                    <th scope="col">Usuário/Função</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Tombo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Observação </th>
                    <th scope="col">Data de Entrada</th>
                    <th scope="col">Editar</th>
                    <th scope="col" >Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['setor']."</td>";
                         echo "<td>".$user_data['responsavel']."</td>";
                        echo "<td>".$user_data['Modelo']."</td>";
                        echo "<td>".$user_data['tombo']."</td>";
                        
                       
                        echo "<td>".$user_data['status']."</td>";
                        echo "<td>".$user_data['observacao']."</td>";
                        echo "<td>".$user_data['data_cadastrato'] = date("d-m-Y")."</td>";
                        echo "<td>  
                        <a   class='editar'  ' href='editar.php?id=$user_data[id]' title='Editar'> 
                        <svg xmlns=http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'class='bi bi-pencil' viewBox='0 0 16 16'>
  <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
</svg>  </a> </td>";  
          echo "
          <td>
          <a  class='deletar' href='delete.php?id=$user_data[id]' title='Deletar'>
          
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
  <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 
  0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
</svg>
          
          </a>

          </td>
          ";
                          echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>


 
 <script>
   var search = document.getElementById('pesquisar');
    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'cadastradocam.php?search='+search.value;
    }
</script>
</body>


</html>

