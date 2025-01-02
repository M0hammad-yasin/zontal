<?php
require_once('../config.php');

$page = $_POST['page'] ?? 1;
$limit = 30;
$row = ($page - 1) * $limit;

$name = $_POST['name']; // Category name from the POST request
// Ready Query by Category Name
$query = "SELECT * FROM zon_games WHERE game_category = '$name' ORDER BY id DESC LIMIT $row, $limit";
$run = mysqli_query($con, $query);
$games = mysqli_fetch_all($run, MYSQLI_ASSOC); // Fetch the data as an associative array

foreach ($games as $game) {
    $game_id = $game['id'];
    $game_name = $game['game_name'];
    $game_image_url = $game['game_image_url'];
    $game_category = $game['game_category'];
    $game_played = $game['game_played'];

    // Generate the URL slug for the game
    $slug = strtolower(str_replace(" ", "-", $game_name));
?>
    <a href="<?php echo $site_url ?>single/<?= $game_id ?>/<?= $slug ?>" title="<?= $game_name ?> - Play Now" class="card-info bg-gray-200 hover:bg-gray-300 transition duration-300 box rounded-xl shadow-md hover:shadow-lg overflow-hidden">
        <!-- Game Image -->
        <div class="card-body relative w-full h-40 overflow-hidden rounded-t-xl">
            <img src="<?= $game_image_url ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" alt="Image of <?= $game_name ?>">
        </div>

        <!-- Game Info Section -->
        <div class="relative w-full py-2 px-2 rounded-b-xl flex flex-col justify-between">
            <!-- Game Name -->
            <h2 class="text-black py-4 font-semibold text-base text-center transition duration-300 group-hover:text-blue-600">
                <?= $game_name ?>
            </h2>

            <!-- Bottom Section: Category and Played Count -->
            <div class="flex justify-between items-center w-full px-2 mt-auto">
                <!-- Game Category -->
                <span class="text-sm text-gray-600 truncate">
                    <?= $game_category ?>
                </span>

                <!-- Game Played Count -->
                <span class="flex items-center bg-blue-500 text-white px-2 py-0.5 rounded-full text-xs">
                    <img class="w-3 h-3 mr-1" src="./static/img/assets/played-icon.png" alt="Played icon for <?= $game_name ?>">
                    <p class="font-normal text-xs"><?= number_format($game_played) ?></p>
                </span>
            </div>
        </div>
    </a>
<?php } ?>