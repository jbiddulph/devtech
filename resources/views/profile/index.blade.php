@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(empty(Auth::user()->profile->avatar))
                    <img src="{{asset('avatar/company-logo.png')}}" width="100" style="width: 100%;" alt="">
                @else
                    <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}" width="100" style="width: 100%;" alt="">
                @endif
                <br /><br />
                <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">Update Avatar</div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="avatar">
                            <br />
                            <button class="btn btn-success float-right" type="submit">Update Avatar</button>
                            @if($errors->has('avatar'))
                                <div class="error text-danger">{{$errors->first('avatar')}}</div>
                            @endif
                        </div>
                    </div>
                </form>
                    <br />
                    <br />
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Close my account
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{route('close')}}" method="POST">@csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to close your account?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" name="active" value="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-danger float-right" type="submit">Close Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <form action="{{route('profile.create')}}" method="POST">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" value="{{Auth::user()->profile->address}}">
                                @if($errors->has('address'))
                                    <div class="error text-danger">{{$errors->first('address')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->profile->phone_number}}">
                                @if($errors->has('phone_number'))
                                    <div class="error text-danger">{{$errors->first('phone_number')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="experience">Experience</label>
                                <textarea name="experience" class="form-control">{{Auth::user()->profile->experience}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea name="bio" class="form-control">{{Auth::user()->profile->bio}}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Your Information</div>
                    <div class="card-body">
                        @if(Auth::user()->name)
                            <p><strong>Name:</strong> {{Auth::user()->name}}</p>
                        @endif
                        @if(Auth::user()->profile->address)
                            <p><strong>Address:</strong> {{Auth::user()->profile->address}}</p>
                        @endif
                        @if(Auth::user()->profile->phone_number)
                            <p><strong>Phone Number:</strong> {{Auth::user()->profile->phone_number}}</p>
                        @endif
                        @if(Auth::user()->profile->gender)
                            <p><strong>Gender:</strong> {{Auth::user()->profile->gender}}</p>
                        @endif
                        @if(Auth::user()->profile->experience)
                            <p><strong>Exp:</strong> {{Auth::user()->profile->experience}}</p>
                        @endif
                        @if(Auth::user()->profile->bio)
                            <p><strong>Bio:</strong> {{Auth::user()->profile->bio}}</p>
                        @endif
                        <p><strong>Joined on:</strong> {{date('F d Y',strtotime(Auth::user()->created_at))}}</p>

    @if(!empty(Auth::user()->profile->cover_letter))
        <p><a href="{{Storage::url(Auth::user()->profile->cover_letter)}}">Cover Letter</a></p>
    @else
        <p>Please upload Cover letter</p>
    @endif
</div>
</div>
<br />
<form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">@csrf
<div class="card">
    <div class="card-header">Update Cover Letter</div>
    <div class="card-body">
        <input type="file" class="form-control" name="cover_letter">
        <br />
        <button class="btn btn-success float-right" type="submit">Update Cover Letter</button>
        @if($errors->has('cover_letter'))
            <div class="error text-danger">{{$errors->first('cover_letter')}}</div>
        @endif
    </div>
</div>
</form>
<br />
<form action="{{route('identification')}}" method="POST" enctype="multipart/form-data">@csrf
<div class="card">
    <div class="card-header">Update Identification</div>
    <div class="card-body">
        <input type="file" class="form-control" name="identification">
        <br />
        <button class="btn btn-success float-right" type="submit">Update Identification</button>
        @if($errors->has('identification'))
            <div class="error text-danger">{{$errors->first('identification')}}</div>
        @endif
    </div>
</div>
</form>
</div>
</div>
</div>
@endsection
