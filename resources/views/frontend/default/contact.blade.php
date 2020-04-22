@extends("frontend.layout")
@section("title","Contact Me")
@section("content")

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Contact Me
        </h1>
        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-lg-8 mb-4">
                <!-- Embedded Google Map -->
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
            </div>
            <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Contact Details</h3>
                <p>
                    <b>Adress:</b>
                    {!! $adres !!}
                    {{$il}} / {{$ilce}} <br> <br>
                    <b>Phone:</b> {{$phone_gsm}}
                </p>
                <p>
                    Email:
                    <a href="{{$mail}}">{{$mail}}
                    </a>
                </p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <h3>Send us a Message</h3>
                <form method="POST">
                    @CSRF
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input class="form-control" type="text" name="name" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input class="form-control" type="text" name="phone" required>
                            <div class="help-block"></div></div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input class="form-control" type="email" name="email" required>
                            <div class="help-block"></div></div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea class="form-control" rows="10" cols="100" class="form-control" name="message" required></textarea>
                            <div class="help-block"></div></div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
                </form>
            </div>

        </div>
        <!-- /.row -->

    </div>

@endsection
@section("css") @endsection
@section("js") @endsection
