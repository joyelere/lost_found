@extends('layouts.app')
@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}" />
</head>

<!-- Top content -->
<div class="top-content section-container" id="top-content">
    <div class="container">
        <div class="row">
            <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h1 class="wow fadeIn"> <strong>Lost and Found Services</strong></h1>
                <div class="description wow fadeInLeft">
                    <p>
                        Making it easier to report found or lost item with either description or with an image of the missing item or both description and image
                    </p>
                </div>
                
                  <div class="buttons wow fadeInUp">
                    
                						
                    <a class="btn btn-primary btn-customized scroll-link" href="{{ route('lostitem.index') }}" role="button">
                        <i></i> LOST ITEMS
                    </a>
                    <a class="btn btn-primary btn-customized-2 scroll-link" href="{{ route('founditem.index') }}" role="button">
                        <i></i> FOUND ITEMS
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- Section 2 -->
  <div class="section-2-container section-container section-container-gray-bg" id="section-2">
    <div class="container">
        <div class="row">
            <div class="col section-2 section-description wow fadeIn">
            </div>
        </div>
        <div class="row">
            <div class="col-8 section-2-box wow fadeInLeft">
                <h3>About Us</h3>
            <h2>Lost And Found</h2>
                <p class="medium-paragraph">
                    Lost And Found is very useful, here you can help others by reporting things that you found or search for your lost items.            
                </p>
    
            </div>
            <div class="col-4 section-2-box wow fadeInUp">
                <img src="assets/img/about-us.jpg" alt="about-us">
            </div>
        </div>
    </div>
</div>

 <!-- Section 6 -->
 <div class="section-6-container section-container section-container-image-bg" id="section-6">
    <div class="container">
        <div class="row">
            <div class="col section-6 section-description wow fadeIn">
                <h2>Contact Us</h2>
                <div class="divider-1 wow fadeInUp"><span></span></div>
                <p>Send us an email using the form below or follow us on our social media channels.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 section-6-box wow fadeInUp">
                <h3>By eMail</h3>
                <div class="section-6-form">
                     @if(Session::has('success'))
              <div class="alert alert-success">
        	    {{ Session::get('success') }}
               </div>
           @endif
                    <form method="post" action="contact-us">
                        {{csrf_field()}}
                        <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label> Email </label>
                              <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>   
                         <div class="col-md-12">
                            <div class="form-group">
                              <label> Subject </label>
                              <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject" name="subject">
                              @error('subject')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>
                         <div class="col-md-12">
                           <div class="form-group">
                              <label> Message </label>
                              <textarea class="form-control textarea @error('message') is-invalid @enderror" placeholder="Message" name="message"></textarea>
                              @error('message')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                         <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-customized"><i class="fas fa-paper-plane"></i> Send Message</button>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
            <div class="col-md-5 offset-md-1 section-6-box wow fadeInDown">
                <h3>Follow us</h3>
                <div class="section-6-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-dribbble"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Footer -->
 <footer class="footer-container">
		
    <div class="container">
        <div class="row">

            <div class="col">
                &copy; Copyright 2020 - Lost And Found is powered by Jere-ben Technologies.
            </div>

        </div>
    </div>
    

</footer>




@endsection
       