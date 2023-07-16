
<div id="sidebar-menu">
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <a href="{{route('super-admin-dashboard')}}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-chat">Dashboard</span>
            </a>
        </li>
        <li class="menu-title">Blog</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-news"></i>
                <span key="t-blog">Articles</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-new-article')}}" key="t-blog">Add New Article</a></li>
                <li><a href="{{route('manage-articles')}}" key="t-blog">Manage Articles</a></li>
                <li><a href="{{route('show-blog-categories')}}" key="t-blog">Categories</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-slider"></i>
                <span key="t-blog">Sliders</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('add-new-slider')}}" key="t-blog">Add New Slider</a></li>
                <li><a href="{{route('show-sliders')}}" key="t-blog">Manage Sliders</a></li>
            </ul>
        </li>
        <li class="menu-title">Access Control</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-shield-quarter"></i>
                <span key="t-access-control">Modules</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('show-app-modules')}}" key="t-access-control">Manage Modules</a></li>
                <li><a href="{{route('show-app-permissions')}}" key="t-access-control">Manage Permissions</a></li>
                <li><a href="{{route('show-blog-categories')}}" key="t-access-control">Manage Roles</a></li>
            </ul>
        </li>
    </ul>
</div>
