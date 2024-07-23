@extends('admin.layouts.app')

@section('title', 'Admin-Charts linegraph')

@section('content')

<style>
    /* Center the line chart */
    #chart-container {
        margin: 0 auto;
        text-align: center;
    }
</style>

<div id="linechart-container">
    <canvas id="lineChart"></canvas>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('public/js/piechart.js') }}"></script>
  
@endsection
