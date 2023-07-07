<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>{{config('app.name')}} | Create An Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Property Manager login screen" name="description" />
    <meta content="{{config('app.name')}}" name="author" />
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="auth-body-bg">
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xl-6">
                <div class="auth-full-bg pt-lg-5 p-4">
                    <div class="w-100">
                        <div class="bg-overlay"></div>
                        <div class="d-flex h-100 flex-column">

                            <div class="p-4 mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="auth-logo">
                                <a href="{{route('homepage')}}" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/assets/drive/logo/logo.png" alt="" class="rounded-circle" height="34">
                                    </span>
                                    </div>
                                </a>

                                <a href="{{route('homepage')}}" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid ">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/assets/drive/logo/logo.png" alt="" class="rounded-circle" height="34">
                                    </span>
                                    </div>
                                </a>
                            </div>
                            <div class="my-auto">
                                @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                    {!! session()->get('success') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-alert-outline me-2"></i>
                                        {!! session()->get('error') !!}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-primary"><span class="text-custom text-uppercase">{{config('app.name')}}</span> Registration</h3>
                                    <p class="text-muted">Effectively manage all your properties in one place. Engage seamlessly with your tenants, team members among other concern persons. </p>
                                </div>

                                <div class="mt-4">
                                    <form autocomplete="off" method="post" class="form-horizontal" action="{{route('register')}}">
                                        @csrf
                                       <div class="row">
                                           <div class="col-md-12 col-12 col-xl-12">
                                               <div class="mb-3">
                                                   <label for="email" class="form-label">Company Name</label>
                                                   <input type="text" class="form-control" name="companyName" value="{{old('companyName')}}" id="companyName" placeholder="Company Name">
                                                   @error('companyName')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="mb-3">
                                                   <label for="firstName" class="form-label">First Name</label>
                                                   <input type="text" class="form-control" name="firstName" value="{{old('firstName')}}" id="firstName" placeholder="First Name">
                                                   @error('firstName')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="mb-3">
                                                   <label for="email" class="form-label">Username <abbr title="This with your chosen password will be used to login"><a href="javascript:void(0);">?</a></abbr></label>
                                                   <input type="text" class="form-control" name="username" value="{{old('username')}}" id="username" placeholder="Username">
                                                   @error('username')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                                   <input type="hidden" name="planId" value="{{$planId}}">
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-6 col-xl-6">
                                               <div class="mb-3">
                                                   <label for="email" class="form-label">Mobile No.</label>
                                                   <input type="text" class="form-control" name="phoneNumber" value="{{old('phoneNumber')}}" id="phoneNumber" placeholder="Mobile No.">
                                                   @error('phoneNumber')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-xl-6">
                                               <div class="mb-3">
                                                   <label for="email" class="form-label">Email Address</label>
                                                   <input type="text" class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="Email Address">
                                                   @error('email')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-xl-6">
                                               <div class="mb-3">
                                                   <label class="form-label">Password</label>
                                                   <div class="input-group auth-pass-inputgroup">
                                                       <input type="password" class="form-control" name="password" placeholder="Enter Password" aria-label="Password" aria-describedby="password-addon">
                                                       <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                   </div>
                                                   @error('password')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-xl-6">
                                               <div class="mb-3">
                                                   <label class="form-label">Re-type Password</label>
                                                   <div class="input-group auth-pass-inputgroup">
                                                       <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" aria-label="Re-type Password" aria-describedby="password-addon">
                                                       <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                   </div>
                                                   @error('password_confirmation')
                                                   <i class="text-danger">{{$message}}</i>
                                                   @enderror
                                               </div>
                                           </div>
                                       </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terms" id="remember-check">
                                            <p>
                                                By submitting this form, you agree to our Terms of Service and that you have read our Privacy Policy.
                                                Checking the checkbox is equivalent to a handwritten signature
                                            </p>
                                            @error('terms')
                                            <i class="text-danger">{{$message}}</i>
                                            @enderror
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                    <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-custom waves-effect waves-light text-uppercase" type="submit" style="height:60px; border-radius:10%;">Create New {{config('app.name')}} Account</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            Already have an account ?  <a href="" class="text-muted"><i class="mdi mdi-lock me-1"></i> Login Here</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class=" text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script>
                                    {{config('app.name')}} All Rights Reserved</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.js"></script>
</body>
</html>

