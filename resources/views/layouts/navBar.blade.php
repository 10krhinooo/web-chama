<header class="headerStyle">
<div class="container">
    <nav class="site-nav">
        <ul>
            <li><a href="#" title="Home"><i class="site-nav--icon"></i>
                    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/ajmsjtcp.json" trigger="hover" stroke="bold"
                        state="hover-partial-roll" colors="primary:#109173,secondary:#000000"
                        style="width:40px;height:40px;padding-top:12px;">
                    </lord-icon>
                </a></li>
            <li><a href="#" title="#"><i class="site-nav--icon"></i>
                    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/unukghxb.json" trigger="hover" stroke="bold"
                        colors="primary:#121331,secondary:#e8308c" style="width:40px;height:40px;padding-top:12px;">
                    </lord-icon>
                </a></li>
            <li><a href="{{route('login')}}" title="Sign In"><i class="site-nav--icon"></i>
                    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/wzwygmng.json" trigger="hover" stroke="bold"
                        state="hover-unfold" colors="primary:#121331,secondary:#16c72e"
                        style="width:40px;height:40px;padding-top:12px;">
                    </lord-icon>
                </a></li>
            <li><a href="{{route('register')}}" title="Sign Up"><i class="site-nav--icon"></i>
                    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/zrkkrrpl.json" trigger="hover" stroke="bold"
                        state="hover-swirl" colors="primary:#121331,secondary:#66a1ee"
                        style="width:40px;height:40px;padding-top:12px;">
                    </lord-icon>
                </a></li>
            <li><a href="{{route('profile')}}" title="profile"><i class="site-nav--icon"></i>
                    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/bgebyztw.json" trigger="hover" stroke="bold"
                        state="hover-looking-around" colors="primary:#121331,secondary:#e83a30"
                        style="width:40px;height:40px;padding-top:12px;">
                    </lord-icon>
                </a></li>
        </ul>
    </nav>

    <div class="menu-toggle">
        <div class="hamburger"></div>
    </div>

</div>
</header>
<style>
    .headerStyle{
    background: transparent;
    color: #7ae0dd;
    padding: 1em 0;
    position: absolute;
    z-index: 10;
    min-width: 100%;
    margin-top: -500px;
    }

    .headerStyle::after {
    content: '';
    clear: both;
    display: block;
    }

    .site-nav {
    position: absolute;
    top: 100%;
    right: 0%;
    background: #464655;
    clip-path: circle(0px at top right);
    transition: clip-path ease-in-out 700ms;
    /* display: none; */
    }

    .site-nav--open {
    clip-path: circle(250% at top right);
    /* display: block; */
    }

    .site-nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    }

    .site-nav li {
    border-bottom: 1px solid #575766;
    }

    .site-nav li:last-child {
    border-bottom: none;
    }

    .site-nav a {
    color: #464c4d;
    display: block;
    padding: 1px 4em 2em 1.5em;
    text-transform: uppercase;
    text-decoration: none;
    }

    .site-nav a:hover,
    .site-nav a:focus {
    background: #E4B363;
    color: #464655;
    }

    .site-nav--icon {
    display: inline-block;
    font-size: 1.5em;
    margin-right: 1em;
    width: 1.1em;
    text-align: right;
    color: rgba(255,255,255,.4);
    }

    .menu-toggle {
    padding: 1em;
    position: absolute;
    top: .5em;
    right: .5em;
    cursor: pointer;
    }

    .hamburger,
    .hamburger::before,
    .hamburger::after {
    content: '';
    display: block;
    background: #464c4d;
    height: 4px;
    width: 1.75em;
    border-radius: 3px;
    transition: all ease-in-out 500ms;
    }

    .hamburger::before {
    transform: translateY(-6px);
    }

    .hamburger::after {
    transform: translateY(3px);
    }

    .open .hamburger {
    transform: rotate(45deg);
    }

    .open .hamburger::before {
    opacity: 0;
    }

    .open .hamburger::after {
    transform: translateY(-3px) rotate(-90deg);
    }

    @media (min-width: 800px) {

    .menu-toggle {
    display: none;
    }

    .site-nav {
    height: auto;
    position: relative;
    background: transparent;
    float: right;
    clip-path: initial;
    }

    .site-nav li {
    display: inline-block;
    border: none;
    }

    .site-nav a {
    padding: 0;
    margin-left: 3em;
    }

    .site-nav a:hover,
    .site-nav a:focus {
    background: transparent;
    }

    .site-nav--icon {
    display: none;
    }

    }
    .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    }

    .tooltip:hover .tooltiptext {
    visibility: visible;
    }
    </style>
