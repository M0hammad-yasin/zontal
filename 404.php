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
<?php // Include Header ?>
<?php include("includes/header.php") ?>
<?php // Include Main Header ?>
<?php include("includes/main-h.php") ?>
<?php // Body Start ?>
<body class="bg-dark dark:bg-[#121317]">
<div class="container-zon flex justify-center items-center h-[80vh] flex-col">
<h1 class="text-9xl font-bold text-red-500">404</h1>
    <h2 class="text-2xl font-semibold mt-4">Oops! Page Not Found</h2>
    <p class="mt-4 text-gray-600">Sorry, the page you are looking for doesn't exist.</p>
    <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'index.php'; ?>" 
       class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        Go Back Home
    </a>
</div>
</body>
<?php // Body End ?>
