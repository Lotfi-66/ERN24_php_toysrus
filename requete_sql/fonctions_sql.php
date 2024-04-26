<?php

function get_all_toys()
{
  //on expose $connexion
  global $connexion;
  //on crée la requete
  $query = 'SELECT * FROM `toys`';
  //on execute la requete
  if ($result = mysqli_query($connexion, $query)) {
    //on vérifie que l'on a des resultats
    if (mysqli_num_rows($result) > 0) {
      //on peut parcourir les résultats
      while ($toy = mysqli_fetch_assoc($result)) {
        render_all_toys($toy);
      }
    }
  }
}
//méthode qui permet de recupérer les marques
function get_brands_with_count()
{
  //on expose $connexion
  global $connexion;
  //on crée la requete
  $query = "SELECT brands.id, brands.name, COUNT(toys.brand_id) AS total
    FROM brands 
    INNER JOIN toys ON brands.id = toys.brand_id 
    GROUP BY brands.id";

  //on execute la requete
  if ($result = mysqli_query($connexion, $query)) {
    //on vérifie que l'on a des resultats
    if (mysqli_num_rows($result) > 0) {
      //on peut parcourir les résultats
      while ($brand = mysqli_fetch_assoc($result)) { ?>
        <li>
          <a class="dropdown-item" href="../brand.php?brand_id=<?php echo $brand['id'] ?>">
            <?php echo $brand['name'] ?> ( <?php echo $brand['total'] ?> )
          </a>
        </li>
     <?php }
    }
  }
}
//méthode qui permet de recupérer un jeu de jouet par son id
function get_toy_by_id($toy_id){
  //on récupère la connexion
  global $connexion;
  //on crée la requete
  $query = "SELECT toys.id, toys.name, toys.price, toys.image, toys.description , brands.name AS brand_name
  FROM `toys` 
  INNER JOIN `brands` ON toys.brand_id = brands.id
  WHERE toys.id = ?";
  //on prépare la requete
  if($stmt = mysqli_prepare($connexion, $query)){
    //on bind les paramètres
    mysqli_stmt_bind_param(
      $stmt,
      "i",
      $toy_id
    );

    //on execute la requete
    if(!mysqli_stmt_execute($stmt)){
      echo "Erreur lors de l'exécution de la requête";
    }

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
      while($toy = mysqli_fetch_assoc($result)){
        render_toy_detail($toy);
      }
    }
  }
}

//méthode qui permet de recupérer les jouets en fonction de la marque
function get_toy_by_brand($brand_id){
  //on expose $connexion
  global $connexion;
  //on crée la requete
  $query = 'SELECT * FROM `toys` WHERE brand_id =?';
  //on execute la requete
  if($stmt = mysqli_prepare($connexion, $query)){
    //on bind les paramètres
    mysqli_stmt_bind_param(
      $stmt,
      "i",
      $brand_id
    );
    //on execute la requete
    if(!mysqli_stmt_execute($stmt)){
      echo "Erreur lors de l'exécution de la requête";
    }

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
      while($toy = mysqli_fetch_assoc($result)){
        render_all_toys($toy);
      }
    }
  }}

