<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3">
                <h5 class="timer" id="dynamic-timer"></h5>

                <script>
                    function formatTimeComponent(component) {
                        return component < 10 ? '0' + component : component;
                    }

                    function getCurrentTime() {
                        const now = new Date();
                        const day = formatTimeComponent(now.getDate());
                        const month = formatTimeComponent(now.getMonth() + 1);
                        const year = now.getFullYear();
                        const dayName = now.toLocaleString('default', { weekday: 'long' });
                        const hours = formatTimeComponent(now.getHours());
                        const minutes = formatTimeComponent(now.getMinutes());
                        const seconds = formatTimeComponent(now.getSeconds());

                        return `${day}:${month}:${year} / ${dayName} / ${hours}:${minutes}:${seconds}`;
                    }

                    function updateTimer() {
                        const timerElement = document.getElementById('dynamic-timer');
                        timerElement.textContent = getCurrentTime();
                    }

                    // Initial call to display time immediately
                    updateTimer();
                    // Update time every second
                    setInterval(updateTimer, 1000);
                </script>
            </div>
            <div class="col-xl-8 col-sm-5 box-col-4">
                <ol class="breadcrumb">
                    @foreach ($items as $item)
                        <li class="breadcrumb-item">
                            @if (isset($item['url']))
                                <a href="{{ $item['url'] }}">
                                    {{ $item['name'] }}
                                </a>
                            @else
                                {{ $item['name'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>

            </div>
        </div>
    </div>
</div>
