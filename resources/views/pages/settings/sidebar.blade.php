@php
    $sidebar = [
        'change_password' => [
            'icon'  => 'fas fa-key',
            'name' => 'Change Password',
            'url' => route('settings.change_password'),
            'callback' => ''
        ],
		'change_name' => [
            'icon'  => 'far fa-id-card',
            'name' => 'Change Name',
            'url' => route('settings.change_name'),
            'callback' => ''
        ]
        
    ];
@endphp

{{-- <div class="box">
			<div class="header">Settings</div>
			<div class="body" style="min-height: 300px;">
				<button class="panel-sidebar-btn sidebarBtn">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
            	<button class="panel-sidebar-btn sidebarBtn sidebar-btn-active">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
				@for($i=1; $i<=10; $i++)
				<button class="panel-sidebar-btn sidebarBtn">
              		<i class="fa fa-trophy"></i> Standing
            	</button>
            	@endfor
			</div>
		</div> --}}

<div class="box">
			<div class="header">Settings</div>
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