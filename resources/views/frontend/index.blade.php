@extends ('frontend.template')

<!DOCTYPE html>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">SENTRA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#faq">Pertanyaan Umum</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-get-started" href="{{route('login')}}" style="color : #ffffff"> Login </a>
    </div>
  </header>

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="{{ asset('landingpage/assets/img/hero-bg-2.jpg') }}" alt="" class="hero-bg">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('landingpage/assets/img/mobileapp.png') }}" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1><span>Selamat Datang di Website Resmi</span></h1>
            <p>Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak</p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
            </div>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

         <!-- Section Title -->
         <div class="container section-title" data-aos="fade-up">
        <div><span class="description-title">Tentang Kami</span></div>
      </div><!-- End Section Title -->


      <div class="container">
        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('landingpage/assets/img/details-1.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <p class="fst-italic">
              Website ini merupakan portal informasi resmi dari Dinas Sosial PPPA yang bertujuan untuk memberikan layanan informasi, edukasi, serta wadah komunikasi
              bagi masyarakat terkait isu-isu sosial, pemberdayaan perempuan, dan perlindungan anak.
              Melalui platform ini, kami berkomitmen utnuk:
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i><span> Meningkatkan transparansi dan akuntabilitas dalam penyelenggaraan program sosial.</span></li>
              <li><i class="bi bi-check2-circle"></i><span> Memberikan akses mudah terhadap layanan sosial, pengaduan, dan perlindungan hak-hak perempuan dan anak.</span></li>
              <li><i class="bi bi-check2-circle"></i><span> Menyediakan informasi terkini mengenai kegiatan, program kerja, serta kebijakan pemerintah dibidang sosial dan pemberdayaan masyarakat.</span></li>
            </ul>
            <p class="fst-italic">
              Kami percaya bahwa sinergi antara pemerintah dan masyarakat menjadi kunci utama dalam mewujudkan kesejahteraan sosial yang inklusif dan berkeadilan.
              Mari bersama menciptakan lingkungan yang aman, ramah, dan memberdayakan bagi selruh warga, terutama perempuan dan anak-anak.
            </p>
            <p> Salam hangat, </p></>
            <p class="fst-italic">Tim Dinas Sosial PPPA</p>
          </div>
        </div>

    </section><!-- /About Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <div class="container-fluid">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
              <h3><strong>PERTANYAAN UMUM</strong></h3>
              <p>
                Pertanyaan umum terkait Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak.
              </p>
            </div>

            <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Apa itu Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak?</h3>
                <div class="faq-content">
                  <p> Dinas Sosial PPPA adalah instansi pemerintah yang bertugas dalam bidang kesejahteraan sosial,
                    perlindungan perempuan, dan perlindungan anak.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Bagaimana cara melaporkan kasus kekerasan terhadap perempuan dan anak?</h3>
                <div class="faq-content">
                  <p> Laporan pengaduan dapat dilakukan melalui aplikasi mobile yang dapat diunduh melalui Website
                    resmi Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Siapa yang dapat mengakses layanan Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak?</h3>
                <div class="faq-content">
                  <p> Masyarakat yang membutuhkan informasi dan edukasi terkait hak perempuan dan anak, perempuan dan anak korban kekerasan atau diskriminasi, 
                    dan pihak keluarga atau masyarakat yang ingin melaporkan kasus kekerasan, pelecehan, dan lain sebagainya.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Apakah layanan di Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak berbayar?</h3>
                <div class="faq-content">
                  <p> Tidak. Semua layanan yang diberikan oleh Dinas Sosial Pemberdayaan Perlindungan Anak bersifat gratis
                    dan terbuka bagi masyarakat yang membutuhkan.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Bagaimana cara mengetahui informasi terbaru dari Dinas Sosial Pemberdayaan perempuan dan Perlindungan Anak?</h3>
                <div class="faq-content">
                  <p> Informasi terbaru dari Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak dapat diperoleh melalui Website resmi, 
                    Sosial Media resmi, atau dapat langsung ke Kantor Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak.
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

          <div class="col-lg-5 order-1 order-lg-2">
            <img src="{{ asset('landingpage/assets/img/faq.png') }}" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title text-center" data-aos="fade-up">
        <div><span>Cek Kontak</span> <span class="description-title">Kami</span></div>
        <p>Informasi terkait Kontak Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak</p>
      </div><!-- End Section Title -->

        <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="info-wrapper grid-layout">

            <div class="info-item text-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <div>
                <h3>Alamat</h3>
                <p>Jl Supriyadi No 7, Kauman, Mangundikaran, Mangun Dikaran</p>
                <p>Kec. Nganjuk, Kabupaten Nganjuk, Jawa Timur 64412</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item text-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <div>
                <h3>Telepon</h3>
                <p>(0358) 3550722</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item text-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-envelope"></i>
              <div>
                <h3>Email</h3>
                <p>dinsospppa@nganjukkab.go.id</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item text-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-clock"></i>
              <div>
                <h3>Jam Buka</h3>
                <p>Senin - Jum'at</p>
                <p>07:30 AM - 03:30 PM</p>
              </div>
            </div><!-- End Info Item -->
        </div>
        </div>

            <div class="container-fluid mt-5">
                <div class="section-title text-center">
                    <h3>Maps</h3>
                    <p>Berikut ini adalah informasi maps yang mengarah langsung ke Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak</p>
                </div>

                <div class="container my-4" style="max-width: 800px;">
                <div class="responsive-map">
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.8438585054073!2d111.898124!3d-7.6013195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e784b06ef170309%3A0xb23b3f2501c3c28e!2sDinas%20Sosial%20Pemberdayaan%20Perempuan%20dan%20Perlindungan%20Anak!5e0!3m2!1sid!2sid!4v1713866091206!5m2!1sid!2sid"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" >
                    </iframe>
                </div>
                </div>
            </div>
    </section><!-- /Contact Section -->

    
    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title text-center" data-aos="fade-up">
        <div><span class="description-title">Tim Pengembang</span></div>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-info">
                <h4>Ratna Indah Anggraini</h4>
                <span>Project Manager</span>
                <div class="social">
                  <a href="https://www.instagram.com/ratnaindah.a"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/ratna-indah-anggraini-1a23b5354"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-info">
                <h4>Angga Prasetio</h4>
                <span>Backend Developer</span>
                <div class="social">
                  <a href="https://www.instagram.com/anggapraseetio"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/angga-prasetio-568626361"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-info">
                <h4>Aulia Silmi Mardiyanti</h4>
                <span>Frontend Developer</span>
                <div class="social">
                  <a href="https://www.instagram.com/aaauulliiaa_"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/aulia-silmi-0262b929b"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-info">
                <h4>Muhamad Igviloja Mahendra</h4>
                <span>Quality Asurance</span>
                <div class="social">
                  <a href="https://www.instagram.com/mixvim.biz"><i class="bi bi-instagram"></i></a>
                  <a href="http://www.linkedin.com/in/muhamad-igviloja-mahendra-320618361"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-info">
                <h4>Nur Rohmatul Laili</h4>
                <span>Tester</span>
                <div class="social">
                  <a href="https://www.instagram.com/laily_885"><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->
    
<footer id="footer" class="footer dark-background">

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-4 col-md-6 footer-about">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="sitename">SENTRA</span>
      </a>
      <p> Sistem Entitas Pelaporan dan Respons Tanggap Aksi</p>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="#hero" class="active">Beranda</a></li>
        <li><a href="#about">Tentang Kami</a></li>
        <li><a href="#team">Team</a></li>
        <li><a href="#faq">Pertanyaan Umum</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Layanan Kami</h4>
      <ul>
        <li><a href="/layanan/perempuan">Layanan Pemberdayaan Perempuan</a></li>
        <li><a href="/layanan/anak">Layanan Perlindungan Anak</a></li>
        <li><a href="/layanan/kesejahteraan">Layanan Sosial dan Bantuan Kesejahteraan</a></li>
        <li><a href="/layanan/edukasi">Layanan Konsultasi dan Edukasi</a></li>
      </ul>
    </div>

    <div class="col-lg-4 col-md-12 footer-newsletter">
      <h4>Sosial Media Kami</h4>
      <p>Follow Media Sosial untuk mendapatkan informasi terbaru kami.</p>
      <div class="social-links d-flex">
            <a href="https://www.instagram.com/dinsosp3anganjuk" target="_blank" class="mx-2"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/@dinsosp3a_nganjuk" target="_blank" class="mx-2"><i class="bi bi-tiktok"></i></a>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">SENTRA</strong> <span>All Rights Reserved</span></p>
  <div class="credits">
  </div>
</div>

</footer>

</body>