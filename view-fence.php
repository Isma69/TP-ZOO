<?php
require_once('config/autoload.php');

$db = new PDO('mysql:host=127.0.0.1;dbname=zoo;charset=utf8', 'root');
$employee = new Employee($db);

// Get the fence ID from the URL parameter
if (isset($_GET['fence_id'])) {
    $fenceId = $_GET['fence_id'];
    $fence = $employee->findFenceById($fenceId);
    $animals = $employee->findAnimalsByFenceId($fenceId);
} else {
    // Redirect back to the fences page if no fence ID is provided
    header("Location: fences.php");
    exit();
}
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
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="index.php">Africa Zoo</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <h2>Fence Details</h2>
        <div class="fence-info">
            <p>Fence Type: <?php echo $fence->getFenceType(); ?></p>
            <p>Filthy: <?php echo $fence->isFilthy() ? 'Yes' : 'No'; ?></p>
            <p>Number of Animals: <?php echo $fence->getNumberOfAnimal(); ?>/<?php echo $fence->getMaxCapacity(); ?></p>
        </div>
        
        <h2>Animals in this Fence</h2>
        <div class="row">
            <?php foreach ($animals as $animal): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $animal->getAvatar(); ?>" class="card-img-top" alt="Avatar">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $animal->getSpeciesName(); ?></h5>
                            <p class="card-text">Species: <?php echo $animal->getSpeciesType(); ?></p>
                            <p class="card-text">Status: <?php echo $animal->isHungry() ? 'Hungry' : 'Not Hungry'; ?>, <?php echo $animal->isSleep() ? 'Sleeping' : 'Not Sleeping'; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>