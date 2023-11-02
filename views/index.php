<?php
// define the title of the page
$title = "Home";

// include the config file from the root folder
require_once '../config.php';

// Connect to MongoDB

$trainingPrograms = $trainingProgramCollection->getAllTrainingPrograms();

// $collection = $db_handle->selectCollection('TrainingPrograms');

// // Fetch the first three training programs
// $trainingPrograms = $collection->find([], ['limit' => 3]);

// include the header files from the includes folder
include VIEWS . '/includes/userHeader.php';
?>

<header class="masthead" style="background: url(&quot;assets/img/never.jpg&quot;) top / cover;filter: blur(0px);margin-top: 52px;height: 662px;">
    <div class="container">
        <div class="intro-text" style="--bs-primary: #0236F0;--bs-primary-rgb: 2,54,240;padding-top: 238px;">
            <div class="intro-lead-in"><span class="text-center" style="font-size: 97px;"></span></div>
            <div class="intro-heading text-uppercase"><span></span></div>
        </div>
    </div>
</header>
<section id="services" style="padding-top: 49px;">
    <h1 class="text-center" style="margin-bottom: 21px;">Discover Our Cutting-Edge Training Products</h1>
    <div class="container">
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary" onclick="searchPrograms()">search</button>
            </div>
    </div>
    <div class="container" style="margin-top: 22px;">
    <div class="card-group">
    <?php 
    $counter = 0;
    foreach ($trainingPrograms as $program): 
        if($counter == 3) break;
    ?>
        <div class="card" style="margin-right: 20px;">
            <img class="card-img-top w-100 d-block" src="assets/img/<?php echo $program->getTrainingProgramImagePath(); ?>"></img>
            <div class="card-body">
                <h4 class="card-title"><?php echo $program->getTrainingProgramName(); ?></h4>
                <p class="card-text"><?php echo $program->getTrainingProgramDescription(); ?></p>
                <a href="trainingSpecific.php?id=<?php echo $program->getTrainingProgramID(); ?>" class="btn btn-primary" style="background: rgb(30,54,240);">Learn More</a>
            </div>
        </div>
    <?php 
        $counter++;
    endforeach; 
    ?>
</div>

    </div>
</section>
<section id="contact" style="background-image: url('assets/img/map-image.png');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-uppercase section-heading">Contact Us</h2>
                <h3 class="text-muted section-subheading">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="contactForm" name="contactForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3"><input class="form-control" type="text" id="name" placeholder="Your Name *" required=""><small class="form-text text-danger flex-grow-1 lead"></small></div>
                            <div class="form-group mb-3"><input class="form-control" type="email" id="email" placeholder="Your Email *" required=""><small class="form-text text-danger lead"></small></div>
                            <div class="form-group mb-3"><input class="form-control" type="tel" placeholder="Your Phone *" required=""><small class="form-text text-danger lead"></small></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3"><textarea class="form-control" id="message" placeholder="Your Message *" required=""></textarea><small class="form-text text-danger lead"></small></div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div><button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit" style="--bs-primary: #0236f0;--bs-primary-rgb: 2,54,240;background: rgb(2,54,240);border-style: none;">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.reflowhq.com/v2/toolkit.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/agency.js"></script>
<script type="text/javascript" src="script.js"></script>
<script>
function searchPrograms() {
    const searchInput = document.querySelector('input[type="search"]');
    const query = searchInput.value;
    fetch(`../controllers/search.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        });
    }

    function displaySearchResults(data) {
    const cardGroup = document.querySelector('.card-group');
    cardGroup.innerHTML = '';

    data.forEach(program => {
        const card = `
            <div class="card" style="margin-right: 20px;">
                <img class="card-img-top w-100 d-block" src="assets/img/${program.trainingProgramImagePath}">
                <div class="card-body">
                    <h4 class="card-title">${program.trainingProgramName}</h4>
                    <p class="card-text">${program.trainingProgramDescription}</p>
                    <a href="trainingSpecific.php?id=${program.trainingProgramID}" class="btn btn-primary" style="background: rgb(30,54,240);">Learn More</a>
                </div>
            </div>
        `;
        cardGroup.innerHTML += card;
    });
}
</script>

<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';