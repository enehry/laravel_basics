@extends('layouts.master_home')

@section('home_content')


<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Contact</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Contact</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<div class="map-section">
    <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
</div>

<section id="contact" class="contact">
    <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

            <div class="col-lg-10">
                @if($contact)
                <div class="info-wrap">
                    <div class="row">

                        <div class="col-lg-4 info">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>{{ $contact->address }}</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>{{ $contact->email }}</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>{{ $contact->phone }}</p>
                        </div>


                    </div>
                </div>
                @else
                <h1>NO DATA</h1>
                @endif
            </div>

        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <form action="{{ route('home.send.message') }} " method="Post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" />

                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" />

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />

                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>

                    </div>
                    <div class="mb-3">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        @endif
                    </div>
                    <div class="text-center"><button class="btn btn-success" type="submit">Send Message</button></div>
                </form>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->


@endsection