@extends('osfrportal::layout')
@section('dashboardTitle', 'NEW Личный кабинет')
@push('footer-scripts')
    <script type="module">
        var options = {
            series: [70],
            chart: {
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    }
                },
            },
            labels: ['<h2 class="bi bi-people card-text"></h2>'],
        };

        var chart = new ApexCharts(document.querySelector("#liveusersChart"), options);
        chart.render();
    </script>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="col-sm-2">
            <div class="my-3 p-3 bg-body rounded shadow-sm text-center" style="max-width: 12rem;">
                <div class="card-header">Активные пользователи</div>
                <div class="card-body text-primary">

                        <div id="liveusersChart">
                        </div>

                </div>
            </div>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Website Analytics-->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Website Analytics</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="analyticsOptions" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="analyticsOptions">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-2" style="position: relative;">
                            <div class="d-flex justify-content-around align-items-center flex-wrap mb-4">
                                <div class="user-analytics text-center me-2">
                                    <i class="bx bx-user me-1"></i>
                                    <span>Users</span>
                                    <div class="d-flex align-items-center mt-2" style="position: relative;">
                                        <div class="chart-report" data-color="success" data-series="35"
                                            style="min-height: 44.7px;">
                                            <div id="apexchartscazxdlhx"
                                                class="apexcharts-canvas apexchartscazxdlhx apexcharts-theme-light"
                                                style="width: 50px; height: 44.7px;"><svg id="SvgjsSvg1825" width="50"
                                                    height="44.699999999999996" xmlns="http://www.w3.org/2000/svg"
                                                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG1827" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(-7.5, -8)">
                                                        <defs id="SvgjsDefs1826">
                                                            <clipPath id="gridRectMaskcazxdlhx">
                                                                <rect id="SvgjsRect1829" width="66" height="75"
                                                                    x="-3" y="-1" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskcazxdlhx"></clipPath>
                                                            <clipPath id="nonForecastMaskcazxdlhx"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskcazxdlhx">
                                                                <rect id="SvgjsRect1830" width="64" height="77"
                                                                    x="-2" y="-2" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <g id="SvgjsG1831" class="apexcharts-radialbar">
                                                            <g id="SvgjsG1832">
                                                                <g id="SvgjsG1833" class="apexcharts-tracks">
                                                                    <g id="SvgjsG1834"
                                                                        class="apexcharts-radialbar-track apexcharts-track"
                                                                        rel="1">
                                                                        <path id="apexcharts-radialbarTrack-0"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451"
                                                                            fill="none" fill-opacity="1"
                                                                            stroke="rgba(233,236,238,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.6138414634146354"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1836">
                                                                    <g id="SvgjsG1838"
                                                                        class="apexcharts-series apexcharts-radial-series"
                                                                        seriesName="Progress" rel="1"
                                                                        data:realIndex="0">
                                                                        <path id="SvgjsPath1839"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 40.258236828065264 37.45304531794023"
                                                                            fill="none" fill-opacity="0.85"
                                                                            stroke="rgba(57,218,138,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.725609756097562"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                            data:angle="126" data:value="35"
                                                                            index="0" j="0"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 40.258236828065264 37.45304531794023">
                                                                        </path>
                                                                    </g>
                                                                    <circle id="SvgjsCircle1837" r="5.872957317073169"
                                                                        cx="30" cy="30"
                                                                        class="apexcharts-radialbar-hollow"
                                                                        fill="transparent"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <line id="SvgjsLine1840" x1="0" y1="0"
                                                            x2="60" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine1841" x1="0" y1="0"
                                                            x2="60" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                    </g>
                                                    <g id="SvgjsG1828" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend"></div>
                                            </div>
                                        </div>
                                        <h3 class="mb-0">61K</h3>
                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 93px; height: 46px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sessions-analytics text-center me-2">
                                    <i class="bx bx-pie-chart-alt me-1"></i>
                                    <span>Sessions</span>
                                    <div class="d-flex align-items-center mt-2" style="position: relative;">
                                        <div class="chart-report" data-color="warning" data-series="76"
                                            style="min-height: 44.7px;">
                                            <div id="apexchartsfrsho1b5"
                                                class="apexcharts-canvas apexchartsfrsho1b5 apexcharts-theme-light"
                                                style="width: 50px; height: 44.7px;"><svg id="SvgjsSvg1842"
                                                    width="50" height="44.699999999999996"
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG1844" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(-7.5, -8)">
                                                        <defs id="SvgjsDefs1843">
                                                            <clipPath id="gridRectMaskfrsho1b5">
                                                                <rect id="SvgjsRect1846" width="66" height="75"
                                                                    x="-3" y="-1" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskfrsho1b5"></clipPath>
                                                            <clipPath id="nonForecastMaskfrsho1b5"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskfrsho1b5">
                                                                <rect id="SvgjsRect1847" width="64" height="77"
                                                                    x="-2" y="-2" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <g id="SvgjsG1848" class="apexcharts-radialbar">
                                                            <g id="SvgjsG1849">
                                                                <g id="SvgjsG1850" class="apexcharts-tracks">
                                                                    <g id="SvgjsG1851"
                                                                        class="apexcharts-radialbar-track apexcharts-track"
                                                                        rel="1">
                                                                        <path id="apexcharts-radialbarTrack-0"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451"
                                                                            fill="none" fill-opacity="1"
                                                                            stroke="rgba(233,236,238,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.6138414634146354"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1853">
                                                                    <g id="SvgjsG1855"
                                                                        class="apexcharts-series apexcharts-radial-series"
                                                                        seriesName="Progress" rel="1"
                                                                        data:realIndex="0">
                                                                        <path id="SvgjsPath1856"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 17.3510094968579 29.11549641981154"
                                                                            fill="none" fill-opacity="0.85"
                                                                            stroke="rgba(253,172,65,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.725609756097562"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                            data:angle="274" data:value="76"
                                                                            index="0" j="0"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 17.3510094968579 29.11549641981154">
                                                                        </path>
                                                                    </g>
                                                                    <circle id="SvgjsCircle1854" r="5.872957317073169"
                                                                        cx="30" cy="30"
                                                                        class="apexcharts-radialbar-hollow"
                                                                        fill="transparent"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <line id="SvgjsLine1857" x1="0" y1="0"
                                                            x2="60" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine1858" x1="0" y1="0"
                                                            x2="60" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                    </g>
                                                    <g id="SvgjsG1845" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend"></div>
                                            </div>
                                        </div>
                                        <h3 class="mb-0">92K</h3>
                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 97px; height: 46px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bounce-rate-analytics text-center">
                                    <i class="bx bx-trending-up me-1"></i>
                                    <span>Bounce Rate</span>
                                    <div class="d-flex align-items-center mt-2" style="position: relative;">
                                        <div class="chart-report" data-color="danger" data-series="65"
                                            style="min-height: 44.7px;">
                                            <div id="apexchartsd9hq6l9f"
                                                class="apexcharts-canvas apexchartsd9hq6l9f apexcharts-theme-light"
                                                style="width: 50px; height: 44.7px;"><svg id="SvgjsSvg1859"
                                                    width="50" height="44.699999999999996"
                                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG1861" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(-7.5, -8)">
                                                        <defs id="SvgjsDefs1860">
                                                            <clipPath id="gridRectMaskd9hq6l9f">
                                                                <rect id="SvgjsRect1863" width="66" height="75"
                                                                    x="-3" y="-1" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskd9hq6l9f"></clipPath>
                                                            <clipPath id="nonForecastMaskd9hq6l9f"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskd9hq6l9f">
                                                                <rect id="SvgjsRect1864" width="64" height="77"
                                                                    x="-2" y="-2" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <g id="SvgjsG1865" class="apexcharts-radialbar">
                                                            <g id="SvgjsG1866">
                                                                <g id="SvgjsG1867" class="apexcharts-tracks">
                                                                    <g id="SvgjsG1868"
                                                                        class="apexcharts-radialbar-track apexcharts-track"
                                                                        rel="1">
                                                                        <path id="apexcharts-radialbarTrack-0"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451"
                                                                            fill="none" fill-opacity="1"
                                                                            stroke="rgba(233,236,238,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.6138414634146354"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1870">
                                                                    <g id="SvgjsG1872"
                                                                        class="apexcharts-series apexcharts-radial-series"
                                                                        seriesName="Progress" rel="1"
                                                                        data:realIndex="0">
                                                                        <path id="SvgjsPath1873"
                                                                            d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 19.741763171934736 37.45304531794023"
                                                                            fill="none" fill-opacity="0.85"
                                                                            stroke="rgba(255,91,92,0.85)"
                                                                            stroke-opacity="1" stroke-linecap="round"
                                                                            stroke-width="3.725609756097562"
                                                                            stroke-dasharray="0"
                                                                            class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                            data:angle="234" data:value="65"
                                                                            index="0" j="0"
                                                                            data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 19.741763171934736 37.45304531794023">
                                                                        </path>
                                                                    </g>
                                                                    <circle id="SvgjsCircle1871" r="5.872957317073169"
                                                                        cx="30" cy="30"
                                                                        class="apexcharts-radialbar-hollow"
                                                                        fill="transparent"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <line id="SvgjsLine1874" x1="0" y1="0"
                                                            x2="60" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine1875" x1="0" y1="0"
                                                            x2="60" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                    </g>
                                                    <g id="SvgjsG1862" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend"></div>
                                            </div>
                                        </div>
                                        <h3 class="mb-0">72.6%</h3>
                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 121px; height: 46px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="analyticsBarChart" style="min-height: 265px;">
                                <div id="apexcharts7jka34as"
                                    class="apexcharts-canvas apexcharts7jka34as apexcharts-theme-light"
                                    style="width: 823px; height: 250px;"><svg id="SvgjsSvg1876" width="823"
                                        height="250" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG1878" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(39.25, 30)">
                                            <defs id="SvgjsDefs1877">
                                                <linearGradient id="SvgjsLinearGradient1882" x1="0"
                                                    y1="0" x2="0" y2="1">
                                                    <stop id="SvgjsStop1883" stop-opacity="0.4"
                                                        stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                    <stop id="SvgjsStop1884" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                    <stop id="SvgjsStop1885" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                </linearGradient>
                                                <clipPath id="gridRectMask7jka34as">
                                                    <rect id="SvgjsRect1887" width="777.75" height="190.348" x="-2" y="0"
                                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMask7jka34as"></clipPath>
                                                <clipPath id="nonForecastMask7jka34as"></clipPath>
                                                <clipPath id="gridRectMarkerMask7jka34as">
                                                    <rect id="SvgjsRect1888" width="777.75" height="194.348" x="-2"
                                                        y="-2" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fff"></rect>
                                                </clipPath>
                                            </defs>
                                            <rect id="SvgjsRect1886" width="8.597222222222223" height="190.348"
                                                x="550.0277811686199" y="0" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke-dasharray="3"
                                                fill="url(#SvgjsLinearGradient1882)" class="apexcharts-xcrosshairs"
                                                y2="190.348" filter="none" fill-opacity="0.9" x1="550.0277811686199"
                                                x2="550.0277811686199"></rect>
                                            <g id="SvgjsG1932" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG1933" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"><text id="SvgjsText1935"
                                                        font-family="Helvetica, Arial, sans-serif" x="42.986111111111114"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1936">Jan</tspan>
                                                        <title>Jan</title>
                                                    </text><text id="SvgjsText1938"
                                                        font-family="Helvetica, Arial, sans-serif" x="128.95833333333334"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1939">Feb</tspan>
                                                        <title>Feb</title>
                                                    </text><text id="SvgjsText1941"
                                                        font-family="Helvetica, Arial, sans-serif" x="214.93055555555557"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1942">Mar</tspan>
                                                        <title>Mar</title>
                                                    </text><text id="SvgjsText1944"
                                                        font-family="Helvetica, Arial, sans-serif" x="300.9027777777778"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1945">Apr</tspan>
                                                        <title>Apr</title>
                                                    </text><text id="SvgjsText1947"
                                                        font-family="Helvetica, Arial, sans-serif" x="386.875" y="219.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1948">May</tspan>
                                                        <title>May</title>
                                                    </text><text id="SvgjsText1950"
                                                        font-family="Helvetica, Arial, sans-serif" x="472.8472222222223"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1951">Jun</tspan>
                                                        <title>Jun</title>
                                                    </text><text id="SvgjsText1953"
                                                        font-family="Helvetica, Arial, sans-serif" x="558.8194444444446"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1954">Jul</tspan>
                                                        <title>Jul</title>
                                                    </text><text id="SvgjsText1956"
                                                        font-family="Helvetica, Arial, sans-serif" x="644.7916666666667"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1957">Aug</tspan>
                                                        <title>Aug</title>
                                                    </text><text id="SvgjsText1959"
                                                        font-family="Helvetica, Arial, sans-serif" x="730.7638888888889"
                                                        y="219.348" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="12px" font-weight="400" fill="#a8b1bb"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1960">Sep</tspan>
                                                        <title>Sep</title>
                                                    </text></g>
                                            </g>
                                            <g id="SvgjsG1971" class="apexcharts-grid">
                                                <g id="SvgjsG1972" class="apexcharts-gridlines-horizontal">
                                                    <line id="SvgjsLine1974" x1="0" y1="0"
                                                        x2="773.75" y2="0" stroke="#e9ecee"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1975" x1="0" y1="63.449333333333335"
                                                        x2="773.75" y2="63.449333333333335" stroke="#e9ecee"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1976" x1="0" y1="126.89866666666667"
                                                        x2="773.75" y2="126.89866666666667" stroke="#e9ecee"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1977" x1="0" y1="190.348"
                                                        x2="773.75" y2="190.348" stroke="#e9ecee"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <g id="SvgjsG1973" class="apexcharts-gridlines-vertical"></g>
                                                <line id="SvgjsLine1979" x1="0" y1="190.348" x2="773.75"
                                                    y2="190.348" stroke="transparent" stroke-dasharray="0"
                                                    stroke-linecap="butt"></line>
                                                <line id="SvgjsLine1978" x1="0" y1="1" x2="0"
                                                    y2="190.348" stroke="transparent" stroke-dasharray="0"
                                                    stroke-linecap="butt"></line>
                                            </g>
                                            <g id="SvgjsG1889" class="apexcharts-bar-series apexcharts-plot-series">
                                                <g id="SvgjsG1890" class="apexcharts-series" rel="1"
                                                    seriesName="2020" data:realIndex="0">
                                                    <path id="SvgjsPath1894"
                                                        d="M 34.38888888888889 190.348L 34.38888888888889 142.58853333333334Q 34.38888888888889 139.58853333333334 37.38888888888889 139.58853333333334L 39.986111111111114 139.58853333333334Q 42.986111111111114 139.58853333333334 42.986111111111114 142.58853333333334L 42.986111111111114 142.58853333333334L 42.986111111111114 190.348Q 42.986111111111114 190.348 42.986111111111114 190.348L 34.38888888888889 190.348Q 34.38888888888889 190.348 34.38888888888889 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 34.38888888888889 190.348L 34.38888888888889 142.58853333333334Q 34.38888888888889 139.58853333333334 37.38888888888889 139.58853333333334L 39.986111111111114 139.58853333333334Q 42.986111111111114 139.58853333333334 42.986111111111114 142.58853333333334L 42.986111111111114 142.58853333333334L 42.986111111111114 190.348Q 42.986111111111114 190.348 42.986111111111114 190.348L 34.38888888888889 190.348Q 34.38888888888889 190.348 34.38888888888889 190.348z"
                                                        pathFrom="M 34.38888888888889 190.348L 34.38888888888889 190.348L 42.986111111111114 190.348L 42.986111111111114 190.348L 42.986111111111114 190.348L 42.986111111111114 190.348L 42.986111111111114 190.348L 34.38888888888889 190.348"
                                                        cy="139.58853333333334" cx="120.36111111111111" j="0"
                                                        val="8" barHeight="50.759466666666675"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1896"
                                                        d="M 120.36111111111111 190.348L 120.36111111111111 136.24360000000001Q 120.36111111111111 133.24360000000001 123.36111111111111 133.24360000000001L 125.95833333333334 133.24360000000001Q 128.95833333333334 133.24360000000001 128.95833333333334 136.24360000000001L 128.95833333333334 136.24360000000001L 128.95833333333334 190.348Q 128.95833333333334 190.348 128.95833333333334 190.348L 120.36111111111111 190.348Q 120.36111111111111 190.348 120.36111111111111 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 120.36111111111111 190.348L 120.36111111111111 136.24360000000001Q 120.36111111111111 133.24360000000001 123.36111111111111 133.24360000000001L 125.95833333333334 133.24360000000001Q 128.95833333333334 133.24360000000001 128.95833333333334 136.24360000000001L 128.95833333333334 136.24360000000001L 128.95833333333334 190.348Q 128.95833333333334 190.348 128.95833333333334 190.348L 120.36111111111111 190.348Q 120.36111111111111 190.348 120.36111111111111 190.348z"
                                                        pathFrom="M 120.36111111111111 190.348L 120.36111111111111 190.348L 128.95833333333334 190.348L 128.95833333333334 190.348L 128.95833333333334 190.348L 128.95833333333334 190.348L 128.95833333333334 190.348L 120.36111111111111 190.348"
                                                        cy="133.24360000000001" cx="206.33333333333334" j="1"
                                                        val="9" barHeight="57.104400000000005"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1898"
                                                        d="M 206.33333333333334 190.348L 206.33333333333334 98.174Q 206.33333333333334 95.174 209.33333333333334 95.174L 211.93055555555557 95.174Q 214.93055555555557 95.174 214.93055555555557 98.174L 214.93055555555557 98.174L 214.93055555555557 190.348Q 214.93055555555557 190.348 214.93055555555557 190.348L 206.33333333333334 190.348Q 206.33333333333334 190.348 206.33333333333334 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 206.33333333333334 190.348L 206.33333333333334 98.174Q 206.33333333333334 95.174 209.33333333333334 95.174L 211.93055555555557 95.174Q 214.93055555555557 95.174 214.93055555555557 98.174L 214.93055555555557 98.174L 214.93055555555557 190.348Q 214.93055555555557 190.348 214.93055555555557 190.348L 206.33333333333334 190.348Q 206.33333333333334 190.348 206.33333333333334 190.348z"
                                                        pathFrom="M 206.33333333333334 190.348L 206.33333333333334 190.348L 214.93055555555557 190.348L 214.93055555555557 190.348L 214.93055555555557 190.348L 214.93055555555557 190.348L 214.93055555555557 190.348L 206.33333333333334 190.348"
                                                        cy="95.174" cx="292.30555555555554" j="2" val="15"
                                                        barHeight="95.174" barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1900"
                                                        d="M 292.30555555555554 190.348L 292.30555555555554 66.44933333333333Q 292.30555555555554 63.44933333333333 295.30555555555554 63.44933333333333L 297.90277777777777 63.44933333333333Q 300.90277777777777 63.44933333333333 300.90277777777777 66.44933333333333L 300.90277777777777 66.44933333333333L 300.90277777777777 190.348Q 300.90277777777777 190.348 300.90277777777777 190.348L 292.30555555555554 190.348Q 292.30555555555554 190.348 292.30555555555554 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 292.30555555555554 190.348L 292.30555555555554 66.44933333333333Q 292.30555555555554 63.44933333333333 295.30555555555554 63.44933333333333L 297.90277777777777 63.44933333333333Q 300.90277777777777 63.44933333333333 300.90277777777777 66.44933333333333L 300.90277777777777 66.44933333333333L 300.90277777777777 190.348Q 300.90277777777777 190.348 300.90277777777777 190.348L 292.30555555555554 190.348Q 292.30555555555554 190.348 292.30555555555554 190.348z"
                                                        pathFrom="M 292.30555555555554 190.348L 292.30555555555554 190.348L 300.90277777777777 190.348L 300.90277777777777 190.348L 300.90277777777777 190.348L 300.90277777777777 190.348L 300.90277777777777 190.348L 292.30555555555554 190.348"
                                                        cy="63.44933333333333" cx="378.27777777777777" j="3"
                                                        val="20" barHeight="126.89866666666668"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1902"
                                                        d="M 378.27777777777777 190.348L 378.27777777777777 104.51893333333334Q 378.27777777777777 101.51893333333334 381.27777777777777 101.51893333333334L 383.875 101.51893333333334Q 386.875 101.51893333333334 386.875 104.51893333333334L 386.875 104.51893333333334L 386.875 190.348Q 386.875 190.348 386.875 190.348L 378.27777777777777 190.348Q 378.27777777777777 190.348 378.27777777777777 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 378.27777777777777 190.348L 378.27777777777777 104.51893333333334Q 378.27777777777777 101.51893333333334 381.27777777777777 101.51893333333334L 383.875 101.51893333333334Q 386.875 101.51893333333334 386.875 104.51893333333334L 386.875 104.51893333333334L 386.875 190.348Q 386.875 190.348 386.875 190.348L 378.27777777777777 190.348Q 378.27777777777777 190.348 378.27777777777777 190.348z"
                                                        pathFrom="M 378.27777777777777 190.348L 378.27777777777777 190.348L 386.875 190.348L 386.875 190.348L 386.875 190.348L 386.875 190.348L 386.875 190.348L 378.27777777777777 190.348"
                                                        cy="101.51893333333334" cx="464.25" j="4" val="14"
                                                        barHeight="88.82906666666668" barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1904"
                                                        d="M 464.25 190.348L 464.25 53.75946666666667Q 464.25 50.75946666666667 467.25 50.75946666666667L 469.84722222222223 50.75946666666667Q 472.84722222222223 50.75946666666667 472.84722222222223 53.75946666666667L 472.84722222222223 53.75946666666667L 472.84722222222223 190.348Q 472.84722222222223 190.348 472.84722222222223 190.348L 464.25 190.348Q 464.25 190.348 464.25 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 464.25 190.348L 464.25 53.75946666666667Q 464.25 50.75946666666667 467.25 50.75946666666667L 469.84722222222223 50.75946666666667Q 472.84722222222223 50.75946666666667 472.84722222222223 53.75946666666667L 472.84722222222223 53.75946666666667L 472.84722222222223 190.348Q 472.84722222222223 190.348 472.84722222222223 190.348L 464.25 190.348Q 464.25 190.348 464.25 190.348z"
                                                        pathFrom="M 464.25 190.348L 464.25 190.348L 472.84722222222223 190.348L 472.84722222222223 190.348L 472.84722222222223 190.348L 472.84722222222223 190.348L 472.84722222222223 190.348L 464.25 190.348"
                                                        cy="50.75946666666667" cx="550.2222222222222" j="5"
                                                        val="22" barHeight="139.58853333333334"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1906"
                                                        d="M 550.2222222222222 190.348L 550.2222222222222 9.34493333333333Q 550.2222222222222 6.34493333333333 553.2222222222222 6.34493333333333L 555.8194444444443 6.34493333333333Q 558.8194444444443 6.34493333333333 558.8194444444443 9.34493333333333L 558.8194444444443 9.34493333333333L 558.8194444444443 190.348Q 558.8194444444443 190.348 558.8194444444443 190.348L 550.2222222222222 190.348Q 550.2222222222222 190.348 550.2222222222222 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 550.2222222222222 190.348L 550.2222222222222 9.34493333333333Q 550.2222222222222 6.34493333333333 553.2222222222222 6.34493333333333L 555.8194444444443 6.34493333333333Q 558.8194444444443 6.34493333333333 558.8194444444443 9.34493333333333L 558.8194444444443 9.34493333333333L 558.8194444444443 190.348Q 558.8194444444443 190.348 558.8194444444443 190.348L 550.2222222222222 190.348Q 550.2222222222222 190.348 550.2222222222222 190.348z"
                                                        pathFrom="M 550.2222222222222 190.348L 550.2222222222222 190.348L 558.8194444444443 190.348L 558.8194444444443 190.348L 558.8194444444443 190.348L 558.8194444444443 190.348L 558.8194444444443 190.348L 550.2222222222222 190.348"
                                                        cy="6.34493333333333" cx="636.1944444444443" j="6" val="29"
                                                        barHeight="184.00306666666668" barWidth="8.597222222222223">
                                                    </path>
                                                    <path id="SvgjsPath1908"
                                                        d="M 636.1944444444443 190.348L 636.1944444444443 22.03479999999999Q 636.1944444444443 19.03479999999999 639.1944444444443 19.03479999999999L 641.7916666666665 19.03479999999999Q 644.7916666666665 19.03479999999999 644.7916666666665 22.03479999999999L 644.7916666666665 22.03479999999999L 644.7916666666665 190.348Q 644.7916666666665 190.348 644.7916666666665 190.348L 636.1944444444443 190.348Q 636.1944444444443 190.348 636.1944444444443 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 636.1944444444443 190.348L 636.1944444444443 22.03479999999999Q 636.1944444444443 19.03479999999999 639.1944444444443 19.03479999999999L 641.7916666666665 19.03479999999999Q 644.7916666666665 19.03479999999999 644.7916666666665 22.03479999999999L 644.7916666666665 22.03479999999999L 644.7916666666665 190.348Q 644.7916666666665 190.348 644.7916666666665 190.348L 636.1944444444443 190.348Q 636.1944444444443 190.348 636.1944444444443 190.348z"
                                                        pathFrom="M 636.1944444444443 190.348L 636.1944444444443 190.348L 644.7916666666665 190.348L 644.7916666666665 190.348L 644.7916666666665 190.348L 644.7916666666665 190.348L 644.7916666666665 190.348L 636.1944444444443 190.348"
                                                        cy="19.03479999999999" cx="722.1666666666665" j="7"
                                                        val="27" barHeight="171.31320000000002"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1910"
                                                        d="M 722.1666666666665 190.348L 722.1666666666665 110.86386666666667Q 722.1666666666665 107.86386666666667 725.1666666666665 107.86386666666667L 727.7638888888887 107.86386666666667Q 730.7638888888887 107.86386666666667 730.7638888888887 110.86386666666667L 730.7638888888887 110.86386666666667L 730.7638888888887 190.348Q 730.7638888888887 190.348 730.7638888888887 190.348L 722.1666666666665 190.348Q 722.1666666666665 190.348 722.1666666666665 190.348z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 722.1666666666665 190.348L 722.1666666666665 110.86386666666667Q 722.1666666666665 107.86386666666667 725.1666666666665 107.86386666666667L 727.7638888888887 107.86386666666667Q 730.7638888888887 107.86386666666667 730.7638888888887 110.86386666666667L 730.7638888888887 110.86386666666667L 730.7638888888887 190.348Q 730.7638888888887 190.348 730.7638888888887 190.348L 722.1666666666665 190.348Q 722.1666666666665 190.348 722.1666666666665 190.348z"
                                                        pathFrom="M 722.1666666666665 190.348L 722.1666666666665 190.348L 730.7638888888887 190.348L 730.7638888888887 190.348L 730.7638888888887 190.348L 730.7638888888887 190.348L 730.7638888888887 190.348L 722.1666666666665 190.348"
                                                        cy="107.86386666666667" cx="808.1388888888887" j="8"
                                                        val="13" barHeight="82.48413333333335"
                                                        barWidth="8.597222222222223"></path>
                                                    <g id="SvgjsG1892" class="apexcharts-bar-goals-markers"
                                                        style="pointer-events: none">
                                                        <g id="SvgjsG1893" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1895" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1897" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1899" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1901" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1903" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1905" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1907" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1909" className="apexcharts-bar-goals-groups"></g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1911" class="apexcharts-series" rel="2"
                                                    seriesName="2019" data:realIndex="1">
                                                    <path id="SvgjsPath1915"
                                                        d="M 42.986111111111114 190.348L 42.986111111111114 161.62333333333333Q 42.986111111111114 158.62333333333333 45.986111111111114 158.62333333333333L 48.583333333333336 158.62333333333333Q 51.583333333333336 158.62333333333333 51.583333333333336 161.62333333333333L 51.583333333333336 161.62333333333333L 51.583333333333336 190.348Q 51.583333333333336 190.348 51.583333333333336 190.348L 42.986111111111114 190.348Q 42.986111111111114 190.348 42.986111111111114 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 42.986111111111114 190.348L 42.986111111111114 161.62333333333333Q 42.986111111111114 158.62333333333333 45.986111111111114 158.62333333333333L 48.583333333333336 158.62333333333333Q 51.583333333333336 158.62333333333333 51.583333333333336 161.62333333333333L 51.583333333333336 161.62333333333333L 51.583333333333336 190.348Q 51.583333333333336 190.348 51.583333333333336 190.348L 42.986111111111114 190.348Q 42.986111111111114 190.348 42.986111111111114 190.348z"
                                                        pathFrom="M 42.986111111111114 190.348L 42.986111111111114 190.348L 51.583333333333336 190.348L 51.583333333333336 190.348L 51.583333333333336 190.348L 51.583333333333336 190.348L 51.583333333333336 190.348L 42.986111111111114 190.348"
                                                        cy="155.62333333333333" cx="128.95833333333334" j="0"
                                                        val="5" barHeight="31.72466666666667"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1917"
                                                        d="M 128.95833333333334 190.348L 128.95833333333334 148.93346666666667Q 128.95833333333334 145.93346666666667 131.95833333333334 145.93346666666667L 134.55555555555557 145.93346666666667Q 137.55555555555557 145.93346666666667 137.55555555555557 148.93346666666667L 137.55555555555557 148.93346666666667L 137.55555555555557 190.348Q 137.55555555555557 190.348 137.55555555555557 190.348L 128.95833333333334 190.348Q 128.95833333333334 190.348 128.95833333333334 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 128.95833333333334 190.348L 128.95833333333334 148.93346666666667Q 128.95833333333334 145.93346666666667 131.95833333333334 145.93346666666667L 134.55555555555557 145.93346666666667Q 137.55555555555557 145.93346666666667 137.55555555555557 148.93346666666667L 137.55555555555557 148.93346666666667L 137.55555555555557 190.348Q 137.55555555555557 190.348 137.55555555555557 190.348L 128.95833333333334 190.348Q 128.95833333333334 190.348 128.95833333333334 190.348z"
                                                        pathFrom="M 128.95833333333334 190.348L 128.95833333333334 190.348L 137.55555555555557 190.348L 137.55555555555557 190.348L 137.55555555555557 190.348L 137.55555555555557 190.348L 137.55555555555557 190.348L 128.95833333333334 190.348"
                                                        cy="142.93346666666667" cx="214.93055555555557" j="1"
                                                        val="7" barHeight="44.41453333333334"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1919"
                                                        d="M 214.93055555555557 190.348L 214.93055555555557 117.20880000000001Q 214.93055555555557 114.20880000000001 217.93055555555557 114.20880000000001L 220.5277777777778 114.20880000000001Q 223.5277777777778 114.20880000000001 223.5277777777778 117.20880000000001L 223.5277777777778 117.20880000000001L 223.5277777777778 190.348Q 223.5277777777778 190.348 223.5277777777778 190.348L 214.93055555555557 190.348Q 214.93055555555557 190.348 214.93055555555557 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 214.93055555555557 190.348L 214.93055555555557 117.20880000000001Q 214.93055555555557 114.20880000000001 217.93055555555557 114.20880000000001L 220.5277777777778 114.20880000000001Q 223.5277777777778 114.20880000000001 223.5277777777778 117.20880000000001L 223.5277777777778 117.20880000000001L 223.5277777777778 190.348Q 223.5277777777778 190.348 223.5277777777778 190.348L 214.93055555555557 190.348Q 214.93055555555557 190.348 214.93055555555557 190.348z"
                                                        pathFrom="M 214.93055555555557 190.348L 214.93055555555557 190.348L 223.5277777777778 190.348L 223.5277777777778 190.348L 223.5277777777778 190.348L 223.5277777777778 190.348L 223.5277777777778 190.348L 214.93055555555557 190.348"
                                                        cy="111.20880000000001" cx="300.90277777777777" j="2"
                                                        val="12" barHeight="76.1392" barWidth="8.597222222222223">
                                                    </path>
                                                    <path id="SvgjsPath1921"
                                                        d="M 300.90277777777777 190.348L 300.90277777777777 85.48413333333333Q 300.90277777777777 82.48413333333333 303.90277777777777 82.48413333333333L 306.5 82.48413333333333Q 309.5 82.48413333333333 309.5 85.48413333333333L 309.5 85.48413333333333L 309.5 190.348Q 309.5 190.348 309.5 190.348L 300.90277777777777 190.348Q 300.90277777777777 190.348 300.90277777777777 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 300.90277777777777 190.348L 300.90277777777777 85.48413333333333Q 300.90277777777777 82.48413333333333 303.90277777777777 82.48413333333333L 306.5 82.48413333333333Q 309.5 82.48413333333333 309.5 85.48413333333333L 309.5 85.48413333333333L 309.5 190.348Q 309.5 190.348 309.5 190.348L 300.90277777777777 190.348Q 300.90277777777777 190.348 300.90277777777777 190.348z"
                                                        pathFrom="M 300.90277777777777 190.348L 300.90277777777777 190.348L 309.5 190.348L 309.5 190.348L 309.5 190.348L 309.5 190.348L 309.5 190.348L 300.90277777777777 190.348"
                                                        cy="79.48413333333333" cx="386.875" j="3" val="17"
                                                        barHeight="107.86386666666668" barWidth="8.597222222222223">
                                                    </path>
                                                    <path id="SvgjsPath1923"
                                                        d="M 386.875 190.348L 386.875 136.24360000000001Q 386.875 133.24360000000001 389.875 133.24360000000001L 392.47222222222223 133.24360000000001Q 395.47222222222223 133.24360000000001 395.47222222222223 136.24360000000001L 395.47222222222223 136.24360000000001L 395.47222222222223 190.348Q 395.47222222222223 190.348 395.47222222222223 190.348L 386.875 190.348Q 386.875 190.348 386.875 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 386.875 190.348L 386.875 136.24360000000001Q 386.875 133.24360000000001 389.875 133.24360000000001L 392.47222222222223 133.24360000000001Q 395.47222222222223 133.24360000000001 395.47222222222223 136.24360000000001L 395.47222222222223 136.24360000000001L 395.47222222222223 190.348Q 395.47222222222223 190.348 395.47222222222223 190.348L 386.875 190.348Q 386.875 190.348 386.875 190.348z"
                                                        pathFrom="M 386.875 190.348L 386.875 190.348L 395.47222222222223 190.348L 395.47222222222223 190.348L 395.47222222222223 190.348L 395.47222222222223 190.348L 395.47222222222223 190.348L 386.875 190.348"
                                                        cy="130.24360000000001" cx="472.84722222222223" j="4"
                                                        val="9" barHeight="57.104400000000005"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1925"
                                                        d="M 472.84722222222223 190.348L 472.84722222222223 85.48413333333333Q 472.84722222222223 82.48413333333333 475.84722222222223 82.48413333333333L 478.44444444444446 82.48413333333333Q 481.44444444444446 82.48413333333333 481.44444444444446 85.48413333333333L 481.44444444444446 85.48413333333333L 481.44444444444446 190.348Q 481.44444444444446 190.348 481.44444444444446 190.348L 472.84722222222223 190.348Q 472.84722222222223 190.348 472.84722222222223 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 472.84722222222223 190.348L 472.84722222222223 85.48413333333333Q 472.84722222222223 82.48413333333333 475.84722222222223 82.48413333333333L 478.44444444444446 82.48413333333333Q 481.44444444444446 82.48413333333333 481.44444444444446 85.48413333333333L 481.44444444444446 85.48413333333333L 481.44444444444446 190.348Q 481.44444444444446 190.348 481.44444444444446 190.348L 472.84722222222223 190.348Q 472.84722222222223 190.348 472.84722222222223 190.348z"
                                                        pathFrom="M 472.84722222222223 190.348L 472.84722222222223 190.348L 481.44444444444446 190.348L 481.44444444444446 190.348L 481.44444444444446 190.348L 481.44444444444446 190.348L 481.44444444444446 190.348L 472.84722222222223 190.348"
                                                        cy="79.48413333333333" cx="558.8194444444443" j="5"
                                                        val="17" barHeight="107.86386666666668"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1927"
                                                        d="M 558.8194444444443 190.348L 558.8194444444443 28.37973333333332Q 558.8194444444443 25.37973333333332 561.8194444444443 25.37973333333332L 564.4166666666665 25.37973333333332Q 567.4166666666665 25.37973333333332 567.4166666666665 28.37973333333332L 567.4166666666665 28.37973333333332L 567.4166666666665 190.348Q 567.4166666666665 190.348 567.4166666666665 190.348L 558.8194444444443 190.348Q 558.8194444444443 190.348 558.8194444444443 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 558.8194444444443 190.348L 558.8194444444443 28.37973333333332Q 558.8194444444443 25.37973333333332 561.8194444444443 25.37973333333332L 564.4166666666665 25.37973333333332Q 567.4166666666665 25.37973333333332 567.4166666666665 28.37973333333332L 567.4166666666665 28.37973333333332L 567.4166666666665 190.348Q 567.4166666666665 190.348 567.4166666666665 190.348L 558.8194444444443 190.348Q 558.8194444444443 190.348 558.8194444444443 190.348z"
                                                        pathFrom="M 558.8194444444443 190.348L 558.8194444444443 190.348L 567.4166666666665 190.348L 567.4166666666665 190.348L 567.4166666666665 190.348L 567.4166666666665 190.348L 567.4166666666665 190.348L 558.8194444444443 190.348"
                                                        cy="22.37973333333332" cx="644.7916666666665" j="6"
                                                        val="26" barHeight="164.9682666666667"
                                                        barWidth="8.597222222222223"></path>
                                                    <path id="SvgjsPath1929"
                                                        d="M 644.7916666666665 190.348L 644.7916666666665 60.1044Q 644.7916666666665 57.1044 647.7916666666665 57.1044L 650.3888888888887 57.1044Q 653.3888888888887 57.1044 653.3888888888887 60.1044L 653.3888888888887 60.1044L 653.3888888888887 190.348Q 653.3888888888887 190.348 653.3888888888887 190.348L 644.7916666666665 190.348Q 644.7916666666665 190.348 644.7916666666665 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 644.7916666666665 190.348L 644.7916666666665 60.1044Q 644.7916666666665 57.1044 647.7916666666665 57.1044L 650.3888888888887 57.1044Q 653.3888888888887 57.1044 653.3888888888887 60.1044L 653.3888888888887 60.1044L 653.3888888888887 190.348Q 653.3888888888887 190.348 653.3888888888887 190.348L 644.7916666666665 190.348Q 644.7916666666665 190.348 644.7916666666665 190.348z"
                                                        pathFrom="M 644.7916666666665 190.348L 644.7916666666665 190.348L 653.3888888888887 190.348L 653.3888888888887 190.348L 653.3888888888887 190.348L 653.3888888888887 190.348L 653.3888888888887 190.348L 644.7916666666665 190.348"
                                                        cy="54.1044" cx="730.7638888888887" j="7" val="21"
                                                        barHeight="133.24360000000001" barWidth="8.597222222222223">
                                                    </path>
                                                    <path id="SvgjsPath1931"
                                                        d="M 730.7638888888887 190.348L 730.7638888888887 129.89866666666666Q 730.7638888888887 126.89866666666666 733.7638888888887 126.89866666666666L 736.3611111111109 126.89866666666666Q 739.3611111111109 126.89866666666666 739.3611111111109 129.89866666666666L 739.3611111111109 129.89866666666666L 739.3611111111109 190.348Q 739.3611111111109 190.348 739.3611111111109 190.348L 730.7638888888887 190.348Q 730.7638888888887 190.348 730.7638888888887 190.348z"
                                                        fill="#5a8dee29" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMask7jka34as)"
                                                        pathTo="M 730.7638888888887 190.348L 730.7638888888887 129.89866666666666Q 730.7638888888887 126.89866666666666 733.7638888888887 126.89866666666666L 736.3611111111109 126.89866666666666Q 739.3611111111109 126.89866666666666 739.3611111111109 129.89866666666666L 739.3611111111109 129.89866666666666L 739.3611111111109 190.348Q 739.3611111111109 190.348 739.3611111111109 190.348L 730.7638888888887 190.348Q 730.7638888888887 190.348 730.7638888888887 190.348z"
                                                        pathFrom="M 730.7638888888887 190.348L 730.7638888888887 190.348L 739.3611111111109 190.348L 739.3611111111109 190.348L 739.3611111111109 190.348L 739.3611111111109 190.348L 739.3611111111109 190.348L 730.7638888888887 190.348"
                                                        cy="123.89866666666667" cx="816.7361111111109" j="8"
                                                        val="10" barHeight="63.44933333333334"
                                                        barWidth="8.597222222222223"></path>
                                                    <g id="SvgjsG1913" class="apexcharts-bar-goals-markers"
                                                        style="pointer-events: none">
                                                        <g id="SvgjsG1914" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1916" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1918" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1920" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1922" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1924" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1926" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1928" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1930" className="apexcharts-bar-goals-groups"></g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1891" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                <g id="SvgjsG1912" class="apexcharts-datalabels" data:realIndex="1"></g>
                                            </g>
                                            <line id="SvgjsLine1980" x1="0" y1="0" x2="773.75"
                                                y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                            <line id="SvgjsLine1981" x1="0" y1="0" x2="773.75"
                                                y2="0" stroke-dasharray="0" stroke-width="0"
                                                stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG1982" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG1983" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG1984" class="apexcharts-point-annotations"></g>
                                        </g>
                                        <g id="SvgjsG1961" class="apexcharts-yaxis" rel="0"
                                            transform="translate(9.25, 0)">
                                            <g id="SvgjsG1962" class="apexcharts-yaxis-texts-g"><text
                                                    id="SvgjsText1963" font-family="Helvetica, Arial, sans-serif" x="20"
                                                    y="31.3" text-anchor="end" dominant-baseline="auto"
                                                    font-size="11px" font-weight="400" fill="#a8b1bb"
                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1964">30</tspan>
                                                    <title>30</title>
                                                </text><text id="SvgjsText1965"
                                                    font-family="Helvetica, Arial, sans-serif" x="20"
                                                    y="94.74933333333333" text-anchor="end" dominant-baseline="auto"
                                                    font-size="11px" font-weight="400" fill="#a8b1bb"
                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1966">20</tspan>
                                                    <title>20</title>
                                                </text><text id="SvgjsText1967"
                                                    font-family="Helvetica, Arial, sans-serif" x="20"
                                                    y="158.19866666666667" text-anchor="end" dominant-baseline="auto"
                                                    font-size="11px" font-weight="400" fill="#a8b1bb"
                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1968">10</tspan>
                                                    <title>10</title>
                                                </text><text id="SvgjsText1969"
                                                    font-family="Helvetica, Arial, sans-serif" x="20" y="221.648"
                                                    text-anchor="end" dominant-baseline="auto" font-size="11px"
                                                    font-weight="400" fill="#a8b1bb"
                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1970">0</tspan>
                                                    <title>0</title>
                                                </text></g>
                                        </g>
                                        <g id="SvgjsG1879" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend" style="max-height: 125px;"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-light"
                                        style="left: 593.576px; top: 1.375px;">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Jul</div>
                                        <div class="apexcharts-tooltip-series-group apexcharts-active"
                                            style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker"
                                                style="background-color: rgba(90, 141, 238, 0.85);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label">2020: </span><span
                                                        class="apexcharts-tooltip-text-y-value">$ 29 thousands</span>
                                                </div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 2; display: none;">
                                            <span class="apexcharts-tooltip-marker"
                                                style="background-color: rgba(90, 141, 238, 0.85);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label">2020: </span><span
                                                        class="apexcharts-tooltip-text-y-value">$ 29 thousands</span>
                                                </div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 868px; height: 373px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Referral, conversion, impression & income charts -->
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <!-- Referral Chart-->
                        <div class="col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body text-center" style="position: relative;">
                                    <h2 class="mb-1">$32,690</h2>
                                    <span class="text-muted">Referral 40%</span>
                                    <div id="referralLineChart" style="min-height: 100px;">
                                        <div id="apexcharts6n6xgo3jl"
                                            class="apexcharts-canvas apexcharts6n6xgo3jl apexcharts-theme-light"
                                            style="width: 376px; height: 100px;"><svg id="SvgjsSvg1985" width="376"
                                                height="100" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev"
                                                class="apexcharts-svg apexcharts-zoomable hovering-zoom"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1987" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(22, 5)">
                                                    <defs id="SvgjsDefs1986">
                                                        <clipPath id="gridRectMask6n6xgo3jl">
                                                            <rect id="SvgjsRect1992" width="352" height="104"
                                                                x="-4" y="-2" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMask6n6xgo3jl"></clipPath>
                                                        <clipPath id="nonForecastMask6n6xgo3jl"></clipPath>
                                                        <clipPath id="gridRectMarkerMask6n6xgo3jl">
                                                            <rect id="SvgjsRect1993" width="372" height="128"
                                                                x="-14" y="-14" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <line id="SvgjsLine1991" x1="68.3" y1="0"
                                                        x2="68.3" y2="100" stroke="#b6b6b6"
                                                        stroke-dasharray="3" stroke-linecap="butt"
                                                        class="apexcharts-xcrosshairs" x="68.3" y="0" width="1"
                                                        height="100" fill="#b1b9c4" filter="none"
                                                        fill-opacity="0.9" stroke-width="1"></line>
                                                    <g id="SvgjsG2010" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG2011" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"></g>
                                                    </g>
                                                    <g id="SvgjsG2020" class="apexcharts-grid">
                                                        <g id="SvgjsG2021" class="apexcharts-gridlines-horizontal"
                                                            style="display: none;">
                                                            <line id="SvgjsLine2023" x1="0" y1="0"
                                                                x2="344" y2="0" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2024" x1="0" y1="25"
                                                                x2="344" y2="25" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2025" x1="0" y1="50"
                                                                x2="344" y2="50" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2026" x1="0" y1="75"
                                                                x2="344" y2="75" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2027" x1="0" y1="100"
                                                                x2="344" y2="100" stroke="#e0e0e0"
                                                                stroke-dasharray="0" stroke-linecap="butt"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG2022" class="apexcharts-gridlines-vertical"
                                                            style="display: none;"></g>
                                                        <line id="SvgjsLine2029" x1="0" y1="100"
                                                            x2="344" y2="100" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        <line id="SvgjsLine2028" x1="0" y1="1"
                                                            x2="0" y2="100" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    </g>
                                                    <g id="SvgjsG1994"
                                                        class="apexcharts-line-series apexcharts-plot-series">
                                                        <g id="SvgjsG1995" class="apexcharts-series"
                                                            seriesName="seriesx1" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath2009"
                                                                d="M 0 100C 24.08 100 44.72 6.25 68.8 6.25C 92.88 6.25 113.52 84.375 137.6 84.375C 161.68 84.375 182.32 37.5 206.4 37.5C 230.48 37.5 251.12 90.625 275.2 90.625C 299.28 90.625 319.92 6.875 344 6.875"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(57,218,138,0.85)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="4"
                                                                stroke-dasharray="0" class="apexcharts-line"
                                                                index="0" clip-path="url(#gridRectMask6n6xgo3jl)"
                                                                pathTo="M 0 100C 24.08 100 44.72 6.25 68.8 6.25C 92.88 6.25 113.52 84.375 137.6 84.375C 161.68 84.375 182.32 37.5 206.4 37.5C 230.48 37.5 251.12 90.625 275.2 90.625C 299.28 90.625 319.92 6.875 344 6.875"
                                                                pathFrom="M -1 100L -1 100L 68.8 100L 137.6 100L 206.4 100L 275.2 100L 344 100">
                                                            </path>
                                                            <g id="SvgjsG1996" class="apexcharts-series-markers-wrap"
                                                                data:realIndex="0">
                                                                <g id="SvgjsG1998" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask6n6xgo3jl)">
                                                                    <circle id="SvgjsCircle1999" r="6" cx="0"
                                                                        cy="100"
                                                                        class="apexcharts-marker no-pointer-events w29aen77oi"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="0" j="0"
                                                                        index="0" default-marker-size="6"></circle>
                                                                    <circle id="SvgjsCircle2000" r="6" cx="68.8"
                                                                        cy="6.25"
                                                                        class="apexcharts-marker no-pointer-events w6opkau69h"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="1" j="1"
                                                                        index="0" default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG2001" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask6n6xgo3jl)">
                                                                    <circle id="SvgjsCircle2002" r="6" cx="137.6"
                                                                        cy="84.375"
                                                                        class="apexcharts-marker no-pointer-events wcx93h5lk"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="2" j="2"
                                                                        index="0" default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG2003" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask6n6xgo3jl)">
                                                                    <circle id="SvgjsCircle2004" r="6" cx="206.4"
                                                                        cy="37.5"
                                                                        class="apexcharts-marker no-pointer-events wo2r2f6hn"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="3" j="3"
                                                                        index="0" default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG2005" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask6n6xgo3jl)">
                                                                    <circle id="SvgjsCircle2006" r="6" cx="275.2"
                                                                        cy="90.625"
                                                                        class="apexcharts-marker no-pointer-events wzyq16t9ll"
                                                                        stroke="transparent" fill="transparent"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="4" j="4"
                                                                        index="0" default-marker-size="6"></circle>
                                                                </g>
                                                                <g id="SvgjsG2007" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask6n6xgo3jl)">
                                                                    <circle id="SvgjsCircle2008" r="6" cx="344"
                                                                        cy="6.875"
                                                                        class="apexcharts-marker no-pointer-events wc2tw2nof"
                                                                        stroke="#39da8a" fill="#ffffff"
                                                                        fill-opacity="1" stroke-width="4"
                                                                        stroke-opacity="0.9" rel="5" j="5"
                                                                        index="0" default-marker-size="6"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1997" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine2030" x1="0" y1="0"
                                                        x2="344" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine2031" x1="0" y1="0"
                                                        x2="344" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG2032" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG2033" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG2034" class="apexcharts-point-annotations"></g>
                                                    <rect id="SvgjsRect2035" width="0" height="0" x="0" y="0"
                                                        rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                                    <rect id="SvgjsRect2036" width="0" height="0" x="0" y="0"
                                                        rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                                </g>
                                                <rect id="SvgjsRect1990" width="0" height="0" x="0" y="0"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                                <g id="SvgjsG2018" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-8, 0)">
                                                    <g id="SvgjsG2019" class="apexcharts-yaxis-texts-g"></g>
                                                </g>
                                                <g id="SvgjsG1988" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 50px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light"
                                                style="left: 102.8px; top: 9.75px;">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">2
                                                </div>
                                                <div class="apexcharts-tooltip-series-group apexcharts-active"
                                                    style="order: 1; display: flex;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(57, 218, 138);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label">series-1:
                                                            </span><span
                                                                class="apexcharts-tooltip-text-y-value">150</span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"
                                                style="left: 75.1281px; top: 107px;">
                                                <div class="apexcharts-xaxistooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 8.34375px;">
                                                    2</div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 421px; height: 203px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Conversion Chart-->
                        <div class="col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-3">
                                    <div class="conversion-title">
                                        <h5 class="card-title mb-1">Conversion</h5>
                                        <p class="mb-0 text-muted">60%
                                            <i class="bx bx-chevron-up text-success"></i>
                                        </p>
                                    </div>
                                    <h2 class="mb-0">89k</h2>
                                </div>
                                <div class="card-body" style="position: relative;">
                                    <div id="conversionBarchart" style="min-height: 100px;">
                                        <div id="apexchartskjzl4hhn"
                                            class="apexcharts-canvas apexchartskjzl4hhn apexcharts-theme-light"
                                            style="width: 376px; height: 100px;"><svg id="SvgjsSvg2037" width="376"
                                                height="100" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG2039" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(13.177777777777777, 0)">
                                                    <defs id="SvgjsDefs2038">
                                                        <linearGradient id="SvgjsLinearGradient2042" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop2043" stop-opacity="0.4"
                                                                stop-color="rgba(216,227,240,0.4)" offset="0">
                                                            </stop>
                                                            <stop id="SvgjsStop2044" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1">
                                                            </stop>
                                                            <stop id="SvgjsStop2045" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1">
                                                            </stop>
                                                        </linearGradient>
                                                        <clipPath id="gridRectMaskkjzl4hhn">
                                                            <rect id="SvgjsRect2047" width="380" height="110"
                                                                x="-11.177777777777777" y="0" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMaskkjzl4hhn"></clipPath>
                                                        <clipPath id="nonForecastMaskkjzl4hhn"></clipPath>
                                                        <clipPath id="gridRectMarkerMaskkjzl4hhn">
                                                            <rect id="SvgjsRect2048" width="361.64444444444445"
                                                                height="114" x="-2" y="-2" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                    </defs>
                                                    <rect id="SvgjsRect2046" width="5.960740740740741" height="110"
                                                        x="0" y="0" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke-dasharray="3"
                                                        fill="url(#SvgjsLinearGradient2042)"
                                                        class="apexcharts-xcrosshairs" y2="110" filter="none"
                                                        fill-opacity="0.9"></rect>
                                                    <g id="SvgjsG2086" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG2087" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"></g>
                                                    </g>
                                                    <g id="SvgjsG2095" class="apexcharts-grid">
                                                        <g id="SvgjsG2096" class="apexcharts-gridlines-horizontal"
                                                            style="display: none;">
                                                            <line id="SvgjsLine2098" x1="-9.177777777777777"
                                                                y1="0" x2="366.8222222222222" y2="0"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine2099" x1="-9.177777777777777"
                                                                y1="22" x2="366.8222222222222" y2="22"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine2100" x1="-9.177777777777777"
                                                                y1="44" x2="366.8222222222222" y2="44"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine2101" x1="-9.177777777777777"
                                                                y1="66" x2="366.8222222222222" y2="66"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine2102" x1="-9.177777777777777"
                                                                y1="88" x2="366.8222222222222" y2="88"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                            <line id="SvgjsLine2103" x1="-9.177777777777777"
                                                                y1="110" x2="366.8222222222222" y2="110"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                stroke-linecap="butt" class="apexcharts-gridline">
                                                            </line>
                                                        </g>
                                                        <g id="SvgjsG2097" class="apexcharts-gridlines-vertical"
                                                            style="display: none;"></g>
                                                        <line id="SvgjsLine2105" x1="0" y1="110"
                                                            x2="357.64444444444445" y2="110"
                                                            stroke="transparent" stroke-dasharray="0"
                                                            stroke-linecap="butt"></line>
                                                        <line id="SvgjsLine2104" x1="0" y1="1"
                                                            x2="0" y2="110" stroke="transparent"
                                                            stroke-dasharray="0" stroke-linecap="butt"></line>
                                                    </g>
                                                    <g id="SvgjsG2049"
                                                        class="apexcharts-bar-series apexcharts-plot-series">
                                                        <g id="SvgjsG2050" class="apexcharts-series"
                                                            seriesName="NewxClients" rel="1"
                                                            data:realIndex="0">
                                                            <path id="SvgjsPath2052"
                                                                d="M -2.9803703703703706 66L -2.9803703703703706 49.66666666666667Q -2.9803703703703706 47.66666666666667 -0.9803703703703706 47.66666666666667L 0.9803703703703706 47.66666666666667Q 2.9803703703703706 47.66666666666667 2.9803703703703706 49.66666666666667L 2.9803703703703706 49.66666666666667L 2.9803703703703706 66Q 2.9803703703703706 66 2.9803703703703706 66L -2.9803703703703706 66Q -2.9803703703703706 66 -2.9803703703703706 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M -2.9803703703703706 66L -2.9803703703703706 49.66666666666667Q -2.9803703703703706 47.66666666666667 -0.9803703703703706 47.66666666666667L 0.9803703703703706 47.66666666666667Q 2.9803703703703706 47.66666666666667 2.9803703703703706 49.66666666666667L 2.9803703703703706 49.66666666666667L 2.9803703703703706 66Q 2.9803703703703706 66 2.9803703703703706 66L -2.9803703703703706 66Q -2.9803703703703706 66 -2.9803703703703706 66z"
                                                                pathFrom="M -2.9803703703703706 66L -2.9803703703703706 66L 2.9803703703703706 66L 2.9803703703703706 66L 2.9803703703703706 66L 2.9803703703703706 66L 2.9803703703703706 66L -2.9803703703703706 66"
                                                                cy="47.66666666666667" cx="2.9803703703703714" j="0"
                                                                val="75" barHeight="18.333333333333332"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2053"
                                                                d="M 20.862592592592595 66L 20.862592592592595 31.333333333333336Q 20.862592592592595 29.333333333333336 22.862592592592595 29.333333333333336L 24.823333333333338 29.333333333333336Q 26.823333333333338 29.333333333333336 26.823333333333338 31.333333333333336L 26.823333333333338 31.333333333333336L 26.823333333333338 66Q 26.823333333333338 66 26.823333333333338 66L 20.862592592592595 66Q 20.862592592592595 66 20.862592592592595 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 20.862592592592595 66L 20.862592592592595 31.333333333333336Q 20.862592592592595 29.333333333333336 22.862592592592595 29.333333333333336L 24.823333333333338 29.333333333333336Q 26.823333333333338 29.333333333333336 26.823333333333338 31.333333333333336L 26.823333333333338 31.333333333333336L 26.823333333333338 66Q 26.823333333333338 66 26.823333333333338 66L 20.862592592592595 66Q 20.862592592592595 66 20.862592592592595 66z"
                                                                pathFrom="M 20.862592592592595 66L 20.862592592592595 66L 26.823333333333338 66L 26.823333333333338 66L 26.823333333333338 66L 26.823333333333338 66L 26.823333333333338 66L 20.862592592592595 66"
                                                                cy="29.333333333333336" cx="26.823333333333338" j="1"
                                                                val="150" barHeight="36.666666666666664"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2054"
                                                                d="M 44.705555555555556 66L 44.705555555555556 13Q 44.705555555555556 11 46.705555555555556 11L 48.666296296296295 11Q 50.666296296296295 11 50.666296296296295 13L 50.666296296296295 13L 50.666296296296295 66Q 50.666296296296295 66 50.666296296296295 66L 44.705555555555556 66Q 44.705555555555556 66 44.705555555555556 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 44.705555555555556 66L 44.705555555555556 13Q 44.705555555555556 11 46.705555555555556 11L 48.666296296296295 11Q 50.666296296296295 11 50.666296296296295 13L 50.666296296296295 13L 50.666296296296295 66Q 50.666296296296295 66 50.666296296296295 66L 44.705555555555556 66Q 44.705555555555556 66 44.705555555555556 66z"
                                                                pathFrom="M 44.705555555555556 66L 44.705555555555556 66L 50.666296296296295 66L 50.666296296296295 66L 50.666296296296295 66L 50.666296296296295 66L 50.666296296296295 66L 44.705555555555556 66"
                                                                cy="11" cx="50.666296296296295" j="2"
                                                                val="225" barHeight="55"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2055"
                                                                d="M 68.54851851851852 66L 68.54851851851852 19.111111111111107Q 68.54851851851852 17.111111111111107 70.54851851851852 17.111111111111107L 72.50925925925927 17.111111111111107Q 74.50925925925927 17.111111111111107 74.50925925925927 19.111111111111107L 74.50925925925927 19.111111111111107L 74.50925925925927 66Q 74.50925925925927 66 74.50925925925927 66L 68.54851851851852 66Q 68.54851851851852 66 68.54851851851852 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 68.54851851851852 66L 68.54851851851852 19.111111111111107Q 68.54851851851852 17.111111111111107 70.54851851851852 17.111111111111107L 72.50925925925927 17.111111111111107Q 74.50925925925927 17.111111111111107 74.50925925925927 19.111111111111107L 74.50925925925927 19.111111111111107L 74.50925925925927 66Q 74.50925925925927 66 74.50925925925927 66L 68.54851851851852 66Q 68.54851851851852 66 68.54851851851852 66z"
                                                                pathFrom="M 68.54851851851852 66L 68.54851851851852 66L 74.50925925925927 66L 74.50925925925927 66L 74.50925925925927 66L 74.50925925925927 66L 74.50925925925927 66L 68.54851851851852 66"
                                                                cy="17.111111111111107" cx="74.50925925925928" j="3"
                                                                val="200" barHeight="48.88888888888889"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2056"
                                                                d="M 92.39148148148149 66L 92.39148148148149 59.44444444444444Q 92.39148148148149 57.44444444444444 94.39148148148149 57.44444444444444L 96.35222222222224 57.44444444444444Q 98.35222222222224 57.44444444444444 98.35222222222224 59.44444444444444L 98.35222222222224 59.44444444444444L 98.35222222222224 66Q 98.35222222222224 66 98.35222222222224 66L 92.39148148148149 66Q 92.39148148148149 66 92.39148148148149 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 92.39148148148149 66L 92.39148148148149 59.44444444444444Q 92.39148148148149 57.44444444444444 94.39148148148149 57.44444444444444L 96.35222222222224 57.44444444444444Q 98.35222222222224 57.44444444444444 98.35222222222224 59.44444444444444L 98.35222222222224 59.44444444444444L 98.35222222222224 66Q 98.35222222222224 66 98.35222222222224 66L 92.39148148148149 66Q 92.39148148148149 66 92.39148148148149 66z"
                                                                pathFrom="M 92.39148148148149 66L 92.39148148148149 66L 98.35222222222224 66L 98.35222222222224 66L 98.35222222222224 66L 98.35222222222224 66L 98.35222222222224 66L 92.39148148148149 66"
                                                                cy="57.44444444444444" cx="98.35222222222224" j="4"
                                                                val="35" barHeight="8.555555555555555"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2057"
                                                                d="M 116.23444444444445 66L 116.23444444444445 55.77777777777778Q 116.23444444444445 53.77777777777778 118.23444444444445 53.77777777777778L 120.1951851851852 53.77777777777778Q 122.1951851851852 53.77777777777778 122.1951851851852 55.77777777777778L 122.1951851851852 55.77777777777778L 122.1951851851852 66Q 122.1951851851852 66 122.1951851851852 66L 116.23444444444445 66Q 116.23444444444445 66 116.23444444444445 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 116.23444444444445 66L 116.23444444444445 55.77777777777778Q 116.23444444444445 53.77777777777778 118.23444444444445 53.77777777777778L 120.1951851851852 53.77777777777778Q 122.1951851851852 53.77777777777778 122.1951851851852 55.77777777777778L 122.1951851851852 55.77777777777778L 122.1951851851852 66Q 122.1951851851852 66 122.1951851851852 66L 116.23444444444445 66Q 116.23444444444445 66 116.23444444444445 66z"
                                                                pathFrom="M 116.23444444444445 66L 116.23444444444445 66L 122.1951851851852 66L 122.1951851851852 66L 122.1951851851852 66L 122.1951851851852 66L 122.1951851851852 66L 116.23444444444445 66"
                                                                cy="53.77777777777778" cx="122.1951851851852" j="5"
                                                                val="50" barHeight="12.222222222222223"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2058"
                                                                d="M 140.0774074074074 66L 140.0774074074074 31.333333333333336Q 140.0774074074074 29.333333333333336 142.0774074074074 29.333333333333336L 144.03814814814814 29.333333333333336Q 146.03814814814814 29.333333333333336 146.03814814814814 31.333333333333336L 146.03814814814814 31.333333333333336L 146.03814814814814 66Q 146.03814814814814 66 146.03814814814814 66L 140.0774074074074 66Q 140.0774074074074 66 140.0774074074074 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 140.0774074074074 66L 140.0774074074074 31.333333333333336Q 140.0774074074074 29.333333333333336 142.0774074074074 29.333333333333336L 144.03814814814814 29.333333333333336Q 146.03814814814814 29.333333333333336 146.03814814814814 31.333333333333336L 146.03814814814814 31.333333333333336L 146.03814814814814 66Q 146.03814814814814 66 146.03814814814814 66L 140.0774074074074 66Q 140.0774074074074 66 140.0774074074074 66z"
                                                                pathFrom="M 140.0774074074074 66L 140.0774074074074 66L 146.03814814814814 66L 146.03814814814814 66L 146.03814814814814 66L 146.03814814814814 66L 146.03814814814814 66L 140.0774074074074 66"
                                                                cy="29.333333333333336" cx="146.03814814814814" j="6"
                                                                val="150" barHeight="36.666666666666664"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2059"
                                                                d="M 163.9203703703704 66L 163.9203703703704 24Q 163.9203703703704 22 165.9203703703704 22L 167.88111111111112 22Q 169.88111111111112 22 169.88111111111112 24L 169.88111111111112 24L 169.88111111111112 66Q 169.88111111111112 66 169.88111111111112 66L 163.9203703703704 66Q 163.9203703703704 66 163.9203703703704 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 163.9203703703704 66L 163.9203703703704 24Q 163.9203703703704 22 165.9203703703704 22L 167.88111111111112 22Q 169.88111111111112 22 169.88111111111112 24L 169.88111111111112 24L 169.88111111111112 66Q 169.88111111111112 66 169.88111111111112 66L 163.9203703703704 66Q 163.9203703703704 66 163.9203703703704 66z"
                                                                pathFrom="M 163.9203703703704 66L 163.9203703703704 66L 169.88111111111112 66L 169.88111111111112 66L 169.88111111111112 66L 169.88111111111112 66L 169.88111111111112 66L 163.9203703703704 66"
                                                                cy="22" cx="169.88111111111112" j="7"
                                                                val="180" barHeight="44"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2060"
                                                                d="M 187.76333333333335 66L 187.76333333333335 55.77777777777778Q 187.76333333333335 53.77777777777778 189.76333333333335 53.77777777777778L 191.72407407407408 53.77777777777778Q 193.72407407407408 53.77777777777778 193.72407407407408 55.77777777777778L 193.72407407407408 55.77777777777778L 193.72407407407408 66Q 193.72407407407408 66 193.72407407407408 66L 187.76333333333335 66Q 187.76333333333335 66 187.76333333333335 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 187.76333333333335 66L 187.76333333333335 55.77777777777778Q 187.76333333333335 53.77777777777778 189.76333333333335 53.77777777777778L 191.72407407407408 53.77777777777778Q 193.72407407407408 53.77777777777778 193.72407407407408 55.77777777777778L 193.72407407407408 55.77777777777778L 193.72407407407408 66Q 193.72407407407408 66 193.72407407407408 66L 187.76333333333335 66Q 187.76333333333335 66 187.76333333333335 66z"
                                                                pathFrom="M 187.76333333333335 66L 187.76333333333335 66L 193.72407407407408 66L 193.72407407407408 66L 193.72407407407408 66L 193.72407407407408 66L 193.72407407407408 66L 187.76333333333335 66"
                                                                cy="53.77777777777778" cx="193.72407407407408" j="8"
                                                                val="50" barHeight="12.222222222222223"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2061"
                                                                d="M 211.6062962962963 66L 211.6062962962963 31.333333333333336Q 211.6062962962963 29.333333333333336 213.6062962962963 29.333333333333336L 215.56703703703704 29.333333333333336Q 217.56703703703704 29.333333333333336 217.56703703703704 31.333333333333336L 217.56703703703704 31.333333333333336L 217.56703703703704 66Q 217.56703703703704 66 217.56703703703704 66L 211.6062962962963 66Q 211.6062962962963 66 211.6062962962963 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 211.6062962962963 66L 211.6062962962963 31.333333333333336Q 211.6062962962963 29.333333333333336 213.6062962962963 29.333333333333336L 215.56703703703704 29.333333333333336Q 217.56703703703704 29.333333333333336 217.56703703703704 31.333333333333336L 217.56703703703704 31.333333333333336L 217.56703703703704 66Q 217.56703703703704 66 217.56703703703704 66L 211.6062962962963 66Q 211.6062962962963 66 211.6062962962963 66z"
                                                                pathFrom="M 211.6062962962963 66L 211.6062962962963 66L 217.56703703703704 66L 217.56703703703704 66L 217.56703703703704 66L 217.56703703703704 66L 217.56703703703704 66L 211.6062962962963 66"
                                                                cy="29.333333333333336" cx="217.56703703703704" j="9"
                                                                val="150" barHeight="36.666666666666664"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2062"
                                                                d="M 235.44925925925926 66L 235.44925925925926 9.333333333333336Q 235.44925925925926 7.333333333333336 237.44925925925926 7.333333333333336L 239.41 7.333333333333336Q 241.41 7.333333333333336 241.41 9.333333333333336L 241.41 9.333333333333336L 241.41 66Q 241.41 66 241.41 66L 235.44925925925926 66Q 235.44925925925926 66 235.44925925925926 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 235.44925925925926 66L 235.44925925925926 9.333333333333336Q 235.44925925925926 7.333333333333336 237.44925925925926 7.333333333333336L 239.41 7.333333333333336Q 241.41 7.333333333333336 241.41 9.333333333333336L 241.41 9.333333333333336L 241.41 66Q 241.41 66 241.41 66L 235.44925925925926 66Q 235.44925925925926 66 235.44925925925926 66z"
                                                                pathFrom="M 235.44925925925926 66L 235.44925925925926 66L 241.41 66L 241.41 66L 241.41 66L 241.41 66L 241.41 66L 235.44925925925926 66"
                                                                cy="7.333333333333336" cx="241.41" j="10"
                                                                val="240" barHeight="58.666666666666664"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2063"
                                                                d="M 259.2922222222222 66L 259.2922222222222 33.77777777777778Q 259.2922222222222 31.77777777777778 261.2922222222222 31.77777777777778L 263.25296296296295 31.77777777777778Q 265.25296296296295 31.77777777777778 265.25296296296295 33.77777777777778L 265.25296296296295 33.77777777777778L 265.25296296296295 66Q 265.25296296296295 66 265.25296296296295 66L 259.2922222222222 66Q 259.2922222222222 66 259.2922222222222 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 259.2922222222222 66L 259.2922222222222 33.77777777777778Q 259.2922222222222 31.77777777777778 261.2922222222222 31.77777777777778L 263.25296296296295 31.77777777777778Q 265.25296296296295 31.77777777777778 265.25296296296295 33.77777777777778L 265.25296296296295 33.77777777777778L 265.25296296296295 66Q 265.25296296296295 66 265.25296296296295 66L 259.2922222222222 66Q 259.2922222222222 66 259.2922222222222 66z"
                                                                pathFrom="M 259.2922222222222 66L 259.2922222222222 66L 265.25296296296295 66L 265.25296296296295 66L 265.25296296296295 66L 265.25296296296295 66L 265.25296296296295 66L 259.2922222222222 66"
                                                                cy="31.77777777777778" cx="265.25296296296295" j="11"
                                                                val="140" barHeight="34.22222222222222"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2064"
                                                                d="M 283.13518518518515 66L 283.13518518518515 49.66666666666667Q 283.13518518518515 47.66666666666667 285.13518518518515 47.66666666666667L 287.0959259259259 47.66666666666667Q 289.0959259259259 47.66666666666667 289.0959259259259 49.66666666666667L 289.0959259259259 49.66666666666667L 289.0959259259259 66Q 289.0959259259259 66 289.0959259259259 66L 283.13518518518515 66Q 283.13518518518515 66 283.13518518518515 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 283.13518518518515 66L 283.13518518518515 49.66666666666667Q 283.13518518518515 47.66666666666667 285.13518518518515 47.66666666666667L 287.0959259259259 47.66666666666667Q 289.0959259259259 47.66666666666667 289.0959259259259 49.66666666666667L 289.0959259259259 49.66666666666667L 289.0959259259259 66Q 289.0959259259259 66 289.0959259259259 66L 283.13518518518515 66Q 283.13518518518515 66 283.13518518518515 66z"
                                                                pathFrom="M 283.13518518518515 66L 283.13518518518515 66L 289.0959259259259 66L 289.0959259259259 66L 289.0959259259259 66L 289.0959259259259 66L 289.0959259259259 66L 283.13518518518515 66"
                                                                cy="47.66666666666667" cx="289.0959259259259" j="12"
                                                                val="75" barHeight="18.333333333333332"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2065"
                                                                d="M 306.97814814814814 66L 306.97814814814814 59.44444444444444Q 306.97814814814814 57.44444444444444 308.97814814814814 57.44444444444444L 310.93888888888887 57.44444444444444Q 312.93888888888887 57.44444444444444 312.93888888888887 59.44444444444444L 312.93888888888887 59.44444444444444L 312.93888888888887 66Q 312.93888888888887 66 312.93888888888887 66L 306.97814814814814 66Q 306.97814814814814 66 306.97814814814814 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 306.97814814814814 66L 306.97814814814814 59.44444444444444Q 306.97814814814814 57.44444444444444 308.97814814814814 57.44444444444444L 310.93888888888887 57.44444444444444Q 312.93888888888887 57.44444444444444 312.93888888888887 59.44444444444444L 312.93888888888887 59.44444444444444L 312.93888888888887 66Q 312.93888888888887 66 312.93888888888887 66L 306.97814814814814 66Q 306.97814814814814 66 306.97814814814814 66z"
                                                                pathFrom="M 306.97814814814814 66L 306.97814814814814 66L 312.93888888888887 66L 312.93888888888887 66L 312.93888888888887 66L 312.93888888888887 66L 312.93888888888887 66L 306.97814814814814 66"
                                                                cy="57.44444444444444" cx="312.93888888888887" j="13"
                                                                val="35" barHeight="8.555555555555555"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2066"
                                                                d="M 330.8211111111111 66L 330.8211111111111 53.333333333333336Q 330.8211111111111 51.333333333333336 332.8211111111111 51.333333333333336L 334.78185185185185 51.333333333333336Q 336.78185185185185 51.333333333333336 336.78185185185185 53.333333333333336L 336.78185185185185 53.333333333333336L 336.78185185185185 66Q 336.78185185185185 66 336.78185185185185 66L 330.8211111111111 66Q 330.8211111111111 66 330.8211111111111 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 330.8211111111111 66L 330.8211111111111 53.333333333333336Q 330.8211111111111 51.333333333333336 332.8211111111111 51.333333333333336L 334.78185185185185 51.333333333333336Q 336.78185185185185 51.333333333333336 336.78185185185185 53.333333333333336L 336.78185185185185 53.333333333333336L 336.78185185185185 66Q 336.78185185185185 66 336.78185185185185 66L 330.8211111111111 66Q 330.8211111111111 66 330.8211111111111 66z"
                                                                pathFrom="M 330.8211111111111 66L 330.8211111111111 66L 336.78185185185185 66L 336.78185185185185 66L 336.78185185185185 66L 336.78185185185185 66L 336.78185185185185 66L 330.8211111111111 66"
                                                                cy="51.333333333333336" cx="336.78185185185185" j="14"
                                                                val="60" barHeight="14.666666666666666"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2067"
                                                                d="M 354.66407407407405 66L 354.66407407407405 38.66666666666667Q 354.66407407407405 36.66666666666667 356.66407407407405 36.66666666666667L 358.6248148148148 36.66666666666667Q 360.6248148148148 36.66666666666667 360.6248148148148 38.66666666666667L 360.6248148148148 38.66666666666667L 360.6248148148148 66Q 360.6248148148148 66 360.6248148148148 66L 354.66407407407405 66Q 354.66407407407405 66 354.66407407407405 66z"
                                                                fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 354.66407407407405 66L 354.66407407407405 38.66666666666667Q 354.66407407407405 36.66666666666667 356.66407407407405 36.66666666666667L 358.6248148148148 36.66666666666667Q 360.6248148148148 36.66666666666667 360.6248148148148 38.66666666666667L 360.6248148148148 38.66666666666667L 360.6248148148148 66Q 360.6248148148148 66 360.6248148148148 66L 354.66407407407405 66Q 354.66407407407405 66 354.66407407407405 66z"
                                                                pathFrom="M 354.66407407407405 66L 354.66407407407405 66L 360.6248148148148 66L 360.6248148148148 66L 360.6248148148148 66L 360.6248148148148 66L 360.6248148148148 66L 354.66407407407405 66"
                                                                cy="36.66666666666667" cx="360.6248148148148" j="15"
                                                                val="120" barHeight="29.333333333333332"
                                                                barWidth="5.960740740740741"></path>
                                                        </g>
                                                        <g id="SvgjsG2068" class="apexcharts-series"
                                                            seriesName="RetainedxClients" rel="2"
                                                            data:realIndex="1">
                                                            <path id="SvgjsPath2070"
                                                                d="M -2.9803703703703706 68L -2.9803703703703706 90.44444444444444Q -2.9803703703703706 92.44444444444444 -0.9803703703703706 92.44444444444444L 0.9803703703703706 92.44444444444444Q 2.9803703703703706 92.44444444444444 2.9803703703703706 90.44444444444444L 2.9803703703703706 90.44444444444444L 2.9803703703703706 68Q 2.9803703703703706 68 2.9803703703703706 68L -2.9803703703703706 68Q -2.9803703703703706 68 -2.9803703703703706 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M -2.9803703703703706 68L -2.9803703703703706 90.44444444444444Q -2.9803703703703706 92.44444444444444 -0.9803703703703706 92.44444444444444L 0.9803703703703706 92.44444444444444Q 2.9803703703703706 92.44444444444444 2.9803703703703706 90.44444444444444L 2.9803703703703706 90.44444444444444L 2.9803703703703706 68Q 2.9803703703703706 68 2.9803703703703706 68L -2.9803703703703706 68Q -2.9803703703703706 68 -2.9803703703703706 68z"
                                                                pathFrom="M -2.9803703703703706 68L -2.9803703703703706 68L 2.9803703703703706 68L 2.9803703703703706 68L 2.9803703703703706 68L 2.9803703703703706 68L 2.9803703703703706 68L -2.9803703703703706 68"
                                                                cy="88.44444444444444" cx="2.9803703703703714" j="0"
                                                                val="-100" barHeight="-24.444444444444446"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2071"
                                                                d="M 20.862592592592595 68L 20.862592592592595 79.44444444444444Q 20.862592592592595 81.44444444444444 22.862592592592595 81.44444444444444L 24.823333333333338 81.44444444444444Q 26.823333333333338 81.44444444444444 26.823333333333338 79.44444444444444L 26.823333333333338 79.44444444444444L 26.823333333333338 68Q 26.823333333333338 68 26.823333333333338 68L 20.862592592592595 68Q 20.862592592592595 68 20.862592592592595 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 20.862592592592595 68L 20.862592592592595 79.44444444444444Q 20.862592592592595 81.44444444444444 22.862592592592595 81.44444444444444L 24.823333333333338 81.44444444444444Q 26.823333333333338 81.44444444444444 26.823333333333338 79.44444444444444L 26.823333333333338 79.44444444444444L 26.823333333333338 68Q 26.823333333333338 68 26.823333333333338 68L 20.862592592592595 68Q 20.862592592592595 68 20.862592592592595 68z"
                                                                pathFrom="M 20.862592592592595 68L 20.862592592592595 68L 26.823333333333338 68L 26.823333333333338 68L 26.823333333333338 68L 26.823333333333338 68L 26.823333333333338 68L 20.862592592592595 68"
                                                                cy="77.44444444444444" cx="26.823333333333338" j="1"
                                                                val="-55" barHeight="-13.444444444444445"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2072"
                                                                d="M 44.705555555555556 68L 44.705555555555556 75.77777777777777Q 44.705555555555556 77.77777777777777 46.705555555555556 77.77777777777777L 48.666296296296295 77.77777777777777Q 50.666296296296295 77.77777777777777 50.666296296296295 75.77777777777777L 50.666296296296295 75.77777777777777L 50.666296296296295 68Q 50.666296296296295 68 50.666296296296295 68L 44.705555555555556 68Q 44.705555555555556 68 44.705555555555556 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 44.705555555555556 68L 44.705555555555556 75.77777777777777Q 44.705555555555556 77.77777777777777 46.705555555555556 77.77777777777777L 48.666296296296295 77.77777777777777Q 50.666296296296295 77.77777777777777 50.666296296296295 75.77777777777777L 50.666296296296295 75.77777777777777L 50.666296296296295 68Q 50.666296296296295 68 50.666296296296295 68L 44.705555555555556 68Q 44.705555555555556 68 44.705555555555556 68z"
                                                                pathFrom="M 44.705555555555556 68L 44.705555555555556 68L 50.666296296296295 68L 50.666296296296295 68L 50.666296296296295 68L 50.666296296296295 68L 50.666296296296295 68L 44.705555555555556 68"
                                                                cy="73.77777777777777" cx="50.666296296296295" j="2"
                                                                val="-40" barHeight="-9.777777777777779"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2073"
                                                                d="M 68.54851851851852 68L 68.54851851851852 95.33333333333333Q 68.54851851851852 97.33333333333333 70.54851851851852 97.33333333333333L 72.50925925925927 97.33333333333333Q 74.50925925925927 97.33333333333333 74.50925925925927 95.33333333333333L 74.50925925925927 95.33333333333333L 74.50925925925927 68Q 74.50925925925927 68 74.50925925925927 68L 68.54851851851852 68Q 68.54851851851852 68 68.54851851851852 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 68.54851851851852 68L 68.54851851851852 95.33333333333333Q 68.54851851851852 97.33333333333333 70.54851851851852 97.33333333333333L 72.50925925925927 97.33333333333333Q 74.50925925925927 97.33333333333333 74.50925925925927 95.33333333333333L 74.50925925925927 95.33333333333333L 74.50925925925927 68Q 74.50925925925927 68 74.50925925925927 68L 68.54851851851852 68Q 68.54851851851852 68 68.54851851851852 68z"
                                                                pathFrom="M 68.54851851851852 68L 68.54851851851852 68L 74.50925925925927 68L 74.50925925925927 68L 74.50925925925927 68L 74.50925925925927 68L 74.50925925925927 68L 68.54851851851852 68"
                                                                cy="93.33333333333333" cx="74.50925925925928" j="3"
                                                                val="-120" barHeight="-29.333333333333332"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2074"
                                                                d="M 92.39148148148149 68L 92.39148148148149 83.11111111111111Q 92.39148148148149 85.11111111111111 94.39148148148149 85.11111111111111L 96.35222222222224 85.11111111111111Q 98.35222222222224 85.11111111111111 98.35222222222224 83.11111111111111L 98.35222222222224 83.11111111111111L 98.35222222222224 68Q 98.35222222222224 68 98.35222222222224 68L 92.39148148148149 68Q 92.39148148148149 68 92.39148148148149 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 92.39148148148149 68L 92.39148148148149 83.11111111111111Q 92.39148148148149 85.11111111111111 94.39148148148149 85.11111111111111L 96.35222222222224 85.11111111111111Q 98.35222222222224 85.11111111111111 98.35222222222224 83.11111111111111L 98.35222222222224 83.11111111111111L 98.35222222222224 68Q 98.35222222222224 68 98.35222222222224 68L 92.39148148148149 68Q 92.39148148148149 68 92.39148148148149 68z"
                                                                pathFrom="M 92.39148148148149 68L 92.39148148148149 68L 98.35222222222224 68L 98.35222222222224 68L 98.35222222222224 68L 98.35222222222224 68L 98.35222222222224 68L 92.39148148148149 68"
                                                                cy="81.11111111111111" cx="98.35222222222224" j="4"
                                                                val="-70" barHeight="-17.11111111111111"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2075"
                                                                d="M 116.23444444444445 68L 116.23444444444445 75.77777777777777Q 116.23444444444445 77.77777777777777 118.23444444444445 77.77777777777777L 120.1951851851852 77.77777777777777Q 122.1951851851852 77.77777777777777 122.1951851851852 75.77777777777777L 122.1951851851852 75.77777777777777L 122.1951851851852 68Q 122.1951851851852 68 122.1951851851852 68L 116.23444444444445 68Q 116.23444444444445 68 116.23444444444445 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 116.23444444444445 68L 116.23444444444445 75.77777777777777Q 116.23444444444445 77.77777777777777 118.23444444444445 77.77777777777777L 120.1951851851852 77.77777777777777Q 122.1951851851852 77.77777777777777 122.1951851851852 75.77777777777777L 122.1951851851852 75.77777777777777L 122.1951851851852 68Q 122.1951851851852 68 122.1951851851852 68L 116.23444444444445 68Q 116.23444444444445 68 116.23444444444445 68z"
                                                                pathFrom="M 116.23444444444445 68L 116.23444444444445 68L 122.1951851851852 68L 122.1951851851852 68L 122.1951851851852 68L 122.1951851851852 68L 122.1951851851852 68L 116.23444444444445 68"
                                                                cy="73.77777777777777" cx="122.1951851851852" j="5"
                                                                val="-40" barHeight="-9.777777777777779"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2076"
                                                                d="M 140.0774074074074 68L 140.0774074074074 80.66666666666667Q 140.0774074074074 82.66666666666667 142.0774074074074 82.66666666666667L 144.03814814814814 82.66666666666667Q 146.03814814814814 82.66666666666667 146.03814814814814 80.66666666666667L 146.03814814814814 80.66666666666667L 146.03814814814814 68Q 146.03814814814814 68 146.03814814814814 68L 140.0774074074074 68Q 140.0774074074074 68 140.0774074074074 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 140.0774074074074 68L 140.0774074074074 80.66666666666667Q 140.0774074074074 82.66666666666667 142.0774074074074 82.66666666666667L 144.03814814814814 82.66666666666667Q 146.03814814814814 82.66666666666667 146.03814814814814 80.66666666666667L 146.03814814814814 80.66666666666667L 146.03814814814814 68Q 146.03814814814814 68 146.03814814814814 68L 140.0774074074074 68Q 140.0774074074074 68 140.0774074074074 68z"
                                                                pathFrom="M 140.0774074074074 68L 140.0774074074074 68L 146.03814814814814 68L 146.03814814814814 68L 146.03814814814814 68L 146.03814814814814 68L 146.03814814814814 68L 140.0774074074074 68"
                                                                cy="78.66666666666667" cx="146.03814814814814" j="6"
                                                                val="-60" barHeight="-14.666666666666666"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2077"
                                                                d="M 163.9203703703704 68L 163.9203703703704 78.22222222222223Q 163.9203703703704 80.22222222222223 165.9203703703704 80.22222222222223L 167.88111111111112 80.22222222222223Q 169.88111111111112 80.22222222222223 169.88111111111112 78.22222222222223L 169.88111111111112 78.22222222222223L 169.88111111111112 68Q 169.88111111111112 68 169.88111111111112 68L 163.9203703703704 68Q 163.9203703703704 68 163.9203703703704 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 163.9203703703704 68L 163.9203703703704 78.22222222222223Q 163.9203703703704 80.22222222222223 165.9203703703704 80.22222222222223L 167.88111111111112 80.22222222222223Q 169.88111111111112 80.22222222222223 169.88111111111112 78.22222222222223L 169.88111111111112 78.22222222222223L 169.88111111111112 68Q 169.88111111111112 68 169.88111111111112 68L 163.9203703703704 68Q 163.9203703703704 68 163.9203703703704 68z"
                                                                pathFrom="M 163.9203703703704 68L 163.9203703703704 68L 169.88111111111112 68L 169.88111111111112 68L 169.88111111111112 68L 169.88111111111112 68L 169.88111111111112 68L 163.9203703703704 68"
                                                                cy="76.22222222222223" cx="169.88111111111112" j="7"
                                                                val="-50" barHeight="-12.222222222222223"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2078"
                                                                d="M 187.76333333333335 68L 187.76333333333335 83.11111111111111Q 187.76333333333335 85.11111111111111 189.76333333333335 85.11111111111111L 191.72407407407408 85.11111111111111Q 193.72407407407408 85.11111111111111 193.72407407407408 83.11111111111111L 193.72407407407408 83.11111111111111L 193.72407407407408 68Q 193.72407407407408 68 193.72407407407408 68L 187.76333333333335 68Q 187.76333333333335 68 187.76333333333335 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 187.76333333333335 68L 187.76333333333335 83.11111111111111Q 187.76333333333335 85.11111111111111 189.76333333333335 85.11111111111111L 191.72407407407408 85.11111111111111Q 193.72407407407408 85.11111111111111 193.72407407407408 83.11111111111111L 193.72407407407408 83.11111111111111L 193.72407407407408 68Q 193.72407407407408 68 193.72407407407408 68L 187.76333333333335 68Q 187.76333333333335 68 187.76333333333335 68z"
                                                                pathFrom="M 187.76333333333335 68L 187.76333333333335 68L 193.72407407407408 68L 193.72407407407408 68L 193.72407407407408 68L 193.72407407407408 68L 193.72407407407408 68L 187.76333333333335 68"
                                                                cy="81.11111111111111" cx="193.72407407407408" j="8"
                                                                val="-70" barHeight="-17.11111111111111"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2079"
                                                                d="M 211.6062962962963 68L 211.6062962962963 73.33333333333333Q 211.6062962962963 75.33333333333333 213.6062962962963 75.33333333333333L 215.56703703703704 75.33333333333333Q 217.56703703703704 75.33333333333333 217.56703703703704 73.33333333333333L 217.56703703703704 73.33333333333333L 217.56703703703704 68Q 217.56703703703704 68 217.56703703703704 68L 211.6062962962963 68Q 211.6062962962963 68 211.6062962962963 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 211.6062962962963 68L 211.6062962962963 73.33333333333333Q 211.6062962962963 75.33333333333333 213.6062962962963 75.33333333333333L 215.56703703703704 75.33333333333333Q 217.56703703703704 75.33333333333333 217.56703703703704 73.33333333333333L 217.56703703703704 73.33333333333333L 217.56703703703704 68Q 217.56703703703704 68 217.56703703703704 68L 211.6062962962963 68Q 211.6062962962963 68 211.6062962962963 68z"
                                                                pathFrom="M 211.6062962962963 68L 211.6062962962963 68L 217.56703703703704 68L 217.56703703703704 68L 217.56703703703704 68L 217.56703703703704 68L 217.56703703703704 68L 211.6062962962963 68"
                                                                cy="71.33333333333333" cx="217.56703703703704" j="9"
                                                                val="-30" barHeight="-7.333333333333333"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2080"
                                                                d="M 235.44925925925926 68L 235.44925925925926 80.66666666666667Q 235.44925925925926 82.66666666666667 237.44925925925926 82.66666666666667L 239.41 82.66666666666667Q 241.41 82.66666666666667 241.41 80.66666666666667L 241.41 80.66666666666667L 241.41 68Q 241.41 68 241.41 68L 235.44925925925926 68Q 235.44925925925926 68 235.44925925925926 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 235.44925925925926 68L 235.44925925925926 80.66666666666667Q 235.44925925925926 82.66666666666667 237.44925925925926 82.66666666666667L 239.41 82.66666666666667Q 241.41 82.66666666666667 241.41 80.66666666666667L 241.41 80.66666666666667L 241.41 68Q 241.41 68 241.41 68L 235.44925925925926 68Q 235.44925925925926 68 235.44925925925926 68z"
                                                                pathFrom="M 235.44925925925926 68L 235.44925925925926 68L 241.41 68L 241.41 68L 241.41 68L 241.41 68L 241.41 68L 235.44925925925926 68"
                                                                cy="78.66666666666667" cx="241.41" j="10"
                                                                val="-60" barHeight="-14.666666666666666"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2081"
                                                                d="M 259.2922222222222 68L 259.2922222222222 75.77777777777777Q 259.2922222222222 77.77777777777777 261.2922222222222 77.77777777777777L 263.25296296296295 77.77777777777777Q 265.25296296296295 77.77777777777777 265.25296296296295 75.77777777777777L 265.25296296296295 75.77777777777777L 265.25296296296295 68Q 265.25296296296295 68 265.25296296296295 68L 259.2922222222222 68Q 259.2922222222222 68 259.2922222222222 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 259.2922222222222 68L 259.2922222222222 75.77777777777777Q 259.2922222222222 77.77777777777777 261.2922222222222 77.77777777777777L 263.25296296296295 77.77777777777777Q 265.25296296296295 77.77777777777777 265.25296296296295 75.77777777777777L 265.25296296296295 75.77777777777777L 265.25296296296295 68Q 265.25296296296295 68 265.25296296296295 68L 259.2922222222222 68Q 259.2922222222222 68 259.2922222222222 68z"
                                                                pathFrom="M 259.2922222222222 68L 259.2922222222222 68L 265.25296296296295 68L 265.25296296296295 68L 265.25296296296295 68L 265.25296296296295 68L 265.25296296296295 68L 259.2922222222222 68"
                                                                cy="73.77777777777777" cx="265.25296296296295" j="11"
                                                                val="-40" barHeight="-9.777777777777779"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2082"
                                                                d="M 283.13518518518515 68L 283.13518518518515 78.22222222222223Q 283.13518518518515 80.22222222222223 285.13518518518515 80.22222222222223L 287.0959259259259 80.22222222222223Q 289.0959259259259 80.22222222222223 289.0959259259259 78.22222222222223L 289.0959259259259 78.22222222222223L 289.0959259259259 68Q 289.0959259259259 68 289.0959259259259 68L 283.13518518518515 68Q 283.13518518518515 68 283.13518518518515 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 283.13518518518515 68L 283.13518518518515 78.22222222222223Q 283.13518518518515 80.22222222222223 285.13518518518515 80.22222222222223L 287.0959259259259 80.22222222222223Q 289.0959259259259 80.22222222222223 289.0959259259259 78.22222222222223L 289.0959259259259 78.22222222222223L 289.0959259259259 68Q 289.0959259259259 68 289.0959259259259 68L 283.13518518518515 68Q 283.13518518518515 68 283.13518518518515 68z"
                                                                pathFrom="M 283.13518518518515 68L 283.13518518518515 68L 289.0959259259259 68L 289.0959259259259 68L 289.0959259259259 68L 289.0959259259259 68L 289.0959259259259 68L 283.13518518518515 68"
                                                                cy="76.22222222222223" cx="289.0959259259259" j="12"
                                                                val="-50" barHeight="-12.222222222222223"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2083"
                                                                d="M 306.97814814814814 68L 306.97814814814814 83.11111111111111Q 306.97814814814814 85.11111111111111 308.97814814814814 85.11111111111111L 310.93888888888887 85.11111111111111Q 312.93888888888887 85.11111111111111 312.93888888888887 83.11111111111111L 312.93888888888887 83.11111111111111L 312.93888888888887 68Q 312.93888888888887 68 312.93888888888887 68L 306.97814814814814 68Q 306.97814814814814 68 306.97814814814814 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 306.97814814814814 68L 306.97814814814814 83.11111111111111Q 306.97814814814814 85.11111111111111 308.97814814814814 85.11111111111111L 310.93888888888887 85.11111111111111Q 312.93888888888887 85.11111111111111 312.93888888888887 83.11111111111111L 312.93888888888887 83.11111111111111L 312.93888888888887 68Q 312.93888888888887 68 312.93888888888887 68L 306.97814814814814 68Q 306.97814814814814 68 306.97814814814814 68z"
                                                                pathFrom="M 306.97814814814814 68L 306.97814814814814 68L 312.93888888888887 68L 312.93888888888887 68L 312.93888888888887 68L 312.93888888888887 68L 312.93888888888887 68L 306.97814814814814 68"
                                                                cy="81.11111111111111" cx="312.93888888888887" j="13"
                                                                val="-70" barHeight="-17.11111111111111"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2084"
                                                                d="M 330.8211111111111 68L 330.8211111111111 75.77777777777777Q 330.8211111111111 77.77777777777777 332.8211111111111 77.77777777777777L 334.78185185185185 77.77777777777777Q 336.78185185185185 77.77777777777777 336.78185185185185 75.77777777777777L 336.78185185185185 75.77777777777777L 336.78185185185185 68Q 336.78185185185185 68 336.78185185185185 68L 330.8211111111111 68Q 330.8211111111111 68 330.8211111111111 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 330.8211111111111 68L 330.8211111111111 75.77777777777777Q 330.8211111111111 77.77777777777777 332.8211111111111 77.77777777777777L 334.78185185185185 77.77777777777777Q 336.78185185185185 77.77777777777777 336.78185185185185 75.77777777777777L 336.78185185185185 75.77777777777777L 336.78185185185185 68Q 336.78185185185185 68 336.78185185185185 68L 330.8211111111111 68Q 330.8211111111111 68 330.8211111111111 68z"
                                                                pathFrom="M 330.8211111111111 68L 330.8211111111111 68L 336.78185185185185 68L 336.78185185185185 68L 336.78185185185185 68L 336.78185185185185 68L 336.78185185185185 68L 330.8211111111111 68"
                                                                cy="73.77777777777777" cx="336.78185185185185" j="14"
                                                                val="-40" barHeight="-9.777777777777779"
                                                                barWidth="5.960740740740741"></path>
                                                            <path id="SvgjsPath2085"
                                                                d="M 354.66407407407405 68L 354.66407407407405 78.22222222222223Q 354.66407407407405 80.22222222222223 356.66407407407405 80.22222222222223L 358.6248148148148 80.22222222222223Q 360.6248148148148 80.22222222222223 360.6248148148148 78.22222222222223L 360.6248148148148 78.22222222222223L 360.6248148148148 68Q 360.6248148148148 68 360.6248148148148 68L 354.66407407407405 68Q 354.66407407407405 68 354.66407407407405 68z"
                                                                fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="round"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="1"
                                                                clip-path="url(#gridRectMaskkjzl4hhn)"
                                                                pathTo="M 354.66407407407405 68L 354.66407407407405 78.22222222222223Q 354.66407407407405 80.22222222222223 356.66407407407405 80.22222222222223L 358.6248148148148 80.22222222222223Q 360.6248148148148 80.22222222222223 360.6248148148148 78.22222222222223L 360.6248148148148 78.22222222222223L 360.6248148148148 68Q 360.6248148148148 68 360.6248148148148 68L 354.66407407407405 68Q 354.66407407407405 68 354.66407407407405 68z"
                                                                pathFrom="M 354.66407407407405 68L 354.66407407407405 68L 360.6248148148148 68L 360.6248148148148 68L 360.6248148148148 68L 360.6248148148148 68L 360.6248148148148 68L 354.66407407407405 68"
                                                                cy="76.22222222222223" cx="360.6248148148148" j="15"
                                                                val="-50" barHeight="-12.222222222222223"
                                                                barWidth="5.960740740740741"></path>
                                                        </g>
                                                        <g id="SvgjsG2051" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                        <g id="SvgjsG2069" class="apexcharts-datalabels"
                                                            data:realIndex="1"></g>
                                                    </g>
                                                    <line id="SvgjsLine2106" x1="-9.177777777777777" y1="0"
                                                        x2="366.8222222222222" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine2107" x1="-9.177777777777777" y1="0"
                                                        x2="366.8222222222222" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG2108" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG2109" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG2110" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <g id="SvgjsG2094" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-18, 0)"></g>
                                                <g id="SvgjsG2040" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 50px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(90, 141, 238);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(253, 172, 65);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 421px; height: 123px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Impression Radial Chart-->
                        <div class="col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body text-center" style="position: relative;">
                                    <div id="impressionDonutChart" style="min-height: 156.8px;">
                                        <div id="apexcharts33yvpubb"
                                            class="apexcharts-canvas apexcharts33yvpubb apexcharts-theme-light"
                                            style="width: 376px; height: 156.8px;"><svg id="SvgjsSvg2111"
                                                width="376" height="156.8" xmlns="http://www.w3.org/2000/svg"
                                                version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <foreignObject x="0" y="0" width="376" height="156.8">
                                                    <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom"
                                                        xmlns="http://www.w3.org/1999/xhtml"
                                                        style="inset: auto 0px 1px; position: absolute; max-height: 92.5px;">
                                                        <div class="apexcharts-legend-series" rel="1"
                                                            seriesname="Social" data:collapsed="false"
                                                            style="margin: 2px 5px;"><span
                                                                class="apexcharts-legend-marker" rel="1"
                                                                data:collapsed="false"
                                                                style="background: rgb(90, 141, 238) !important; color: rgb(90, 141, 238); height: 10px; width: 10px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                                class="apexcharts-legend-text" rel="1" i="0"
                                                                data:default-text="Social" data:collapsed="false"
                                                                style="color: rgb(103, 119, 136); font-size: 12px; font-weight: 400; font-family: &quot;IBM Plex Sans&quot;;">Social</span>
                                                        </div>
                                                        <div class="apexcharts-legend-series" rel="2"
                                                            seriesname="Email" data:collapsed="false"
                                                            style="margin: 2px 5px;"><span
                                                                class="apexcharts-legend-marker" rel="2"
                                                                data:collapsed="false"
                                                                style="background: rgb(0, 207, 221) !important; color: rgb(0, 207, 221); height: 10px; width: 10px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                                class="apexcharts-legend-text" rel="2" i="1"
                                                                data:default-text="Email" data:collapsed="false"
                                                                style="color: rgb(103, 119, 136); font-size: 12px; font-weight: 400; font-family: &quot;IBM Plex Sans&quot;;">Email</span>
                                                        </div>
                                                        <div class="apexcharts-legend-series" rel="3"
                                                            seriesname="Search" data:collapsed="false"
                                                            style="margin: 2px 5px;"><span
                                                                class="apexcharts-legend-marker" rel="3"
                                                                data:collapsed="false"
                                                                style="background: rgb(253, 172, 65) !important; color: rgb(253, 172, 65); height: 10px; width: 10px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span
                                                                class="apexcharts-legend-text" rel="3" i="2"
                                                                data:default-text="Search" data:collapsed="false"
                                                                style="color: rgb(103, 119, 136); font-size: 12px; font-weight: 400; font-family: &quot;IBM Plex Sans&quot;;">Search</span>
                                                        </div>
                                                    </div>
                                                    <style type="text/css">
                                                        .apexcharts-legend {
                                                            display: flex;
                                                            overflow: auto;
                                                            padding: 0 10px;
                                                        }

                                                        .apexcharts-legend.apx-legend-position-bottom,
                                                        .apexcharts-legend.apx-legend-position-top {
                                                            flex-wrap: wrap
                                                        }

                                                        .apexcharts-legend.apx-legend-position-right,
                                                        .apexcharts-legend.apx-legend-position-left {
                                                            flex-direction: column;
                                                            bottom: 0;
                                                        }

                                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                                        .apexcharts-legend.apx-legend-position-right,
                                                        .apexcharts-legend.apx-legend-position-left {
                                                            justify-content: flex-start;
                                                        }

                                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                            justify-content: center;
                                                        }

                                                        .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                                        .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                            justify-content: flex-end;
                                                        }

                                                        .apexcharts-legend-series {
                                                            cursor: pointer;
                                                            line-height: normal;
                                                        }

                                                        .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                                                        .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                                                            display: flex;
                                                            align-items: center;
                                                        }

                                                        .apexcharts-legend-text {
                                                            position: relative;
                                                            font-size: 14px;
                                                        }

                                                        .apexcharts-legend-text *,
                                                        .apexcharts-legend-marker * {
                                                            pointer-events: none;
                                                        }

                                                        .apexcharts-legend-marker {
                                                            position: relative;
                                                            display: inline-block;
                                                            cursor: pointer;
                                                            margin-right: 3px;
                                                            border-style: solid;
                                                        }

                                                        .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                                        .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                                            display: inline-block;
                                                        }

                                                        .apexcharts-legend-series.apexcharts-no-click {
                                                            cursor: auto;
                                                        }

                                                        .apexcharts-legend .apexcharts-hidden-zero-series,
                                                        .apexcharts-legend .apexcharts-hidden-null-series {
                                                            display: none !important;
                                                        }

                                                        .apexcharts-inactive-legend {
                                                            opacity: 0.45;
                                                        }
                                                    </style>
                                                </foreignObject>
                                                <g id="SvgjsG2113" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(12, 0)">
                                                    <defs id="SvgjsDefs2112">
                                                        <clipPath id="gridRectMask33yvpubb">
                                                            <rect id="SvgjsRect2115" width="358" height="131"
                                                                x="-2" y="0" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="forecastMask33yvpubb"></clipPath>
                                                        <clipPath id="nonForecastMask33yvpubb"></clipPath>
                                                        <clipPath id="gridRectMarkerMask33yvpubb">
                                                            <rect id="SvgjsRect2116" width="358" height="135"
                                                                x="-2" y="-2" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <g id="SvgjsG2117" class="apexcharts-pie">
                                                        <g id="SvgjsG2118" transform="translate(0, 0) scale(1)">
                                                            <circle id="SvgjsCircle2119" r="53.91219512195123"
                                                                cx="177" cy="65.5" fill="transparent">
                                                            </circle>
                                                            <g id="SvgjsG2120" class="apexcharts-slices">
                                                                <g id="SvgjsG2121"
                                                                    class="apexcharts-series apexcharts-pie-series"
                                                                    seriesName="Social" rel="1"
                                                                    data:realIndex="0">
                                                                    <path id="SvgjsPath2122"
                                                                        d="M 177 5.597560975609753 A 59.90243902439025 59.90243902439025 0 0 1 188.0070442867682 124.3824861664308 L 186.9063398580914 118.49423754978773 A 53.91219512195123 53.91219512195123 0 0 0 177 11.587804878048772 L 177 5.597560975609753 z"
                                                                        fill="rgba(90,141,238,1)" fill-opacity="1"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="0" stroke-dasharray="0"
                                                                        class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                                        index="0" j="0"
                                                                        data:angle="169.41176470588235"
                                                                        data:startAngle="0" data:strokeWidth="0"
                                                                        data:value="80"
                                                                        data:pathOrig="M 177 5.597560975609753 A 59.90243902439025 59.90243902439025 0 0 1 188.0070442867682 124.3824861664308 L 186.9063398580914 118.49423754978773 A 53.91219512195123 53.91219512195123 0 0 0 177 11.587804878048772 L 177 5.597560975609753 z">
                                                                    </path>
                                                                </g>
                                                                <g id="SvgjsG2123"
                                                                    class="apexcharts-series apexcharts-pie-series"
                                                                    seriesName="Email" rel="2"
                                                                    data:realIndex="1">
                                                                    <path id="SvgjsPath2124"
                                                                        d="M 188.0070442867682 124.3824861664308 A 59.90243902439025 59.90243902439025 0 0 1 129.1968217024325 101.599284559694 L 133.97713953218923 97.98935610372459 A 53.91219512195123 53.91219512195123 0 0 0 186.9063398580914 118.49423754978773 L 188.0070442867682 124.3824861664308 z"
                                                                        fill="rgba(0,207,221,1)" fill-opacity="1"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="0" stroke-dasharray="0"
                                                                        class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                                        index="0" j="1"
                                                                        data:angle="63.529411764705884"
                                                                        data:startAngle="169.41176470588235"
                                                                        data:strokeWidth="0" data:value="30"
                                                                        data:pathOrig="M 188.0070442867682 124.3824861664308 A 59.90243902439025 59.90243902439025 0 0 1 129.1968217024325 101.599284559694 L 133.97713953218923 97.98935610372459 A 53.91219512195123 53.91219512195123 0 0 0 186.9063398580914 118.49423754978773 L 188.0070442867682 124.3824861664308 z">
                                                                    </path>
                                                                </g>
                                                                <g id="SvgjsG2125"
                                                                    class="apexcharts-series apexcharts-pie-series"
                                                                    seriesName="Search" rel="3"
                                                                    data:realIndex="2">
                                                                    <path id="SvgjsPath2126"
                                                                        d="M 129.1968217024325 101.599284559694 A 59.90243902439025 59.90243902439025 0 0 1 176.98954505214357 5.59756188797607 L 176.9905905469292 11.587805699178453 A 53.91219512195123 53.91219512195123 0 0 0 133.97713953218923 97.98935610372459 L 129.1968217024325 101.599284559694 z"
                                                                        fill="rgba(253,172,65,1)" fill-opacity="1"
                                                                        stroke-opacity="1" stroke-linecap="round"
                                                                        stroke-width="0" stroke-dasharray="0"
                                                                        class="apexcharts-pie-area apexcharts-donut-slice-2"
                                                                        index="0" j="2"
                                                                        data:angle="127.05882352941177"
                                                                        data:startAngle="232.94117647058823"
                                                                        data:strokeWidth="0" data:value="60"
                                                                        data:pathOrig="M 129.1968217024325 101.599284559694 A 59.90243902439025 59.90243902439025 0 0 1 176.98954505214357 5.59756188797607 L 176.9905905469292 11.587805699178453 A 53.91219512195123 53.91219512195123 0 0 0 133.97713953218923 97.98935610372459 L 129.1968217024325 101.599284559694 z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG2127" class="apexcharts-datalabels-group"
                                                            transform="translate(0, 0) scale(1)"><text
                                                                id="SvgjsText2128" font-family="IBM Plex Sans" x="177"
                                                                y="85.5" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="16px" font-weight="400" fill="#677788"
                                                                class="apexcharts-text apexcharts-datalabel-label"
                                                                style="font-family: &quot;IBM Plex Sans&quot;;">Impression</text><text
                                                                id="SvgjsText2129" font-family="Rubik" x="177" y="61.5"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="1.625rem" font-weight="500" fill="#516377"
                                                                class="apexcharts-text apexcharts-datalabel-value"
                                                                style="font-family: Rubik;">170</text></g>
                                                    </g>
                                                    <line id="SvgjsLine2130" x1="0" y1="0"
                                                        x2="354" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine2131" x1="0" y1="0"
                                                        x2="354" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" stroke-linecap="butt"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                </g>
                                                <g id="SvgjsG2114" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-tooltip apexcharts-theme-dark">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(90, 141, 238);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: &quot;IBM Plex Sans&quot;; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(0, 207, 221);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: &quot;IBM Plex Sans&quot;; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                                <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(253, 172, 65);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: &quot;IBM Plex Sans&quot;; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-y-label"></span><span
                                                                class="apexcharts-tooltip-text-y-value"></span></div>
                                                        <div class="apexcharts-tooltip-goals-group"><span
                                                                class="apexcharts-tooltip-text-goals-label"></span><span
                                                                class="apexcharts-tooltip-text-goals-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 421px; height: 202px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Growth Chart-->
                        <div class="col-sm-6 col-12">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between" style="position: relative;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar">
                                                        <span class="avatar-initial bg-label-primary rounded-circle"><i
                                                                class="bx bx-user fs-4"></i></span>
                                                    </div>
                                                    <div class="card-info">
                                                        <h5 class="card-title mb-0 me-2">$38,566</h5>
                                                        <small class="text-muted">Conversion</small>
                                                    </div>
                                                </div>
                                                <div id="conversationChart" style="min-height: 40px;">
                                                    <div id="apexchartsgbmx347nf"
                                                        class="apexcharts-canvas apexchartsgbmx347nf apexcharts-theme-light"
                                                        style="width: 240px; height: 40px;"><svg id="SvgjsSvg2132"
                                                            width="240" height="40"
                                                            xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                            style="background: transparent;">
                                                            <g id="SvgjsG2134"
                                                                class="apexcharts-inner apexcharts-graphical"
                                                                transform="translate(10, 5)">
                                                                <defs id="SvgjsDefs2133">
                                                                    <clipPath id="gridRectMaskgbmx347nf">
                                                                        <rect id="SvgjsRect2139" width="227"
                                                                            height="33" x="-3.5" y="-1.5"
                                                                            rx="0" ry="0"
                                                                            opacity="1" stroke-width="0"
                                                                            stroke="none" stroke-dasharray="0"
                                                                            fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="forecastMaskgbmx347nf"></clipPath>
                                                                    <clipPath id="nonForecastMaskgbmx347nf"></clipPath>
                                                                    <clipPath id="gridRectMarkerMaskgbmx347nf">
                                                                        <rect id="SvgjsRect2140" width="224"
                                                                            height="34" x="-2" y="-2" rx="0"
                                                                            ry="0" opacity="1"
                                                                            stroke-width="0" stroke="none"
                                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <linearGradient id="SvgjsLinearGradient2145"
                                                                        x1="0" y1="1" x2="1"
                                                                        y2="1">
                                                                        <stop id="SvgjsStop2146" stop-opacity="0"
                                                                            stop-color="rgba(173,198,247,0)"
                                                                            offset="0">
                                                                        </stop>
                                                                        <stop id="SvgjsStop2147" stop-opacity="0.9"
                                                                            stop-color="rgba(90,141,238,0.9)"
                                                                            offset="0.3"></stop>
                                                                        <stop id="SvgjsStop2148" stop-opacity="0.9"
                                                                            stop-color="rgba(90,141,238,0.9)"
                                                                            offset="0.7"></stop>
                                                                        <stop id="SvgjsStop2149" stop-opacity="0"
                                                                            stop-color="rgba(173,198,247,0)"
                                                                            offset="1">
                                                                        </stop>
                                                                    </linearGradient>
                                                                </defs>
                                                                <line id="SvgjsLine2138" x1="0" y1="0"
                                                                    x2="0" y2="30" stroke="#b6b6b6"
                                                                    stroke-dasharray="3" stroke-linecap="butt"
                                                                    class="apexcharts-xcrosshairs" x="0" y="0"
                                                                    width="1" height="30" fill="#b1b9c4"
                                                                    filter="none" fill-opacity="0.9"
                                                                    stroke-width="1">
                                                                </line>
                                                                <g id="SvgjsG2151" class="apexcharts-xaxis"
                                                                    transform="translate(0, 0)">
                                                                    <g id="SvgjsG2152" class="apexcharts-xaxis-texts-g"
                                                                        transform="translate(0, -4)"></g>
                                                                </g>
                                                                <g id="SvgjsG2160" class="apexcharts-grid">
                                                                    <g id="SvgjsG2161"
                                                                        class="apexcharts-gridlines-horizontal"
                                                                        style="display: none;">
                                                                        <line id="SvgjsLine2163" x1="0"
                                                                            y1="0" x2="220"
                                                                            y2="0" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2164" x1="0"
                                                                            y1="7.5" x2="220"
                                                                            y2="7.5" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2165" x1="0"
                                                                            y1="15" x2="220"
                                                                            y2="15" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2166" x1="0"
                                                                            y1="22.5" x2="220"
                                                                            y2="22.5" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2167" x1="0"
                                                                            y1="30" x2="220"
                                                                            y2="30" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                    </g>
                                                                    <g id="SvgjsG2162"
                                                                        class="apexcharts-gridlines-vertical"
                                                                        style="display: none;"></g>
                                                                    <line id="SvgjsLine2169" x1="0"
                                                                        y1="30" x2="220" y2="30"
                                                                        stroke="transparent" stroke-dasharray="0"
                                                                        stroke-linecap="butt"></line>
                                                                    <line id="SvgjsLine2168" x1="0"
                                                                        y1="1" x2="0" y2="30"
                                                                        stroke="transparent" stroke-dasharray="0"
                                                                        stroke-linecap="butt"></line>
                                                                </g>
                                                                <g id="SvgjsG2141"
                                                                    class="apexcharts-line-series apexcharts-plot-series">
                                                                    <g id="SvgjsG2142" class="apexcharts-series"
                                                                        seriesName="seriesx1" data:longestSeries="true"
                                                                        rel="1" data:realIndex="0">
                                                                        <path id="SvgjsPath2150"
                                                                            d="M 0 17.5C 15.399999999999999 17.5 28.6 5 44 5C 59.4 5 72.6 30 88 30C 103.4 30 116.6 15 132 15C 147.4 15 160.6 25 176 25C 191.4 25 204.6 22.5 220 22.5"
                                                                            fill="none" fill-opacity="1"
                                                                            stroke="url(#SvgjsLinearGradient2145)"
                                                                            stroke-opacity="1" stroke-linecap="butt"
                                                                            stroke-width="3" stroke-dasharray="0"
                                                                            class="apexcharts-line" index="0"
                                                                            clip-path="url(#gridRectMaskgbmx347nf)"
                                                                            pathTo="M 0 17.5C 15.399999999999999 17.5 28.6 5 44 5C 59.4 5 72.6 30 88 30C 103.4 30 116.6 15 132 15C 147.4 15 160.6 25 176 25C 191.4 25 204.6 22.5 220 22.5"
                                                                            pathFrom="M -1 30L -1 30L 44 30L 88 30L 132 30L 176 30L 220 30">
                                                                        </path>
                                                                        <g id="SvgjsG2143"
                                                                            class="apexcharts-series-markers-wrap"
                                                                            data:realIndex="0"></g>
                                                                    </g>
                                                                    <g id="SvgjsG2144" class="apexcharts-datalabels"
                                                                        data:realIndex="0"></g>
                                                                </g>
                                                                <line id="SvgjsLine2170" x1="0" y1="0"
                                                                    x2="220" y2="0" stroke="#b6b6b6"
                                                                    stroke-dasharray="0" stroke-width="1"
                                                                    stroke-linecap="butt"
                                                                    class="apexcharts-ycrosshairs">
                                                                </line>
                                                                <line id="SvgjsLine2171" x1="0" y1="0"
                                                                    x2="220" y2="0" stroke-dasharray="0"
                                                                    stroke-width="0" stroke-linecap="butt"
                                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                                                <g id="SvgjsG2172" class="apexcharts-yaxis-annotations">
                                                                </g>
                                                                <g id="SvgjsG2173" class="apexcharts-xaxis-annotations">
                                                                </g>
                                                                <g id="SvgjsG2174" class="apexcharts-point-annotations">
                                                                </g>
                                                            </g>
                                                            <rect id="SvgjsRect2137" width="0" height="0"
                                                                x="0" y="0" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fefefe"></rect>
                                                            <g id="SvgjsG2159" class="apexcharts-yaxis" rel="0"
                                                                transform="translate(-18, 0)"></g>
                                                            <g id="SvgjsG2135" class="apexcharts-annotations"></g>
                                                        </svg>
                                                        <div class="apexcharts-legend" style="max-height: 20px;"></div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 377px; height: 43px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between" style="position: relative;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar">
                                                        <span class="avatar-initial bg-label-warning rounded-circle"><i
                                                                class="bx bx-dollar fs-4"></i></span>
                                                    </div>
                                                    <div class="card-info">
                                                        <h5 class="card-title mb-0 me-2">$53,659</h5>
                                                        <small class="text-muted">Income</small>
                                                    </div>
                                                </div>
                                                <div id="incomeChart" style="min-height: 40px;">
                                                    <div id="apexchartszryt1bcog"
                                                        class="apexcharts-canvas apexchartszryt1bcog apexcharts-theme-light"
                                                        style="width: 241px; height: 40px;"><svg id="SvgjsSvg2175"
                                                            width="241" height="40"
                                                            xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                            style="background: transparent;">
                                                            <g id="SvgjsG2177"
                                                                class="apexcharts-inner apexcharts-graphical"
                                                                transform="translate(10, 10)">
                                                                <defs id="SvgjsDefs2176">
                                                                    <clipPath id="gridRectMaskzryt1bcog">
                                                                        <rect id="SvgjsRect2182" width="228"
                                                                            height="33" x="-3.5" y="-1.5"
                                                                            rx="0" ry="0"
                                                                            opacity="1" stroke-width="0"
                                                                            stroke="none" stroke-dasharray="0"
                                                                            fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="forecastMaskzryt1bcog"></clipPath>
                                                                    <clipPath id="nonForecastMaskzryt1bcog"></clipPath>
                                                                    <clipPath id="gridRectMarkerMaskzryt1bcog">
                                                                        <rect id="SvgjsRect2183" width="225"
                                                                            height="34" x="-2" y="-2" rx="0"
                                                                            ry="0" opacity="1"
                                                                            stroke-width="0" stroke="none"
                                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <linearGradient id="SvgjsLinearGradient2188"
                                                                        x1="0" y1="1" x2="1"
                                                                        y2="1">
                                                                        <stop id="SvgjsStop2189" stop-opacity="0"
                                                                            stop-color="rgba(254,214,160,0)"
                                                                            offset="0">
                                                                        </stop>
                                                                        <stop id="SvgjsStop2190" stop-opacity="0.9"
                                                                            stop-color="rgba(253,172,65,0.9)"
                                                                            offset="0.3"></stop>
                                                                        <stop id="SvgjsStop2191" stop-opacity="0.9"
                                                                            stop-color="rgba(253,172,65,0.9)"
                                                                            offset="0.7"></stop>
                                                                        <stop id="SvgjsStop2192" stop-opacity="0"
                                                                            stop-color="rgba(254,214,160,0)"
                                                                            offset="1">
                                                                        </stop>
                                                                    </linearGradient>
                                                                </defs>
                                                                <line id="SvgjsLine2181" x1="0" y1="0"
                                                                    x2="0" y2="30" stroke="#b6b6b6"
                                                                    stroke-dasharray="3" stroke-linecap="butt"
                                                                    class="apexcharts-xcrosshairs" x="0" y="0"
                                                                    width="1" height="30" fill="#b1b9c4"
                                                                    filter="none" fill-opacity="0.9"
                                                                    stroke-width="1">
                                                                </line>
                                                                <g id="SvgjsG2194" class="apexcharts-xaxis"
                                                                    transform="translate(0, 0)">
                                                                    <g id="SvgjsG2195" class="apexcharts-xaxis-texts-g"
                                                                        transform="translate(0, -4)"></g>
                                                                </g>
                                                                <g id="SvgjsG2203" class="apexcharts-grid">
                                                                    <g id="SvgjsG2204"
                                                                        class="apexcharts-gridlines-horizontal"
                                                                        style="display: none;">
                                                                        <line id="SvgjsLine2206" x1="0"
                                                                            y1="0" x2="221"
                                                                            y2="0" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2207" x1="0"
                                                                            y1="4.285714285714286" x2="221"
                                                                            y2="4.285714285714286" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2208" x1="0"
                                                                            y1="8.571428571428571" x2="221"
                                                                            y2="8.571428571428571" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2209" x1="0"
                                                                            y1="12.857142857142858" x2="221"
                                                                            y2="12.857142857142858" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2210" x1="0"
                                                                            y1="17.142857142857142" x2="221"
                                                                            y2="17.142857142857142" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2211" x1="0"
                                                                            y1="21.428571428571427" x2="221"
                                                                            y2="21.428571428571427" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2212" x1="0"
                                                                            y1="25.71428571428571" x2="221"
                                                                            y2="25.71428571428571" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine2213" x1="0"
                                                                            y1="29.999999999999996" x2="221"
                                                                            y2="29.999999999999996" stroke="#e0e0e0"
                                                                            stroke-dasharray="0" stroke-linecap="butt"
                                                                            class="apexcharts-gridline"></line>
                                                                    </g>
                                                                    <g id="SvgjsG2205"
                                                                        class="apexcharts-gridlines-vertical"
                                                                        style="display: none;"></g>
                                                                    <line id="SvgjsLine2215" x1="0"
                                                                        y1="30" x2="221" y2="30"
                                                                        stroke="transparent" stroke-dasharray="0"
                                                                        stroke-linecap="butt"></line>
                                                                    <line id="SvgjsLine2214" x1="0"
                                                                        y1="1" x2="0" y2="30"
                                                                        stroke="transparent" stroke-dasharray="0"
                                                                        stroke-linecap="butt"></line>
                                                                </g>
                                                                <g id="SvgjsG2184"
                                                                    class="apexcharts-line-series apexcharts-plot-series">
                                                                    <g id="SvgjsG2185" class="apexcharts-series"
                                                                        seriesName="seriesx1" data:longestSeries="true"
                                                                        rel="1" data:realIndex="0">
                                                                        <path id="SvgjsPath2193"
                                                                            d="M 0 25.71428571428571C 15.47 25.71428571428571 28.730000000000004 12.857142857142858 44.2 12.857142857142858C 59.67 12.857142857142858 72.93 26.57142857142857 88.4 26.57142857142857C 103.87 26.57142857142857 117.13 4.285714285714285 132.6 4.285714285714285C 148.07 4.285714285714285 161.33 25.71428571428571 176.8 25.71428571428571C 192.27 25.71428571428571 205.53 15 221 15"
                                                                            fill="none" fill-opacity="1"
                                                                            stroke="url(#SvgjsLinearGradient2188)"
                                                                            stroke-opacity="1" stroke-linecap="butt"
                                                                            stroke-width="3" stroke-dasharray="0"
                                                                            class="apexcharts-line" index="0"
                                                                            clip-path="url(#gridRectMaskzryt1bcog)"
                                                                            pathTo="M 0 25.71428571428571C 15.47 25.71428571428571 28.730000000000004 12.857142857142858 44.2 12.857142857142858C 59.67 12.857142857142858 72.93 26.57142857142857 88.4 26.57142857142857C 103.87 26.57142857142857 117.13 4.285714285714285 132.6 4.285714285714285C 148.07 4.285714285714285 161.33 25.71428571428571 176.8 25.71428571428571C 192.27 25.71428571428571 205.53 15 221 15"
                                                                            pathFrom="M -1 42.857142857142854L -1 42.857142857142854L 44.2 42.857142857142854L 88.4 42.857142857142854L 132.6 42.857142857142854L 176.8 42.857142857142854L 221 42.857142857142854">
                                                                        </path>
                                                                        <g id="SvgjsG2186"
                                                                            class="apexcharts-series-markers-wrap"
                                                                            data:realIndex="0"></g>
                                                                    </g>
                                                                    <g id="SvgjsG2187" class="apexcharts-datalabels"
                                                                        data:realIndex="0"></g>
                                                                </g>
                                                                <line id="SvgjsLine2216" x1="0" y1="0"
                                                                    x2="221" y2="0" stroke="#b6b6b6"
                                                                    stroke-dasharray="0" stroke-width="1"
                                                                    stroke-linecap="butt"
                                                                    class="apexcharts-ycrosshairs">
                                                                </line>
                                                                <line id="SvgjsLine2217" x1="0" y1="0"
                                                                    x2="221" y2="0" stroke-dasharray="0"
                                                                    stroke-width="0" stroke-linecap="butt"
                                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                                                <g id="SvgjsG2218" class="apexcharts-yaxis-annotations">
                                                                </g>
                                                                <g id="SvgjsG2219" class="apexcharts-xaxis-annotations">
                                                                </g>
                                                                <g id="SvgjsG2220" class="apexcharts-point-annotations">
                                                                </g>
                                                            </g>
                                                            <rect id="SvgjsRect2180" width="0" height="0"
                                                                x="0" y="0" rx="0" ry="0"
                                                                opacity="1" stroke-width="0" stroke="none"
                                                                stroke-dasharray="0" fill="#fefefe"></rect>
                                                            <g id="SvgjsG2202" class="apexcharts-yaxis" rel="0"
                                                                transform="translate(-18, 0)"></g>
                                                            <g id="SvgjsG2178" class="apexcharts-annotations"></g>
                                                        </svg>
                                                        <div class="apexcharts-legend" style="max-height: 20px;"></div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 377px; height: 43px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Referral, conversion, impression & income charts -->

                <!-- Activity -->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Activity</h5>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-2">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary"><i
                                                class="bx bx-cube"></i></span>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Total Sales</span>
                                            <span class="text-muted">$2,459</span>
                                        </div>
                                        <div class="progress" style="height:6px;">
                                            <div class="progress-bar bg-primary" style="width: 40%" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-2">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded-circle bg-label-success"><i
                                                class="bx bx-dollar"></i></span>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Income</span>
                                            <span class="text-muted">$8,478</span>
                                        </div>
                                        <div class="progress" style="height:6px;">
                                            <div class="progress-bar bg-success" style="width: 80%" role="progressbar"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-2">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded-circle bg-label-warning"><i
                                                class="bx bx-trending-up"></i></span>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Budget</span>
                                            <span class="text-muted">$12,490</span>
                                        </div>
                                        <div class="progress" style="height:6px;">
                                            <div class="progress-bar bg-warning" style="width: 80%" role="progressbar"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-2">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded-circle bg-label-danger"><i
                                                class="bx bx-check"></i></span>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Tasks</span>
                                            <span class="text-muted">$184</span>
                                        </div>
                                        <div class="progress" style="height:6px;">
                                            <div class="progress-bar bg-danger" style="width: 25%" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Activity -->

                <!-- Profit Report & Registration -->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profit Report</h5>
                                </div>
                                <div class="card-body d-flex align-items-end justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center gap-3 w-100">
                                        <div class="d-flex align-content-center" style="position: relative;">
                                            <div class="chart-report" data-color="danger" data-series="25"
                                                style="min-height: 44.7px;">
                                                <div id="apexchartsjffkfo82"
                                                    class="apexcharts-canvas apexchartsjffkfo82 apexcharts-theme-light"
                                                    style="width: 50px; height: 44.7px;"><svg id="SvgjsSvg1791"
                                                        width="50" height="44.699999999999996"
                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                        xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                        style="background: transparent;">
                                                        <g id="SvgjsG1793" class="apexcharts-inner apexcharts-graphical"
                                                            transform="translate(-7.5, -8)">
                                                            <defs id="SvgjsDefs1792">
                                                                <clipPath id="gridRectMaskjffkfo82">
                                                                    <rect id="SvgjsRect1795" width="66"
                                                                        height="75" x="-3" y="-1" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="forecastMaskjffkfo82"></clipPath>
                                                                <clipPath id="nonForecastMaskjffkfo82"></clipPath>
                                                                <clipPath id="gridRectMarkerMaskjffkfo82">
                                                                    <rect id="SvgjsRect1796" width="64"
                                                                        height="77" x="-2" y="-2" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>
                                                            </defs>
                                                            <g id="SvgjsG1797" class="apexcharts-radialbar">
                                                                <g id="SvgjsG1798">
                                                                    <g id="SvgjsG1799" class="apexcharts-tracks">
                                                                        <g id="SvgjsG1800"
                                                                            class="apexcharts-radialbar-track apexcharts-track"
                                                                            rel="1">
                                                                            <path id="apexcharts-radialbarTrack-0"
                                                                                d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451"
                                                                                fill="none" fill-opacity="1"
                                                                                stroke="rgba(233,236,238,0.85)"
                                                                                stroke-opacity="1"
                                                                                stroke-linecap="round"
                                                                                stroke-width="3.6138414634146354"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area"
                                                                                data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1802">
                                                                        <g id="SvgjsG1804"
                                                                            class="apexcharts-series apexcharts-radial-series"
                                                                            seriesName="Progress" rel="1"
                                                                            data:realIndex="0">
                                                                            <path id="SvgjsPath1805"
                                                                                d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 42.67987804878049 30"
                                                                                fill="none" fill-opacity="0.85"
                                                                                stroke="rgba(255,91,92,0.85)"
                                                                                stroke-opacity="1"
                                                                                stroke-linecap="round"
                                                                                stroke-width="3.725609756097562"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                                data:angle="90" data:value="25"
                                                                                index="0" j="0"
                                                                                data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 42.67987804878049 30">
                                                                            </path>
                                                                        </g>
                                                                        <circle id="SvgjsCircle1803" r="5.872957317073169"
                                                                            cx="30" cy="30"
                                                                            class="apexcharts-radialbar-hollow"
                                                                            fill="transparent"></circle>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <line id="SvgjsLine1806" x1="0" y1="0"
                                                                x2="60" y2="0" stroke="#b6b6b6"
                                                                stroke-dasharray="0" stroke-width="1"
                                                                stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                                            </line>
                                                            <line id="SvgjsLine1807" x1="0" y1="0"
                                                                x2="60" y2="0" stroke-dasharray="0"
                                                                stroke-width="0" stroke-linecap="butt"
                                                                class="apexcharts-ycrosshairs-hidden"></line>
                                                        </g>
                                                        <g id="SvgjsG1794" class="apexcharts-annotations"></g>
                                                    </svg>
                                                    <div class="apexcharts-legend"></div>
                                                </div>
                                            </div>
                                            <div class="chart-info">
                                                <h5 class="mb-0">$12k</h5>
                                                <small class="text-muted">2020</small>
                                            </div>
                                            <div class="resize-triggers">
                                                <div class="expand-trigger">
                                                    <div style="width: 92px; height: 46px;"></div>
                                                </div>
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-content-center" style="position: relative;">
                                            <div class="chart-report" data-color="info" data-series="50"
                                                style="min-height: 44.7px;">
                                                <div id="apexchartsgqn0r5jw"
                                                    class="apexcharts-canvas apexchartsgqn0r5jw apexcharts-theme-light"
                                                    style="width: 50px; height: 44.7px;"><svg id="SvgjsSvg1808"
                                                        width="50" height="44.699999999999996"
                                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                        xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                        style="background: transparent;">
                                                        <g id="SvgjsG1810" class="apexcharts-inner apexcharts-graphical"
                                                            transform="translate(-7.5, -8)">
                                                            <defs id="SvgjsDefs1809">
                                                                <clipPath id="gridRectMaskgqn0r5jw">
                                                                    <rect id="SvgjsRect1812" width="66"
                                                                        height="75" x="-3" y="-1" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="forecastMaskgqn0r5jw"></clipPath>
                                                                <clipPath id="nonForecastMaskgqn0r5jw"></clipPath>
                                                                <clipPath id="gridRectMarkerMaskgqn0r5jw">
                                                                    <rect id="SvgjsRect1813" width="64"
                                                                        height="77" x="-2" y="-2" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>
                                                            </defs>
                                                            <g id="SvgjsG1814" class="apexcharts-radialbar">
                                                                <g id="SvgjsG1815">
                                                                    <g id="SvgjsG1816" class="apexcharts-tracks">
                                                                        <g id="SvgjsG1817"
                                                                            class="apexcharts-radialbar-track apexcharts-track"
                                                                            rel="1">
                                                                            <path id="apexcharts-radialbarTrack-0"
                                                                                d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451"
                                                                                fill="none" fill-opacity="1"
                                                                                stroke="rgba(233,236,238,0.85)"
                                                                                stroke-opacity="1"
                                                                                stroke-linecap="round"
                                                                                stroke-width="3.6138414634146354"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area"
                                                                                data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 1 1 29.997786943804208 17.3201221443451">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1819">
                                                                        <g id="SvgjsG1821"
                                                                            class="apexcharts-series apexcharts-radial-series"
                                                                            seriesName="Progress" rel="1"
                                                                            data:realIndex="0">
                                                                            <path id="SvgjsPath1822"
                                                                                d="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 30 42.67987804878049"
                                                                                fill="none" fill-opacity="0.85"
                                                                                stroke="rgba(0,207,221,0.85)"
                                                                                stroke-opacity="1"
                                                                                stroke-linecap="round"
                                                                                stroke-width="3.725609756097562"
                                                                                stroke-dasharray="0"
                                                                                class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                                data:angle="180" data:value="50"
                                                                                index="0" j="0"
                                                                                data:pathOrig="M 30 17.320121951219512 A 12.679878048780488 12.679878048780488 0 0 1 30 42.67987804878049">
                                                                            </path>
                                                                        </g>
                                                                        <circle id="SvgjsCircle1820" r="5.872957317073169"
                                                                            cx="30" cy="30"
                                                                            class="apexcharts-radialbar-hollow"
                                                                            fill="transparent"></circle>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                            <line id="SvgjsLine1823" x1="0" y1="0"
                                                                x2="60" y2="0" stroke="#b6b6b6"
                                                                stroke-dasharray="0" stroke-width="1"
                                                                stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                                            </line>
                                                            <line id="SvgjsLine1824" x1="0" y1="0"
                                                                x2="60" y2="0" stroke-dasharray="0"
                                                                stroke-width="0" stroke-linecap="butt"
                                                                class="apexcharts-ycrosshairs-hidden"></line>
                                                        </g>
                                                        <g id="SvgjsG1811" class="apexcharts-annotations"></g>
                                                    </svg>
                                                    <div class="apexcharts-legend"></div>
                                                </div>
                                            </div>
                                            <div class="chart-info">
                                                <h5 class="mb-0">$64k</h5>
                                                <small class="text-muted">2021</small>
                                            </div>
                                            <div class="resize-triggers">
                                                <div class="expand-trigger">
                                                    <div style="width: 96px; height: 46px;"></div>
                                                </div>
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header pb-2">
                                    <h5 class="card-title mb-0">Registration</h5>
                                </div>
                                <div class="card-body pb-2">
                                    <div class="d-flex justify-content-between align-items-end gap-3"
                                        style="position: relative;">
                                        <div class="mb-3">
                                            <div class="d-flex align-content-center">
                                                <h5 class="mb-1">58.4k</h5>
                                                <i class="bx bx-chevron-up text-success"></i>
                                            </div>
                                            <small class="text-success">12.8%</small>
                                        </div>
                                        <div id="registrationsBarChart" style="min-height: 110px;">
                                            <div id="apexchartsmfbxzia1"
                                                class="apexcharts-canvas apexchartsmfbxzia1 apexcharts-theme-light"
                                                style="width: 155px; height: 95px;"><svg id="SvgjsSvg2221"
                                                    width="155" height="95" xmlns="http://www.w3.org/2000/svg"
                                                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG2223" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(10, 10)">
                                                        <defs id="SvgjsDefs2222">
                                                            <linearGradient id="SvgjsLinearGradient2226" x1="0"
                                                                y1="0" x2="0" y2="1">
                                                                <stop id="SvgjsStop2227" stop-opacity="0.4"
                                                                    stop-color="rgba(216,227,240,0.4)" offset="0">
                                                                </stop>
                                                                <stop id="SvgjsStop2228" stop-opacity="0.5"
                                                                    stop-color="rgba(190,209,230,0.5)" offset="1">
                                                                </stop>
                                                                <stop id="SvgjsStop2229" stop-opacity="0.5"
                                                                    stop-color="rgba(190,209,230,0.5)" offset="1">
                                                                </stop>
                                                            </linearGradient>
                                                            <clipPath id="gridRectMaskmfbxzia1">
                                                                <rect id="SvgjsRect2231" width="149" height="90"
                                                                    x="-2" y="0" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskmfbxzia1"></clipPath>
                                                            <clipPath id="nonForecastMaskmfbxzia1"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskmfbxzia1">
                                                                <rect id="SvgjsRect2232" width="149" height="94"
                                                                    x="-2" y="-2" rx="0" ry="0"
                                                                    opacity="1" stroke-width="0" stroke="none"
                                                                    stroke-dasharray="0" fill="#fff"></rect>
                                                            </clipPath>
                                                        </defs>
                                                        <rect id="SvgjsRect2230" width="10.357142857142858"
                                                            height="90" x="0" y="0" rx="0" ry="0"
                                                            opacity="1" stroke-width="0" stroke-dasharray="3"
                                                            fill="url(#SvgjsLinearGradient2226)"
                                                            class="apexcharts-xcrosshairs" y2="90"
                                                            filter="none" fill-opacity="0.9"></rect>
                                                        <g id="SvgjsG2251" class="apexcharts-xaxis"
                                                            transform="translate(0, 0)">
                                                            <g id="SvgjsG2252" class="apexcharts-xaxis-texts-g"
                                                                transform="translate(0, -4)"></g>
                                                        </g>
                                                        <g id="SvgjsG2262" class="apexcharts-grid">
                                                            <g id="SvgjsG2263" class="apexcharts-gridlines-horizontal"
                                                                style="display: none;">
                                                                <line id="SvgjsLine2265" x1="0" y1="0"
                                                                    x2="145" y2="0" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine2266" x1="0" y1="18"
                                                                    x2="145" y2="18" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine2267" x1="0" y1="36"
                                                                    x2="145" y2="36" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine2268" x1="0" y1="54"
                                                                    x2="145" y2="54" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine2269" x1="0" y1="72"
                                                                    x2="145" y2="72" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine2270" x1="0" y1="90"
                                                                    x2="145" y2="90" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                            </g>
                                                            <g id="SvgjsG2264" class="apexcharts-gridlines-vertical"
                                                                style="display: none;"></g>
                                                            <line id="SvgjsLine2272" x1="0" y1="90"
                                                                x2="145" y2="90" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                            <line id="SvgjsLine2271" x1="0" y1="1"
                                                                x2="0" y2="90" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG2233"
                                                            class="apexcharts-bar-series apexcharts-plot-series">
                                                            <g id="SvgjsG2234" class="apexcharts-series"
                                                                rel="1" seriesName="seriesx1"
                                                                data:realIndex="0">
                                                                <path id="SvgjsPath2238"
                                                                    d="M 5.178571428571429 88L 5.178571428571429 65Q 5.178571428571429 63 7.178571428571429 63L 13.535714285714286 63Q 15.535714285714286 63 15.535714285714286 65L 15.535714285714286 65L 15.535714285714286 88Q 15.535714285714286 90 13.535714285714286 90L 7.178571428571429 90Q 5.178571428571429 90 5.178571428571429 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 5.178571428571429 88L 5.178571428571429 65Q 5.178571428571429 63 7.178571428571429 63L 13.535714285714286 63Q 15.535714285714286 63 15.535714285714286 65L 15.535714285714286 65L 15.535714285714286 88Q 15.535714285714286 90 13.535714285714286 90L 7.178571428571429 90Q 5.178571428571429 90 5.178571428571429 88z"
                                                                    pathFrom="M 5.178571428571429 88L 5.178571428571429 88L 15.535714285714286 88L 15.535714285714286 88L 15.535714285714286 88L 15.535714285714286 88L 15.535714285714286 88L 5.178571428571429 88"
                                                                    cy="63" cx="25.892857142857146" j="0"
                                                                    val="30" barHeight="27"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2240"
                                                                    d="M 25.892857142857146 88L 25.892857142857146 42.5Q 25.892857142857146 40.5 27.892857142857146 40.5L 34.25 40.5Q 36.25 40.5 36.25 42.5L 36.25 42.5L 36.25 88Q 36.25 90 34.25 90L 27.892857142857146 90Q 25.892857142857146 90 25.892857142857146 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 25.892857142857146 88L 25.892857142857146 42.5Q 25.892857142857146 40.5 27.892857142857146 40.5L 34.25 40.5Q 36.25 40.5 36.25 42.5L 36.25 42.5L 36.25 88Q 36.25 90 34.25 90L 27.892857142857146 90Q 25.892857142857146 90 25.892857142857146 88z"
                                                                    pathFrom="M 25.892857142857146 88L 25.892857142857146 88L 36.25 88L 36.25 88L 36.25 88L 36.25 88L 36.25 88L 25.892857142857146 88"
                                                                    cy="40.5" cx="46.60714285714286" j="1"
                                                                    val="55" barHeight="49.5"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2242"
                                                                    d="M 46.60714285714286 88L 46.60714285714286 51.5Q 46.60714285714286 49.5 48.60714285714286 49.5L 54.96428571428572 49.5Q 56.96428571428572 49.5 56.96428571428572 51.5L 56.96428571428572 51.5L 56.96428571428572 88Q 56.96428571428572 90 54.96428571428572 90L 48.60714285714286 90Q 46.60714285714286 90 46.60714285714286 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 46.60714285714286 88L 46.60714285714286 51.5Q 46.60714285714286 49.5 48.60714285714286 49.5L 54.96428571428572 49.5Q 56.96428571428572 49.5 56.96428571428572 51.5L 56.96428571428572 51.5L 56.96428571428572 88Q 56.96428571428572 90 54.96428571428572 90L 48.60714285714286 90Q 46.60714285714286 90 46.60714285714286 88z"
                                                                    pathFrom="M 46.60714285714286 88L 46.60714285714286 88L 56.96428571428572 88L 56.96428571428572 88L 56.96428571428572 88L 56.96428571428572 88L 56.96428571428572 88L 46.60714285714286 88"
                                                                    cy="49.5" cx="67.32142857142858" j="2"
                                                                    val="45" barHeight="40.5"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2244"
                                                                    d="M 67.32142857142858 88L 67.32142857142858 6.5Q 67.32142857142858 4.5 69.32142857142858 4.5L 75.67857142857144 4.5Q 77.67857142857144 4.5 77.67857142857144 6.5L 77.67857142857144 6.5L 77.67857142857144 88Q 77.67857142857144 90 75.67857142857144 90L 69.32142857142858 90Q 67.32142857142858 90 67.32142857142858 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 67.32142857142858 88L 67.32142857142858 6.5Q 67.32142857142858 4.5 69.32142857142858 4.5L 75.67857142857144 4.5Q 77.67857142857144 4.5 77.67857142857144 6.5L 77.67857142857144 6.5L 77.67857142857144 88Q 77.67857142857144 90 75.67857142857144 90L 69.32142857142858 90Q 67.32142857142858 90 67.32142857142858 88z"
                                                                    pathFrom="M 67.32142857142858 88L 67.32142857142858 88L 77.67857142857144 88L 77.67857142857144 88L 77.67857142857144 88L 77.67857142857144 88L 77.67857142857144 88L 67.32142857142858 88"
                                                                    cy="4.5" cx="88.0357142857143" j="3"
                                                                    val="95" barHeight="85.5"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2246"
                                                                    d="M 88.0357142857143 88L 88.0357142857143 29Q 88.0357142857143 27 90.0357142857143 27L 96.39285714285717 27Q 98.39285714285717 27 98.39285714285717 29L 98.39285714285717 29L 98.39285714285717 88Q 98.39285714285717 90 96.39285714285717 90L 90.0357142857143 90Q 88.0357142857143 90 88.0357142857143 88z"
                                                                    fill="rgba(253,172,65,0.85)" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 88.0357142857143 88L 88.0357142857143 29Q 88.0357142857143 27 90.0357142857143 27L 96.39285714285717 27Q 98.39285714285717 27 98.39285714285717 29L 98.39285714285717 29L 98.39285714285717 88Q 98.39285714285717 90 96.39285714285717 90L 90.0357142857143 90Q 88.0357142857143 90 88.0357142857143 88z"
                                                                    pathFrom="M 88.0357142857143 88L 88.0357142857143 88L 98.39285714285717 88L 98.39285714285717 88L 98.39285714285717 88L 98.39285714285717 88L 98.39285714285717 88L 88.0357142857143 88"
                                                                    cy="27" cx="108.75000000000003" j="4"
                                                                    val="70" barHeight="63"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2248"
                                                                    d="M 108.75000000000003 88L 108.75000000000003 47Q 108.75000000000003 45 110.75000000000003 45L 117.10714285714289 45Q 119.10714285714289 45 119.10714285714289 47L 119.10714285714289 47L 119.10714285714289 88Q 119.10714285714289 90 117.10714285714289 90L 110.75000000000003 90Q 108.75000000000003 90 108.75000000000003 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 108.75000000000003 88L 108.75000000000003 47Q 108.75000000000003 45 110.75000000000003 45L 117.10714285714289 45Q 119.10714285714289 45 119.10714285714289 47L 119.10714285714289 47L 119.10714285714289 88Q 119.10714285714289 90 117.10714285714289 90L 110.75000000000003 90Q 108.75000000000003 90 108.75000000000003 88z"
                                                                    pathFrom="M 108.75000000000003 88L 108.75000000000003 88L 119.10714285714289 88L 119.10714285714289 88L 119.10714285714289 88L 119.10714285714289 88L 119.10714285714289 88L 108.75000000000003 88"
                                                                    cy="45" cx="129.46428571428575" j="5"
                                                                    val="50" barHeight="45"
                                                                    barWidth="10.357142857142858"></path>
                                                                <path id="SvgjsPath2250"
                                                                    d="M 129.46428571428575 88L 129.46428571428575 33.5Q 129.46428571428575 31.5 131.46428571428575 31.5L 137.8214285714286 31.5Q 139.8214285714286 31.5 139.8214285714286 33.5L 139.8214285714286 33.5L 139.8214285714286 88Q 139.8214285714286 90 137.8214285714286 90L 131.46428571428575 90Q 129.46428571428575 90 129.46428571428575 88z"
                                                                    fill="#fdac4129" fill-opacity="1"
                                                                    stroke-opacity="1" stroke-linecap="round"
                                                                    stroke-width="0" stroke-dasharray="0"
                                                                    class="apexcharts-bar-area" index="0"
                                                                    clip-path="url(#gridRectMaskmfbxzia1)"
                                                                    pathTo="M 129.46428571428575 88L 129.46428571428575 33.5Q 129.46428571428575 31.5 131.46428571428575 31.5L 137.8214285714286 31.5Q 139.8214285714286 31.5 139.8214285714286 33.5L 139.8214285714286 33.5L 139.8214285714286 88Q 139.8214285714286 90 137.8214285714286 90L 131.46428571428575 90Q 129.46428571428575 90 129.46428571428575 88z"
                                                                    pathFrom="M 129.46428571428575 88L 129.46428571428575 88L 139.8214285714286 88L 139.8214285714286 88L 139.8214285714286 88L 139.8214285714286 88L 139.8214285714286 88L 129.46428571428575 88"
                                                                    cy="31.5" cx="150.17857142857147" j="6"
                                                                    val="65" barHeight="58.5"
                                                                    barWidth="10.357142857142858"></path>
                                                                <g id="SvgjsG2236" class="apexcharts-bar-goals-markers"
                                                                    style="pointer-events: none">
                                                                    <g id="SvgjsG2237"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2239"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2241"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2243"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2245"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2247"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                    <g id="SvgjsG2249"
                                                                        className="apexcharts-bar-goals-groups"></g>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG2235" class="apexcharts-datalabels"
                                                                data:realIndex="0"></g>
                                                        </g>
                                                        <line id="SvgjsLine2273" x1="0" y1="0"
                                                            x2="145" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1"
                                                            stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                                        <line id="SvgjsLine2274" x1="0" y1="0"
                                                            x2="145" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                        <g id="SvgjsG2275" class="apexcharts-yaxis-annotations"></g>
                                                        <g id="SvgjsG2276" class="apexcharts-xaxis-annotations"></g>
                                                        <g id="SvgjsG2277" class="apexcharts-point-annotations"></g>
                                                    </g>
                                                    <g id="SvgjsG2260" class="apexcharts-yaxis" rel="0"
                                                        transform="translate(-8, 0)">
                                                        <g id="SvgjsG2261" class="apexcharts-yaxis-texts-g"></g>
                                                    </g>
                                                    <g id="SvgjsG2224" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend" style="max-height: 47.5px;"></div>
                                                <div class="apexcharts-tooltip apexcharts-theme-light">
                                                    <div class="apexcharts-tooltip-title"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    </div>
                                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                            class="apexcharts-tooltip-marker"
                                                            style="background-color: rgba(253, 172, 65, 0.16);"></span>
                                                        <div class="apexcharts-tooltip-text"
                                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                            <div class="apexcharts-tooltip-y-group"><span
                                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                                            <div class="apexcharts-tooltip-goals-group"><span
                                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                                    class="apexcharts-tooltip-text-goals-value"></span>
                                                            </div>
                                                            <div class="apexcharts-tooltip-z-group"><span
                                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                    <div class="apexcharts-yaxistooltip-text"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 377px; height: 111px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Profit Report & Registration -->

                <!-- Sales -->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-start justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Sales</h5>
                                <small class="card-subtitle text-muted">Calculated in last 7 days</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="salesReport" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesReport">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="position: relative;">
                            <div id="salesChart" style="min-height: 120px;">
                                <div id="apexcharts11p740ypj"
                                    class="apexcharts-canvas apexcharts11p740ypj apexcharts-theme-light"
                                    style="width: 376px; height: 120px;"><svg id="SvgjsSvg2278" width="376"
                                        height="120" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG2280" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(-2, 0)">
                                            <defs id="SvgjsDefs2279">
                                                <linearGradient id="SvgjsLinearGradient2283" x1="0"
                                                    y1="0" x2="0" y2="1">
                                                    <stop id="SvgjsStop2284" stop-opacity="0.4"
                                                        stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                    <stop id="SvgjsStop2285" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                    <stop id="SvgjsStop2286" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                </linearGradient>
                                                <clipPath id="gridRectMask11p740ypj">
                                                    <rect id="SvgjsRect2288" width="372" height="70.72999999999999"
                                                        x="-2" y="0" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMask11p740ypj"></clipPath>
                                                <clipPath id="nonForecastMask11p740ypj"></clipPath>
                                                <clipPath id="gridRectMarkerMask11p740ypj">
                                                    <rect id="SvgjsRect2289" width="372" height="74.72999999999999"
                                                        x="-2" y="-2" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fff"></rect>
                                                </clipPath>
                                            </defs>
                                            <rect id="SvgjsRect2287" width="7.885714285714285"
                                                height="70.72999999999999" x="0" y="0" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke-dasharray="3"
                                                fill="url(#SvgjsLinearGradient2283)" class="apexcharts-xcrosshairs"
                                                y2="70.72999999999999" filter="none" fill-opacity="0.9"></rect>
                                            <g id="SvgjsG2315" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG2316" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"><text id="SvgjsText2318"
                                                        font-family="Helvetica, Arial, sans-serif" x="26.285714285714285"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2319">S</tspan>
                                                        <title>S</title>
                                                    </text><text id="SvgjsText2321"
                                                        font-family="Helvetica, Arial, sans-serif" x="78.85714285714286"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2322">M</tspan>
                                                        <title>M</title>
                                                    </text><text id="SvgjsText2324"
                                                        font-family="Helvetica, Arial, sans-serif" x="131.42857142857144"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2325">T</tspan>
                                                        <title>T</title>
                                                    </text><text id="SvgjsText2327"
                                                        font-family="Helvetica, Arial, sans-serif" x="184"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2328">W</tspan>
                                                        <title>W</title>
                                                    </text><text id="SvgjsText2330"
                                                        font-family="Helvetica, Arial, sans-serif" x="236.57142857142856"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2331">T</tspan>
                                                        <title>T</title>
                                                    </text><text id="SvgjsText2333"
                                                        font-family="Helvetica, Arial, sans-serif" x="289.1428571428571"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2334">F</tspan>
                                                        <title>F</title>
                                                    </text><text id="SvgjsText2336"
                                                        font-family="Helvetica, Arial, sans-serif" x="341.71428571428567"
                                                        y="99.72999999999999" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="13px" font-weight="400"
                                                        fill="#a8b1bb" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2337">S</tspan>
                                                        <title>S</title>
                                                    </text></g>
                                            </g>
                                            <g id="SvgjsG2340" class="apexcharts-grid">
                                                <g id="SvgjsG2341" class="apexcharts-gridlines-horizontal"
                                                    style="display: none;">
                                                    <line id="SvgjsLine2343" x1="0" y1="0"
                                                        x2="368" y2="0" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2344" x1="0" y1="14.145999999999997"
                                                        x2="368" y2="14.145999999999997" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2345" x1="0" y1="28.291999999999994"
                                                        x2="368" y2="28.291999999999994" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2346" x1="0" y1="42.43799999999999"
                                                        x2="368" y2="42.43799999999999" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2347" x1="0" y1="56.58399999999999"
                                                        x2="368" y2="56.58399999999999" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2348" x1="0" y1="70.72999999999999"
                                                        x2="368" y2="70.72999999999999" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <g id="SvgjsG2342" class="apexcharts-gridlines-vertical"
                                                    style="display: none;"></g>
                                                <line id="SvgjsLine2350" x1="0" y1="70.72999999999999"
                                                    x2="368" y2="70.72999999999999" stroke="transparent"
                                                    stroke-dasharray="0" stroke-linecap="butt"></line>
                                                <line id="SvgjsLine2349" x1="0" y1="1"
                                                    x2="0" y2="70.72999999999999" stroke="transparent"
                                                    stroke-dasharray="0" stroke-linecap="butt"></line>
                                            </g>
                                            <g id="SvgjsG2290" class="apexcharts-bar-series apexcharts-plot-series">
                                                <g id="SvgjsG2291" class="apexcharts-series" rel="1"
                                                    seriesName="seriesx1" data:realIndex="0">
                                                    <rect id="SvgjsRect2294" width="7.885714285714285"
                                                        height="70.72999999999999" x="22.34285714285714" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2296"
                                                        d="M 22.34285714285714 65.72999999999999L 22.34285714285714 33.291999999999994Q 22.34285714285714 28.291999999999994 27.34285714285714 28.291999999999994L 25.228571428571428 28.291999999999994Q 30.228571428571428 28.291999999999994 30.228571428571428 33.291999999999994L 30.228571428571428 33.291999999999994L 30.228571428571428 65.72999999999999Q 30.228571428571428 70.72999999999999 25.228571428571428 70.72999999999999L 27.34285714285714 70.72999999999999Q 22.34285714285714 70.72999999999999 22.34285714285714 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 22.34285714285714 65.72999999999999L 22.34285714285714 33.291999999999994Q 22.34285714285714 28.291999999999994 27.34285714285714 28.291999999999994L 25.228571428571428 28.291999999999994Q 30.228571428571428 28.291999999999994 30.228571428571428 33.291999999999994L 30.228571428571428 33.291999999999994L 30.228571428571428 65.72999999999999Q 30.228571428571428 70.72999999999999 25.228571428571428 70.72999999999999L 27.34285714285714 70.72999999999999Q 22.34285714285714 70.72999999999999 22.34285714285714 65.72999999999999z"
                                                        pathFrom="M 22.34285714285714 65.72999999999999L 22.34285714285714 65.72999999999999L 30.228571428571428 65.72999999999999L 30.228571428571428 65.72999999999999L 30.228571428571428 65.72999999999999L 30.228571428571428 65.72999999999999L 30.228571428571428 65.72999999999999L 22.34285714285714 65.72999999999999"
                                                        cy="28.291999999999994" cx="74.91428571428571" j="0"
                                                        val="60" barHeight="42.437999999999995"
                                                        barWidth="7.885714285714285"></path>
                                                    <rect id="SvgjsRect2297" width="7.885714285714285"
                                                        height="70.72999999999999" x="74.91428571428571" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2299"
                                                        d="M 74.91428571428571 65.72999999999999L 74.91428571428571 50.97449999999999Q 74.91428571428571 45.97449999999999 79.91428571428571 45.97449999999999L 77.8 45.97449999999999Q 82.8 45.97449999999999 82.8 50.97449999999999L 82.8 50.97449999999999L 82.8 65.72999999999999Q 82.8 70.72999999999999 77.8 70.72999999999999L 79.91428571428571 70.72999999999999Q 74.91428571428571 70.72999999999999 74.91428571428571 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 74.91428571428571 65.72999999999999L 74.91428571428571 50.97449999999999Q 74.91428571428571 45.97449999999999 79.91428571428571 45.97449999999999L 77.8 45.97449999999999Q 82.8 45.97449999999999 82.8 50.97449999999999L 82.8 50.97449999999999L 82.8 65.72999999999999Q 82.8 70.72999999999999 77.8 70.72999999999999L 79.91428571428571 70.72999999999999Q 74.91428571428571 70.72999999999999 74.91428571428571 65.72999999999999z"
                                                        pathFrom="M 74.91428571428571 65.72999999999999L 74.91428571428571 65.72999999999999L 82.8 65.72999999999999L 82.8 65.72999999999999L 82.8 65.72999999999999L 82.8 65.72999999999999L 82.8 65.72999999999999L 74.91428571428571 65.72999999999999"
                                                        cy="45.97449999999999" cx="127.48571428571428" j="1"
                                                        val="35" barHeight="24.755499999999998"
                                                        barWidth="7.885714285714285"></path>
                                                    <rect id="SvgjsRect2300" width="7.885714285714285"
                                                        height="70.72999999999999" x="127.48571428571428" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2302"
                                                        d="M 127.48571428571428 65.72999999999999L 127.48571428571428 58.04749999999999Q 127.48571428571428 53.04749999999999 132.48571428571427 53.04749999999999L 130.37142857142857 53.04749999999999Q 135.37142857142857 53.04749999999999 135.37142857142857 58.04749999999999L 135.37142857142857 58.04749999999999L 135.37142857142857 65.72999999999999Q 135.37142857142857 70.72999999999999 130.37142857142857 70.72999999999999L 132.48571428571427 70.72999999999999Q 127.48571428571428 70.72999999999999 127.48571428571428 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 127.48571428571428 65.72999999999999L 127.48571428571428 58.04749999999999Q 127.48571428571428 53.04749999999999 132.48571428571427 53.04749999999999L 130.37142857142857 53.04749999999999Q 135.37142857142857 53.04749999999999 135.37142857142857 58.04749999999999L 135.37142857142857 58.04749999999999L 135.37142857142857 65.72999999999999Q 135.37142857142857 70.72999999999999 130.37142857142857 70.72999999999999L 132.48571428571427 70.72999999999999Q 127.48571428571428 70.72999999999999 127.48571428571428 65.72999999999999z"
                                                        pathFrom="M 127.48571428571428 65.72999999999999L 127.48571428571428 65.72999999999999L 135.37142857142857 65.72999999999999L 135.37142857142857 65.72999999999999L 135.37142857142857 65.72999999999999L 135.37142857142857 65.72999999999999L 135.37142857142857 65.72999999999999L 127.48571428571428 65.72999999999999"
                                                        cy="53.04749999999999" cx="180.05714285714285" j="2"
                                                        val="25" barHeight="17.682499999999997"
                                                        barWidth="7.885714285714285"></path>
                                                    <rect id="SvgjsRect2303" width="7.885714285714285"
                                                        height="70.72999999999999" x="180.05714285714285" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2305"
                                                        d="M 180.05714285714285 65.72999999999999L 180.05714285714285 22.682499999999997Q 180.05714285714285 17.682499999999997 185.05714285714285 17.682499999999997L 182.94285714285712 17.682499999999997Q 187.94285714285712 17.682499999999997 187.94285714285712 22.682499999999997L 187.94285714285712 22.682499999999997L 187.94285714285712 65.72999999999999Q 187.94285714285712 70.72999999999999 182.94285714285712 70.72999999999999L 185.05714285714285 70.72999999999999Q 180.05714285714285 70.72999999999999 180.05714285714285 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 180.05714285714285 65.72999999999999L 180.05714285714285 22.682499999999997Q 180.05714285714285 17.682499999999997 185.05714285714285 17.682499999999997L 182.94285714285712 17.682499999999997Q 187.94285714285712 17.682499999999997 187.94285714285712 22.682499999999997L 187.94285714285712 22.682499999999997L 187.94285714285712 65.72999999999999Q 187.94285714285712 70.72999999999999 182.94285714285712 70.72999999999999L 185.05714285714285 70.72999999999999Q 180.05714285714285 70.72999999999999 180.05714285714285 65.72999999999999z"
                                                        pathFrom="M 180.05714285714285 65.72999999999999L 180.05714285714285 65.72999999999999L 187.94285714285712 65.72999999999999L 187.94285714285712 65.72999999999999L 187.94285714285712 65.72999999999999L 187.94285714285712 65.72999999999999L 187.94285714285712 65.72999999999999L 180.05714285714285 65.72999999999999"
                                                        cy="17.682499999999997" cx="232.62857142857143" j="3"
                                                        val="75" barHeight="53.04749999999999"
                                                        barWidth="7.885714285714285"></path>
                                                    <rect id="SvgjsRect2306" width="7.885714285714285"
                                                        height="70.72999999999999" x="232.62857142857143" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2308"
                                                        d="M 232.62857142857143 65.72999999999999L 232.62857142857143 65.12049999999999Q 232.62857142857143 60.12049999999999 237.62857142857143 60.12049999999999L 235.5142857142857 60.12049999999999Q 240.5142857142857 60.12049999999999 240.5142857142857 65.12049999999999L 240.5142857142857 65.12049999999999L 240.5142857142857 65.72999999999999Q 240.5142857142857 70.72999999999999 235.5142857142857 70.72999999999999L 237.62857142857143 70.72999999999999Q 232.62857142857143 70.72999999999999 232.62857142857143 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 232.62857142857143 65.72999999999999L 232.62857142857143 65.12049999999999Q 232.62857142857143 60.12049999999999 237.62857142857143 60.12049999999999L 235.5142857142857 60.12049999999999Q 240.5142857142857 60.12049999999999 240.5142857142857 65.12049999999999L 240.5142857142857 65.12049999999999L 240.5142857142857 65.72999999999999Q 240.5142857142857 70.72999999999999 235.5142857142857 70.72999999999999L 237.62857142857143 70.72999999999999Q 232.62857142857143 70.72999999999999 232.62857142857143 65.72999999999999z"
                                                        pathFrom="M 232.62857142857143 65.72999999999999L 232.62857142857143 65.72999999999999L 240.5142857142857 65.72999999999999L 240.5142857142857 65.72999999999999L 240.5142857142857 65.72999999999999L 240.5142857142857 65.72999999999999L 240.5142857142857 65.72999999999999L 232.62857142857143 65.72999999999999"
                                                        cy="60.12049999999999" cx="285.2" j="4" val="15"
                                                        barHeight="10.609499999999999" barWidth="7.885714285714285">
                                                    </path>
                                                    <rect id="SvgjsRect2309" width="7.885714285714285"
                                                        height="70.72999999999999" x="285.2" y="0" rx="5"
                                                        ry="5" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#5a8dee29"
                                                        class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2311"
                                                        d="M 285.2 65.72999999999999L 285.2 46.023399999999995Q 285.2 41.023399999999995 290.2 41.023399999999995L 288.0857142857143 41.023399999999995Q 293.0857142857143 41.023399999999995 293.0857142857143 46.023399999999995L 293.0857142857143 46.023399999999995L 293.0857142857143 65.72999999999999Q 293.0857142857143 70.72999999999999 288.0857142857143 70.72999999999999L 290.2 70.72999999999999Q 285.2 70.72999999999999 285.2 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 285.2 65.72999999999999L 285.2 46.023399999999995Q 285.2 41.023399999999995 290.2 41.023399999999995L 288.0857142857143 41.023399999999995Q 293.0857142857143 41.023399999999995 293.0857142857143 46.023399999999995L 293.0857142857143 46.023399999999995L 293.0857142857143 65.72999999999999Q 293.0857142857143 70.72999999999999 288.0857142857143 70.72999999999999L 290.2 70.72999999999999Q 285.2 70.72999999999999 285.2 65.72999999999999z"
                                                        pathFrom="M 285.2 65.72999999999999L 285.2 65.72999999999999L 293.0857142857143 65.72999999999999L 293.0857142857143 65.72999999999999L 293.0857142857143 65.72999999999999L 293.0857142857143 65.72999999999999L 293.0857142857143 65.72999999999999L 285.2 65.72999999999999"
                                                        cy="41.023399999999995" cx="337.77142857142854" j="5"
                                                        val="42" barHeight="29.706599999999998"
                                                        barWidth="7.885714285714285"></path>
                                                    <rect id="SvgjsRect2312" width="7.885714285714285"
                                                        height="70.72999999999999" x="337.77142857142854" y="0"
                                                        rx="5" ry="5" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#5a8dee29" class="apexcharts-backgroundBar"></rect>
                                                    <path id="SvgjsPath2314"
                                                        d="M 337.77142857142854 65.72999999999999L 337.77142857142854 15.609499999999997Q 337.77142857142854 10.609499999999997 342.77142857142854 10.609499999999997L 340.65714285714284 10.609499999999997Q 345.65714285714284 10.609499999999997 345.65714285714284 15.609499999999997L 345.65714285714284 15.609499999999997L 345.65714285714284 65.72999999999999Q 345.65714285714284 70.72999999999999 340.65714285714284 70.72999999999999L 342.77142857142854 70.72999999999999Q 337.77142857142854 70.72999999999999 337.77142857142854 65.72999999999999z"
                                                        fill="rgba(90,141,238,0.85)" fill-opacity="1"
                                                        stroke-opacity="1" stroke-linecap="round" stroke-width="0"
                                                        stroke-dasharray="0" class="apexcharts-bar-area"
                                                        index="0" clip-path="url(#gridRectMask11p740ypj)"
                                                        pathTo="M 337.77142857142854 65.72999999999999L 337.77142857142854 15.609499999999997Q 337.77142857142854 10.609499999999997 342.77142857142854 10.609499999999997L 340.65714285714284 10.609499999999997Q 345.65714285714284 10.609499999999997 345.65714285714284 15.609499999999997L 345.65714285714284 15.609499999999997L 345.65714285714284 65.72999999999999Q 345.65714285714284 70.72999999999999 340.65714285714284 70.72999999999999L 342.77142857142854 70.72999999999999Q 337.77142857142854 70.72999999999999 337.77142857142854 65.72999999999999z"
                                                        pathFrom="M 337.77142857142854 65.72999999999999L 337.77142857142854 65.72999999999999L 345.65714285714284 65.72999999999999L 345.65714285714284 65.72999999999999L 345.65714285714284 65.72999999999999L 345.65714285714284 65.72999999999999L 345.65714285714284 65.72999999999999L 337.77142857142854 65.72999999999999"
                                                        cy="10.609499999999997" cx="390.3428571428571" j="6"
                                                        val="85" barHeight="60.12049999999999"
                                                        barWidth="7.885714285714285"></path>
                                                    <g id="SvgjsG2293" class="apexcharts-bar-goals-markers"
                                                        style="pointer-events: none">
                                                        <g id="SvgjsG2295" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2298" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2301" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2304" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2307" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2310" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG2313" className="apexcharts-bar-goals-groups"></g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG2292" class="apexcharts-datalabels" data:realIndex="0">
                                                </g>
                                            </g>
                                            <line id="SvgjsLine2351" x1="0" y1="0" x2="368"
                                                y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                                stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine2352" x1="0" y1="0" x2="368"
                                                y2="0" stroke-dasharray="0" stroke-width="0"
                                                stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG2353" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG2354" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG2355" class="apexcharts-point-annotations"></g>
                                        </g>
                                        <g id="SvgjsG2338" class="apexcharts-yaxis" rel="0"
                                            transform="translate(-8, 0)">
                                            <g id="SvgjsG2339" class="apexcharts-yaxis-texts-g"></g>
                                        </g>
                                        <g id="SvgjsG2281" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend" style="max-height: 60px;"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-light">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(90, 141, 238);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-3">
                                    <span class="text-primary me-2"><i class="bx bx-up-arrow-alt bx-sm"></i></span>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0 lh-1">Best Selling</h6>
                                            <small class="text-muted">Saturday</small>
                                        </div>
                                        <div class="item-progress">28.6k</div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <span class="text-secondary me-2"><i class="bx bx-down-arrow-alt bx-sm"></i></span>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0 lh-1">Lowest Selling</h6>
                                            <small class="text-muted">Thursday</small>
                                        </div>
                                        <div class="item-progress">7.9k</div>
                                    </div>
                                </li>
                            </ul>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 421px; height: 233px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales -->

                <!-- Growth Chart-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
                    <div class="card">
                        <div class="card-body text-center" style="position: relative;">
                            <div class="dropdown mb-4">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButtonSec" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    2020
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonSec">
                                    <a class="dropdown-item" href="javascript:void(0);">2022</a>
                                    <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                    <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                </div>
                            </div>
                            <div id="growthRadialChart" style="min-height: 157.575px;">
                                <div id="apexchartsewhkeoei"
                                    class="apexcharts-canvas apexchartsewhkeoei apexcharts-theme-light"
                                    style="width: 376px; height: 157.575px;"><svg id="SvgjsSvg2356" width="376"
                                        height="157.57500000000002" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG2358" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(86, -15)">
                                            <defs id="SvgjsDefs2357">
                                                <clipPath id="gridRectMaskewhkeoei">
                                                    <rect id="SvgjsRect2360" width="212" height="255" x="-3"
                                                        y="-1" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMaskewhkeoei"></clipPath>
                                                <clipPath id="nonForecastMaskewhkeoei"></clipPath>
                                                <clipPath id="gridRectMarkerMaskewhkeoei">
                                                    <rect id="SvgjsRect2361" width="210" height="257" x="-2"
                                                        y="-2" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fff"></rect>
                                                </clipPath>
                                                <linearGradient id="SvgjsLinearGradient2366" x1="0"
                                                    y1="1" x2="1" y2="1">
                                                    <stop id="SvgjsStop2367" stop-opacity="1"
                                                        stop-color="rgba(90,141,238,1)" offset="0"></stop>
                                                    <stop id="SvgjsStop2368" stop-opacity="1"
                                                        stop-color="rgba(255,255,255,1)" offset="1"></stop>
                                                    <stop id="SvgjsStop2369" stop-opacity="1"
                                                        stop-color="rgba(255,255,255,1)" offset="1"></stop>
                                                </linearGradient>
                                                <linearGradient id="SvgjsLinearGradient2377" x1="0"
                                                    y1="1" x2="1" y2="1">
                                                    <stop id="SvgjsStop2378" stop-opacity="1"
                                                        stop-color="rgba(90,141,238,1)" offset="0"></stop>
                                                    <stop id="SvgjsStop2379" stop-opacity="1"
                                                        stop-color="rgba(255,91,92,1)" offset="1"></stop>
                                                    <stop id="SvgjsStop2380" stop-opacity="1"
                                                        stop-color="rgba(255,91,92,1)" offset="1"></stop>
                                                </linearGradient>
                                            </defs>
                                            <g id="SvgjsG2362" class="apexcharts-radialbar">
                                                <g id="SvgjsG2363">
                                                    <g id="SvgjsG2364" class="apexcharts-tracks">
                                                        <g id="SvgjsG2365"
                                                            class="apexcharts-radialbar-track apexcharts-track"
                                                            rel="1">
                                                            <path id="apexcharts-radialbarTrack-0"
                                                                d="M 56.968642032770106 149.0313579672299 A 65.09817073170733 65.09817073170733 0 1 1 149.0313579672299 149.0313579672299"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(255,255,255,0.85)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="8.129878048780489"
                                                                stroke-dasharray="0" class="apexcharts-radialbar-area"
                                                                data:pathOrig="M 56.968642032770106 149.0313579672299 A 65.09817073170733 65.09817073170733 0 1 1 149.0313579672299 149.0313579672299">
                                                            </path>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG2371">
                                                        <g id="SvgjsG2376"
                                                            class="apexcharts-series apexcharts-radial-series"
                                                            seriesName="Growth" rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath2381"
                                                                d="M 56.968642032770106 149.0313579672299 A 65.09817073170733 65.09817073170733 0 1 1 166.16447684936077 87.25132713651456"
                                                                fill="none" fill-opacity="0.85"
                                                                stroke="url(#SvgjsLinearGradient2377)"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="16.259756097560977" stroke-dasharray="3"
                                                                class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                data:angle="211" data:value="78" index="0" j="0"
                                                                data:pathOrig="M 56.968642032770106 149.0313579672299 A 65.09817073170733 65.09817073170733 0 1 1 166.16447684936077 87.25132713651456">
                                                            </path>
                                                        </g>
                                                        <circle id="SvgjsCircle2372" r="56.033231707317086"
                                                            cx="103" cy="103"
                                                            class="apexcharts-radialbar-hollow" fill="transparent">
                                                        </circle>
                                                        <g id="SvgjsG2373" class="apexcharts-datalabels-group"
                                                            transform="translate(0, 0) scale(1)" style="opacity: 1;">
                                                            <text id="SvgjsText2374" font-family="IBM Plex Sans" x="103"
                                                                y="127" text-anchor="middle" dominant-baseline="auto"
                                                                font-size="15px" font-weight="500" fill="#677788"
                                                                class="apexcharts-text apexcharts-datalabel-label"
                                                                style="font-family: &quot;IBM Plex Sans&quot;;">Growth</text><text
                                                                id="SvgjsText2375" font-family="Rubik" x="103" y="104"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="26px" font-weight="500" fill="#516377"
                                                                class="apexcharts-text apexcharts-datalabel-value"
                                                                style="font-family: Rubik;">78%</text></g>
                                                    </g>
                                                </g>
                                            </g>
                                            <line id="SvgjsLine2382" x1="0" y1="0" x2="206"
                                                y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                                                stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine2383" x1="0" y1="0" x2="206"
                                                y2="0" stroke-dasharray="0" stroke-width="0"
                                                stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                                        </g>
                                        <g id="SvgjsG2359" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend"></div>
                                </div>
                            </div>
                            <h6 class="mb-0 mt-5"> 62% Growth in 2022</h6>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 421px; height: 317px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Growth Chart-->

                <!-- Finance Summary -->
                <div class="col-md-7 col-lg-7 mb-4 mb-md-0">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center me-3">
                                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle me-3"
                                    width="54">
                                <div class="card-title mb-0">
                                    <h5 class="mb-0">Financial Report for Kiara Cruiser</h5>
                                    <small class="text-muted">Awesome App for Project Management</small>
                                </div>
                            </div>
                            <div class="dropdown btn-pinned">
                                <button class="btn p-0" type="button" id="financoalReport"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="financoalReport">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-4 mb-5 mt-4">
                                <div class="d-flex flex-column me-2">
                                    <h6>Start Date</h6>
                                    <span class="badge bg-label-success">02 APR 22</span>
                                </div>
                                <div class="d-flex flex-column me-2">
                                    <h6>End Date</h6>
                                    <span class="badge bg-label-danger">06 MAY 22</span>
                                </div>
                                <div class="d-flex flex-column me-2">
                                    <h6>Members</h6>
                                    <ul class="list-unstyled me-2 d-flex align-items-center avatar-group mb-0">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                                            aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                            <img class="rounded-circle" src="../../assets/img/avatars/5.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                                            aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                                            <img class="rounded-circle" src="../../assets/img/avatars/12.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                                            aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                                            <img class="rounded-circle" src="../../assets/img/avatars/6.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                                            aria-label="Ellen Wagner" data-bs-original-title="Ellen Wagner">
                                            <img class="rounded-circle" src="../../assets/img/avatars/14.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            data-bs-placement="top" class="avatar avatar-xs pull-up"
                                            aria-label="Darcey Nooner" data-bs-original-title="Darcey Nooner">
                                            <img class="rounded-circle" src="../../assets/img/avatars/10.png"
                                                alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex flex-column me-2">
                                    <h6>Budget</h6>
                                    <span>$249k</span>
                                </div>
                                <div class="d-flex flex-column me-2">
                                    <h6>Expenses</h6>
                                    <span>$82k</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <span class="text-nowrap d-block mb-1">Kiara Cruiser Progress</span>
                                <div class="progress w-100 mb-3" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <span>I distinguish three main text objectives. First, your objective could be merely to inform
                                people. A second be to persuade people.</span>
                        </div>
                        <div class="card-footer border-top">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><i class="bx bx-check"></i> 74 Tasks</li>
                                <li class="list-inline-item"><i class="bx bx-chat"></i> 678 Comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Finance Summary -->

                <!-- Activity Timeline -->
                <div class="col-md-5 col-lg-5 mb-0">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Activity Timeline</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Activity Timeline -->
                            <ul class="timeline">
                                <li class="timeline-item timeline-item-transparent ps-4">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event pb-2">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">12 Invoices have been paid</h6>
                                            <small class="text-muted">12 min ago</small>
                                        </div>
                                        <p class="mb-2">Invoices have been paid to the company</p>
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="me-3">
                                                <img src="../../assets/img/icons/misc/pdf.png" alt="PDF image"
                                                    width="23" class="me-2">
                                                <span class="fw-bold text-body">Invoices.pdf</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent ps-4">
                                    <span class="timeline-point timeline-point-warning"></span>
                                    <div class="timeline-event pb-2">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Client Meeting</h6>
                                            <small class="text-muted">45 min ago</small>
                                        </div>
                                        <p class="mb-2">Project meeting with john @10:15am</p>
                                        <div class="d-flex flex-wrap">
                                            <div class="avatar me-3">
                                                <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">John Doe (Client)</h6>
                                                <span class="text-muted">CEO of Pixinvent</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent ps-4">
                                    <span class="timeline-point timeline-point-info"></span>
                                    <div class="timeline-event pb-0">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">Create a new project for client</h6>
                                            <small class="text-muted">2 Day Ago</small>
                                        </div>
                                        <p class="mb-2">5 team members in a project</p>
                                        <div class="d-flex align-items-center avatar-group">
                                            <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                                <img src="../../assets/img/avatars/5.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                aria-label="Marrie Patty" data-bs-original-title="Marrie Patty">
                                                <img src="../../assets/img/avatars/12.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                aria-label="Jimmy Jackson" data-bs-original-title="Jimmy Jackson">
                                                <img src="../../assets/img/avatars/9.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                aria-label="Kristine Gill" data-bs-original-title="Kristine Gill">
                                                <img src="../../assets/img/avatars/6.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                aria-label="Nelson Wilson" data-bs-original-title="Nelson Wilson">
                                                <img src="../../assets/img/avatars/14.png" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-end-indicator">
                                    <i class="bx bx-check-circle"></i>
                                </li>
                            </ul>
                            <!-- /Activity Timeline -->
                        </div>
                    </div>
                </div>
                <!--/ Activity Timeline -->
            </div>
        </div>
    </div>
@endsection
