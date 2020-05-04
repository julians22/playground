<div>
    <div class="d-flex justify-content-center mt-4">
        <h5 class="d-block bg-dark text-white text-uppercase py-1 px-5 rounded-pill">Select Package</h5>
    </div>
    <div class="row mt-3 mb-5 justify-content-center">
        <div class="col-4">
            <button class="btn btn-outline-primary btn-block rounded-pill" wire:click="dedicatedCollect">Dedicated</button>
        </div>
        <div class="col-4">
            <button class="btn btn-outline-primary btn-block rounded-pill" wire:click="sohoCollect">Soho</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-7 col-sm-12 col-md-7">
            <div class="package">
                @foreach ($data as $item)
                    <div class="card">
                        <div style="width: 100%; height: 150px; overflow: hidden;">
                            <div class="package-gauge" id="container-speed-{{ $package->name }}-{{ $loop->iteration }}" width="100px" height="100px" data-value="{{ $item->speed }}"></div>
                        </div>
                        <h3>{{ $item->speed }}</h3>
                        <h3>{{ $package->name }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    document.addEventListener("livewire:load", function(event) {
        window.livewire.hook('beforeDomUpdate', () => {
            // Add your custom JavaScript here.
        });

        window.livewire.hook('afterDomUpdate', () => {
            $('.package').slick({
                slidesToShow: 3,
                infinite: false
            });

            var target = $('.package-gauge');
            for (let i = 0; i < target.length; i++) {
                const packageId = $('#'+target[i].id);
                const valueY = packageId.data("value");
                const valueT = valueY;
                packageId.highcharts({
                    chart: {
                        type: "solidgauge",
                        margin: [0, 0, 0, 0],
                        backgroundColor: "transparent"
                    },
                    title: null,
                    yAxis: {
                        min: 0,
                        max: 100,
                        lineWidth: 0,
                        tickPositions: [],
                        stops: [
                            [0.05, "#DF5353"], // red
                            [0.3, "#DDDF0D"], // yellow
                            [0.9, "#55BF3B"] // green
                        ]
                    },
                    pane: {
                        size: "70%",
                        center: ["50%", "20%"],
                        startAngle: -130,
                        endAngle: 130,
                        background: {
                            borderWidth: 10,
                            backgroundColor: "#DBDBDB",
                            shape: "arc",
                            borderColor: "#DBDBDB",
                            outerRadius: "100%",
                            innerRadius: "100%"
                        }
                    },
                    tooltip: {
                        enabled: false
                    },
                    plotOptions: {
                        solidgauge: {
                            borderColor: "#009CE8",
                            borderWidth: 10,
                            radius: 90,
                            innerRadius: "90%",
                            dataLabels: {
                                y: 5,
                                borderWidth: 0,
                                useHTML: true
                            }
                        }
                    },
                    series: [
                        {
                            name: "windSpeed",
                            data: [
                                {
                                    borderColor: "red",
                                    color: Highcharts.getOptions().colors[0],
                                    radius: "100%",
                                    innerRadius: "100%",
                                    y: valueY
                                }
                            ],
                            dataLabels: {
                                format:
                                    '<div style="Width: 50px; text-align: center; margin-top: -48px; font-family: \'Montserrat\'; color: black;"><span style="font-size: 18px; color: #2f2f2f; font-weight: 500;">Up to<br><b style="font-size: 25px;">' +
                                    valueT +
                                    "</b><br>Mbps</span></div>"
                            }
                        }
                    ],
                    credits: {
                        enabled: false
                    }
                },
                function(chart) {
                    var y = this.series[0].data[0].y;
                    for (var i = y; i >= 0; i = i - y / 80) {
                        chart.addSeries(
                            {
                                data: [
                                    {
                                        y: i,
                                        radius: "100%",
                                        innerRadius: "100%"
                                    }
                                ],
                                stickyTracking: true,
                                enableMouseTracking: false
                            },
                            false
                        );
                    }
                    chart.redraw();

                    Highcharts.each(chart.series, function(s) {
                        s.update(
                            {
                                borderColor: s.data[0].color
                            },
                            false
                        );
                    });
                    chart.redraw();
                })
            }

        });
    });
</script>
@endpush
