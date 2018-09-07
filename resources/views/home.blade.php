@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('events') }}">Events</a>
                </div>  <br>
            <div class="card">
                <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<div class="container text-center" >    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#">My Profile</a></p>
        <img src="images/face.jpg" class="img-thumbnail" height="80" width="80" alt="Avatar"> <br><br>
        <p><span class="glyphicon glyphicon-tag"></span> BS Information Technology Web Development </p>
        <p><span class="glyphicon glyphicon-tag"></span> President Code Geeks </p>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <div style="margin-left: 20">
                <p> <span class="glyphicon glyphicon-pencil"></span> <strong>Update Status</strong> | <span class="glyphicon glyphicon-picture"></span> <strong>Add Photos/Video </strong> </p>
              </div>

         <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
               <textarea class="form-control" name="body" id="new-post" rows="3" placeholder="Your Post"></textarea>
            </div>
            <div class="form-group">
               <label for="image">Image (only .jpg)</label>
               <input type="file" name="image" class="form-control" id="image">
            </div>
            <button type="submit" class="btn btn-primary"> Post</button>
         </form>

              </div>     
            </div>
          </div>
        </div>

<!-- MGA POST -->
@foreach($posts as $post)
  <div style="text-align: left;">
    <div>
        <div class="col-md-12 col-sm-7">
            <div class="[ panel panel-default ] panel-google-plus">
              @if(Auth::user() == $post->user)
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a id="edit">Edit</a></li>
                        <li role="presentation"><a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a></li>
                    </ul>

                </div>
@endif
                <div class="panel-heading">
                    <img class="[ img-thumbnail pull-left ]" src="https://lh3.googleusercontent.com/-CxXg7_7ylq4/AAAAAAAAAAI/AAAAAAAAAQ8/LhCIKQC5Aq4/s46-c-k-no/photo.jpg" alt="Mouse0270" />
                    <h3><a href="{{ route('userpage', ['user_id' => $post->user->id]) }}">{{ $post->user->name }}</a></h3>
                    <h5><span>{{ $post->created_at }}</span> </h5>
                </div>
                <div class="panel-body">
                    <p>{{ $post->body }}</p>
                    @if(is_file(public_path('/storage/assets/img/posts/' . $post->post_image)))
                           <img src="{{ asset('storage/assets/img/posts/'. $post->post_image) }}" alt"" class="postwithimg" / width="300px" height="300px">
                           <br />
                        @endif
                </div>
                <div class="panel-footer">
                  {{ DB::table('likes')->where([['post_id', $post->id],['like', 1]])->count() }} likes this post.<br />
                    <form action="{{ route('like', $post->id) }}" method="post">
                        @csrf

                   <button type="submit" ="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? ' Dislike' : 'Like' : ' Like' }}</button>
                </div>
                <div class="container">
            <div class="row">
                <div class="col-md-8">

                   <div class="comments-list">
                      @foreach ($comments as $comment)
                      @if($post->id == $comment->post_id)

                       <div class="media">
                            <a class="media-left" href="#">
                              <img src="http://lorempixel.com/40/40/people/1/">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name"><a href="{{ route('userpage', ['user_id' => $comment->user->id]) }}">{{ $comment->user->name }} - {{ $comment->created_at }}</a></h4>
                             {{ $comment->comment}}
                            </div>
                          </div>
                          @endif
                          @endforeach
                   </div>
                </div>
            </div>
        </div>
                <div class="panel-footer">
                    <div class="input-placeholder">Add a comment...</div>
                </div>
                <div class="panel-google-plus-comment">
                    <img class="img-thumbnail" src="images/face.jpg" width="50" alt="User Image" />
                    <div class="panel-google-plus-textarea">
                        <form action="{{ route('comment.create') }}" method="post">
                        <textarea rows="4" placeholder="Type a reply..." class="form-control"
                          name="comment" id="new-comment" ></textarea>
                          <input type="hidden" value="{{ $post->id}}" name="c_post_id"/>
                     <input type="hidden" value="{{ Session::token() }}" name="_token">
                        <button type="submit" class="[ btn btn-primary disabled ]">Comment</button>
                        <button type="reset" class="[ btn btn-default ]">Cancel</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


   <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <label for="post-body">Edit the Post</label>
                     <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->

                   </div>
               </div>
           </div>
       </div>
   </div>

      <script>
      var urlEdit = '{{ route('edit') }}';
      </script>
@endsection
