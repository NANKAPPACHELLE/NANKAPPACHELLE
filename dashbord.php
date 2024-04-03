<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion de Transport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: block;
            margin-bottom: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .main-content {
            display: flex;
            margin-bottom: 50px;
        }

        .sidebar {
            flex: 0 0 250px;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .content {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            color: #333;
        }

        .content p {
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1 style="color: #333;">Tableau de Bord - Gestion de Transport</h1>
    </header>

    <section class="main-content">
        <div class="sidebar">
            <nav>
                <ul>
                    <li><a href="#" style="color: #333;">Accueil</a></li>
                    <li><a href="#" style="color: #333;">Élèves</a></li>
                    <li><a href="#" style="color: #333;">Itinéraires</a></li>
                    <li><a href="#" style="color: #333;">Véhicules</a></li>
                    <li><a href="#" style="color: #333;">Chauffeurs</a></li>
                </ul>
            </nav>
        </div>

        <div class="content">
            <h2>Tableau de Bord</h2>
            <div class="summary">
                <a href="eleve.php"><div class="card">
                    <h2>Élèves</h2>
                    <p>Nombre total d'élèves : 250</p>
                </div></a>
                <div class="card">
                    <h2>Itinéraires</h2>
                    <p>Nombre total d'itinéraires : 10</p>
                </div>
                <div class="card">
                    <h2>Véhicules</h2>
                    <p>Nombre total de véhicules : 15</p>
                </div>
                <div class="card">
                    <h2>Chauffeurs</h2>
                    <p>Nombre total de chauffeurs : 12</p>
                </div>
            </div>

            <div class="recent-activities">
                <h2>Activités récentes</h2>
                <ul>
                    <li>Un nouvel itinéraire a été ajouté.</li>
                    <li>L'itinéraire n°5 a été modifié.</li>
                    <li>Le véhicule n°10 est en réparation.</li>
                </ul>
            </div```html
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 École Primaire XYZ - Tous droits réservés</p>
    </footer>
</div>

</body>
</html>