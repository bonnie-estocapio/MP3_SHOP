<?php

require_once 'includes/autoload.php';

session_start();

$functions = new Functions;
$tracks = new Track;
$guest = $functions->state();
?>

<?php include 'templates/header.php'; ?>
<title>Shop - Music Locker</title>
</head>

<body>
    <!-- Navigation -->
<?php include 'templates/navbar.php'; ?>

    <!-- Page Content -->
    
    <div class="container">
        <div class="search">
            <form method="post">
                <input type="text" name="searchtext" placeholder="Search here">
                <input type="radio" name="category" value="title"> Title
                <input type="radio" name="category" value="artist"> Artist
                <input type="radio" name="category" value="album"> Album 
                <input type="radio" name="category" value="year"> Year
                <input type="radio" name="category" value="genre"> Genre
                <input type="submit" name="search" value="search">
            </form>
        </div>
        <div class="row">

            <div class="col-md-9">
                <div class="row">

                    <!-- TRACK 1 -->
                    <?php
                    if (!isset($_POST['search'])) {
                        $tracks->all();
                    } elseif (isset($_POST['search']) && isset($_POST['category'])) {
                        if ($_POST['category'] === 'title') {
                            $tracks->search($_POST['searchtext'], 'title');
                        } elseif ($_POST['category'] === 'artist') {
                            $tracks->search($_POST['searchtext'], 'artist');
                        } elseif ($_POST['category'] === 'album') {
                            $tracks->search($_POST['searchtext'], 'album');
                        } elseif ($_POST['category'] === 'genre') {
                            $tracks->search($_POST['searchtext'], 'genre');
                        } elseif ($_POST['category'] === 'year') {
                            $tracks->search($_POST['searchtext'], 'year');
                        }
                    } elseif (isset($_POST['search']) && !isset($_POST['category'])) {
                        echo
                        "
                        <script>
                        alert('Category not Set');
                        </script>
                        ";
                        $tracks->all();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <hr>
<?php include 'templates/footer.php'; ?>