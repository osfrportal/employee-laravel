<div class="col">
    <div class="card bg-body rounded shadow-sm text-center">
        <div class="card-header">Заявки ОЗИ за период 30 дней</div>
        <div class="card-body text-primary otrs-chart">
                <canvas id="OtrsOZICreatedTicketsChart">
                    <p>Заявки ОЗИ за период 30 дней</p>
                </canvas>
        </div>
    </div>
</div>
<div class="col">
    <!-- div class="my-3 p-3 bg-body rounded shadow-sm text-center otrs-chart" -->
    <div class="card bg-body rounded shadow-sm text-center">
        <div class="card-header">Заявки ИТ за период 30 дней</div>
        <div class="card-body text-primary otrs-chart">
                <canvas id="OtrsITCreatedTicketsChart">
                    <p>Заявки ИТ за период 30 дней</p>
                </canvas>
        </div>
    </div>
</div>

@push('footer-scripts')
<script type="module">
    <?php
    $route_api_ozi = route('osfrapi.osfrportal.admin.otrs.stats', ['otrs_graph_unit' => 'ozi']);
    $route_api_oit = route('osfrapi.osfrportal.admin.otrs.stats', ['otrs_graph_unit' => 'oit']);
    ?>
    var progress = document.getElementById('animationProgress');
    // Graphs
    const graph_options = {
        responsive: true,
        maintainAspectRatio: false,
        spanGaps: true,
        scales: {
            x: {
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'Дата',
                }
            },
            y: {
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Количество созданных заявок',
                },
                grid: {
                    drawTicks: true,
                },
                ticks: {
                    beginAtZero: true,
                }
            }
        },
        legend: {
            display: true,
            position: 'top',
        },
        plugins: {
            title: {
                display: true,
                text: '',
            }
        },
    };
    if (document.getElementById('OtrsOZICreatedTicketsChart')) {
            $.ajax({
                type: 'GET',
                url: '{{ $route_api_ozi }}',
                datatype: 'json',
                success: function (result) {
                    var ctx_ozi = document.getElementById('OtrsOZICreatedTicketsChart');
                    var mychart_ozi = new Chart(ctx_ozi,
                        {
                            type: 'line',
                            data: result,
                            options: graph_options
                        })
                }
            });
        };
        if (document.getElementById('OtrsITCreatedTicketsChart')) {
            $.ajax({
                type: 'GET',
                url: '{{ $route_api_oit }}',
                datatype: 'json',
                success: function (result) {
                    var ctx_it = document.getElementById('OtrsITCreatedTicketsChart');
                    var mychart_it = new Chart(ctx_it,
                        {
                            type: 'line',
                            data: result,
                            options: graph_options,
                        });
                }
            });
        };
    </script>

@endpush
