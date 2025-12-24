<?php
// Fetch Yahoo Finance chart data for a symbol
function fetchChartData($symbol) {
    $url = "https://query1.finance.yahoo.com/v8/finance/chart/{$symbol}?interval=1d&range=1y";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200 && $response) {
        return json_decode($response, true);
    }
    return null;
}

// Calculate percent change
function calcChange($prices, $days) {
    if (count($prices) < $days + 1) return null;
    $current = $prices[count($prices) - 1];
    $past = $prices[max(0, count($prices) - 1 - $days)];
    if (!$past) return null;
    return (($current - $past) / $past) * 100;
}

// ETF Configuration
$etfConfig = [
    'XEQT.TO' => ['symbol' => 'XEQT', 'name' => 'RRSP', 'color' => '#10b981'],
    'XGRO.TO' => ['symbol' => 'XGRO', 'name' => 'TFSA', 'color' => '#3b82f6'],
    'XBAL.TO' => ['symbol' => 'XBAL', 'name' => 'RESP', 'color' => '#f59e0b'],
    'XCNS.TO' => ['symbol' => 'XCNS', 'name' => 'Non-Reg', 'color' => '#8b5cf6'],
    '^GSPC' => ['symbol' => 'S&P', 'name' => 'S&P 500', 'color' => '#ef4444'],
];

// Fetch data for all ETFs
$etfData = [];
$historicalData = [];
$error = null;

foreach ($etfConfig as $yahooSymbol => $config) {
    $data = fetchChartData($yahooSymbol);
    
    if ($data && isset($data['chart']['result'][0])) {
        $chart = $data['chart']['result'][0];
        $closes = $chart['indicators']['quote'][0]['close'];
        $timestamps = $chart['timestamp'];
        
        // Filter out nulls
        $prices = [];
        $validTimestamps = [];
        foreach ($closes as $i => $price) {
            if ($price !== null) {
                $prices[] = $price;
                $validTimestamps[] = $timestamps[$i];
            }
        }
        
        if (count($prices) > 0) {
            $currentPrice = end($prices);

            $etfData[] = [
                'symbol' => $config['symbol'],
                'name' => $config['name'],
                'color' => $config['color'],
                'price' => $currentPrice,
                'day' => calcChange($prices, 1),
                'week' => calcChange($prices, 5),
                'month' => calcChange($prices, 21),
                'year' => calcChange($prices, min(252, count($prices) - 1)),
            ];
            
            // Normalize prices for chart (start at 100)
            $startPrice = $prices[0];
            $normalized = [];
            foreach ($validTimestamps as $i => $ts) {
                $normalized[] = [
                    'x' => $ts * 1000, // JavaScript timestamp
                    'y' => ($prices[$i] / $startPrice) * 100
                ];
            }
            $historicalData[$config['symbol']] = $normalized;
        }
    }
}

if (empty($etfData)) {
    $error = "Could not fetch ETF data from Yahoo Finance";
}

// Format percentage
function formatPct($val) {
    if ($val === null) return 'N/A';
    $sign = $val >= 0 ? '+' : '';
    return $sign . number_format($val, 1) . '%';
}

function pctClass($val) {
    if ($val === null) return '';
    return $val >= 0 ? 'positive' : 'negative';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>iShares ETF Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0e17;
            --bg-card: #151d2b;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --text-primary: #f9fafb;
            --text-secondary: #9ca3af;
            --text-muted: #6b7280;
            --border: #2d3748;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 12px;
            padding-top: max(12px, env(safe-area-inset-top));
            padding-bottom: max(12px, env(safe-area-inset-bottom));
        }
        header { text-align: center; margin-bottom: 10px; }
        h1 {
            font-size: 1.1rem;
            font-weight: 700;
            background: linear-gradient(135deg, #06b6d4 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .timestamp {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.6rem;
            color: var(--accent-green);
        }
        .live-dot {
            width: 6px;
            height: 6px;
            background: var(--accent-green);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--accent-red);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            color: var(--accent-red);
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
        .etf-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.7rem;
            margin-bottom: 10px;
            background: var(--bg-card);
            border-radius: 8px;
            overflow: hidden;
        }
        .etf-table th {
            background: #1a2332;
            padding: 6px 4px;
            text-align: center;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .etf-table th:first-child { text-align: left; padding-left: 8px; }
        .etf-table td {
            padding: 8px 4px;
            text-align: center;
            border-top: 1px solid var(--border);
            font-family: 'JetBrains Mono', monospace;
        }
        .etf-table td:first-child { text-align: left; padding-left: 8px; }
        .etf-symbol { font-weight: 700; font-size: 0.75rem; }
        .etf-symbol.xeqt { color: #10b981; }
        .etf-symbol.xgro { color: #3b82f6; }
        .etf-symbol.xbal { color: #f59e0b; }
        .etf-symbol.xcns { color: #8b5cf6; }
        .etf-symbol.sp { color: #ef4444; }
        .etf-meta { font-size: 0.55rem; color: var(--text-muted); font-family: 'Inter', sans-serif; }
        .price { font-weight: 600; font-size: 0.75rem; }
        .positive { color: var(--accent-green); }
        .negative { color: var(--accent-red); }
        .perf-cell { font-size: 0.68rem; font-weight: 500; }
        .chart-section { background: var(--bg-card); border-radius: 8px; padding: 10px; }
        .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
        .chart-title { font-size: 0.7rem; font-weight: 600; color: var(--text-secondary); }
        .chart-legend { display: flex; gap: 8px; }
        .legend-item { display: flex; align-items: center; gap: 3px; font-size: 0.55rem; color: var(--text-secondary); }
        .legend-dot { width: 6px; height: 6px; border-radius: 50%; }
        .chart-container { height: 180px; position: relative; }
        .footer-info { display: flex; justify-content: center; gap: 12px; margin-top: 8px; font-size: 0.55rem; color: var(--text-muted); }
    </style>
</head>
<body>
    <header>
        <h1>iShares Core ETF Portfolios</h1>
        <p class="timestamp">
            <span class="live-badge"><span class="live-dot"></span>LIVE</span>
            <?= date('M j, Y g:i A T') ?>
        </p>
    </header>

    <?php if ($error): ?>
        <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php else: ?>
        <table class="etf-table">
            <thead>
                <tr>
                    <th>ETF</th>
                    <th>Price</th>
                    <th>1D</th>
                    <th>1W</th>
                    <th>1M</th>
                    <th>1Y</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etfData as $etf): ?>
                <tr>
                    <td>
                        <div class="etf-symbol <?= preg_replace('/[^a-z0-9]/', '', strtolower($etf['symbol'])) ?>"><?= $etf['symbol'] ?></div>
                        <div class="etf-meta"><?= $etf['name'] ?></div>
                    </td>
                    <td class="price">$<?= number_format($etf['price'], 2) ?></td>
                    <td class="perf-cell <?= pctClass($etf['day']) ?>"><?= formatPct($etf['day']) ?></td>
                    <td class="perf-cell <?= pctClass($etf['week']) ?>"><?= formatPct($etf['week']) ?></td>
                    <td class="perf-cell <?= pctClass($etf['month']) ?>"><?= formatPct($etf['month']) ?></td>
                    <td class="perf-cell <?= pctClass($etf['year']) ?>"><?= formatPct($etf['year']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="chart-section">
            <div class="chart-header">
                <div class="chart-title">1-Year Performance (Normalized)</div>
                <div class="chart-legend">
                    <div class="legend-item"><div class="legend-dot" style="background:#10b981"></div>XEQT</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#3b82f6"></div>XGRO</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#f59e0b"></div>XBAL</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#8b5cf6"></div>XCNS</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#ef4444"></div>S&P</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="priceChart"></canvas>
            </div>
        </div>

        <div class="footer-info">
            <span>TSX Toronto</span>
            <span>•</span>
            <span>BlackRock iShares</span>
            <span>•</span>
            <span>MER: 0.20%</span>
        </div>

        <script>
            const historicalData = <?= json_encode($historicalData) ?>;
            const etfData = <?= json_encode($etfData) ?>;

            const ctx = document.getElementById('priceChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: etfData.map(etf => ({
                        label: etf.symbol,
                        data: historicalData[etf.symbol].map(p => ({ x: new Date(p.x), y: p.y })),
                        borderColor: etf.color,
                        borderWidth: 1.5,
                        fill: false,
                        tension: 0.4,
                        pointRadius: 0
                    }))
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a2332',
                            titleColor: '#f9fafb',
                            bodyColor: '#9ca3af',
                            titleFont: { size: 10 },
                            bodyFont: { size: 9, family: 'JetBrains Mono' },
                            padding: 8,
                            callbacks: {
                                title: (items) => items[0].raw.x.toLocaleDateString('en-CA', { month: 'short', day: 'numeric' }),
                                label: (ctx) => `${ctx.dataset.label}: ${(ctx.raw.y - 100).toFixed(1)}%`
                            }
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            time: { unit: 'month', displayFormats: { month: 'MMM' } },
                            grid: { color: '#2d3748', drawBorder: false },
                            ticks: { color: '#6b7280', font: { size: 8 }, maxTicksLimit: 6 }
                        },
                        y: {
                            grid: { color: '#2d3748', drawBorder: false },
                            ticks: { 
                                color: '#6b7280', 
                                font: { size: 8 },
                                callback: (v) => v === 100 ? '0%' : `${v > 100 ? '+' : ''}${(v-100).toFixed(0)}%`
                            }
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>
