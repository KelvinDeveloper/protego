<div class="am-left-sidebar">
	<div class="content">
		<div class="am-logo"></div>
		<ul class="sidebar-elements">
			<li class="parent">
				@foreach( $Menu as $Group )
					<a href="#"><i class="material-icons">layers</i> </i><span>{{ $Group['name']}}</span></a>
					<ul class="sub-menu"><li class="title">{{ $Group['name']}}</li>
						<li class="nav-items">
							<div class="am-scroller nano has-scrollbar">
								<div class="content nano-content" style="margin-right: 0px; right: -15px;">
									<ul>
										@foreach( $Group['items'] as $Item )
											<li><a href="{{ $Item['href'] }}">{{ $Item['name'] }}</a></li>
										@endforeach
									</ul>
								</div>
								<div class="nano-pane" style="display: none;">
									<div class="nano-slider" style="height: 438px; transform: translate(0px, 0px);"></div>
								</div>
							</div>
						</li>
					</ul>
				@endforeach
			</li>
		</ul>
	</div>
</div>