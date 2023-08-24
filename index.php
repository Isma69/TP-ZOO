<?php
require_once('config/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=zoo;charset=utf8', 'root');
$animalManager = new AnimalsManager($db);
// Ajout d'un nouvel animal s'il y a des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avatar = $_POST['avatar'];
    $species_id = $_POST['species_id'];
    $fences_id = $_POST['fences_id'];
    $age = (int) $_POST['age'];

    // Instanciation de la classe correspondante en fonction de l'avatar choisi
    if ($avatar === "images/paon-fiche.jpg") {
        $species_id = 2;
    } elseif ($avatar === "images/fiche-suricate.jpg") {
        $species_id = 3;
    } elseif ($avatar === "images/becouvert.jpg") {
        $species_id = 4;
    } elseif ($avatar === "images/iguane-fiche.jpg") {
        $species_id = 1;
    }

    // Création de l'objet Animal avec les valeurs correctes
    $animal = new Animal([
        'avatar' => $avatar,
        'species_id' => $species_id,
        'fences_id' => $fences_id,
        'age' => $age,
        'sleep' => false,
        'hungry' => false,
        'sick' => false
    ]);
    $animalManager->add($animal);
    header("Location: index.php");
    exit();
}
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="#">Africa Zoo</a>
            </div>
        </nav>
    </header>

    <main>
        <script>
            function updateAvatar() {
                console.log("updateAvatar() called");
                const selectElement = document.getElementById('avatar');
                const selectedAvatar = selectElement.value;
                const avatarImageElement = document.getElementById('avatarImage');
                avatarImageElement.src = selectedAvatar;
            }

            // Appel initial pour afficher l'avatar correspondant à l'option par défaut
            updateAvatar();
        </script>
            <div class="row">
                <div class="col-md-3 mt-1">
                    <!-- Formulaire HTML -->
                    <form method="POST" class="text-center text-dark" id="formAnimal">
                        <h4>Créer votre Animal</h4>
                        <div class="mt-1">
                            <label for="avatar" class="form-label">Choisissez un avatar :</label>
                            <select id="avatar" name="avatar" onchange="updateAvatar()" class="form-select">
                                <option value="images/iguane-fiche.jpg" selected>Iguane</option>
                                <option value="images/paon-fiche.jpg">Paon</option>
                                <option value="images/fiche-suricate.jpg">Suricate</option>
                                <option value="images/becouvert.jpg">Becouvert</option>
                            </select>
                            <img src="images/iguane-fiche.jpg" id="avatarImage" alt="Avatar" class="mt-1"
                                style="max-height: 100px;">
                        </div>
                        <div class="mt-1">
                            <label for="age" class="form-label">Age :</label>
                            <input type="number" id="age" name="age" class="form-control" placeholder="Age">
                        </div>
                        <div class="mb-1">
                            <label for="fences_id" class="form-label">Choisissez une clôture :</label>
                            <select id="fences_id" name="fences_id" class="form-select">
                                <option value="1">Meadow</option>
                                <option value="2">FlyCage</option>
                                <option value="3">PondFence</option>
                            </select>
                        </div>
                        <input type="hidden" id="species_id" name="species_id" value="1">
                        <div class="">
                            <input type="submit" value="Ajouter" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Affichage des animaux -->
                <div class="row" id="cardDisplay">
                <?php
                $db = new PDO('mysql:host=127.0.0.1;dbname=zoo;charset=utf8', 'root');
                $animalManager = new AnimalsManager($db);
                $animals = $animalManager->findAllAnimal();

                foreach ($animals as $animal) {
                    ?>
                    <div class="col-md-2">
                        <div class="card">
                            <img src="<?php echo ($animal->getAvatar()); ?>" class="card-img-top" alt="Avatar"
                                height="120px">
                            <div class="card-body text-center text-primary">
                                <h5 class="card-title">
                                    <?php echo ($animal->getSpeciesName()); ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo ($animal->getSpeciesType()); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
    </main>

    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>

</html>