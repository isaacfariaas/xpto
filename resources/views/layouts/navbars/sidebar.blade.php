<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('BD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Black Dashboard') }}</a>
        </div>
        <ul class="nav">
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>


            <a href="{{ route('profile.edit')  }}">
                <i class="tim-icons icon-single-02"></i>
                <p>{{ __('User Profile') }}</p>
            </a>
            </li>
            <a href="{{ route('competition.index') }}">
                <i class="tim-icons icon-atom"></i>
                <p>{{ __('Bolsões') }}</p>
            </a>
            </li>
        </ul>
    </div>
</div>