@extends ('frontend.template')

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">SENTRA</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ 'frontend/assets/img/logo_sentra.png' }}" class="img-fluid w-100 animated"
                        alt="">
                </div>
                <div class="col-lg-6  d-flex flex-column justify-content-center text-center text-md-start"
                    data-aos="fade-in">
                    <h2>Selamat Datang Diwebsite PPA</h2>
                    <p>Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak</p>
                    <div class="d-flex mt-4 justify-content-center justify-content-md-start">
                        <a href="#" class="download-btn"><i class="bi bi-google-play"></i> <span>Google
                                Play</span></a>
                        <a href="#" class="download-btn"><i class="bi bi-apple"></i> <span>App
                                Store</span></a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang Kami</h2>
            <p>Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p>
                        Dinas Sosial adalah instansi yang menangani kesejahteraan sosial, pemberdayaan perempuan, dan
                        perlindungan Anak
                        melalui layanan advokasi, bantuan sosial, serta program pemberdayaan masyarakat.
                        Layanan di Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak:
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-circle"></i> <span>Layanan Pemberdayaan Perempuan</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Layanan Perlindungan Anak</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Layanan Sosial dan Bantuan Kesejahteraan</span>
                        </li>
                        <li><i class="bi bi-check2-circle"></i> <span>Layanan Konsultasi dan Edukasi</span></li>
                    </ul>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <p> Dengan adanya Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak, diharapkan perempuan
                        dan anak dapat hidup
                        dalam lingkungan yang aman, terlindungi, dan memiliki kesempatan yang sama dalam berbagai aspek
                        kehidupan.
                    </p>
                    <a href="#" class="read-more"><span>Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <p>FAQ terkait Dinas Pemberdayaan Perempuan dan Perlindungan Anak</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-container">
                        <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Apa itu Dinas PPPA?</h3>
                            <div class="faq-content">
                                <p> Dinas Sosial PPPA adalah instansi pemerintah yang bertugas dalam bidang
                                    kesejahteraan sosial,
                                    perlindungan perempuan, dan perlindungan anak.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Bagaimana cara melaporkan kasus kekerasan terhadap perempuan dan anak?</h3>
                            <div class="faq-content">
                                <p> Laporan pengaduan dapat dilakukan melalui aplikasi mobile yang dapat diunduh
                                    melalui google play store yang sudah tertera diatas.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Siapa yang dapat mengakses layanan Dinas PPPA?</h3>
                            <div class="faq-content">
                                <p> Perempuan dan Anak korban kekerasan atau diskriminasi, Masyarakat yang membutuhkan
                                    informasi
                                    dan edukasi terkait hak perempuan dan anak, dan pihak keluarga atau masyarakat yang
                                    ingin melaporkan kasus kekerasan
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Apakah Layanan di Dinas PPPA berbayar?</h3>
                            <div class="faq-content">
                                <p> Tidak. Semua layanan yang diberikan oleh Dinas PPPA bersifat gratis dan terbuka bagi
                                    masyarakat yang membutuhkan
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Bagaimana cara mengetahui informasi terbaru dari Dinas PPPA?</h3>
                            <div class="faq-content">
                                <p> Informasi terbaru dari Dinas PPPA dapat diperoleh melalui Website resmi Dinas PPPA,
                                    Media Sosial resmi, atau datang langsung ke kantor Dinas PPPA.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Masyarakat dapat menghubungi Dinas melalui:</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 text-center">
                <div class="col-md-3">
                    <div class="info-item" data-aos="fade" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Alamat</h3>
                        <p>Jl Supriyadi No 7, Kauman, Mangundikaran, Mangun Dikaran</p>
                        <p>Kec. Nganjuk, Kabupaten Nganjuk, Jawa Timur 64412</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-md-3">
                    <div class="info-item" data-aos="fade" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Telepon</h3>
                        <p>(0358) 3550722</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-md-3">
                    <div class="info-item" data-aos="fade" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>dinsospppa@nganjukkab.go.id</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-md-3">
                    <div class="info-item" data-aos="fade" data-aos-delay="500">
                        <i class="bi bi-clock"></i>
                        <h3>JAM BUKA</h3>
                        <p>Senin - Jum'at</p>
                        <p>07:30 AM - 03:30 PM</p>
                    </div>
                </div><!-- End Info Item -->
            </div>
        </div>
    </section><!-- /Contact Section -->

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SENTRA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl Supriyadi No 7, Kauman, Mangundikaran, Mangun Dikaran</p>
                        <p>Kec. Nganjuk, Kabupaten Nganjuk, Jawa Timur 64412</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>(0358) 3550722</span></p>
                        <p><strong>Email:</strong> <span>dinsospppa@nganjukkab.go.id</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#faq">FAQ</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="/layanan/perempuan">Layanan Pemberdayaan
                                Perempuan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/layanan/anak">Layanan Perlindungan Anak</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/layanan/kesejahteraan">Layanan Sosial dan
                                Bantuan Kesejahteraan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/layanan/edukasi">Layanan Konsultasi dan
                                Edukasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Sosial Media</h4>
                    <p>Cek informasi terbaru kami di Sosial Media</p>
                    <div class="social-links d-flex">
                        <a href="https://www.instagram.com/dinsosp3anganjuk" target="_blank" class="mx-2"><i
                                class="bi bi-instagram fs-3 text-danger"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SENTRA</strong> <span>2025</span>
            </p>
        </div>

    </footer>
</body>

</html>
