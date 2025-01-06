<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body px-0 py-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item pr-0 pb-1">
                        @if(getLoggedInUser()->hasRole('super_admin'))
                            <a href="{{ route('admin.settings.index', ['section' => 'general']) }}"
                               class="nav-link custom-general-text {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : ''}}">
                                {{__('messages.general_settings')}}
                            </a>
                        @else
                            <a href="{{ route('settings.index', ['section' => 'general']) }}"
                               class="nav-link custom-general-text {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : ''}}">
                                {{__('messages.general_settings')}}
                            </a>
                        @endif
                    </li>
                    <li class="nav-item px-0 pb-1">
                        @if(getLoggedInUser()->hasRole('super_admin'))
                            <a href="{{ route('admin.settings.index', ['section' => 'social-settings']) }}"
                               class="nav-link {{ (isset($sectionName) && $sectionName == 'social-settings') ? 'active' : ''}}">
                                {{__('messages.social_settings')}}
                            </a>
                        @else
                            <a href="{{ route('settings.index', ['section' => 'social-settings']) }}"
                               class="nav-link {{ (isset($sectionName) && $sectionName == 'social-settings') ? 'active' : ''}}">
                                {{__('messages.social_settings')}}
                            </a>
                        @endif
                    </li>
                    @if(getLoggedInUser()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="{{ route('settings.index', ['section' => 'theme-settings']) }}"
                               class="nav-link {{ (isset($sectionName) && $sectionName == 'theme-settings') ? 'active' : ''}}">
                                {{__('messages.theme_settings')}}
                            </a>
                        </li>
                    @endif
                    @if(getLoggedInUser()->hasRole('super_admin'))
                        <li class="nav-item px-0 pb-1">
                            <a href="{{ route('admin.settings.index', ['section' => 'privacy-settings']) }}"
                               class="nav-link {{ (isset($sectionName) && $sectionName == 'privacy-settings') ? 'active' : ''}}">
                                {{__('messages.privacy_settings')}}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @yield('section')
    </div>
</div>

