<div class="userSidebar">
	<ul>
	    <li><a href="{{url('dashboard')}}"><i class="ti-dashboard"></i> Dashboard </a></li>

		@if(Auth::user()->role == 1)	    
		    <li><a href="{{url('roles')}}"><i class="ti-user"></i> Roles </a></li>
		    <li><a href="{{url('plans')}}"><i class="ti-money"></i> Plans </a></li>
		    <li><a href="{{url('users')}}"><i class="ti-user"></i> Users </a></li>
		    <li><a href="{{url('addusers')}}"><i class="ti-user"></i>Add Members </a></li>
		    <li><a href="{{url('admin/services')}}"><i class="ti-layout-grid3-alt"></i> Services </a></li>
		    <li><a href="{{url('admin/blogs')}}"><i class="ti-layout-grid3-alt"></i> Blogs </a></li>
		    <li><a href="{{url('admin/terms')}}"><i class="ti-layout-grid3-alt"></i> Terms </a></li>
		@elseif(Auth::user()->role == 5)    
	    	<li><a href="{{url('users')}}"><i class="ti-user"></i> Users </a></li>
		    <li><a href="{{url('addusers')}}"><i class="ti-user"></i>Add Members </a></li>


		@elseif(Auth::user()->role == 4 && Auth::user()->verification != '0')    
		    <li><a href="{{url('user/edit-profile')}}"><i class="ti-pencil"></i> Edit Profile </a></li>
		    <li><a href="{{url('/activeplan')}}"><i class="ti-money"></i> Plan</a></li>
		    <li><a href="{{url('/wishlist')}}"><i class="ti-save"></i> Wishlist</a></li>
		    <li><a href="{{url('/chats')}}"><i class="ti-save"></i> Chats 
		    	@if($newMsg > 0)<em>{{ $newMsg }}</em> @endif
		    </a></li>

	    @elseif(Auth::user()->role == 3 && Auth::user()->verification != '0')    
		    <li><a href="{{url('serviceprovider/edit-profile')}}"><i class="ti-pencil"></i> Edit Profile </a></li>
		    <li><a href="{{url('/activeplan')}}"><i class="ti-money"></i> Plan</a></li>
		    <li><a href="{{url('/wishlist')}}"><i class="ti-save"></i> Wishlist</a></li>
		    <li><a href="{{url('/chats')}}"><i class="ti-save"></i> Chats 
		    	@if($newMsg > 0)<em>{{ $newMsg }}</em> @endif
		    </a></li>

		@elseif(Auth::user()->role == 2 && Auth::user()->verification != '0')    
		    <li><a href="{{url('investor/edit-profile')}}"><i class="ti-pencil"></i> Edit Profile </a></li>
		    <li><a href="{{url('/activeplan')}}"><i class="ti-money"></i> Plan</a></li>
		    <li><a href="{{url('/wishlist')}}"><i class="ti-save"></i> Wishlist</a></li>
		    <li><a href="{{url('/chats')}}"><i class="ti-save"></i> Chats 
		    	@if($newMsg > 0)<em>{{ $newMsg }}</em> @endif
		    </a></li>
	    @endif

	    <li>
	    	<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	    	<i class="fa fa-sign-out fa-fw"></i> Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
	    </li>
	</ul>
</div>