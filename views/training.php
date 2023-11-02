<?php
$title = "Training Programs";
require_once '../config.php';

include VIEWS . '/includes/userHeader.php';

$trainingPrograms = $trainingProgramCollection->getAllTrainingPrograms();

?>

<section>
<div class="row mb-5" style="margin-bottom: 23px;padding-bottom: 0px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 style="font-size: 57px;">Training</h1>
                </div>
            </div>
    <div>
        <div class="row" data-masonry="{&quot;percentPosition&quot;: true }">
            <?php foreach ($trainingPrograms as $program): ?>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <img class="card-img-top p-3" src="assets/img/<?php echo $program->getTrainingProgramImagePath(); ?>" alt="Training Program Image" style="border-radius: 24px;object-fit: cover;" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $program->getTrainingProgramName(); ?><br /></h5>
                        <p class="card-text text-muted"><?php echo $program->getTrainingTutorName(); ?><br /></p>
                        <a href="trainingSpecific.php?id=<?php echo $program->getTrainingProgramID(); ?>" class="btn btn-primary" style="background: rgb(30,54,240);">Learn More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';
?>
