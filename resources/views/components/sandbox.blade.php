<style>
    #hero {
        width: 100%;
        height: 100vh;
        opacity: 0.9;
        background: url("{{asset('assets/images/profile3.jpg')}}") top center;
        background-size: cover;

    }


    #hero:before {
        /*content: "";*/
        /*background: rgba(5, 13, 24, 0.3);*/
        /*position: absolute;*/
        /*bottom: 0;*/
        /*top: 0;*/
        /*left: 0;*/
        /*right: 0;*/
        /*z-index: 1;*/
    }
    #myhero:before {
        content: "";
        background: rgba(5, 13, 24, 0.3);
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1;
    }

    #hero .hero-container {
        position: relative;
        z-index: 2;
        min-width: 300px;
    }

    #hero h1 {
        margin: 0 0 10px 0;
        font-size: 64px;
        font-weight: 700;
        line-height: 56px;
        color: #fff;
    }

    #hero p {
        color: #fff;
        margin-bottom: 50px;
        font-size: 26px;
        font-family: "Poppins", sans-serif;
    }

    #hero p span {
        color: #fff;
        padding-bottom: 4px;
        letter-spacing: 1px;
        border-bottom: 3px solid #149ddd;
    }

    .pulse{
        /*-webkit-text-stroke: 1px #0018b6;*/
        animation:
            /*myOrbit1 20s linear infinite, */
        Pulsate 1s linear infinite;
    }

    /*@keyframes myOrbit1 {*/
    /*    from {transform: rotate(0deg) translateX(150px) rotate(0deg)}*/
    /*    from {transform: rotate(360deg) translateX(150px) rotate(-360deg)}*/
    /*}*/

    @keyframes Pulsate {
        from {opacity: 1;}
        50% {opacity: 0.6;}
        to {opacity: 1;}
    }

    @media (min-width: 1024px) {
        #hero {
            background-attachment: fixed;
        }
    }

    @media (max-width: 768px) {
        #hero h1 {
            font-size: 28px;
            line-height: 36px;
        }

        #hero h2 {
            font-size: 18px;
            line-height: 24px;
            margin-bottom: 30px;
        }
    }


</style>

<div class="modal fade" id="sandbox">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title">--}}
{{--                    System Information--}}
{{--                </h5>--}}
{{--                <button type="button" data-bs-dismiss="modal" class="btn-close"></button>--}}
{{--            </div>--}}
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">System Information  <button type="button" data-bs-dismiss="modal" class="btn-close float-end"></button></h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">About</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Developer</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">

                                <section id="about" class="my-4">
                                    <div class="container">
                                        <div class="section-title">
                                            <h2 class="text-center">About Company</h2>
                                        </div>
                                        <br>
                                        <p class="text-center text-muted">
                                            This is FiberGigaBandWifi system which is help you to reach your dreams.
                                            <br>
                                            This platform provides fast and very competitive internet connection in just simple transaction.
                                            <br>
                                            Just contact the access provider and voila !!! Got your access code in a second.
                                            <br>
                                            Thank you for using FiberGigaBandWifi platform. Im looking forward to be a part of your success!
                                        </p>
                                        <hr>

                                        <div class="copyright text-center small">
                                            <p >
                                                <span class="text-muted">@FiberGigaBand v1 --version</span>
                                            </p>
                                            <i class="bi bi-c-circle-fill"></i> Copyright <strong><span>2023</span></strong>. All Rights Reserved
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
                                    <img src="{{asset('')}}" alt="">
                                    <div class="hero-container" data-aos="fade-in">
                                        <h1 class="pulse">Jhun Norman Alonzo</h1>
                                        <p>I'm <span class="typed" data-typed-items="Designer., Full-Stack Developer., Freelancer., Photographer."></span></p>
                                    </div>
                                </section><!-- End Hero -->
                                <section id="facts" class="facts my-4">
                                    <div class="container">
                                        <div class="section-title">
                                            <h2>About me</h2>
                                            <hr>
                                            <p class="" style="font-size: 17px">
                                                I live in Lal-lo Cagayan Valley and I love to write tutorial and tips
                                                that can help to other newbie in the world of web development.
                                                <br>
                                                Im a big fan of  <span class="text-primary">PHP</span>, <span class="text-primary">Laravel</span>, <span class="text-primary">Node</span>, <span class="text-primary">Javascript</span>, <span class="text-primary">JQuery</span>, and <span class="text-primary">Bootstrap</span>
                                                from the early stage.
                                                <br>
                                                I Believe in Hardworking and Consistency.
                                            </p>
                                            <br>
                                            <h6 class="text-primary">Follow me
                                                <a target="_blank" class="p-1 px-2 rounded rounded-circle btn btn-outline-primary" href="https://web.facebook.com/alonzojhunnorman"><i class="bi bi-facebook"></i></a>
                                                <a class="p-1 px-2 rounded rounded-circle btn btn-outline-primary" target="_blank" href="https://instagram.com/nrmnalonzo?igshid=NmQ2ZmYxZjA="><i class="bi bi-instagram"></i></a>
                                                <a class="p-1 px-2 rounded rounded-circle btn btn-outline-primary" target="_blank" href="https://join.skype.com/invite/V2gYC1bz8TdJ"><i class="bi bi-skype"></i></a>
                                                <a class="p-1 px-2 rounded rounded-circle btn btn-outline-primary" target="_blank" href="https://www.linkedin.com/in/jhunnorman-alonzo-327ba9178"><i class="bi bi-linkedin"></i></a>
                                                </div>
                                            </h6>

                                        </div>



                                    </div>
                                </section><!-- End Facts Section -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }

        const typed = select('.typed')
        if (typed) {
            let typed_strings = typed.getAttribute('data-typed-items')
            typed_strings = typed_strings.split(',')
            new Typed('.typed', {
                strings: typed_strings,
                loop: true,
                typeSpeed: 100,
                backSpeed: 50,
                backDelay: 2000
            });
        }
    </script>
@endsection
