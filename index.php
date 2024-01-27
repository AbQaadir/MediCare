<?php
require_once 'header.php';
require_once 'config/config-session.php';

try {
    require_once 'config/db.inc.php';
    require_once 'config/models/upload.model.php';

    $categories = ["Promotion", "Heart", "Eyes", "PersonalCare", "Diabetes"];

    // Loop through the categories and set session variables for each
    foreach ($categories as $category) {
        $_SESSION[$category] = getProducts($pdo, $category);
    }

    require_once 'config/views/upload.view.php';
} catch (PDOException $e) {
    die("Could not connect. " . $e->getMessage());
}
?>


<?php
require_once 'hero.php';
?>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane active" id="man" role="tabpanel">
        <h1>
            <ul>Promotions</ul>
        </h1>
        <div class="tab-single">
            <div class="row">
                <?php showAllPromotion(); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="women" role="tabpanel">
        <h1>
            <ul>Eye</ul>
        </h1>
        <div class="tab-single">
            <div class="row">
                <?php showAllEyes(); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="kids" role="tabpanel">
        <h1>
            <ul>Heart</ul>
        </h1>
        <div class="tab-single">
            <div class="row">
                <?php showAllHeart(); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="accessories" role="tabpanel">
        <h1>
            <ul>Diabetes</ul>
        </h1>
        <div class="tab-single">
            <div class="row">
                <?php showAllDiabetes(); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="essential" role="tabpanel">
        <h1>
            <ul>Personal Care</ul>
        </h1>
        <div class="tab-single">
            <div class="row">
                <?php showAllPersonalCare(); ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
</body>

</html>