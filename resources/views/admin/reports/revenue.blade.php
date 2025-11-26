@extends('layouts.webflow')

@section('title', 'Revenue Report')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Revenue Report</h1>
            <p class="text-muted">Financial Overview for {{ date('Y') }}</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline">
            <i class="fas fa-print"></i> Print
        </button>
    </div>

    <div class="card mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="card-title mb-0">Total Revenue (YTD)</h3>
                <p class="text-muted mb-0">All completed transactions</p>
            </div>
            <div class="text-primary" style="font-size: 2rem; font-weight: bold;">
                KSh {{ number_format($totalRevenue) }}
            </div>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title mb-3">Monthly Breakdown</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Revenue</th>
                    <th>Trend</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monthlyRevenue as $record)
                    <tr>
                        <td>{{ date('F', mktime(0, 0, 0, $record->month, 10)) }}</td>
                        <td>KSh {{ number_format($record->total) }}</td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> Positive
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">No revenue data available for this year.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
