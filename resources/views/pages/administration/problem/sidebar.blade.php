@php
    $sidebar = [
        'overview' => [
            'icon'  => 'fas fa-home',
            'name' => 'Overview',
            'url' => route('administration.problem.overview',['slug' => request()->slug]),
            'callback' => ''
        ],
        'details' => [
            'icon'  => 'fas fa-home',
            'name' => 'Details',
            'url' => route('administration.problem.details',['slug' => request()->slug]),
            'callback' => ''
        ],
        
    ];
@endphp

<div class="box">
			<div class="header">Problem Dashboard</div>
			<div class="body" style="min-height: 300px;">
				@foreach($sidebar as $key => $value)
          <a href="{{$value['url']}}" callback="{{$value['callback']}}">
            <button class="panel-sidebar-btn sidebar-btn {{ Request::segment(4) == $key ? 'sidebar-btn-active' : '' }}">
              <i class="{{$value['icon']}}"></i> {{$value['name']}}
            </button>
          </a>
        @endforeach
      </div>
</div>