<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Homepage | Dental Clinic</title>
    <link rel="shortcut icon" href="../src/images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../src/styles/homepage.css?v=<?php echo time() ?>">

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="#">
                <img src="../src/images/logo.png" alt="Dental Clinic Logo" />
            </a>
        </div>

        <nav>
            <ul>
                <a href="#home">
                    <li>HOME</li>
                </a>
                <a href="#about">
                    <li>ABOUT US</li>
                </a>
                <a href="#services">
                    <li>SERVICES</li>
                </a>
                <a href="#contactUs">
                    <li>CONTACT</li>
                </a>
                <a href="userLoginForm.php">
                    <li><button id="logInBtn">LOG IN</button></li>
                </a>
            </ul>
        </nav>
    </header>

    <main>
        <section class="headerContent" id="home">
            <div class="content-wrapper">
                <h1 id="tag">
                    Dental Service That You Can Trust
                </h1>
                <p id="subtag">
                    We provides always our best services for our Clients and always try to
                    achieve our Clients trust and satisfactions.
                </p>

                <button id="readMore">Read more</button>
            </div>
        </section>

        <section class="about" id="about">
            <div class="sectionTag">
                <h2>About Us</h2>
            </div>

            <div class="about-content">
                <div class="about-img">
                    <img src="../src/images/appointmentImage.jpg" alt="Clinic image">
                </div>

                <div class="whyUsContent">
                    <h3>Why choose us?</h3>
                    <p>
                        We work hard to maintain a comfortable, relaxing atmosphere at our dental clinic.We genuinely
                        care about our patients.
                        If you have a problem with your teeth, let us know! We are always more than happy to help.
                    </p>

                    <a href="userAppointmentForm.php">
                        <button id="appointmentBtn">
                            Make an appointment
                        </button>
                    </a>
                </div>
            </div>
        </section>

        <section class="services" id="services">
            <div class="serviceTag">
                <h2>Our Services</h2>
            </div>

            <div class="services-cards">
                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img src="../src/images/brokenTooth.png" alt="services">
                    </div>
                    <div class="card-tittle">
                        <h4>Dental Check Up</h4>
                    </div>

                    <div class="card-body">
                        <p>
                            Polish your teeth. Report their findings to the dentist. Take X-rays if ordered by the
                            dentist.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <section class="contactUs" id="contactUs">
            <div class="contactTag">
                <h2>Contact Us</h2>
            </div>

            <div class="logoimgContact">
                <img src="../src/images/logo.png" alt="">
            </div>

            <div class="contact-cards">
                <div class="contact-card">
                    <div class="card">
                        <div class="card-img">
                            <img src="../src/images/landline.png" alt="services">
                        </div>
                        <div class="card-tittle">
                            <h4>OUR MAIN OFFICES</h4>
                        </div>

                        <div class="card-body">
                            <p>
                                Liwayway75 St. Kasiglahan,Rodriguez Rizal
                            </p>
                        </div>
                    </div>
                </div>


                <div class="contact-card">
                    <div class="card">
                        <div class="card-img">
                            <img src="../src/images/email.png" alt="services">
                        </div>
                        <div class="card-tittle">
                            <h4>EMAIL</h4>
                        </div>

                        <div class="card-body">
                            <p>
                                example@yahoo.com
                            </p>
                        </div>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="card">
                        <div class="card-img">
                            <img src="../src/images/landline.png" alt="services">
                        </div>
                        <div class="card-tittle">
                            <h4>Phone Number</h4>
                        </div>

                        <div class="card-body">
                            <p>
                                (02)123-45-78
                                +639123456789.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cpright">
            <img src="../src/images/copyright.png" alt="">
            <p>
                Alrights Reserved
                Copyright infringement
            </p>
        </section>
    </main>
</body>

</html>