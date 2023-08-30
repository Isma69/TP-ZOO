<?php
require_once('config/autoload.php');

$db = new PDO('mysql:host=127.0.0.1;dbname=zoo;charset=utf8', 'root');
$employee = new Employee($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFence = new Fence();
    $newFence->setFenceType($_POST['fenceType']);
    $newFence->setFilthy(isset($_POST['filthy']));
    $newFence->setNumberOfAnimal(intval($_POST['numberOfAnimal']));

    $employee->addFence($newFence);

    // Refresh the page to display the updated list
    header("Location: fences.php");
    exit();
}

// Example of retrieving all fences

$fences = $employee->findAllFences();
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
            <a class="navbar-brand mx-auto" href="#">Africa Zoo</a>
        </div>
    </nav>
</header>

<main>
    <div class="container">
        <h2>Add New Fence</h2>
        <form method="post">
            <div class="mb-1">
                <label for="fencesType" class="form-label">Pick a fence :</label>
                <select id="fencesType" name="fenceType" class="form-select">
                    <option value="Meadow">Meadow</option>
                    <option value="FlyCage">FlyCage</option>
                    <option value="PondFence">PondFence</option>
                </select>
            </div>
            <label for="filthy">Filthy:</label>
            <input type="checkbox" name="filthy" id="filthy"><br>
            <button type="submit">Add Fence</button>
        </form>
    </div>
</main>

<div class="container">
    <h2>Fences</h2>
    <ul>
    <?php foreach ($fences as $fence): ?>
            <li>
                <div class="fence-info">
                    <div class="fence-image">
                        <img src="<?php echo $fence->getPicture(); ?>" alt="<?php echo $fence->getFenceType(); ?>">
                    </div>
                    <div class="fence-details">
                        <p>Fence Type: <?php echo $fence->getFenceType(); ?></p>
                        <p>Filthy: <?php echo $fence->isFilthy() ? 'Yes' : 'No'; ?></p>
                        <p>Number of Animals: <?php echo $fence->getNumberOfAnimal(); ?>/<?php echo $fence->getMaxCapacity(); ?></p>
                        <a href="view-fence.php?fence_id=<?php echo $fence->getId(); ?>" class="btn btn-primary">Visiter l'enclos</a>
                    </div>
                </div>
                <hr>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</main>

<footer>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>