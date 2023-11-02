<?php
$title = "Training Programs";
require_once '../config.php';

    // Make sure the id parameter exists in the URL
if (isset($_GET['id'])) {
    $programId = $_GET['id'];
    
    // Create a new TrainingProgramCollection instance

    // Get the specific training program from your database
    $specificProgram = $trainingProgramCollection->getTrainingProgramById($programId);
    $specificProgram->getTrainingProgramName();

} else {
    // Redirect to homepage or show an error if the id parameter doesn't exist
    header('Location: index.php');
}
include VIEWS . '/includes/userHeader.php';

?>

<!-- trainingProgramImagePath -->
<header class="masthead" style="background: linear-gradient(black 7%, var(--bs-border-color-translucent) 100%), url(&quot;assets/img/<?php echo $specificProgram->getTrainingProgramImagePath(); ?>&quot;) top / cover;filter: blur(0px);margin-top: 52px;">
    <div class="container">
        <div class="intro-text" style="--bs-primary: #0236F0;--bs-primary-rgb: 2,54,240;padding-top: 238px;">
            <div class="intro-lead-in"></div>
            <span class="text-center" style="font-size: 101px;font-family: 'Abhaya Libre', serif;"><?php echo $specificProgram->getTrainingProgramName(); ?></span>
            <div class="intro-heading text-uppercase"><span></span></div>
        </div>
    </div>
</header>
    <section id="services" style="padding-top: 49px;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 col-xl-7">
                    <h4 class="text-start section-heading">Description</h4>
                    <p class="text-start text-muted"><?php echo $specificProgram->getTrainingProgramDescription(); ?></p>
                </div>
                <div class="col">
                    <div class="card text-white bg-primary border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bold text-white mb-0" style="text-align: left;">Price</h3>
                                    <h4 class="display-6 fw-bold text-white"><?php echo $specificProgram->getTrainingProgramPrice(); ?></h4>
                                </div>
                                <div><span class="badge rounded-pill bg-primary text-uppercase bg-white-300">Best Value</span></div>
                            </div>
                            <div></div>
                            <a class="btn btn-primary d-block w-100 bg-white-300" role="button" 
                                href="<?php echo ($loggedIn) ? 'trainingRequest.php?id=' . $specificProgram->getTrainingProgramID() . '&userId=' . $userId : 'login.php'; ?>" 
                                style="border-style: solid;">
                                    <?php echo ($loggedIn) ? 'Request' : 'Log in to request'; ?>
                                </a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row text-center">
                <div class="col-md-4 col-xl-7">
                    <h4 class="text-start section-heading">Program Details</h4>
                    <p class="text-start text-muted">Tutor: <?php echo $specificProgram->getTrainingTutorName(); ?></p>
                    <p class="text-start text-muted">Date: <?php echo $specificProgram->getTrainingProgramDate(); ?></p>
                    <p class="text-start text-muted">Time: <?php echo $specificProgram->getTrainingProgramTime(); ?></p>
                    <p class="text-start text-muted">Duration: <?php echo $specificProgram->getTrainingProgramDuration(); ?></p>
                </div>
                <div class="col">
                    <div class="card text-white bg-primary border-0"></div>
                </div>
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
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4"><span class="copyright">Copyright&nbsp;© Brand 2023</span></div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal4">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal5">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="portfolioModal6">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <h2 class="text-uppercase">Project Name</h2>
                                <p class="text-muted item-intro">Lorem ipsum dolor sit amet consectetur.</p><img class="img-fluid d-block mx-auto" src="assets/img/portfolio/6-full.jpg">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <ul class="list-unstyled">
                                    <li>Date: January 2017</li>
                                    <li>Client: Threads</li>
                                    <li>Category: Illustration</li>
                                </ul><button class="btn btn-primary" type="button" data-bs-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/agency.js"></script>

<?php
// include the footer files from the includes folder
include VIEWS . '/includes/userFooter.php';