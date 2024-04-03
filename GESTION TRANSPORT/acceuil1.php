<!DOCTYPE html>
<!-- ========= APPLICATION DE GESTION DU TRANSPORT ========= -->
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Gestion du Transport</title>

    <!-- Montserrat Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <!-- Material Icons -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/fontawesome.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <div class="grid-container">
      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="profile">
            <span class="material-icons-outlined">account_circle</span>
            <h5>Bienvenue,PACHELLE</h5>
          </span>
          <button><span class="material-icons-outlined">email</span></button>
          <button>
            <span class="material-icons-outlined">notifications</span>
          </button>
          <button><span class="material-icons-outlined">search</span></button>
        </div>
        <div class="header-right">
          <span class="logout">
            <form method="post" action="logout.php">
              <button type="submit">
                <h2 class="white">Déconnexion</h2>
                <span class="material-icons-outlined white">logout</span>
              </button>
            </form>
          </span>
        </div>
      </header>
	  
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <div id="gbs"><img src="logo gbs ms.jpg" alt="GBS la différence"></div>
            <img
              src="./images/LOGO_TRANSPORT.jpg"
              alt=""
              width="20"
              height="20"
            />
            <span>Gestion du Transport</span>
          </div>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="#tableau-de-bord">
              <span class="material-icons-outlined">dashboard</span> Tableau de
              bord
            </a>
          </li>
          <!-- Ajouter un lien ici pour les élèves -->
          <li class="sidebar-list-item">
            <a href="#eleve.php">
              <span class="material-icons-outlined">people</span> Élèves
            </a>
          </li>
          <!-- Ajouter un lien ici pour les chauffeurs -->
          <li class="sidebar-list-item">
            <a href="#chauffeur.php">
              <span class="material-icons-outlined">commute</span> Chauffeurs
            </a>
          </li>
          <!-- Ajouter un lien ici pour les itinéraires -->
          <li class="sidebar-list-item">
            <a href="#itineraire.php">
              <span class="material-icons-outlined">map</span> Itinéraires
            </a>
          </li>
          <!-- Ajouter un lien ici pour les véhicules -->
          <li class="sidebar-list-item">
            <a href="#vehicules">
              <span class="material-icons-outlined">directions_bus</span> Véhicules
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <!-- Section Tableau de bord -->
        <div id="tableau-de-bord" class="main-title">
          <h2>Tableau de bord</h2>
        </div>

        <!-- Section Élèves -->
        <div id="eleves" class="main-cards">
          <div class="card">
            <div class="card-inner">
              <h3>ÉLÈVES</h3>
              <span class="material-icons-outlined">add</span>
            </div>
            <h1>0</h1>
          </div>
        </div>

        <!-- Section Chauffeurs -->
        <div id="chauffeurs" class="main-cards">
          <div class="card">
            <div class="card-inner">
              <h3>CHAUFFEURS</h3>
              <span class="material-icons-outlined">add</span>
            </div>
            <h1>0</h1>
          </div>
        </div>

        <!-- Section Itinéraires -->
        <div id="itineraires" class="main-cards">
          <div class="card">
            <div class="card-inner">
              <h3>ITINÉRAIRES</h3>
              <span class="material-icons-outlined">add</span>
            </div>
            <h1>0</h1>
          </div>
        </div>

        <!-- Section Véhicules -->
        <div id="vehicules" class="main-cards">
          <div class="card">
            <div class="card-inner">
              <h3>VÉHICULES</h3>
              <span class="material-icons-outlined">add</span>
            </div>
            <h1>0</h1>
          </div>
        </div>

        <div class="charts">
          <div class="charts-card">
            <h2 class="chart-title">Statistiques des Élèves</h2>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Statistiques des Itinéraires</h2>
          </div>
        </div>
      </main>
      <!-- End Main -->
    </div>

    <!-- JS -->
    <script src="js/scripts.js"></script>
    <script src="./js/fontawesome.js"></script>
  </body>
  <!-- ========= APPLICATION DE GESTION DU TRANSPORT ========= -->
</html>
