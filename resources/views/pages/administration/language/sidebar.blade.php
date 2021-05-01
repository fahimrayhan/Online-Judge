@php
    $sidebar = [
      'languages' => [
                'icon'  => 'fas fa-cog',
                'name' => 'Languages',
                'url' => route('administration.languages'),
                'callback' => ''
        ],
        
    ];
@endphp

<div class="box">
			<div class="header">Administration</div>
			<div class="body" style="min-height: 300px;">
				@foreach($sidebar as $key => $value)
          <a href="{{$value['url']}}" callback="{{$value['callback']}}" style="display: block;">
            <button class="panel-sidebar-btn sidebar-btn {{ Request::segment(2) == $key ? 'sidebar-btn-active' : '' }}">
              <i class="{{$value['icon']}}"></i> {{$value['name']}}
            </button>
          </a>
        @endforeach
      </div>
</div>