@extends('layout.home')

@section('content')
<div class="col-md-9">
	<div class="blog-posts">
		@foreach($articles as $k=>$v)
		
		<article class="post post-medium">
			<div class="row">
				<div class="col-md-5">
					<div class="post-image">
						<div>
							<div class="img-thumbnail">
								<img class="img-responsive" src="{{$v->img}}" alt="">
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-7">
					<div class="post-content">
						<h2><a href="{{route('detail',['id'=>$v->id])}}">{{$v->title}}</a></h2>
						<p>{!!$v->content!!}</p>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="post-meta">
						<span>
							<i class="fa fa-calendar"></i>{{$v->created_at}}
						</span>
						<span>
							<i class="fa fa-user"></i><a href="#">{{$v->user->username}}</a> 
						</span>
						<span>
							<i class="fa fa-tag"></i><a href="#">php</a>
						</span>
						<span>
							<i class="fa fa-comments"></i><a href="#">12 Comments</a>
						</span>
						<a href="{{route('detail',['id'=>$v->id])}}" class="btn btn-xs btn-primary pull-right">阅读全文</a>
					</div>
				</div>
			</div>

		</article>
		@endforeach
		
		<div id="pages" class="pull-right">
		{!!$articles->render()!!}
		</div>
	</div>
</div>
@endsection
