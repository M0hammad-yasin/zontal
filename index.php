<?php
// +------------------------------------------------------------------------+
// | @author: MvnThemes
// | @name: Zontal - The Arcade Online HTML5 Game Playing Platform
// | @author_email: mvk62015@gmail.com   
// | @version: 1.0v
// +------------------------------------------------------------------------+
// | Zontal - The Arcade Online HTML5 Game Playing Platform
// | Copyright (c) 2017 Zontal. All rights reserved.
// 
?>
<?php // include Header 
?>
<?php include("includes/header.php") ?>

<?php // Getting Total Categories 
?>
<?php
$run = mysqli_query($con, "select * from zon_category");
$count = mysqli_num_rows($run);
?>
<?php // Body Start 
?>

<body class="bg-dark dark:bg-[#121317]">
    <?php // include Main Header 
    ?>
    <?php include("includes/main-h.php") ?>
    <?php
    // Categories Container (Sidebar)
    ?>
    <?php
    // Categories Container (Sidebar)
    ?>
    <div class="flex mt-4">
        <!-- Sidebar (Categories) -->
        <div class="sidebar w-1/5 bg-gray-200 dark:bg-zinc-800 p-1 rounded-md shadow-md">
            <h3 class="text-xl px-3 pt-3 font-semibold text-gray-700 dark:text-white mb-4">Game Categories</h3>
            <div class="cat-item-container flex flex-col">
                <?php
                $run = mysqli_query($con, "select * from zon_category");
                while ($row = mysqli_fetch_assoc($run)) {
                ?>
                    <a href="<?php echo $site_url ?>game/<?= $row['slug'] ?>"
                        class="transition duration-300 hover:bg-blue-600 hover:text-gray-100 text-gray-600 dark:text-gray-300 dark:bg-[#1b1d22] dark:hover:bg-zinc-700 text-sm rounded-md bg-gray-200">
                        <?= $row['name'] ?>
                    </a>
                <?php } ?>
            </div>
        </div>

        <!-- Main Content (Game Cards) -->
        <div class="main-content w-4/54 ml-4">
            <article class="grid">
                <?php
                $run_d = mysqli_query($con, "select * from zon_games order by id desc limit 1,63");
                while ($row = mysqli_fetch_assoc($run_d)) {
                    // Validate game name length before displaying the card
                    $game_name = $row['game_name'];
                    if (strlen($game_name) > 20) {
                        continue; // Skip the game if the name exceeds 20 characters
                    }
                ?>
                    <a href="single/<?= $row['id'] ?>/<?php
                                                        $text = $row['game_name'];
                                                        $lower = strtolower($text);
                                                        $revspace = str_replace(" ", "-", $lower);
                                                        echo $revspace;
                                                        ?>"
                        title="<?= $row['game_name'] ?> - Play Now"
                        class="card-info bg-gray-200 hover:bg-gray-300 transition duration-300 box rounded-xl shadow-md hover:shadow-lg overflow-hidden">
                        <!-- Game Image -->
                        <div class="card-body relative w-full h-40 overflow-hidden rounded-t-xl">
                            <img src="<?= $row['game_image_url'] ?>"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                alt="Image of <?= $row['game_name'] ?>">
                        </div>

                        <!-- Game Info Section -->
                        <div class="relative w-full py-2 px-2 rounded-b-xl flex flex-col justify-between">
                            <!-- Game Name -->
                            <h2 class="text-black py-4 font-semibold text-base text-center transition duration-300 group-hover:text-blue-600">
                                <?= $row['game_name'] ?>
                            </h2>

                            <!-- Bottom Section: Category and Played Count -->
                            <div class="flex justify-between items-center w-full px-2 mt-auto">
                                <!-- Game Category -->
                                <span class="text-sm text-gray-600 truncate">
                                    <?= $row['game_category'] ?>
                                </span>

                                <!-- Game Played Count -->
                                <span class="flex items-center bg-blue-500 text-white px-2 py-0.5 rounded-full text-xs">
                                    <img class="w-3 h-3 mr-1"
                                        src="./static/img/assets/played-icon.png"
                                        alt="Played icon for <?= $row['game_name'] ?>">
                                    <p class="font-normal text-xs"><?= number_format($row['game_played']) ?></p>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </article>

            <?php // Start Advertisement Area No. 1 
            ?>
            <?php
            $run = mysqli_query($con, "select * from zon_ads limit 1,1");
            while ($row = mysqli_fetch_assoc($run)) {
            ?>
                <?php if ($row['status'] == 0) { ?>
                    <div class="advertisement flex mt-6 relative overflow-hidden justify-center ">
                        <div class="banner">
                            <?= $row['code'] ?>
                        </div>
                    </div>
            <?php }
            } ?>
            <?php // End Advertisement Area No. 1 
            ?>

            <div class="category-title-container">
                <?php
                // Fetch all categories from the database
                $category_query = mysqli_query($con, "SELECT * FROM zon_category");

                // Loop through each category
                while ($category = mysqli_fetch_assoc($category_query)) {
                    $category_name = $category['name'];
                    $category_slug = $category['slug']; // Assuming 'slug' is the unique identifier for categories
                ?>
                    <!-- Category Title -->
                    <div class="category-title-container mb-6">
                        <h3 class="category-title text-2xl font-bold mb-4"><?= $category_name ?> Games</h3>
                    </div>

                    <!-- Category Games -->
                    <article class="grid">
                        <?php
                        // Fetch games for the current category
                        $game_query = mysqli_query($con, "SELECT * FROM zon_games WHERE game_category = '$category_slug' ORDER BY id DESC LIMIT 54");

                        // Loop through each game in the category
                        while ($row = mysqli_fetch_assoc($game_query)) {
                            $game_name = $row['game_name'];
                            $game_id = $row['id'];
                            $game_image_url = $row['game_image_url'];
                            $game_played = $row['game_played'];
                            $game_category = $row['game_category'];

                            // Validate game name length before displaying the card
                            if (strlen($game_name) > 20) {
                                continue; // Skip the game if the name exceeds 20 characters
                            }

                            // Generate the game URL using slug-friendly format
                            $game_slug = strtolower(str_replace(" ", "-", $game_name));
                            $game_url = "single/{$game_id}/{$game_slug}";
                        ?>
                            <a href="<?= $game_url ?>" title="<?= $game_name ?> - Play Now" class="card-info bg-gray-200 hover:bg-gray-300 transition duration-300 box rounded-xl shadow-md hover:shadow-lg overflow-hidden">
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
                        <?php
                        }
                        ?>
                    </article>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php // Include Footer 
    ?>
    <?php include("includes/footer.php") ?>

</body>
<?php // Body End 
?>

</html>