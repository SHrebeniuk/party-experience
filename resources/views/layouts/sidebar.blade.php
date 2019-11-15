<aside>
	{{-- {{ dd(auth()->user()) }} --}}
	<div class="links d-flex flex-column">
		{{-- <a href="/profile">Profile</a> --}}
		@if( auth()->user()->team_id )
			<a href="/teams/show/{{ auth()->user()->team->title }}">My Team</a>
		@else
			<a href="/teams">Teams</a>
		@endif
	</div>
</aside>