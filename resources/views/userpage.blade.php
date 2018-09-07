@extends('layouts.app')

@section('content')
   <div id="wrapper" class="toggled">
      <div id="sidebar-wrapper">
         <div class="profile">
            <br />
            <h1> {{ $user_name = DB::table('users')->where('id', $user_id)->first()->name }} </h1>
         </div>
      </div>

      <div id="page-content-wrapper">
         @if(Auth::user()->id == $user_id)
            <section class="row new-post">
               <div class="col-md-8 col-md-offset-1">
                  <header><h3>What do you have to say?</h3></header>
                  <form action="{{ route('post.create') }}" method="post">
                     <div class="form-group">
                        <textarea class="form-control" name="body" id="new-post" rows="3" placeholder="Your Post"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Create Post</button>
                     <input type="hidden" value="{{ Session::token() }}" name="_token">
                  </form>
               </div>
            </section>
         @endif
         <section class="row posts">
            <div class="col-md-8 col-md-offset-1">
               @if($posts->count() != 0)
                  <header><h3>Posts</h3></header>
                  @foreach($posts as $post)
                     <article class="post" data-postid="{{ $post->id }}">
                        <div class="margin60">
                           <p>{{ $post->body }}</p>
                           <div class="info">
                              Posted by {{ $post->user->name }} on {{ $post->created_at }}
                           </div>
                           <div class="interaction">
                           
                              @if(Auth::user() == $post->user)
                                 |
                                 <a href="#" class="edit">Edit</a> |
                                 <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                              @endif
                           </div>


                           <hr />

                           <div class="comments">
                              @foreach ($comments as $comment)
                                 @if($post->id == $comment->post_id)
                                    <div class="comment">
                                       <a href="{{ route('userpage', ['user_id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                                       <p>{{ $comment->comment}}</p>
                                       <div class="info">
                                          at {{ $comment->created_at }}
                                       </div>
                                    </div>
                                 @endif

                              @endforeach
                           </div>

                           <form action="{{ route('comment.create') }}" method="post">
                              <div class="input-group">
                                 <input class="form-control" type="text" name="comment" id="new-comment" />
                                 <span class="input-group-btn"><button type="submit" class="btn btn-primary">Comment</button></span>
                              </div>
                              <input type="hidden" value="{{ $post->id}}" name="c_post_id"/>
                              <input type="hidden" value="{{ Session::token() }}" name="_token">
                           </form>

                        </div>
                     </article>
                  @endforeach
               @else
                  <header><h3>No posts yet..</h3></header>
               @endif
            </div>
         </section>
      </div>

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

      <script>
      var urlEdit = '{{ route('edit') }}';
      var urlLike = '{{ route('like') }}';
      </script>
   </div>
@endsection
